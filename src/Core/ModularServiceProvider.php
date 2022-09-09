<?php

namespace Kascat\EasyModule\Core;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;

/**
 * Class ModularServiceProvider
 * @package Kascat\EasyModule\Core
 */
class ModularServiceProvider extends ServiceProvider
{
    /** @var string */
    const MODULES_PATH = 'modules';

    /**
     * Module routes.
     *
     * @return void
     */
    public function boot()
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
}
