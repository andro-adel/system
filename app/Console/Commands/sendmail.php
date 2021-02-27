<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\users;

class sendmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'expire user every 5 mintues auto';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = users::where('expire' , 0)->get();
        foreach($users as $user) {
            $user -> update(['expire' => 1]);
        }
    }
}
