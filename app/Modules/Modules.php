<?php

namespace App\Modules;

use App\Modules\Blogs\BlogsWithLimitModule;
use App\Modules\Blogs\BlogsWithPaginateModule;
use App\Modules\CustomComponents\BoxListingModule;
use App\Modules\CustomComponents\ClientCommentsModule;
use App\Modules\CustomComponents\CounterModule;
use App\Modules\CustomComponents\PricingModule;
use App\Modules\CustomComponents\Slider;
use App\Modules\CustomComponents\StepNumbersModule;
use App\Modules\CustomPages\AboutUsModule;
use App\Modules\GeneralComponents\DetailModule;
use App\Modules\GeneralComponents\ListModule;
use App\Modules\Layout\Footer;
use App\Modules\Layout\Header;

class Modules
{

    /**
     * @var \class-string[]|array
     */
    private static array $modules = [
        'about_us'=>AboutUsModule::class,
        'slider'=>Slider::class,
        'blogs_with_limit'=>BlogsWithLimitModule::class,
        'blogs_with_paginate'=>BlogsWithPaginateModule::class,
        'box_listing'=>BoxListingModule::class,
        'client_comments'=>ClientCommentsModule::class,
        'counter'=>CounterModule::class,
        'pricing'=>PricingModule::class,
        'step_numbers'=>StepNumbersModule::class,
        'detail'=>DetailModule::class,
        'list'=>ListModule::class,
        'footer'=>Footer::class,
        'header'=>Header::class
    ];

    public static function getModuleByName($name)
    {
        return self::$modules[$name] ?? false;
    }

    public static function getModules()
    {
        return self::$modules;
    }
}
