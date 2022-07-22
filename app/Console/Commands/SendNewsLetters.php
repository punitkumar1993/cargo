<?php

namespace App\Console\Commands;

use App\Models\Post;
use App\Models\Setting;
use Illuminate\Console\Command;

class SendNewsLetters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:sendNewsLetter';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a newsletter to subscribers.';

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
        $newsletter_status = Setting::where('name', 'newsletter_status')->first();
        if($newsletter_status->value == "true")
        {
            $result = Post::sendNewsLetter();
            dd($result['message']);
        }
    }
}
