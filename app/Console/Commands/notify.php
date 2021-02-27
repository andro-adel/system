<?php

namespace App\Console\Commands;

use App\Mail\notifymail;
use App\Models\users;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class notify extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notify for all users every day';

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
        //$user = users::select('email')->get();
        $emails = users::pluck('email')->toArray();
        $data = ['title'=>'programming' , 'body'=>'php'];
        foreach($emails as $email) {
            Mail::To($email)->send(new notifymail($data));
        }
    }
}
