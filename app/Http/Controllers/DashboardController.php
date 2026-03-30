<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        // Base query : seulement les opportunités créées par l'utilisateur connecté
        $baseQuery = Opportunity::query()
            ->with('client')
            ->where('user_id', $user->id);

        // Cartes
        $myOpportunities = (clone $baseQuery)->count();

        $myOpenOpportunities = (clone $baseQuery)
            ->where('stage', '!=', 'Terminée')
            ->count();

        $myClosedOpportunities = (clone $baseQuery)
            ->where('stage', 'Terminée')
            ->count();

        $myUpcomingClosingsCount = (clone $baseQuery)
            ->where('stage', '!=', 'Terminée')
            ->whereNotNull('expected_closing_date')
            ->whereDate('expected_closing_date', '>=', today())
            ->count();

        $myMonthlyRevenue = DB::table('opportunity_product')
            ->join('opportunities', 'opportunities.id', '=', 'opportunity_product.opportunity_id')
            ->where('opportunities.user_id', $user->id)
            ->where('opportunities.stage', 'Terminée')
            ->whereYear('opportunities.expected_closing_date', now()->year)
            ->whereMonth('opportunities.expected_closing_date', now()->month)
            ->sum(DB::raw('opportunity_product.quantity * opportunity_product.unit_price'));

        // Mes prochaines clôtures
        $myUpcomingClosings = Opportunity::with('client')
            ->where('user_id', $user->id)
            ->where('stage', '!=', 'Terminée')
            ->whereNotNull('expected_closing_date')
            ->orderBy('expected_closing_date', 'asc')
            ->take(5)
            ->get();

        foreach ($myUpcomingClosings as $opportunity) {
            $opportunity->total_amount = DB::table('opportunity_product')
                ->where('opportunity_id', $opportunity->id)
                ->sum(DB::raw('quantity * unit_price'));
        }

        // Mes activités récentes
        $recentActivities = Opportunity::with('client')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get();

        // Mes meilleures opportunités ouvertes
        $myTopOpenOffers = DB::table('opportunities')
            ->leftJoin('clients', 'clients.id', '=', 'opportunities.client_id')
            ->leftJoin('opportunity_product', 'opportunity_product.opportunity_id', '=', 'opportunities.id')
            ->selectRaw("
                opportunities.id,
                opportunities.title,
                opportunities.stage,
                opportunities.expected_closing_date,
                clients.name as client_name,
                COALESCE(SUM(opportunity_product.quantity * opportunity_product.unit_price), 0) as total_amount
            ")
            ->where('opportunities.user_id', $user->id)
            ->where('opportunities.stage', '!=', 'Terminée')
            ->groupBy(
                'opportunities.id',
                'opportunities.title',
                'opportunities.stage',
                'opportunities.expected_closing_date',
                'clients.name'
            )
            ->orderByDesc('total_amount')
            ->take(5)
            ->get();

        // Répartition de mes opportunités par étape
        $pipelineByStage = Opportunity::select('stage', DB::raw('COUNT(*) as total'))
            ->where('user_id', $user->id)
            ->groupBy('stage')
            ->orderBy('total', 'desc')
            ->get();

        $pipelineLabels = $pipelineByStage->pluck('stage');
        $pipelineValues = $pipelineByStage->pluck('total');

        // Mon CA mensuel sur l'année en cours
        $revenueByMonthRaw = DB::table('opportunity_product')
            ->join('opportunities', 'opportunities.id', '=', 'opportunity_product.opportunity_id')
            ->selectRaw("
                MONTH(opportunities.expected_closing_date) as month_number,
                SUM(opportunity_product.quantity * opportunity_product.unit_price) as total
            ")
            ->where('opportunities.user_id', $user->id)
            ->where('opportunities.stage', 'Terminée')
            ->whereYear('opportunities.expected_closing_date', now()->year)
            ->groupByRaw('MONTH(opportunities.expected_closing_date)')
            ->orderByRaw('MONTH(opportunities.expected_closing_date)')
            ->get()
            ->keyBy('month_number');

        $monthNames = [
            1 => 'Jan', 2 => 'Fév', 3 => 'Mar', 4 => 'Avr',
            5 => 'Mai', 6 => 'Juin', 7 => 'Juil', 8 => 'Août',
            9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Déc'
        ];

        $revenueLabels = [];
        $revenueValues = [];

        for ($i = 1; $i <= 12; $i++) {
            $revenueLabels[] = $monthNames[$i];
            $revenueValues[] = isset($revenueByMonthRaw[$i]) ? (float) $revenueByMonthRaw[$i]->total : 0;
        }

        return view('home', compact(
            'myOpportunities',
            'myOpenOpportunities',
            'myClosedOpportunities',
            'myUpcomingClosingsCount',
            'myMonthlyRevenue',
            'myUpcomingClosings',
            'recentActivities',
            'myTopOpenOffers',
            'pipelineLabels',
            'pipelineValues',
            'revenueLabels',
            'revenueValues'
        ));
    }
}
