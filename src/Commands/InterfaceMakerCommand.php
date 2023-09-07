<?php

namespace Dnridwn\LaravelFileMaker\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Pluralizer;

/**
 * Class InterfaceMakerCommand
 */
class InterfaceMakerCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    public $signature = 'make:interface {name}';

    /**
     * The description of the command.
     *
     * @var string
     */
    public $description = 'Make an Interface Class';

    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $path = $this->getSourceFilePath();

        $this->makeDirectory(dirname($path));

        $contents = $this->getSourceFile();

        if (! $this->files->exists($path)) {
            $this->files->put($path, $contents);
            $this->info("File : {$path} created");
        } else {
            $this->info("File : {$path} already exits");
        }

        return self::SUCCESS;
    }

    /**
     * Get the singular class name.
     */
    public function getSingularClassName(string $name): string
    {
        return ucwords(Pluralizer::singular($name));
    }

    /**
     * Get the path to the stub file.
     */
    public function getStubPath(): string
    {
        return __DIR__.'../../../stubs/interface.stub';
    }

    /**
     * Get the stub variables.
     */
    public function getStubVariable(): array
    {
        return [
            'NAMESPACE' => 'App\\Interfaces',
            'CLASS_NAME' => $this->getSingularClassName($this->argument('name')),
        ];
    }

    /**
     * Get the source file contents.
     */
    public function getSourceFile(): string|false
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariable());
    }

    /**
     * Get the contents of a stub file.
     */
    public function getStubContents(string $stub, array $stubVariables = []): string|false
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$'.$search.'$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Get the path to the source file.
     */
    public function getSourceFilePath(): string
    {
        return base_path('app/Interfaces/').$this->getSingularClassName($this->argument('name')).'Interface.php';
    }

    /**
     * Make the directory if it doesn't exist.
     */
    protected function makeDirectory(string $path): string
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
