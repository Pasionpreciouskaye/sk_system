<?php

namespace App\Charts;

use ConsoleTVs\Charts\Classes\Chartjs\Chart;
use Illuminate\Support\Facades\Cache;
use App\Models\Project;
use App\Models\Event;

class ProjectsEventsChart extends Chart
{
    public function __construct()
    {
        parent::__construct();

        [$projects, $events] = Cache::remember(
            'chart.projects_events',
            now()->addMinutes(10),
            fn() => [ Project::count(), Event::count() ]
        );

        $this->height(300);
        
        if ($projects + $events === 0) {
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
        
        $this->labels(['Projects', 'Events'])
             ->dataset('Totals', 'bar', [$projects, $events])
             ->options([
                 'responsive'          => true,
                 'maintainAspectRatio' => false,
             ]);
    }
}