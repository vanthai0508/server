<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(CategoryRequest $request)
    {

        return $this->sendResponse($this->categoryService->create($request), "Created");
    }

    public function list()
    {

        return $this->sendResponse($this->categoryService->list(), "List category");
    }

    public function find($id)
    {
        return $this->sendResponse($this->categoryService->find($id), "Category");
    }

    public function update($id, CategoryRequest $request)
    {
        return $this->sendResponse($this->categoryService->update($id, $request->all()), "Updated category");
    }

    public function delete($id)
    {
        return $this->sendResponse($this->categoryService->delete($id), "Deleted");
    }

    public function videoOfCategory($id)
    {
        return $this->sendResponse($this->categoryService->videoOfCategory($id), "Video of category");
    }
}
