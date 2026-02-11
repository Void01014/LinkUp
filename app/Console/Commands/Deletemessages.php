<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class deletemessages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'messages:delete {--time=24}';

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
        Delete
        // echo "workinnnnnnnnnnnnnnnnnnnnnn " . $this->option('time') . "\n" ;
        
    }
}
