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
        $video->category()->sync($request->get('category'));
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

    public function find($id)
    {
        try {
            return $this->video->find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function update(int $id,array $request)
    {
        try {
            $videoResult = $this->video->find($id);
            if(isset($request['video'])){
                $fileName = $request['video']->getClientOriginalName();
                $filePath = 'videos/' . $fileName;
 
                $isFileUploaded = Storage::disk('public')->put($filePath, file_get_contents($request['video']));
 
                // File URL to access the video in frontend
                // $url = Storage::disk('public')->url($filePath);
 
                if ($isFileUploaded) {
                    $video['title'] = $request['title'];
                    $video['path'] = $filePath;
                    $videoResult->update($video);
                }
                $videoResult->category()->sync($request['category']);
                return $videoResult;
            } else {
                $video['title'] = $request['title'];
                $videoResult->update($video);
                $videoResult->category()->sync($request['category']);
                return $videoResult;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $videoDelete = $this->video->with(['category'])->find($id);
            $videoDelete->category()->detach();
            $videoDelete->delete();
            return $videoDelete;

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
