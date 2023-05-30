<?php
namespace App\Services;

use App\Jobs\SendEmailJob;

class EmailService
{


    public function __construct(SendEmailJob $mailService)
    {
    }

    public function send(string $email, string $subject, string $body): void
    {
        $emailComposition = [
            'to' => $email,
            'subject' => $subject,
            'body' => $body
        ];

        $job = app()->make(SendEmailJob::class, $emailComposition);
        dispatch($job);
    }

}
