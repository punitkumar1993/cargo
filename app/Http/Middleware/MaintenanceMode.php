<?php

namespace App\Http\Middleware;

use Closure;

use App\Helpers\Settings;


use Artesaos\SEOTools\Facades\SEOTools;

class MaintenanceMode
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Settings::get('maintenance') == 'y') {
            $image = (Settings::get('ogimage')) ? asset('storage/images/' . Settings::get('ogimage')) : asset('images/cover.png');

            SEOTools::setTitle('Maintenance Mode');
            SEOTools::setDescription(Settings::get('sitedescription'));
            SEOTools::metatags()->setKeywords(Settings::get('metakeyword'));
            SEOTools::setCanonical(Settings::get('siteurl'));
            SEOTools::opengraph()->setTitle(Settings::get('sitename'));
            SEOTools::opengraph()->setDescription(Settings::get('sitedescription'));
            SEOTools::opengraph()->setUrl(Settings::get('siteurl'));
            SEOTools::opengraph()->setSiteName(Settings::get('company_name'));
            SEOTools::opengraph()->addImage($image);
            SEOTools::twitter()->setSite('@' . Settings::get('twitter'));
            SEOTools::twitter()->setTitle(Settings::get('sitename'));
            SEOTools::twitter()->setDescription(Settings::get('sitedescription'));
            SEOTools::twitter()->setUrl(Settings::get('siteurl'));
            SEOTools::twitter()->setImage($image);
            SEOTools::jsonLd()->setTitle(Settings::get('sitename'));
            SEOTools::jsonLd()->setDescription(Settings::get('sitedescription'));
            SEOTools::jsonLd()->setType('WebPage');
            SEOTools::jsonLd()->setUrl(Settings::get('siteurl'));
            SEOTools::jsonLd()->setImage($image);
            
            abort('503');
        }

        return $next($request);
    }
}
