<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends BaseController
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function create(Request $request)
    {

        return $this->sendResponse($this->categoryService->create($request), "Created");
    }

    public function list()
    {

        return $this->sendResponse($this->categoryService->list(), "List category");
    }
}
