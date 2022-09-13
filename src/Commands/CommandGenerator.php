<?php
/**
 * Copyright by Fabio Dukievicz <fabiojd47@gmail.com>
 * Licensed under MIT
 */

namespace Kascat\EasyModule\Commands;

/**
 * Class CommandGenerator
 * @package Kascat\EasyModule\Commands
 */
class CommandGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easy:command
    { name : Module name, for example: User }
    { --O|overwrite : If file exists, overwrite }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create command file (console.php)';

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name      = $this->argument('name');
        $overwrite = $this->option('overwrite');

        $this->create('console', $name, $overwrite);

        $this->info('Command file created successfully!');
    }
}
