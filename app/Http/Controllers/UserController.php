<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class UserController extends BaseController
{

    protected $userService;
    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }
    

    
    
    public function list()
    {
        return $this->sendResponse($this->userService->list(), "List user");
    }

    public function registerCategory($id)
    {
        if($this->userService->registerCategory($id) == 1){
            return $this->sendResponse(null, "Success!!");
        } else {
            return $this->sendError("You are registered !!!", null, $code = 422);
        }
    }

    public function listCategoryOfUser()
    {   
        return $this->sendResponse($this->userService->listCategoryOfUser(), "List category");
    }
    
    public function checkRoleWatchCategory($id)
    {
        if($this->userService->checkRoleWatchCategory($id) == 1){
            return $this->sendResponse(null, "Check role watch category!!");
        } else {
            return $this->sendError("Please register category !!!", null, $code = 422);
        }
    }
}   