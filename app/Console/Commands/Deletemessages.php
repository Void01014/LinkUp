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
<<<<<<< HEAD
    protected $signature = "messages:delete {user_id} {--time=24}" ;
=======
    protected $signature = "messages:delete {user_id} {--time=24}";
>>>>>>> d1c7fdc08c68fb79728d3dc35d53d24534f92fff

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
