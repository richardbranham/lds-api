<?php

use Illuminate\Http\Request;

use Webpatser\Uuid\Uuid;
use App\Location;
use App\TrainingContent;

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


Route::get('/getfile', function (Request $request) {
	$contents = Storage::get('public/StatueOfLiberty.jpg');
	$contents = Storage::url('public/StatueOfLiberty.jpg');
	$contents = Storage::url('public/UserStatusChanges.mp4');
	return $contents;
});

Route::get('/training/getcontent', function (Request $request) {
	$trainingContent = TrainingContent::first();

	$contents = Storage::url($trainingContent->file_path . "/" . $trainingContent->file_name);
	return $contents;
});
