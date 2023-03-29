<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Constants\Constants;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class VideoService
{
    protected $video;

    protected $category;


    public function __construct(Video $video, Category $category)
    {
        $this->video = $video;
        $this->category = $category;
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
            $video->link_test = $request->link_test;
            $video->code = $this->randString(10);
            
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

    function randString( $length ) {
        $str =null;
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }
        return $str;
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

    public function detailVideo($id)
    {
        try {
            $data = $this->video->with(['category'])->find($id);
            $data['history_score'] = DB::table('sheet')->where('email', Auth::user()->email)->where('code', $data->code)->orderBy('created_at', 'desc')->get();
            return $data;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function checkRoleWatch($idVideo, $idCategory)
    {
        try {
            $categories = $this->category->with(['videos'])->find($idCategory);
            if(sizeof($categories['videos']) >= 2)
            {
                $position = 0;
                foreach($categories['videos'] as $key => $value){
                    if($value->id == $idVideo){
                        $position = $key;
                    }
                }
                if($position >= 1) {
                    $video = DB::table('sheet')->where('email', Auth::user()->email)->where('code', $categories['videos'][$position - 1]['code'])->orderBy('created_at', 'desc')->first();
                    $scoreArray = explode("/", $video->score);
                    if(intval($scoreArray[0]) >= 7) {
                        return 1;
                    } else return 0;
                } else return 1;
            } else return 1;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
