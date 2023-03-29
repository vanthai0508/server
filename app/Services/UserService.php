<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use App\Constants\Constants;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserService
{
    protected $user;
    protected $category;

    public function __construct(User $user, Category $category)
    {
        $this->user = $user;
        $this->category = $category;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            return $this->user->get();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function registerCategory($id)
    {
        try {
            $user = $this->user->find(Auth::user()->id);
            $data = DB::table('user_category')->where('user_id', Auth::user()->id)->where('category_id', $id)->get();
            if(sizeof($data) == 0){
                $user->category()->attach($id);
                return 1;
            } else return 0;
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function listCategoryOfUser()
    {
        try {
            $listCategory = $this->user->with(['category'])->find(Auth::user()->id);
            return $listCategory;
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }

    public function checkRoleWatchCategory($id)
    {
        try {
            $listCategory = $this->user->with(['category'])->find(Auth::user()->id);
            foreach($listCategory['category'] as $category){
                if($category->id == $id){
                    return 1;
                }
            }
            return 0;
            
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return null;
        }
    }
}
