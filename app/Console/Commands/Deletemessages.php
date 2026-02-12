<?php

namespace App\Console\Commands;

use App\Jobs\Deletemessages as JobsDeletemessages;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class Deletemessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = "messages:delete {user_id} {--time=24}";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete user messeges that reach the spesified time ';

    /**
     * Execute the console command.
     */
    public function handle()
    {

        $user_id = $this->argument('user_id') ;
        $time = $this->option('time') ;

        $this->info("remove mr. $user_id messages that pass $time Houre") ;
        JobsDeletemessages::dispatch($user_id , $time) ;
        
        
    }
}
