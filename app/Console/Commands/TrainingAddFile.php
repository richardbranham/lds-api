<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\TrainingContent;
use Webpatser\Uuid\Uuid;

class TrainingAddFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'training:addfile';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add a training file.';

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
        $file = new TrainingContent();
        $file->training_contents_uuid = Uuid::generate();
        $file->file_path = 'public';
        $file->file_name = 'UserStatusChanges.mp4';
        $file->file_type = 'video';
        $file->video_length = 10;
        //echo print_r($file, true);
        $file->save();
    }
}
