<?php

namespace NextDeveloper\Commons;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Str;
use Illuminate\Support\Stringable;
use NextDeveloper\Commons\Macros\Acronym;

/**
 * Class CommonsServiceProvider
 *
 * @package NextDeveloper\Commons
 */
class CommonsServiceProvider extends AbstractServiceProvider {
    /**
     * @var bool
     */
    protected $defer = false;

    /**
     * @throws \Exception
     *
     * @return void
     */
    public function boot() {
        $this->publishes([
            __DIR__.'/../config/commons.php' => config_path('commons.php'),
        ], 'config');

        $this->loadViewsFrom($this->dir.'/../resources/views', 'Commons');

//        $this->bootErrorHandler();
        $this->bootChannelRoutes();
        $this->bootModelBindings();
        $this->bootLogger();
        $this->bootMacros();
        $this->bootSchedule();
    }

    public function bootMacros() {
        //  String macros
        $macros = [
            'acronym' => Acronym::class,
        ];

        foreach ($macros as $macro) {
            if(!Str::hasMacro($macro::NAME, $macro)) {
                Str::macro($macro::NAME, app($macro)());
                Stringable::macro($macro::NAME, app($macro)());
            }
        }
    }

    /**
     * @return void
     */
    public function register() {
        $this->registerHelpers();
        $this->registerMiddlewares('generator');
        $this->registerRoutes();
        $this->registerCommands();

        $this->mergeConfigFrom(__DIR__.'/../config/commons.php', 'commons');
        $this->customMergeConfigFrom(__DIR__.'/../config/relation.php', 'relation');
    }

    /**
     * @return void
     */
    public function bootLogger() {
//        $monolog = Log::getMonolog();
//        $monolog->pushProcessor(new \Monolog\Processor\WebProcessor());
//        $monolog->pushProcessor(new \Monolog\Processor\MemoryUsageProcessor());
//        $monolog->pushProcessor(new \Monolog\Processor\MemoryPeakUsageProcessor());
    }

    /**
     * @return array
     */
    public function provides() {
        return ['generator'];
    }

//    public function bootErrorHandler() {
//        $this->app->singleton(
//            ExceptionHandler::class,
//            Handler::class
//        );
//    }

    /**
     * @return void
     */
    private function bootChannelRoutes() {
        if (file_exists(($file = $this->dir.'/../config/channel.routes.php'))) {
            require_once $file;
        }
    }

    /**
     * Register module routes
     *
     * @return void
     */
    protected function registerRoutes() {
        if ( ! $this->app->routesAreCached() && config('leo.allowed_routes.commons', true) ) {
            $this->app['router']
                ->namespace('NextDeveloper\Commons\Http\Controllers')
                ->group(__DIR__.DIRECTORY_SEPARATOR.'Http'.DIRECTORY_SEPARATOR.'api.routes.php');
        }
    }

    /**
     * Registers module based commands
     * @return void
     */
    protected function registerCommands() {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Commands\FetchExchangeRateCommand::class,
                Console\Commands\TaskSchedulerActionCommand::class,
            ]);
        }
    }

    /**
     * This is here, in case of shit happens!
     * @return void
     */
    private function checkDatabaseConnection() {
        $isSuccessfull = false;

        try {
            \DB::connection()->getPdo();

            $isSuccessfull = true;
        } catch (\Exception $e) {
            die('Could not connect to the database. Please check your configuration. error:'.$e);
        }

        return $isSuccessfull;
    }
    // EDIT AFTER HERE - WARNING: ABOVE THIS LINE MAY BE REGENERATED AND YOU MAY LOSE CODE

    protected function bootSchedule(): void
    {
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
            $schedule->command('common:fetch-exchange-rate')
                ->cron(config('commons.exchange_rate.schedule.cron'))
                ->when(function () {
                    return config('commons.exchange_rate.schedule.enabled');
                })
                ->before(function () {
                    logger()->info('Fetches Exchange Rates starting...');
                })
                ->after(function () {
                    logger()->info('Fetches Exchange Rates ended.');
                });

//            $schedule->command('common:task-scheduler-action')
//                ->cron(config('commons.task_scheduler.schedule.cron'))
//                ->when(function () {
//                    return config('commons.task_scheduler.schedule.enabled');
//                })
//                ->before(function () {
//                    logger()->info('Task Scheduler starting...');
//                })
//                ->after(function () {
//                    logger()->info('Task Scheduler ended.');
//                });
        });
    }
}
