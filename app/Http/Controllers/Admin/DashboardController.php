<?php

namespace App\Http\Controllers\Admin;

use App\Charts\GoogleAnalyticChart;
use App\Helpers\Settings;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Term;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

use Spatie\Analytics\AnalyticsFacade as Analytics;
use Spatie\Analytics\Period;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DashboardController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function __invoke(Request $request)
    {
        //displays the amount of data in the dashboard
        $countPost = Post::ofType('post')->count(); //get the amount of data post
        $countPage = Post::ofType('page')->count(); //get the amount of data page
        $countPermission = Permission::count(); //get the amount of data permission
        $countGallery = Post::ofType('gallery')->count(); //get the amount of data gallery

        //displays the amount of data based on user roles
        if (Auth::User()->hasRole('superadmin')) {
            $countUser = User::count();
            $countRole = Role::count();
        } else if (Auth::User()->hasRole('admin')){
            $countUser = User::role(['admin','member'])->count();
            $countRole = Role::whereIn('name', ['admin','member'])->count();
        } else {
            $countUser = User::notRole(['superadmin','admin'])->count();
            $countRole = Role::whereNotIn('name', ['superadmin','admin'])->count();
        }

        //displays the number of category and tag data
        if ( is_null(Term::with('taxonomy')->first()) === TRUE )
        {
            $countCategory = 0;
            $countTag = 0;
        }
        else
        {
            $getDataTaxonomy = Term::with('taxonomy')->get();
            //get the amount of data category
            $countCategory = $getDataTaxonomy->first()->taxonomy->where('taxonomy','category')->count();
            //get the amount of data tag
            $countTag = $getDataTaxonomy->first()->taxonomy->where('taxonomy','tag')->count();
        }

        $arrayCount = [
            'post' => $countPost,
            'page' => $countPage,
            'user' => $countUser,
            'category' => $countCategory,
            'tag' => $countTag,
            'role' => $countRole,
            'permission' => $countPermission,
            'gallery' => $countGallery
        ];

        $count = (object) $arrayCount;

        //variable for analytics
        $totalVP = null;
        $activeUsers = null;
        $devices = null;
        $mostVisited = null;
        $topBrowsers = null;
        $topOperatingSystem = null;
        $topCountry = null;
      

        //if internet is available data will be displayed otherwise it will be null
        $connection = false;
        if (Settings::check_connection()) {
            if(env('ANALYTICS_VIEW_ID') != "") {
                //display analytics
                $connection = true;
                $activeUsers = $this->fetchOnlineUsers();
                $mostVisited = Analytics::fetchMostVisitedPages(Period::days(7), 8);
                $topBrowsers = Analytics::fetchTopBrowsers(Period::days(7), 8);
                $topOperatingSystem = $this->fetchTopOperatingSystem(Period::days(7), 8);
                $topCountry = $this->fetchTopCountry(Period::days(7), 8);
            }
        }

        return view('admin.dashboard',
            compact('count',
                'activeUsers',
                'mostVisited',
                'topBrowsers',
                'topOperatingSystem',
                'topCountry',
                'connection'));
    }

    /**
     * @return mixed
     */
    public function fetchOnlineUsers() {
        $analytics = Analytics::getAnalyticsService();
        return $analytics->data_realtime
            ->get(
                'ga:' .env('ANALYTICS_VIEW_ID'),
                'rt:activeVisitors'
            )
            ->totalsForAllResults['rt:activeVisitors'];
    }

    /**
     * @param Period $period
     * @param int $maxResults
     * @return Collection
     */
    public function fetchTopOperatingSystem(Period $period, int $maxResults = 10): Collection
    {
        $response = Analytics::performQuery(
            $period,
            'ga:sessions',
            [
                'dimensions' => 'ga:operatingSystem,ga:operatingSystemVersion',
                'sort' => '-ga:sessions',
            ]
        );

        $topOSs = collect($response['rows'] ?? [])->map(function (array $osRow) {
            return [
                'os' => $osRow[0],
                'version' => $osRow[1],
                'sessions' => (int) $osRow[2],
            ];
        });

        if ($topOSs->count() <= $maxResults) {
            return $topOSs;
        }

        return $this->summarizeTopOperatingSystem($topOSs, $maxResults);
    }

    /**
     * @param Collection $topOSs
     * @param int $maxResults
     * @return Collection
     */
    protected function summarizeTopOperatingSystem(Collection $topOSs, int $maxResults): Collection
    {
        return $topOSs
            ->take($maxResults - 1)
            ->push([
                'os' => 'Others',
                'version' => '-',
                'sessions' => $topOSs->splice($maxResults - 1)->sum('sessions'),
            ]);
    }

    /**
     * @param Period $period
     * @param int $maxResults
     * @return Collection
     */
    public function fetchTopCountry(Period $period, int $maxResults = 10): Collection
    {
        $response = Analytics::performQuery(
            $period,
            'ga:sessions',
            [
                'dimensions' => 'ga:country',
                'sort' => '-ga:sessions',
            ]
        );

        $topCountrys = collect($response['rows'] ?? [])->map(function (array $countryRow) {
            return [
                'country' => $countryRow[0],
                'sessions' => (int) $countryRow[1],
            ];
        });

        if ($topCountrys->count() <= $maxResults) {
            return $topCountrys;
        }

        return $this->summarizeTopCountry($topCountrys, $maxResults);
    }

    /**
     * @param Collection $topCountrys
     * @param int $maxResults
     * @return Collection
     */
    protected function summarizeTopCountry(Collection $topCountrys, int $maxResults): Collection
    {
        return $topCountrys
            ->take($maxResults - 1)
            ->push([
                'country' => 'Others',
                'sessions' => $topCountrys->splice($maxResults - 1)->sum('sessions'),
            ]);
    }
}
