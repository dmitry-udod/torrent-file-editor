<?php namespace App\Http\Controllers;

use File;
use Log;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class TorrentFileController extends Controller
{
    public function edit($fileName)
    {
        $path = public_path('uploads');
        $files = File::files($path);

        if (!in_array($path . DIRECTORY_SEPARATOR . $fileName, $files)) {
            Log::error('Cant edit file', [$path, $fileName, $files]);
            throw new FileNotFoundException;
        }
    }
}
