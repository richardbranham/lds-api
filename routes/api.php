<?php

use Illuminate\Http\Request;

use Webpatser\Uuid\Uuid;
use App\Location;
use App\TrainingContent;
use App\TrainingProgress;
use App\User;

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

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

    Route::get('user', function (Request $request) {
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

		$timestamp = round(microtime(true));

		$start = microtime(true);

		$diskFilePath = '/var/www/html/lds-api/storage/app/public/';
		$diskFileName = explode(".", $request->uploads[0]->getClientOriginalName())[0] . "-$timestamp." . $request->uploads[0]->getClientOriginalExtension();
		$diskFileNameWithPath = $diskFilePath . $diskFileName;

		$fileType = $request->uploads[0]->getMimeType();
		Log::info("move:  " . $request->uploads[0]->move($diskFilePath, $diskFileName));

		$getID3 = new getID3;
	    $ThisFileInfo = $getID3->analyze($diskFileNameWithPath);
	    $duration = $ThisFileInfo['playtime_seconds'];

	    $end = microtime(true);
	    Log::info("Processed in " . round(($end - $start) * 1000) . " milliseconds.");

	    $trainingModel = new TrainingContent();
	    $trainingModel->training_contents_uuid = Uuid::generate();
	    $trainingModel->file_path = $diskFilePath;
	    $trainingModel->file_name = $diskFileName;
	    $trainingModel->video_length = intval($duration);
	    if($duration > 0) {
	    	$trainingModel->file_type = $fileType;
	    }
	    $trainingModel->save();
	});

	Route::get('/getfile', function (Request $request) {
		$contents = Storage::get('public/StatueOfLiberty.jpg');
		$contents = Storage::url('public/StatueOfLiberty.jpg');
		$contents = Storage::url('public/UserStatusChanges.mp4');
		return $contents;
	});

	Route::post('/training/getcontent/{getall?}', function (Request $request) {
		Log::info("Getting content");
		//Log::info($request->all());
		Log::info("auth user: " . Auth::user());

		if(!Auth::user())
		{
			return "{'error':'User not set'}";
		}

		if($request->getall == true) {
			Log::info("Returning all training content.");
			$recs = TrainingContent::all();
			foreach($recs as $rec) {
				Log::info("===> " . $rec);
			}
			Log::info(TrainingContent::all());
			return TrainingContent::all();
		}

		$users_id = Auth::user()->id;

		if(isset($users_id)) {
			Log::info("users_id is set to " . $users_id);
		}
		else {
			Log::info("users_id is not set");
		}

		Log::info(json_encode(User::find($users_id)->trainingcontent));

		return User::find($users_id)->trainingcontent;
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

	Route::post('/training/push', function (Request $request) {
		// Continue logic for pushing training to all users.
		return "Nada push";
	});

	Route::post('/training/updateprogress', function (Request $request) {
		return "Nada";

		$trainingProgress = TrainingContent::first();

		$contents = Storage::url($trainingContent->file_path . "/" . $trainingContent->file_name);
		return $contents;
	});

}); // group

