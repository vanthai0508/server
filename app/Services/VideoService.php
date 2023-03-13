<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Support\Facades\Log;
use App\Constants\Constants;
use Illuminate\Support\Facades\Storage;

class VideoService
{
    protected $video;

    public function __construct(Video $video)
    {
        $this->video = $video;
    }


    public function uploadVideo($request)
    {
        $fileName = $request->video->getClientOriginalName();
        $filePath = 'videos/' . $fileName;
 
        $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request->video));
 
        // File URL to access the video in frontend
        // $url = Storage::disk('public')->url($filePath);
 
        if ($isFileUploaded) {
            $video = new Video();
            $video->title = $request->title;
            $video->path = $filePath;
            $video->save();
        }
        return $video;
    }

    public function list()
    {
        try {
            return $this->video->get();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
