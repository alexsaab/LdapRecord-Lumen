<?php

namespace LdapRecord\Lumen;

use LdapRecord\Laravel\LdapServiceProvider as BaseServiceProvider;

class LdapServiceProvider extends BaseServiceProvider
{
    /**
     * {@inheritDoc}
     */
    protected function registerConfiguration()
    {
        $this->app->configure('ldap');

        return $this;
    }
}
