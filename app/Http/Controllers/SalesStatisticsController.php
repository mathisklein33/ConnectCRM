<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use Illuminate\Support\Facades\DB;

class SalesStatisticsController extends Controller
{
    public function index()
    {
        $totalWonRevenue = DB::table('opportunity_product')
            ->join('opportunities', 'opportunities.id', '=', 'opportunity_product.opportunity_id')
            ->where('opportunities.stage', 'Terminée')
            ->sum(DB::raw('opportunity_product.quantity * opportunity_product.unit_price'));

        $totalPipelineRevenue = DB::table('opportunity_product')
            ->join('opportunities', 'opportunities.id', '=', 'opportunity_product.opportunity_id')
            ->where('opportunities.stage', '!=', 'Terminée')
            ->sum(DB::raw('opportunity_product.quantity * opportunity_product.unit_price'));

        $weightedPipelineRevenue = DB::table('opportunity_product')
            ->join('opportunities', 'opportunities.id', '=', 'opportunity_product.opportunity_id')
            ->where('opportunities.stage', '!=', 'Terminée')
            ->sum(DB::raw('(opportunity_product.quantity * opportunity_product.unit_price) * (opportunities.probability / 100)'));

        $totalOpportunities = Opportunity::count();
        $wonOpportunities = Opportunity::where('stage', 'Terminée')->count();

        $conversionRate = $totalOpportunities > 0
            ? round(($wonOpportunities / $totalOpportunities) * 100, 2)
            : 0;

        $monthlyRevenue = DB::table('opportunity_product')
            ->join('opportunities', 'opportunities.id', '=', 'opportunity_product.opportunity_id')
            ->selectRaw("
                DATE_FORMAT(opportunities.expected_closing_date, '%Y-%m') as month,
                SUM(opportunity_product.quantity * opportunity_product.unit_price) as total
            ")
            ->where('opportunities.stage', 'Terminée')
            ->whereNotNull('opportunities.expected_closing_date')
            ->groupByRaw("DATE_FORMAT(opportunities.expected_closing_date, '%Y-%m')")
            ->orderByRaw("DATE_FORMAT(opportunities.expected_closing_date, '%Y-%m')")
            ->get();

        $labels = $monthlyRevenue->pluck('month');
        $values = $monthlyRevenue->pluck('total');

        $stageStats = Opportunity::select('stage', DB::raw('COUNT(*) as total'))
            ->groupBy('stage')
            ->orderBy('stage')
            ->get();

        $upcomingClosings = Opportunity::with('client')
            ->where('stage', '!=', 'Terminée')
            ->whereNotNull('expected_closing_date')
            ->orderBy('expected_closing_date', 'asc')
            ->take(5)
            ->get();

        foreach ($upcomingClosings as $opportunity) {
            $opportunity->total_amount = DB::table('opportunity_product')
                ->where('opportunity_id', $opportunity->id)
                ->sum(DB::raw('quantity * unit_price'));
        }

        $topProducts = DB::table('opportunity_product')
            ->join('products', 'products.id', '=', 'opportunity_product.product_id')
            ->join('opportunities', 'opportunities.id', '=', 'opportunity_product.opportunity_id')
            ->selectRaw("
                products.id,
                products.name,
                products.sku,
                SUM(opportunity_product.quantity) as total_quantity,
                SUM(opportunity_product.quantity * opportunity_product.unit_price) as total_revenue
            ")
            ->where('opportunities.stage', 'Terminée')
            ->groupBy('products.id', 'products.name', 'products.sku')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();

        // Rentabilité / performance par commercial (créateur de l'opportunité)
        $salespeopleProfitability = DB::table('opportunity_product')
            ->join('opportunities', 'opportunities.id', '=', 'opportunity_product.opportunity_id')
            ->join('users', 'users.id', '=', 'opportunities.user_id')
            ->selectRaw("
                users.id,
                users.name,
                COUNT(DISTINCT opportunities.id) as total_opportunities,
                SUM(CASE WHEN opportunities.stage = 'Terminée' THEN 1 ELSE 0 END) as closed_opportunities,
                SUM(CASE WHEN opportunities.stage = 'Terminée'
                    THEN opportunity_product.quantity * opportunity_product.unit_price
                    ELSE 0 END) as total_revenue,
                SUM(CASE WHEN opportunities.stage != 'Terminée'
                    THEN opportunity_product.quantity * opportunity_product.unit_price
                    ELSE 0 END) as pipeline_revenue
            ")
            ->groupBy('users.id', 'users.name')
            ->orderByDesc('total_revenue')
            ->get()
            ->map(function ($item) {
                $item->conversion_rate = $item->total_opportunities > 0
                    ? round(($item->closed_opportunities / $item->total_opportunities) * 100, 2)
                    : 0;

                return $item;
            });

        $topClients = DB::table('opportunities')
            ->join('clients', 'clients.id', '=', 'opportunities.client_id')
            ->leftJoin('opportunity_product', 'opportunity_product.opportunity_id', '=', 'opportunities.id')
            ->selectRaw("
        clients.id,
        clients.name as client_name,
        COUNT(DISTINCT opportunities.id) as total_completed_opportunities,
        COALESCE(SUM(opportunity_product.quantity * opportunity_product.unit_price), 0) as total_revenue
    ")
            ->where('opportunities.stage', 'Terminée')
            ->groupBy('clients.id', 'clients.name')
            ->orderByDesc('total_revenue')
            ->take(5)
            ->get();

        $totalOpportunities = Opportunity::count();
        $completedOpportunities = Opportunity::where('stage', 'Terminée')->count();
        $ongoingOpportunities = Opportunity::where('stage', '!=', 'Terminée')->count();

        return view('sales_statistics.index', compact(
            'totalWonRevenue',
            'totalPipelineRevenue',
            'weightedPipelineRevenue',
            'conversionRate',
            'labels',
            'values',
            'stageStats',
            'upcomingClosings',
            'topProducts',
            'salespeopleProfitability',
            'totalOpportunities',
            'completedOpportunities',
            'ongoingOpportunities',
            'topClients'
        ));
    }
}
