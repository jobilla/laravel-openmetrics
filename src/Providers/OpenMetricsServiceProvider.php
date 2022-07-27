<?php

namespace Jobilla\LaravelOpenMetrics\Providers;

use Illuminate\Support\ServiceProvider;
use Prometheus\CollectorRegistry;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Http\Kernel;
use Jobilla\LaravelOpenMetrics\Exceptions\UnsupportedAdapterException;
use Jobilla\LaravelOpenMetrics\Handlers\Database;
use Jobilla\LaravelOpenMetrics\Http\Controllers\Metrics;
use Prometheus\Storage\APC;
use Prometheus\Storage\APCng;
use Prometheus\Storage\InMemory;
use Prometheus\Storage\Redis;

class OpenMetricsServiceProvider extends ServiceProvider
{
    protected CollectorRegistry $registry;
    protected $configuration_path = __DIR__ . '/../../config/openmetrics.php';

    public function register()
    {
        $this->mergeConfigFrom($this->configuration_path, 'openmetrics');
    }

    public function boot(Repository $config, Kernel $kernel)
    {
        $this->publishes([$this->configuration_path], 'laravel-openmetrics');

        if ($config->get('openmetrics.enabled', true)) {
            $this->app->singleton(CollectorRegistry::class, function() use ($config) {
                $adapter = $config->get('openmetrics.adapter', 'memory');

                switch ($adapter) {
                    case 'redis':
                        return new CollectorRegistry(new Redis($config->get('openmetrics.redis', [])));
                    break;
                    case 'apc':
                        return new CollectorRegistry(new APC);
                    break;
                    case 'apcng':
                        return new CollectorRegistry(new APCng);
                    break;
                    case 'memory':
                        return new CollectorRegistry(new InMemory);
                    break;
                    default:
                        throw new UnsupportedAdapterException("Adapter `{$adapter}` is not supported.");
                    break;
                }
            });

            if ($config->get('openmetrics.handles.database')) {
                $this->app->make(Database::class)->handle();
            }

            if ($config->get('openmetrics.route.enabled')) {
                $this->app['router']->get($config->get('openmetrics.route.path'), Metrics::class);
            }
        }
    }
}