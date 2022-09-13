<?php
/**
 * Copyright by Fabio Dukievicz <fabiojd47@gmail.com>
 * Licensed under MIT
 */

namespace Kascat\EasyModule\Commands;

/**
 * Class RouteGenerator
 * @package Kascat\EasyModule\Commands
 */
class RouteGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easy:route
    { name : Module name, for example: User }
    { --O|overwrite : If file exists, overwrite }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create route files (api.php and web.php)';

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name      = $this->argument('name');
        $overwrite = $this->option('overwrite');

        $this->create('api', $name, $overwrite);
        $this->create('web', $name, $overwrite);

        $this->info('Route files created successfully!');
    }
}
