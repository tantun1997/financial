<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
class MakeService extends Command
{
    protected $signature = 'make:service {name}';

    protected $description = 'Create a new service class';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $name = $this->argument('name');
        $serviceClass = Str::studly($name);

        $servicePath = app_path("Services/{$serviceClass}.php");

        if (File::exists($servicePath)) {
            $this->error("Service {$serviceClass} already exists!");
            return;
        }

        $stub = File::get(app_path('Stubs/service.stub'));

        $stub = str_replace('DummyService', $serviceClass, $stub);

        File::put($servicePath, $stub);

        $this->info("Service {$serviceClass} created successfully.");
    }
}
