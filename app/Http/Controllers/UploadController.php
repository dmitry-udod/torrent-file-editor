<?php namespace App\Http\Controllers;

use App\Http\Requests\UploadFileFromUrlRequest;
use App\Http\Requests\UploadFileRequest;
use Input;
use Log;
use File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadController extends Controller
{
    /**
     * Upload torrent file
     *
     * @param UploadFileRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function file(UploadFileRequest $request)
    {
        /** @var UploadedFile $file */
        $file = Input::file('torrent_file');
        $fileName = $file->getClientOriginalName();
        $path = public_path('uploads');
        $result = $file->move($path, $fileName);

        if ($result) {
            return redirect()->route('edit_torrent_file', $fileName);
        } else {
            Log::error('Error cant move file:', [$fileName, $path]);
            return redirect()->back()->withErrors(['error' => "Can't save file"]);
        }
    }

    public function fileFromUrl(UploadFileFromUrlRequest $request)
    {
        $contents = file_get_contents(Input::get('url'));
        $path = public_path('uploads');
        $fileName = uniqid() . '.torrent';
        $fullFilePath = $path . DIRECTORY_SEPARATOR . $fileName;
        $result = File::put($fullFilePath, $contents);

        if ($result) {
            return redirect()->route('edit_torrent_file', $fileName);
        } else {
            Log::error('Error cant download file:', [$fileName, $path]);
            return redirect()->back()->withErrors(['error' => "Can't download torrent file"]);
        }
    }
}
