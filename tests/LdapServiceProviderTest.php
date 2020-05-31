<?php

namespace LdapRecord\Lumen\Tests;

use LdapRecord\Container;
use LdapRecord\Connection;
use LdapRecord\Lumen\LdapServiceProvider;

class LdapServiceProviderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        config(['ldap.default' => 'default']);
        config(['ldap.connections.default' => [
            'hosts' => ['localhost'],
            'username' => 'user',
            'password' => 'secret',
        ]]);

        app()->register(LdapServiceProvider::class);
    }

    public function test_connections_are_registered()
    {
        $this->assertIsArray($connections = Container::getInstance()->all());
        $this->assertCount(1, $connections);

        $this->assertInstanceOf(Connection::class, $default = $connections['default']);
        $this->assertEquals(['localhost'], $default->getConfiguration()->get('hosts'));
    }
}
