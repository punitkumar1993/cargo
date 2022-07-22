<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;

use Illuminate\Support\Arr;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class GoogleAnalyticChart extends BaseChart
{
    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    public ?string $name = 'custom_chart_name';

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'chart_route_name';

    /**
     * Determines the prefix that will be used by the chart
     * endpoint.
     */
    public ?string $prefix = 'some_prefix';

    /**
     * Determines the middlewares that will be applied
     * to the chart endpoint.
     */
    public ?array $middlewares = ['auth'];

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     * @param Request $request
     * @return Chartisan
     */
    public function handler(Request $request): Chartisan
    {
        $totalVP = $this->fetchTotalVisitorsAndPageViews(Period::days(7));
        $dates_VP = $totalVP->map(function ($item, $key) {
            return $item['date']->format('d M');
        });

        $visitors_VP = $totalVP->pluck('visitors');
        $pageViews_VP = $totalVP->pluck('pageViews');

        return Chartisan::build()
            ->labels(Arr::flatten($dates_VP))
            ->dataset('Visitors', Arr::flatten($visitors_VP))
            ->dataset('Pageviews', Arr::flatten($pageViews_VP));
    }

    /**
     * @param Period $period
     * @return mixed
     */
    public function fetchTotalVisitorsAndPageViews(Period $period)
    {
        return Analytics::fetchTotalVisitorsAndPageViews($period);
    }

}
