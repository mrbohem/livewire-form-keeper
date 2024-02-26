<?php

namespace MrBohem\LivewireFormKeeper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \MrBohem\LivewireFormKeeper\LivewireFormKeeper
 */
class LivewireFormKeeper extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \MrBohem\LivewireFormKeeper\LivewireFormKeeper::class;
    }
}
