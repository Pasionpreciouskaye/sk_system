<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SpentPerMonthChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        [$months, $totals] = Cache::remember(
            'chart.spent_per_month',
            now()->addMinutes(10),
            function() {
                $start = Carbon::now()->subMonths(11)->startOfMonth();
                $end   = Carbon::now()->endOfMonth();

                $rows = DB::table('budgets')
                    ->selectRaw("DATE_FORMAT(date_spent, '%Y-%m') AS month, SUM(spent) AS total")
                    ->whereBetween('date_spent', [$start, $end])
                    ->groupBy('month')
                    ->orderBy('month')
                    ->get();

                $map = $rows->pluck('total','month')->toArray();
                return [array_keys($map), array_values($map)];
            }
        );

        $this->height(300);
        
        if (empty($months)) {
            $this->options([
                'responsive'          => true,
                'maintainAspectRatio' => false,
                'plugins'             => [
                    'title'  => [
                        'display' => true,
                        'text'    => 'No data yet',
                        'font'    => ['size' => 16],
                        'padding' => ['top' => 100, 'bottom' => 100],
                    ],
                    'legend' => [
                        'display' => false,
                    ],
                ],
                'scales'              => [
                    'x' => ['display' => false],
                    'y' => ['display' => false],
                ],
            ]);

            return;
        }
        
        $this->labels($months)
             ->dataset('Spent', 'line', $totals)
             ->options([
                 'responsive'          => true,
                 'maintainAspectRatio' => false,
                 'scales'              => [
                     'yAxes' => [[ 'ticks' => ['beginAtZero' => true] ]],
                 ],
             ]);
    }
}