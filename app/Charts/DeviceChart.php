<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;

class DeviceChart extends BaseChart
{
    /**
     * Determines the chart name to be used on the
     * route. If null, the name will be a snake_case
     * version of the class name.
     */
    public ?string $name = 'device_chart';

    /**
     * Determines the name suffix of the chart route.
     * This will also be used to get the chart URL
     * from the blade directrive. If null, the chart
     * name will be used.
     */
    public ?string $routeName = 'device_chart';

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
     */
    public function handler(Request $request): Chartisan
    {
        $devices = $this->fetchDeviceCategory(Period::days(7));

        $type_devices = collect($devices['rows'])->map(function (array $item) {
            $icon = ($item['0'] == 'desktop') ? 'desktop' : (($item['0'] == 'mobile') ? 'mobile' : 'tablet');
            return Str::ucfirst($item['0']);
        });

        $result_devices = collect($devices['rows'])->map(function (array $item) {
            return (int) $item['1'];
        });

        return Chartisan::build()
            ->labels(Arr::flatten($type_devices))
            ->dataset('Device Category', Arr::flatten($result_devices));
    }

    public function fetchDeviceCategory(Period $period)
    {
        return Analytics::performQuery(
            $period,
            'ga:visitors',
            ['dimensions' => 'ga:deviceCategory']
        );
    }
}
