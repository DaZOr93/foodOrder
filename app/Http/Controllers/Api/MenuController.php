<?php

namespace App\Http\Controllers\Api;

use App\Facades\LoadPictureFacade as LoadPicture;
use App\Http\Controllers\Controller;
use App\Http\Requests\Menu\StoreRequest;
use App\Http\Requests\Menu\UpdateRequest;
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
    public function edit($id)
    {
        $menu = Menu::find($id);
        return $menu;
    }
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token','image');
        if ($request->file('image')) {
            $filename = LoadPicture::saveImage($request->file('image'));
            $data['picture' ] =  'storage/image/' . $filename;
        }
        $menu = Menu::find($id);
        $menu->update($data);

        return 200;
    }
    public function store(StoreRequest  $request)
    {

        $data = $request->except('_token','image');
        if ($request->file('image')) {
            $filename = LoadPicture::saveImage($request->file('image'));
            $data['picture' ] =  'storage/image/' . $filename;
        }
        Menu::create($data);
        return 200;
    }
    public function destroy($id)
    {
        $menu=Menu::find($id);
        $menu->delete();

        return 200;

    }

}
