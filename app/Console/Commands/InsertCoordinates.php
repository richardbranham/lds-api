<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Location;
use Webpatser\Uuid\Uuid;

class InsertCoordinates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'location:insertcoordinates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Insert coordinates into locations table.';

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
        echo "Insert coordinates" . PHP_EOL;
        $coord = "33.8809787,-84.1300936";
        $coord = explode(",", $coord);
        $loc = new Location();
        $loc->latitude = $coord[0];
        $loc->longitude = $coord[1];
        $loc->users_id = 1;
        $loc->location_uuid = Uuid::generate();
        $loc->save();
        //echo print_r($loc, true);
    }
}
