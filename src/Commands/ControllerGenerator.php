<?php

/**
 * This file is part of the kascat/easy-module library
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @copyright Copyright (c) Fabio Dukievicz <fabiojd47@gmail.com>
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace Kascat\EasyModule\Commands;

/**
 * Class ControllerGenerator
 * @package Kascat\EasyModule\Commands
 */
class ControllerGenerator extends Generator
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'easy:controller
    { name : Module name, for example: User }
    { --O|overwrite : If file exists, overwrite }';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create controller files (Controller, Request, Response, Api Route)';

    /**
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        $name      = $this->argument('name');
        $overwrite = $this->option('overwrite');

        $this->create('request', $name, $overwrite);
        $this->create('response', $name, $overwrite);
        $this->create('controller', $name, $overwrite);
        $this->create('api', $name, $overwrite);

        $this->info('Controller files created successfully!');
    }
}
