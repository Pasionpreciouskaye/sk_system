<?php

namespace App\Http\Controllers;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use App\Models\Project;
use App\Models\Event;
use App\Models\Budget;

class DashboardController extends Controller
{
    public function index()
    {
        $projectsCount = Project::count();
        $eventsCount   = Event::count();
        $hasCountData  = ($projectsCount + $eventsCount) > 0;

        $projectsEventsChart = new Chart();
        $projectsEventsChart
            ->height(300)
            ->labels(['Projects','Events'])
            ->dataset('Totals', 'bar', $hasCountData ? [$projectsCount, $eventsCount] : [])
            ->options([
                'responsive'          => true,
                'maintainAspectRatio' => false,
                'plugins'             => [
                    'title' => [
                        'display' => !$hasCountData,
                        'text'    => 'No data yet',
                        'font'    => [ 'size' => 16 ]
                    ],
                    'legend' => [
                        'display' => $hasCountData
                    ],
                ],
                'scales' => [
                    'y' => ['beginAtZero' => true]
                ]
            ]);
        $spentData = Budget::selectRaw("DATE_FORMAT(date_spent, '%Y-%m') as month")
            ->selectRaw("SUM(spent) as total")
            ->whereNotNull('date_spent')
            ->groupBy('month')
            ->orderBy('month')
            ->limit(12)
            ->get();

        $months      = $spentData->pluck('month')->all();
        $spentValues = $spentData->pluck('total')->all();
        $hasSpentData = count($spentValues) > 0;

        $spentChart = new Chart();
        $spentChart
            ->height(300)
            ->labels($hasSpentData ? $months : [])
            ->dataset('Spent', 'line', $hasSpentData ? $spentValues : [])
            ->options([
                'responsive'          => true,
                'maintainAspectRatio' => false,
                'plugins'             => [
                    'title' => [
                        'display' => !$hasSpentData,
                        'text'    => 'No data yet',
                        'font'    => [ 'size' => 16 ]
                    ],
                    'legend' => [
                        'display' => $hasSpentData
                    ],
                ],
                'scales' => [
                    'x' => [
                        'title' => [
                            'display' => true,
                            'text'    => 'Month'
                        ]
                    ],
                    'y' => [
                        'beginAtZero' => true,
                        'title' => [
                            'display' => true,
                            'text'    => 'Amount'
                        ]
                    ]
                ]
            ]);

        return view('dashboard', compact('projectsEventsChart', 'spentChart'));
    }
}