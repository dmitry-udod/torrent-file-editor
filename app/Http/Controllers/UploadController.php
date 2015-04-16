<?php namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use Input;
use Log;
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
}
