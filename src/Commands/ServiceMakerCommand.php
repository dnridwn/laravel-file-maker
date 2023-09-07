<?php

namespace Dnridwn\LaravelFileMaker\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Pluralizer;
use Illuminate\Filesystem\Filesystem;

/**
 * Class ServiceMakerCommand
 *
 * @package Dnridwn\LaravelFileMaker\Commands
 */
class ServiceMakerCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    public $signature = 'make:service {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    public $description = 'Make an Service Class';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (!$this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }

        return self::SUCCESS;
    }

    /**
     * Get the singular class name.
     *
     * @param  string  $name
     * @return string
     */
    public function getSingularClassName(string $name): string
    {
        return ucwords(Pluralizer::singular($name));
    }

    /**
     * Get the path to the stub file.
     *
     * @return string
     */
    public function getStubPath(): string
    {
        return __DIR__ . '../../../stubs/service.stub';
    }

    /**
     * Get the stub variables.
     *
     * @return array
     */
    public function getStubVariable(): array
    {
        return [
            'NAMESPACE' => 'App\\Services',
            'CLASS_NAME' => $this->getSingularClassName($this->argument('name'))
        ];
    }

    /**
     * Get the source file contents.
     *
     * @return string|false
     */
    public function getSourceFile(): string|false
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariable());
    }

    /**
     * Get the contents of a stub file.
     *
     * @param  string  $stub
     * @param  array  $stubVariables
     * @return string|false
     */
    public function getStubContents(string $stub, array $stubVariables = []): string|false
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace)
        {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Get the path to the source file.
     *
     * @return string
     */
    public function getSourceFilePath(): string
    {
        return base_path('app/Services/') . $this->getSingularClassName($this->argument('name')) . 'Service.php';
    }

    /**
     * Make the directory if it doesn't exist.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory(string $path): string
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }

}
