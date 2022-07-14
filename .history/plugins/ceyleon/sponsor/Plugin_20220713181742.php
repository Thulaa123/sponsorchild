<?php namespace Ceyleon\Sponsor;

use System\Classes\PluginBase;
use Ceyleon\Sponsor\Components\ChildInfo;
use Ceyleon\Sponsor\Components\SponsorInfo;
use Ceyleon\Sponsor\Components\CountryInfo;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        {
            return [
                ChildInfo::class => 'childInfo',
                SponsorInfo::class => 'sponsorInfo',
                CountryInfo::class => 'countryInfo'
            ];
        }
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        \Event::listen('offline.sitesearch.query', function ($query) {

            // The controller is used to generate page URLs.
            $controller = Backend\Classes\Controller::getController() ?? new Backend\Classes\Controller();

            // Search your plugin's contents
            $items = Models\Sponsor
                ::where('title', 'like', "%${query}%")
                ->orWhere('content', 'like', "%${query}%")
                ->get();

            // Now build a results array
            $results = $items->map(function ($item) use ($query, $controller) {

                // If the query is found in the title, set a relevance of 2
                $relevance = mb_stripos($item->title, $query) !== false ? 2 : 1;
                
                // Optional: Add an age penalty to older results. This makes sure that
                // newer results are listed first.
                // if ($relevance > 1 && $item->created_at) {
                //    $ageInDays = $item->created_at->diffInDays(\Illuminate\Support\Carbon::now());
                //    $relevance -= \OFFLINE\SiteSearch\Classes\Providers\ResultsProvider::agePenaltyForDays($ageInDays);
                // }

                return [
                    'title'     => $item->title,
                    'text'      => $item->content,
                    'url'       => $controller->pageUrl('cms-page-file-name', ['slug' => $item->slug]),
                    'thumb'     => optional($item->images)->first(), // Instance of System\Models\File
                    'relevance' => $relevance, // higher relevance results in a higher
                                            // position in the results listing
                    // 'meta' => 'data',       // optional, any other information you want
                                            // to associate with this result
                    // 'model' => $item,       // optional, pass along the original model
                ];
            });

            return [
                'provider' => 'Document', // The badge to display for this result
                'results'  => $results,
            ];
        });
    }
}
