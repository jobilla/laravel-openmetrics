<?php

namespace Jobilla\LaravelOpenMetrics\Http\Controllers;

use Illuminate\Http\Response;
use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;

class Metrics
{
    public function __invoke(RenderTextFormat $renderer, CollectorRegistry $registry)
    {
        return new Response(
            $renderer->render($registry->getMetricFamilySamples()),
            Response::HTTP_OK,
            ['Content-Type' => RenderTextFormat::MIME_TYPE]
        );
    }
}