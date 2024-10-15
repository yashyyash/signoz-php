<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

use OpenTelemetry\SDK\Trace\TracerProviderFactory;
use OpenTelemetry\SDK\Common\Attribute\Attributes;
use OpenTelemetry\SDK\Trace\SpanProcessor\SimpleSpanProcessor;
use OpenTelemetry\SDK\Trace\TracerProvider;

// Set environment variables for SigNoz OTLP endpoint
putenv('OTEL_EXPORTER_OTLP_ENDPOINT=http://localhost:4318/v1/traces');  // SigNoz OTel collector's path
putenv('OTEL_EXPORTER_OTLP_PROTOCOL=http/protobuf');

// Initialize the Tracer Provider
$factory = new TracerProviderFactory();
$tracerProvider = $factory->create();
$tracer = $tracerProvider->getTracer('io.signoz.php.example');

// Create and activate the root span
$root = $span = $tracer->spanBuilder('root')->startSpan();
$rootScope = $span->activate();

// Create, initialize, set data, and end spans inside the for loop
for ($i = 0; $i < 3; $i++) {
    // Start a span, register some events
    $span = $tracer->spanBuilder('loop-' . $i)->startSpan();

    $span->setAttribute('remote_ip', '1.2.3.4')
        ->setAttribute('country', 'USA');

    // Corrected attributes initialization
    $span->addEvent('found_login' . $i, new Attributes([
        'id' => $i,
        'username' => 'otuser' . $i,
    ], 0)); // Set dropped attributes count to 0

    $span->addEvent('generated_session', new Attributes([
        'id' => md5((string) microtime(true)),
    ], 0)); // Set dropped attributes count to 0

    $span->end();
}
echo "Trace data sent successfully.";

// End the root span
$root->end();
$rootScope->detach();

