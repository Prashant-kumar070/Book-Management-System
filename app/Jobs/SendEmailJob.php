<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use QBeacon\QueueMonitor\Models\QueueMonitor;
use Illuminate\Support\Facades\DB;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;

    /**
     * Create a new job instance.
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        Log::info("SendEmailJob started for: {$this->email}");

        // Find the existing monitor record using the `uuid` in the payload
        $jobMonitor = QueueMonitor::where('failed_job_id', $this->job->uuid)->first();
        Log::info($jobMonitor);

        if (!$jobMonitor) {
            // If no monitor record exists, create a new one
            $jobMonitor = QueueMonitor::create([
                'job_name' => 'SendEmailJob',
                'status' => 'processing',
                'attempts' => $this->attempts(),
                'failed_job_id' => $this->job->uuid,
            ]);
        } else {
            // Update the existing monitor record
            $jobMonitor->update([
                'status' => 'processing',
                'attempts' => $this->attempts(),
            ]);
        }

        try {
            // Send email
            Mail::raw('This is a test email from the job queue!', function ($message) {
                $message->to($this->email)
                        ->subject('Test Email from Laravel Queue');
            });

            Log::info("Email sent successfully to: {$this->email}");

            // Mark the job as completed
            $jobMonitor->update(['status' => 'completed']);
        } catch (\Exception $e) {
            Log::error("SendEmailJob failed: " . $e->getMessage());

            // Mark the job as failed
            $jobMonitor->update(['status' => 'failed']);
            throw $e; // Rethrow the exception to let Laravel handle it
        }
    }
}
