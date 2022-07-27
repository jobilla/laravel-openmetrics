# Open Metrics / Prometheus Metrics for Laravel

## Installation
```bash
composer require jobilla/laravel-openmetrics
```

This package should be auto discovered by Laravel.

If it isn't, add `Jobilla\LaravelOpenMetrics\Providers\OpenMetricsServiceProvider` to your `config/app.php` providers list.

## Configuration

Laravel Open Metrics has sensible defaults configured, and the configuration is changable via environment variables. However, if you would prefer to bring the configuration into your own repository, then run the following command:

```bash
php artisan vendor:publish --tag=laravel-openmetrics
```

## Feature Set
- Multiple Adapters (APC, APCng, Memory, Redis)
- HTTP Metrics
- Database Metrics

## Usage

### Enable / Disable Laravel Open Metrics

By default, Laravel Open Metrics is enabled. To turn it off set your environment variable `OPENMETRICS_ENABLED` to `false`. Alternatively, you can also use the `OPENMETRICS_ADAPTER` set to `memory`.

### Changing The Adapter

Laravel Open Metrics supports the following adapters:

- apc (requires APC extension and `symfony/polyfill-apcu` if PHP >8.0)
- apcng (requires APC extension and `symfony/polyfill-apcu` if PHP >8.0)
- memory
- redis (requries Redis extension)

> **note**
> APC and APCng are not enabled for CLI environments by default.
> 
> For these instances, you may want to choose a different adapter, or turn off Laravel Metrics.
>
> For more information: https://www.php.net/manual/en/apcu.configuration.php
>
> For more information on APCng: https://github.com/PromPHP/prometheus_client_php/blob/main/README.APCng.md

### Configuring Redis

To provide custom configuration to the Redis adapter, the following options are available to you

| Redis Configuration Option | Environment Variable                       | Configuration Option                     | Default Value | Comments   |
|----------------------------|--------------------------------------------|------------------------------------------|---------------|------------|
| host                       | `OPENMETRICS_REDIS_HOST`                   | openmetrics.redis.host                   | 127.0.0.1     |            |
| port                       | `OPENMETRICS_REDIS_PORT`                   | openmetrics.redis.port                   | 6379          |            |
| password                   | `OPENMETRICS_REDIS_PASSWORD`               | openmetrics.redis.password               | null          |            |
| database                   | `OPENMETRICS_REDIS_DATABASE`               | openmetrics.redis.database               | 0             |            |
| timeout                    | `OPENMETRICS_REDIS_TIMEOUT`                | openmetrics.redis.timeout                | 0.1           | in seconds |
| read_timeout               | `OPENMETRICS_REDIS_READ_TIMEOUT`           | openmetrics.redis.read_timeout           | 10            | in seconds |
| persistent_connections     | `OPENMETRICS_REDIS_PERSISTENT_CONNECTIONS` | openmetrics.redis.persistent_connections | false         |            |


## Further Reading
- [Open Metrics](https://openmetrics.io/)
- [Prometheus](https://prometheus.io/)
- [Laravel](https://laravel.com/)
- [Jobilla's Open Source Engineering](https://github.com/jobilla)