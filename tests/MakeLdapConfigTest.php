<?php

namespace LdapRecord\Lumen\Tests;

use Illuminate\Filesystem\Filesystem;

class MakeLdapConfigTest extends TestCase
{
    protected function tearDown(): void
    {
        $this->deleteConfigStub();

        parent::tearDown();
    }

    protected function deleteConfigStub()
    {
        $files = app(Filesystem::class);

        $files->delete($this->configFilePath());
        $files->deleteDirectory($this->configFileFolder());
    }

    protected function configFilePath()
    {
        return $this->configFileFolder() . '/ldap.php';
    }

    protected function configFileFolder()
    {
        return __DIR__.'/../config';
    }

    public function test_configuration_can_be_published()
    {
        $this->artisan('make:ldap-config');

        $this->assertTrue(file_exists($this->configFilePath()));
        $this->assertTrue(file_exists($this->configFileFolder()));
    }
}
