<?php

namespace App\Services;

use App\Models\Video;
use Illuminate\Support\Facades\Log;
use App\Constants\Constants;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create($request)
    {
        try {
            $image = $request->file('file');

            $imageName = time() . '.' . $image->extension();

            $image->storeAs('public/images', $imageName);

            $request['path'] = 'storage/images/'.$imageName;
            return $this->category->create($request->all()); 
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function list()
    {
        try {
            return $this->category->get();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function find($id)
    {
        try {
            return $this->category->find($id);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function update($id, $request)
    {
        try {

            $category = $this->find($id);
            $category->update($request);
            return $category;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function delete($id)
    {
        try {
            $categoryDelete = $this->find($id);
            $categoryDelete->videos()->detach();
            $categoryDelete->delete();
            return $categoryDelete;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function videoOfCategory($id)
    {
        try {
            $category = $this->category->with(['videos'])->find($id);
            return $category;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function search($request)
    {
        try {
            if($request['textSearch'] == null){
                $category = $this->category->get();
            } else {
                $category = $this->category->where('name', 'LIKE', "%{$request['textSearch']}%")->get();
            }
            return $category;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
