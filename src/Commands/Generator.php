<?php
/**
 * Copyright by Fabio Dukievicz <fabiojd47@gmail.com>
 * Licensed under MIT
 */

namespace Kascat\EasyModule\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

/**
 * Class Generator
 * @package Kascat\EasyModule\Commands
 */
class Generator extends Command
{
    /**
     * File type name map
     */
    const FILE_TYPES_SUFIXES = [
        'console'    => 'console',
        'web'        => 'web',
        'api'        => 'api',
        'model'      => '__module__',
        'controller' => '__module__Controller',
        'repository' => '__module__Repository',
        'request'    => '__module__Request',
        'response'   => '__module__Response',
        'service'    => '__module__Service',
    ];

    /** @var Filesystem */
    private $filesystem;

    /** @var Str */
    private $str;

    /**
     * Generator constructor.
     * @param Filesystem $filesystem
     * @param Str $str
     */
    public function __construct(Filesystem $filesystem, Str $str)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
        $this->str        = $str;
    }

    /**
     * @param $fileType
     * @param $moduleName
     * @param false $overwrite
     * @return bool|int
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function create($fileType, $moduleName, $overwrite = false)
    {
        $moduleName       = ucfirst($this->str->singular($moduleName));
        $pluralModuleName = ucfirst($this->str->plural($moduleName));

        $content = $this->parseStub($fileType, $moduleName);

        if (!$this->filesystem->exists(base_path() . "/modules/")) {
            $this->filesystem->makeDirectory(base_path() . "/modules/");
        }

        if (!$this->filesystem->exists(base_path() . "/modules/$pluralModuleName/")) {
            $this->filesystem->makeDirectory(base_path() . "/modules/$pluralModuleName/");
        }

        $filename = str_replace('__module__', $moduleName, self::FILE_TYPES_SUFIXES[$fileType]);

        $path = base_path() . "/modules/$pluralModuleName/$filename.php";
        if (!$overwrite && $this->filesystem->exists($path)) {
            $uniqueId = (new \DateTime)->format('YmdHis');
            $path     = base_path() . "/modules/$pluralModuleName/$filename-$uniqueId.php";
        }

        return $this->filesystem->put($path, $content);
    }

    /**
     * @param $type
     * @return string
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function getStub($type)
    {
        return $this->filesystem->get(__DIR__ . "/../stubs/{$type}.stub");
    }

    /**
     * @param $stub
     * @param $name
     * @param array $args
     * @return array|string|string[]
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function parseStub($stub, $name, $args = [])
    {
        $toParse = array_merge([
            'modelName'                  => ucfirst($this->str->singular($name)),
            'modelNamePlural'            => ucfirst($this->str->plural($name)),
            'modelNamePluralLowerCase'   => lcfirst($this->str->plural($name)),
            'modelNameSingularLowerCase' => lcfirst($this->str->singular($name)),
        ], $args);

        return str_replace(
            array_map(function ($key) {
                return "{{{$key}}}";
            }, array_keys($toParse)),
            array_values($toParse),
            $this->getStub($stub)
        );
    }
}
