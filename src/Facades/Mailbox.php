<?php

namespace devakb\Mailbox\Facades;

use Illuminate\Support\Facades\Facade;

class Mailbox extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'mailbox';
    }
}
