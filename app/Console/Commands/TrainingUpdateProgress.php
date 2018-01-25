<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TrainingProgress;
use Webpatser\Uuid\Uuid;

class TrainingUpdateProgress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'training:updateprogress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        echo "Not implemented.  No action taken." . PHP_EOL;
    }
}
