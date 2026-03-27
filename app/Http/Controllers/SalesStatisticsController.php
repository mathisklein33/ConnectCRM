<?php

namespace App\Http\Controllers;

use App\Models\Opportunity;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class SalesStatisticsController extends Controller
{
    public function index()
    {
        $data = DB::table('opportunity_product')
            ->join('opportunities', 'opportunities.id', '=', 'opportunity_product.opportunity_id')
            ->selectRaw("
            DATE_FORMAT(opportunities.expected_closing_date, '%Y-%m') as month,
            SUM(opportunity_product.quantity * opportunity_product.unit_price) as total
        ")
            ->where('opportunities.stage', 'gagné')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $labels = $data->pluck('month');
        $values = $data->pluck('total');

        return view('sales_statistics.index', compact('labels', 'values'));
    }
}
