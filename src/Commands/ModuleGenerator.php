<?php
/**
 * Copyright by Fabio Dukievicz <fabiojd47@gmail.com>
 * Licensed under MIT
 */

namespace Kascat\EasyModule\Commands;

/**
 * Class ModuleGenerator
 * @package Kascat\EasyModule\Commands
 */
class ModuleGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easy:module
    { name : Module name, for example: User }
    { --O|overwrite : If file exists, overwrite }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create all module skeleton structure';

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name      = $this->argument('name');
        $overwrite = $this->option('overwrite');

        $this->create('model', $name, $overwrite);
        $this->create('service', $name, $overwrite);
        $this->create('request', $name, $overwrite);
        $this->create('response', $name, $overwrite);
        $this->create('repository', $name, $overwrite);
        $this->create('controller', $name, $overwrite);
        $this->create('api', $name, $overwrite);

        $this->info('Module structure created successfully!');
    }
}
