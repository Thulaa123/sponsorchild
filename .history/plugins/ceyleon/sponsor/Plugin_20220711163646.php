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
}
