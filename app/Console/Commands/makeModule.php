<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeModule extends Command
{
    protected $signature = 'make:module {name}';

    protected $description = 'Generate Repository, Interface, Service and Binding';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));

        $this->createInterface($name);
        $this->createRepository($name);
        $this->createService($name);

        $this->bindRepository($name);

        $this->info("{$name} module generated successfully.");
    }

    /*
    |--------------------------------------------------------------------------
    | Interface
    |--------------------------------------------------------------------------
    */

    protected function createInterface($name)
    {
        $directory = app_path('Repositories/Interfaces');

        File::ensureDirectoryExists($directory);

        $path = $directory . "/{$name}Interface.php";

        if (File::exists($path)) {
            $this->warn("{$name}Interface already exists.");
            return;
        }

        $content = "<?php

namespace App\Repositories\Interfaces;

interface {$name}Interface
{

}
";

        File::put($path, $content);
    }

    /*
    |--------------------------------------------------------------------------
    | Repository
    |--------------------------------------------------------------------------
    */

    protected function createRepository($name)
    {
        $directory = app_path('Repositories');

        File::ensureDirectoryExists($directory);

        $path = $directory . "/{$name}Repository.php";

        if (File::exists($path)) {
            $this->warn("{$name}Repository already exists.");
            return;
        }

        $content = "<?php

namespace App\Repositories;

use App\Repositories\Interfaces\\{$name}Interface;

class {$name}Repository implements {$name}Interface
{

}
";

        File::put($path, $content);
    }

    /*
    |--------------------------------------------------------------------------
    | Service
    |--------------------------------------------------------------------------
    */

    protected function createService($name)
    {
        $directory = app_path('Services');

        File::ensureDirectoryExists($directory);

        $path = $directory . "/{$name}Service.php";

        if (File::exists($path)) {
            $this->warn("{$name}Service already exists.");
            return;
        }

        $variable = lcfirst($name);

        $content = "<?php

namespace App\Services;

use App\Repositories\Interfaces\\{$name}Interface;

class {$name}Service
{
    protected \${$variable}Repository;

    public function __construct(
        {$name}Interface \${$variable}Repository
    ) {
        \$this->{$variable}Repository = \${$variable}Repository;
    }
}
";

        File::put($path, $content);
    }

    /*
    |--------------------------------------------------------------------------
    | Binding
    |--------------------------------------------------------------------------
    */

    protected function bindRepository($name)
{
    /*
    |--------------------------------------------------------------------------
    | Existing Provider Path
    |--------------------------------------------------------------------------
    */

    $providerPath = app_path('Providers/AppServiceProvider.php');

    $content = File::get($providerPath);

    /*
    |--------------------------------------------------------------------------
    | Use Statements
    |--------------------------------------------------------------------------
    */

    $interfaceUse =
        "use App\Repositories\Interfaces\\{$name}Interface;";

    $repositoryUse =
        "use App\Repositories\\{$name}Repository;";

    if (!str_contains($content, $interfaceUse)) {

        $content = str_replace(
            "namespace App\Providers;",
            "namespace App\Providers;

{$interfaceUse}
{$repositoryUse}",
            $content
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Binding Code
    |--------------------------------------------------------------------------
    */

    $bindingCode = "\$this->app->bind(
            {$name}Interface::class,
            {$name}Repository::class
        );";

    /*
    |--------------------------------------------------------------------------
    | Prevent Duplicate Bindings
    |--------------------------------------------------------------------------
    */

    if (!str_contains($content, $bindingCode)) {

        $content = preg_replace(
            '/public function register\(\): void\s*\{/',
            "public function register(): void
    {
        {$bindingCode}",
            $content,
            1
        );
    }

    File::put($providerPath, $content);
}
}
