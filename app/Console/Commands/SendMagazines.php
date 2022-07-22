<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;

class SendMagazines extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:sendMagazine';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a published magazine to subscribers.';

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
        $result = Post::sendMagazineLetter();
        dd($result['message']);
    }
}
