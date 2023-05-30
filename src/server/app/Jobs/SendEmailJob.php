<?php

namespace App\Jobs;

use Illuminate\Support\Facades\Mail;
use Throwable;
use App\Mail\SendEmail;

class SendEmailJob extends Job
{

    public $timeout = 0;
    /**
    * The number of times the job may be attempted.
    *
    * @var int
    */
    public $tries = 5;

    /**
    * Email data and params
    *
    * @var array
    */
    protected $email;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        try {
            Mail::to($this->email['to'])
            // ->cc($array_emails)
            // ->bcc($array_emails)
            ->send(new SendEmail($this->email));
        } catch (\Exception $e) {
            return $e->getMessage;
        }
    }


     /**
     * Handle a job failure.
     *
     * @param  \Throwable  $exception
     * @return void
     */
    public function failed(Throwable $exception)
    {
        // Send user notification of failure, etc...
    }

}