<?php

namespace App\Charts;

use App\Models\Opportunity;
use ConsoleTVs\Charts\Classes\Chartjs\Chart;

class SalesChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        $data = Opportunity::all()->groupBy('stage')->map->count();

        $this->labels($data->keys());

        $this->dataset('Opportunités', 'bar', $data->values())
            ->backgroundColor([
                '#3490dc',
                '#38c172',
                '#ffed4a',
                '#e3342f'
            ]);
    }
}
