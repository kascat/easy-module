<?php
/**
 * Copyright by Fabio Dukievicz <fabiojd47@gmail.com>
 * Licensed under MIT
 */

namespace Kascat\EasyModule\Commands;

/**
 * Class ModelGenerator
 * @package Kascat\EasyModule\Commands
 */
class ModelGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easy:model
    { name : Model name, for example: User }
    { --O|overwrite : If file exists, overwrite }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create model file';

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name      = $this->argument('name');
        $overwrite = $this->option('overwrite');

        $this->create('model', $name, $overwrite);

        $this->info('Model file created successfully!');
    }
}
