<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UploadFile;
use DB;
use Log;

class ZTPController extends Controller
{
    public function home()
    {
        $files = UploadFile::all();
        return view('ztp.home', compact('files'));
    }

    public function uploadFile(Request $request)
    {
        $this->validate($request, [
            'filename' => 'required|string',
            'file_type' => 'required|string',
            'upload_file' => 'required'
        ]);

        DB::beginTransaction();
        try {
            $uploadFile = UploadFile::create([
                'filename' => $request->filename,
                'file_type' => $request->file_type,
            ]);

            $file = request()->file('upload_file');
            $name = $request->filename . '_' . $uploadFile->id . '.' .$file->getClientOriginalExtension();
            $folder = '/lcw/ztp/';
            $filePath = $this->uploadOne($file, $folder, $name);

            $uploadFile->file_path = $filePath;
            $uploadFile->save();

            DB::commit();
            session()->flash('success_message', 'File Uploaded Successfully.');
            
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }

        return back();
    }

    public function deleteFile(UploadFile $file)
    {
        DB::beginTransaction();
        try {
            $this->deleteOne($file->file_path);
            $file->delete();
            DB::commit();
            session()->flash('success_message', 'File deleted successfully.');
        } catch (\Exception $ex) {
            DB::rollback();
            Log::error($ex->getMessage());
            session()->flash('error_message', $ex->getMessage());
        }
        return back();
    }
}
