<?php

namespace App\Jobs;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class Deletemessages implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */

    private $time;
    private $user_id;

    public function __construct($user_id, $time)
    {
        $this->user_id = $user_id;
        $this->time = $time;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $deleteBefore = Carbon::now()->subHours($this->time);

        Log::info("remove mr. $this->user_id messages that pass $this->time Houre") ;

        //run when messages is ready
        // Message::where('user_id', $this->user_id)
        //     ->where('created_at', '<', $deleteBefore)
        //     ->delete();
    }
}
