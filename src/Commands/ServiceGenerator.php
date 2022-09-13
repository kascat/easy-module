<?php
/**
 * Copyright by Fabio Dukievicz <fabiojd47@gmail.com>
 * Licensed under MIT
 */

namespace Kascat\EasyModule\Commands;

/**
 * Class ServiceGenerator
 * @package Kascat\EasyModule\Commands
 */
class ServiceGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easy:service
    { name : Module name, for example: User }
    { --O|overwrite : If file exists, overwrite }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create service files (Service and Repository)';

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name      = $this->argument('name');
        $overwrite = $this->option('overwrite');

        $this->create('repository', $name, $overwrite);
        $this->create('service', $name, $overwrite);

        $this->info('Service files created successfully!');
    }
}
