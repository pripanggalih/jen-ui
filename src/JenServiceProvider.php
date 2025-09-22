<?php

namespace Jen;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Jen\Console\Commands\JenAddCommand;
use Jen\Console\Commands\JenInstallCommand;

class JenServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register components using auto-discovery for optimal performance
        $prefix = config('jen.prefix', 'jen');
        Blade::componentNamespace('Jen\\View\\Components', $prefix);

        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'jen');
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Register blade directives
        $this->registerBladeDirectives();

        // Share prefix to all jen views for dynamic component references
        view()->composer('jen::*', function ($view) use ($prefix) {
            $view->with('jenPrefix', $prefix);
        });

        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function registerBladeDirectives(): void
    {
        $this->registerScopeDirective();
    }

    public function registerScopeDirective(): void
    {
        /**
         * All credits from this blade directive goes to Konrad Kalemba.
         * Just copied and modified for my very specific use case.
         *
         * https://github.com/konradkalemba/blade-components-scoped-slots
         */
        Blade::directive('scope', function ($expression) {
            // Split the expression by `top-level` commas (not in parentheses)
            $directiveArguments = preg_split("/,(?![^\(\(]*[\)\)])/", $expression);
            $directiveArguments = array_map('trim', $directiveArguments);

            [$name, $functionArguments] = $directiveArguments;

            // Build function "uses" to inject extra external variables
            $uses = Arr::except(array_flip($directiveArguments), [$name, $functionArguments]);
            $uses = array_flip($uses);
            array_push($uses, '$__env');
            array_push($uses, '$__bladeCompiler');
            $uses = implode(',', $uses);

            /**
             *  Slot names can't contains dot , eg: `user.city`.
             *  So we convert `user.city` to `user___city`
             *
             *  Later, on component it will be replaced back.
             */
            $name = str_replace('.', '___', $name);

            return "<?php \$__bladeCompiler = \$__bladeCompiler ?? null; \$loop = null; \$__env->slot({$name}, function({$functionArguments}) use ({$uses}) { \$loop = (object) \$__env->getLoopStack()[0] ?>";
        });

        Blade::directive('endscope', function () {
            return '<?php }); ?>';
        });
    }

    /**
     * Register any package services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/jen.php', 'jen');
    }

    /**
     * Console-specific booting.
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file
        $this->publishes([
            __DIR__ . '/../config/jen.php' => config_path('jen.php'),
        ], 'jen.config');

        $this->commands([
            JenInstallCommand::class,
        ]);
    }
}
