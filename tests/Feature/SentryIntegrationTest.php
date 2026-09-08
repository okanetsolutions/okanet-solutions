<?php

use Sentry\State\HubInterface;

it('reports Laravel exceptions to Sentry', function () {
    $hub = app(HubInterface::class);
    $previousEventId = $hub->getLastEventId();

    report(new RuntimeException('Sentry integration verification'));

    expect($hub->getLastEventId())->not->toEqual($previousEventId);
});
