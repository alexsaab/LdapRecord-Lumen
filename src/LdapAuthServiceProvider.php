<?php

namespace LdapRecord\Lumen;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use LdapRecord\Laravel\LdapAuthServiceProvider as BaseServiceProvider;

class LdapAuthServiceProvider extends BaseServiceProvider
{
    /**
     * {@inheritDoc}
     */
    protected function registerAuthProvider()
    {
        if (! is_null(Auth::getFacadeRoot())) {
            parent::registerAuthProvider();
        }

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    protected function registerEventListeners()
    {
        if (! is_null(Event::getFacadeRoot())) {
            parent::registerEventListeners();
        }

        return $this;
    }
}
