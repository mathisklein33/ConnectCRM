<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\DB;

class RevenueChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

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

        $this->labels($labels);

        $this->dataset('Chiffre d’affaires (€)', 'line', $values)
            ->backgroundColor('rgba(54, 162, 235, 0.2)')
            ->color('#3490dc');
    }
}
