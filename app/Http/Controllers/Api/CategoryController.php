<?php

namespace App\Http\Controllers\Api;

use App\Facades\LoadPictureFacade as LoadPicture;
use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $category = Category::all();


        return $category;
    }
    public function store(StoreRequest $request)
    {
        $filename = LoadPicture::saveImage($request->file('image'));
        $category = ['name' => $request->name, 'picture' => 'storage/image/' . $filename];
        Category::create($category);
        return redirect()->route('category.index');

    }

    public function edit($id)
    {
        $category = Category::find($id);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = ['name' => $request->name];

        if ($request->file('image')) {
            $filename = LoadPicture::saveImage($request->file('image'));
            $data['picture' ] =  'storage/image/' . $filename;
        }
        $category = Category::find($id);
        $category->update($data);

        return 200;
    }


    public function destroy($id)
    {
        $categoryId = Menu::where('category_id', $id)->get();
        if ($categoryId->isEmpty()) {
            $category = Category::find($id);
            $category->delete();
            return 200;
        }
        return response()->json(['errors' => ['delete'=>["Категория не пустая"]]], 422);

    }
}
