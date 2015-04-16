<?php namespace App\Http\Controllers;

use File;
use Log;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use PHP\BitTorrent\Torrent;

class TorrentFileController extends Controller
{
    public function __construct()
    {
        $encoder = new \PHP\BitTorrent\Encoder();
        $this->decoder = new \PHP\BitTorrent\Decoder($encoder);
    }

    /**
     * @param $fileName
     * @return \Illuminate\View\View
     * @throws FileNotFoundException
     */
    public function edit($fileName)
    {
        $path = public_path('uploads');
        $files = File::files($path);
        $fullFileName = $path . DIRECTORY_SEPARATOR . $fileName;

        if (!in_array($fullFileName, $files)) {
            Log::error('Cant edit file', [$path, $fileName, $files]);
            throw new FileNotFoundException;
        }

        $decodedFile =  $this->decoder->decodeFile($fullFileName);
        $torrent = Torrent::createFromTorrentFile($fullFileName);

        return view('torrent.edit', compact('decodedFile', 'torrent', 'fileName'));
    }
}