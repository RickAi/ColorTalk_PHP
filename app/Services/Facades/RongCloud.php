<?php

namespace App\Services\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * Created by PhpStorm.
 * User: CIR
 * Date: 16/1/23
 * Time: 10:20
 */

class RongCloud extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'rongcloud';
    }
}