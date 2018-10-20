# laravel-debug-helper
Laravel package to help debug
This package allows you to log SQL queries (and slow SQL queries) to log file in Laravel framework

[![Build Status](https://travis-ci.org/wujunze/laravel-debug-helper.svg?branch=master)](https://travis-ci.org/wujunze/laravel-debug-helper)
[![Latest Stable Version](https://poser.pugx.org/wujunze/laravel-debug-helper/v/stable.svg)](https://packagist.org/packages/wujunze/laravel-debug-helper)
[![Licence](https://poser.pugx.org/wujunze/laravel-debug-helper/license.svg)](https://packagist.org/packages/wujunze/laravel-debug-helper)
[![Total Downloads](https://poser.pugx.org/wujunze/laravel-debug-helper/downloads.svg)](https://packagist.org/packages/wujunze/laravel-debug-helper)


## Inspiration and Thanks
[mnabialek/laravel-sql-logger](https://github.com/mnabialek/laravel-sql-logger)   
[lingxi/laravel-sql-log](https://github.com/lingxi/laravel-sql-log)

## Installation

```php   
 composer require wujunze/laravel-debug-helper --dev 
```
   
Please keep the `--dev` option. (it's recommended to use this package only for development). 
The Logger will be enabled when APP_DEBUG is true

## Configuration

If you use Laravel < 5.5 open `app/Providers/AppServiceProvider.php` and in `register` method add:

```php
public function register()
{
    if ($this->app['config']->get('app.debug')) {
        $this->app->register(WuJunze\LaravelDebugHelper\Providers\ServiceProvider::class);
    }
}
```
    
> Laravel 5.5 uses Package Auto-Discovery and it will automatically load this service provider so you don't need to add anything into above file.
    
    
If you use Laravel < 5.5 run:
    
```php
php artisan vendor:publish --provider="WuJunze\LaravelDebugHelper\Providers\ServiceProvider"
```
    
in your console to publish default configuration files.
    
#### If you are using Laravel 5.5 run:
    
```php
php artisan vendor:publish
```
    
and choose the number matching `"WuJunze\LaravelDebugHelper\Providers\ServiceProvider"` provider.
This operation will create config file in `config/sql_loger.php`.
By default you should not edit published file because all the settings are loaded from `.env` file by default.

For Lumen you should skip this step. 
        
#### In your .env file add the following entries:

```
# Whether all SQL queries should be logged
SQL_LOG_QUERIES=true 

# Whether slow SQL queries should be logged (you can log all queries and
# also slow queries in separate file or you might to want log only slow queries)
SQL_LOG_SLOW_QUERIES=true

# Time of query (in milliseconds) when this query is considered as slow
SQL_SLOW_QUERIES_MIN_EXEC_TIME=100

#Whether slow SQL queries should be logged (you can log all queries and
#also slow queries in separate file or you might to want log only slow queries)
SQL_LOG_OVERRIDE=false

# Directory where log files will be saved
SQL_LOG_DIRECTORY=logs/sql

# Whether execution time in log file should be displayed in seconds(by default it's in milliseconds)
SQL_CONVERT_TIME_TO_SECONDS=false

# Whether artisan queries should be logged to separate files
SQL_LOG_SEPARATE_ARTISAN=false
```
    
## License
MIT

