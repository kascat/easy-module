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

namespace Kascat\EasyModule\Core;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Kascat\EasyModule\Commands\CommandGenerator;
use Kascat\EasyModule\Commands\ControllerGenerator;
use Kascat\EasyModule\Commands\ModelGenerator;
use Kascat\EasyModule\Commands\ModuleGenerator;
use Kascat\EasyModule\Commands\RouteGenerator;
use Kascat\EasyModule\Commands\ServiceGenerator;

/**
 * Class ModularServiceProvider
 * @package Kascat\EasyModule\Core
 */
class ModularCommandServiceProvider extends ServiceProvider
{
    /** @var string */
    const MODULES_PATH = 'modules';

    /** @var string[] */
    protected $commands = [
        ModuleGenerator::class,
        ModelGenerator::class,
        ServiceGenerator::class,
        ControllerGenerator::class,
        RouteGenerator::class,
        CommandGenerator::class,
    ];

    /**
     * Modular inicialization.
     *
     * @return void
     */
    public function boot()
    {
        // Easy-module commands
        $this->commands($this->commands);
    }
}
