<?php

namespace App\Http\Controllers;

use App\Http\Requests\VideoRequest;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use App\Services\VideoService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends BaseController
{
    protected $videoService;
    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }
    //
    public function uploadVideo(VideoRequest $request)
    {
        return $this->sendResponse($this->videoService->uploadVideo($request), "Video uploaded");
    }

    public function list()
    {
        return $this->sendResponse($this->videoService->list(), "List video");
    }

    public function find($id)
    {
        return $this->sendResponse(new VideoResource($this->videoService->find($id)) , "Video");
    }

    public function update($id, VideoRequest $request)
    {
        // dd($request);
        return $this->sendResponse(new VideoResource($this->videoService->update($id, $request->all())), "Video updated");
    }

    public function delete($id)
    {
        return $this->sendResponse($this->videoService->delete($id), "Deleted");
    }

    public function detailVideo($id)
    {   
        return $this->sendResponse($this->videoService->detailVideo($id), "Detail video");
    }
}
