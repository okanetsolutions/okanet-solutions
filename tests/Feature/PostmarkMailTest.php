<?php

use Symfony\Component\Mailer\Bridge\Postmark\Transport\PostmarkApiTransport;

it('builds the Postmark API transport with the configured message stream', function (): void {
    config()->set('services.postmark.key', 'POSTMARK_API_TEST');
    config()->set('mail.mailers.postmark.message_stream_id', 'outbound');

    $transport = app('mail.manager')->mailer('postmark')->getSymfonyTransport();

    expect($transport)
        ->toBeInstanceOf(PostmarkApiTransport::class)
        ->and((string) $transport)
        ->toBe('postmark+api://api.postmarkapp.com?message_stream=outbound');
});
