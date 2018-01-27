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
	Log::info($request->all());

	Log::info($request->uploads[0]);
 	//Log::info($request->uploads[0]->storeAs('', 'testfile.txt'));

 	//$contents = Storage::get('public/StatueOfLiberty.jpg');
 	//$path = Storage::putFileAs('public', $request->uploads[0]->getClientOriginalName(), 'local');

	//return "res = " . move_uploaded_file($request->uploads[0]->getClientOriginalName(), "/var/www/html/lds-api/storage/app/public/" . $request->uploads[0]->getClientOriginalName());

	return $request->uploads[0]->move('/var/www/html/lds-api/storage/app/public/', $request->uploads[0]->getClientOriginalName());


 	return $request->all();
/*

	Log::info(print_r($request->uploads[0]->getClientOriginalName(), true));

	$fileName = $request->uploads[0]->getClientOriginalName();
	Log::info("fileName:  " . $fileName);

	$milliseconds = round(microtime(true) * 1000);

	$storedFileName = $milliseconds . "--" . $fileName;
	Log::info("storedFileName:  " . $storedFileName);
	$storedFile = $request->uploads[0]->storeAs('public', $storedFileName);
	Log::info("storedFile:  " . $storedFile);
	return;

    $fileMetaData = new TrainingContent();
    $fileMetaData->training_contents_uuid = Uuid::generate();
    $fileMetaData->file_path = 'public';
    $fileMetaData->file_name = $fileName;
    $fileMetaData->file_type = $request->uploads[0]->getMimeType();
    $fileMetaData->video_length = 10;

    Log::info("File extension:  " . strtolower($request->uploads[0]->getClientOriginalExtension()));

    if(strtolower($request->uploads[0]->getClientOriginalExtension()) == "mp4") {
    	$ffmpeg = FFMpeg::create();

		if(file_exists($storedFile . "/" . $fileName)) { 
			$finfo = finfo_open(FILEINFO_MIME_TYPE);

			$mime_type = finfo_file($finfo, $storedFile . "/" . $fileName);

			finfo_close($finfo);

			if (preg_match('/video//', $mime_type)) { 
				$video_attributes = _get_video_attributes($storedFile, $ffmpeg_path);

				Log::info($video_attributes['hours'] . ':' . $video_attributes['mins'] . ':' . $video_attributes['secs'] . '.' . $video_attributes['ms']);
			} 
		}
	    $fileMetaData->video_length = 10;
    }
*/

    //echo print_r($fileMetaData, true);
    //Log::info("Saving file metadata:  " . print_r($fileMetaData, true));
    //$fileMetaData->save();

	//return $request->all();
});

Route::get('/getfile', function (Request $request) {
	$contents = Storage::get('public/StatueOfLiberty.jpg');
	$contents = Storage::url('public/StatueOfLiberty.jpg');
	$contents = Storage::url('public/UserStatusChanges.mp4');
	return $contents;
});

Route::get('/training/getcontent', function (Request $request) {
	Log::info("Getting content");
	$trainingContent = TrainingContent::first();

	$contents = Storage::url($trainingContent->file_path . "/" . $trainingContent->file_name);
	return $contents;
});


Route::post('/training/getprogress', function (Request $request) {
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

