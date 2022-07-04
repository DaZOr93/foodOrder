<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menu = Menu::where('status' ,'active')->with(['category'])->get();

        return $menu;
    }

    public function category($category)
    {
        $menu = Menu::where('status' ,'active')->where('category_id', $category)->with(['category'])->get();

        return $menu;
    }

}
