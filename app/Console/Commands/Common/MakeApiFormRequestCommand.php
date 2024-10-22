<?php

namespace App\Console\Commands\Common;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

final class MakeApiFormRequestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:api-request {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Realiza un FormRequest adaptado para API';

    /**
     * Filesystem instance
     */
    protected Filesystem $files;

    /**
     * Create a new command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
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
    }

    /**
     * Return the stub file path
     */
    public function getStubPath(): string
    {
        return base_path('app/Stubs/ApiFormRequest.stub');
    }

    /**
     **
     * Map the stub variables present in stub to its value
     */
    public function getStubVariables(): array
    {
        $count_slash = substr_count($this->argument('name'), '/');

        // Si hay un slash o mas significa que va en varios niveles de carpetas
        if ($count_slash > 0) {
            $ultimo_slash = strrpos($this->argument('name'), '/');
            $class_name = substr($this->argument('name'), $ultimo_slash + 1);
            $namespace = 'App\\Http\\Requests\\API\\'.str_replace('/', '\\', substr($this->argument('name'), 0, $ultimo_slash));

        } else {
            $namespace = 'App\\Http\\Requests\\API';
            $class_name = $this->argument('name');
        }

        return [
            'NAMESPACE' => $namespace,
            'CLASS_NAME' => $class_name,
        ];
    }

    /**
     * Get the stub path and the stub variables
     */
    public function getSourceFile(): mixed
    {
        return $this->getStubContents($this->getStubPath(), $this->getStubVariables());
    }

    /**
     * Replace the stub variables(key) with the desire value
     */
    public function getStubContents(mixed $stub, array $stubVariables = []): mixed
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$'.$search.'$', $replace, $contents);
        }

        return $contents;
    }

    /**
     * Get the full path of generate class
     */
    public function getSourceFilePath(): string
    {
        return base_path('app/Http/Requests/API').'/'.$this->argument('name').'Request.php';
    }

    /**
     * Build the directory for the class if necessary.
     */
    protected function makeDirectory(string $path): string
    {
        if (! $this->files->isDirectory($path)) {
            $this->files->makeDirectory($path, 0777, true, true);
        }

        return $path;
    }
}
