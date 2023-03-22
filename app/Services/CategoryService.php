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
}
