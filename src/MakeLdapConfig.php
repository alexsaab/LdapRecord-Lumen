<?php

namespace LdapRecord\Lumen;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class MakeLdapConfig extends Command
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'make:ldap-config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new LDAP configuration file.';

    /**
     * Create a new controller creator command instance.
     *
     * @param Filesystem $files
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Create the LDAP configuration file.
     */
    public function handle()
    {
        if (! $this->files->exists($stubPath = $this->getStubPath())) {
            return $this->error("Unable to retrieve LDAP configuration stub file from path [$stubPath]");
        }

        $publishPath = $this->getLdapConfigPath(
            $configPath = $this->getConfigPath()
        );

        if ($this->alreadyExists($publishPath)) {
            return $this->error("LDAP configuration file already exists at path [$publishPath]");
        }

        if (! $this->alreadyExists($configPath)) {
            $this->makeDirectory($configPath);
        }

        $this->files->put($publishPath, $this->getContents($stubPath));

        $this->info("Successfully created LDAP configuration file at path [$publishPath]");
    }

    /**
     * Determine if the given file / folder already exists.
     *
     * @param string $path
     *
     * @return bool
     */
    protected function alreadyExists($path)
    {
        return $this->files->exists($path);
    }

    /**
     * Make the given directory path.
     *
     * @param string $path
     */
    protected function makeDirectory($path)
    {
        $this->files->makeDirectory($path);
    }

    /**
     * Get the contents of the given file.
     *
     * @param string $path
     *
     * @return string
     */
    protected function getContents($path)
    {
        return $this->files->get($path);
    }

    /**
     * Get the LDAP configuration file stub.
     *
     * @return string
     */
    protected function getStubPath()
    {
        return base_path(implode(DIRECTORY_SEPARATOR, ['vendor', 'directorytree', 'ldaprecord-laravel', 'config', 'ldap.php']));
    }

    /**
     * Get the configuration folder path.
     *
     * @return string
     */
    public function getConfigPath()
    {
        return base_path('config');
    }

    /**
     * Get the full LDAP configuration file path.
     *
     * @param string $configPath
     *
     * @return string
     */
    protected function getLdapConfigPath($configPath)
    {
        return $configPath . DIRECTORY_SEPARATOR . 'ldap.php';
    }
}
