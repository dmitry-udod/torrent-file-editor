<?php namespace App\Http\Controllers;

use File;
use Log;
use Input;
use App;
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

        try {
            $decodedFile =  $this->decoder->decodeFile($fullFileName);
            $torrent = Torrent::createFromTorrentFile($fullFileName);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => "Can't decode torrent file"]);
        }

        return view('torrent.edit', compact('decodedFile', 'torrent', 'fileName'));
    }

    /**
     * Update and download torrent file
     *
     * @param $fileName
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws FileNotFoundException
     */
    public function updateAndDownload($fileName)
    {
        $fullFileName = $this->getFullFileName($fileName);
        $torrent = Torrent::createFromTorrentFile($fullFileName);
        App::make('TorrentFile')->update($torrent, Input::all(), $fileName);

        return response()->download($fileName, Input::get('file_name'))->deleteFileAfterSend(true);
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
