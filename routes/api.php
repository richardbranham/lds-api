<?php

use Illuminate\Http\Request;

use Webpatser\Uuid\Uuid;
use FFMpeg\FFMpeg;
use App\Location;
use App\TrainingContent;
use App\TrainingProgress;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//http://ldsapi.kotter.net/api/user

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/location', function (Request $request) {

	$lat = mt_rand(33500000, 34500000) / 1000000;
	$lng = 1 - (mt_rand(84000000, 85000000) / 1000000);

    $loc = new Location();
    $loc->latitude = $lat;
    $loc->longitude = $lng;
    $loc->users_id = 1;
    $loc->location_uuid = Uuid::generate();
    $loc->save();

	return Location::orderBy('created_at')->get();
});


Route::post('/uploadfile', function (Request $request) {
	//Log::info($request->all());

	return $request->uploads[0]->move('/var/www/html/lds-api/storage/app/public/', $request->uploads[0]->getClientOriginalName());
});

Route::get('/getfile', function (Request $request) {
	$contents = Storage::get('public/StatueOfLiberty.jpg');
	$contents = Storage::url('public/StatueOfLiberty.jpg');
	$contents = Storage::url('public/UserStatusChanges.mp4');
	return $contents;
});

Route::post('/training/getcontent', function (Request $request) {
	Log::info("Getting content");
	Log::info($request->all());

	if(isset($request->users_id)) {
		Log::info("users_id is set to " . $request->users_id);
	}
	else {
		Log::info("users_id is not set");
	}

	$trainingContent = TrainingContent::first();

	if(isset($trainingContent)) {
		$contents = Storage::url($trainingContent->file_path . "/" . $trainingContent->file_name);
		$contents = "/storage/aPasswordEntry - Copy.mp4";
		return $contents;
	}
	else {
		return json_encode("no_training_found");
	}
});


Route::post('/training/getprogress', function (Request $request) {
	Log::info("Getting progress");
	$users_id = $request->userId;
	$training_contents_uuid = $request->contentId;

	Log::info("users_id = " . $users_id);
	Log::info("training_contents_uuid = " . $training_contents_uuid);

	$trainingProgress = TrainingProgress::where([['training_contents_uuid', '=', $training_contents_uuid], ['users_id', '=', $users_id]])->first();

	if(!$trainingProgress) {
		$t = new TrainingProgress();
		$t->training_progress_uuid = Uuid::generate();
		$t->training_contents_uuid = $training_contents_uuid;
		$t->users_id = $users_id;
		$t->video_last_location = 0;
		$t->save();
		return $t;
	}

	return $trainingProgress;
});


Route::post('/training/updateprogress', function (Request $request) {
	return "Nada";

	$trainingProgress = TrainingContent::first();

	$contents = Storage::url($trainingContent->file_path . "/" . $trainingContent->file_name);
	return $contents;
});

