<?php
/**
 * Copyright by Fabio Dukievicz <fabiojd47@gmail.com>
 * Licensed under MIT
 */

namespace Kascat\EasyModule\Core;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Kascat\EasyModule\Commands\CommandGenerator;
use Kascat\EasyModule\Commands\ControllerGenerator;
use Kascat\EasyModule\Commands\ModelGenerator;
use Kascat\EasyModule\Commands\ModuleGenerator;
use Kascat\EasyModule\Commands\RouteGenerator;
use Kascat\EasyModule\Commands\ServiceGenerator;
use Symfony\Component\Finder\Finder;

/**
 * Class ModularServiceProvider
 * @package Kascat\EasyModule\Core
 */
class ModularServiceProvider extends ServiceProvider
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

        // Modular commands
        $this->modularCommands();

        // Modular routes
        $this->modularRoutes();
    }

    /**
     * Register modular routes
     */
    private function modularRoutes()
    {
        $this->routes(function () {
            if (!is_dir(base_path(self::MODULES_PATH))) {
                return;
            }

            $finder = new Finder();

            $finder
                ->files()
                ->name('api.php')
                ->name('web.php')
                ->in(base_path(self::MODULES_PATH));

            /** @var \Symfony\Component\Finder\SplFileInfo $file */
            foreach ($finder as $file) {
                if ($file->getFilename() === 'api.php') {
                    Route::prefix('api')
                        ->middleware('api')
                        ->namespace($this->namespace)
                        ->group($file->getRealPath());
                } else {
                    Route::middleware('web')
                        ->namespace($this->namespace)
                        ->group($file->getRealPath());
                }
            }
        });
    }

    /**
     * Register modular commands
     */
    private function modularCommands()
    {
        $finder = new Finder();

        $finder
            ->files()
            ->name('console.php')
            ->in(base_path(self::MODULES_PATH));

        /** @var \Symfony\Component\Finder\SplFileInfo $file */
        foreach ($finder as $file) {
            require $file->getRealPath();
        }
    }
}
