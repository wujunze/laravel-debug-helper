<?php declare(strict_types=1);
/**
 *
 * This file is part of the package.
 *
 * (c) Panda <itwujunze@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace WuJunze\LaravelDebugHelper\Providers;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use WuJunze\LaravelDebugHelper\Services\DebugSqlService;
use WuJunze\LaravelDebugHelper\Services\LogProfile;
use WuJunze\LaravelDebugHelper\Services\LogWriter;

class ServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        $this->setConfig();

        if ($this->app['config']->get('app.debug')) {
            // if any of logging type is enabled we will listen database to get all
            // executed queries
            if ($this->app['config']->get('debug_helper.debug_sql.log_queries') ||
                $this->app['config']->get('debug_helper.debug_sql.log_slow_queries')) {
                // create logger class
                $logger = new DebugSqlService($this->app);

                // listen to database queries
                $this->app['db']->listen(function (
                    $query,
                    $bindings = null,
                    $time = null
                ) use ($logger) {
                    $logger->log($query, $bindings, $time);
                });
            }
        }

        $this->app->singleton(LogProfile::class, config('debug_helper.http_logger.log_profile'));
        $this->app->singleton(LogWriter::class, config('debug_helper.http_logger.log_writer'));
    }

    protected function setConfig()
    {
        $source = realpath(__DIR__.'/../../config/debug_helper.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                $source => (function_exists('config_path') ?
                    config_path('debug_helper.php') :
                    base_path('config/debug_helper.php')),
            ]);
        }
        $this->mergeConfigFrom($source, 'debug_helper');
    }
}
