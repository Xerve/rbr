<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateDataCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update users data and users posts from api once a day';

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
        app('App\Http\Controllers\UpdateDataController')->updateUsers();
        app('App\Http\Controllers\UpdateDataController')->updatePosts();
        \Log::info("Data downloaded and updated");
    }
}
