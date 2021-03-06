<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

$this->app->bind('TorrentFile', function()
{
    return new \App\Generators\TorrentFile();
});

Route::get('/', 'WelcomeController@index');

Route::post('upload-torrent-file', ['as' => 'upload_torrent_file', 'uses' => 'UploadController@file']);
Route::post('upload-torrent-file-from-url', ['as' => 'upload_torrent_file_from_url', 'uses' => 'UploadController@fileFromUrl']);
Route::get('edit-torrent-file/{fileName}', ['as' => 'edit_torrent_file', 'uses' => 'TorrentFileController@edit']);
Route::post('edit-torrent-file/{fileName}', ['as' => 'download_torrent_file', 'uses' => 'TorrentFileController@updateAndDownload']);