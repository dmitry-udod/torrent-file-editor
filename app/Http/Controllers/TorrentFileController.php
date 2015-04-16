<?php namespace App\Http\Controllers;

use File;
use Log;
use Input;
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
        $fullFileName = $this->getFullFileName($fileName);
        $decodedFile =  $this->decoder->decodeFile($fullFileName);
        $torrent = Torrent::createFromTorrentFile($fullFileName);

        return view('torrent.edit', compact('decodedFile', 'torrent', 'fileName'));
    }

    public function updateAndDownload($fileName)
    {
        $fullFileName = $this->getFullFileName($fileName);
        $torrent = Torrent::createFromTorrentFile($fullFileName);
        $info = $torrent->getInfo();
        $info['name'] = Input::get('name');
        $torrent->setInfo($info);
        $torrent->save($fileName);
//        $torrent->se
//        dd($fileName);
        dd(\Input::all());
        return response()->download($fileName);
    }

    /**
     * Get full file path
     *
     * @param $fileName
     * @return string
     * @throws FileNotFoundException
     */
    private function getFullFileName($fileName)
    {
        $path = public_path('uploads');
        $files = File::files($path);
        $fullFileName = $path . DIRECTORY_SEPARATOR . $fileName;

        if (!in_array($fullFileName, $files)) {
            Log::error('Cant edit file', [$path, $fileName, $files]);
            throw new FileNotFoundException;
        }

        return $fullFileName;
    }
}
