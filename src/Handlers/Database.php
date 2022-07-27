<?php

namespace Jobilla\LaravelOpenMetrics\Handlers;

use Illuminate\Contracts\Config\Repository;
use Illuminate\Database\Events\QueryExecuted;
use Illuminate\Support\Facades\DB;
use Prometheus\CollectorRegistry;

class Database
{
    protected CollectorRegistry $registry;
    protected Repository $config;

    public function __construct(CollectorRegistry $registry, Repository $config)
    {
        $this->registry = $registry;
        $this->config = $config;
    }

    public function handle()
    {
        DB::listen(function(QueryExecuted $query) {
            $labels = ['query' => $query->sql, 'model' => strtok($query->sql, ' ')];

            $counter = $this->registry->getOrRegisterCounter('db', 'query_total', 'Number of ran queries', array_keys($labels));
            $counter->inc(array_values($labels));

            $duration = $this->registry->getOrRegisterHistogram('db', 'query_duration_ms', 'Duration of queries', array_keys($labels));
            $duration->observe($query->time, array_values($labels));
        });
    }
}