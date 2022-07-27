<?php

namespace Jobilla\LaravelOpenMetrics\Handlers;

use Illuminate\Contracts\Http\Kernel;
use Jobilla\LaravelOpenMetrics\Http\Middleware\RecordRequestMetrics;

class Http
{
    protected Kernel $kernel;

    public function __construct(Kernel $kernel)
    {
        $this->kernel = $kernel;
    }

    public function handle()
    {
        $this->kernel->prependMiddleware(RecordRequestMetrics::class);
    }
}