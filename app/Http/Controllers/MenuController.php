<?php

namespace App\Http\Controllers;

use App\Http\Requests\Menu\StoreRequest;
use App\Http\Requests\Menu\UpdateRequest;
use App\Models\Menu;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return
     */
    public function index()
    {

        $categories = Category::all();
        $menu = Menu::all();

        return view('index', ['categories' => $categories, 'menu' => $menu]);
    }

    public function category($category){

        $categories = Category::all();
        $menu = Menu::where('category_id' ,$category)->get();

        return view('index', ['categories' => $categories, 'menu'=>$menu, 'categoryId'=>$category]);

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return
     */
    public function create()
    {
        $categories = Category::all();
        return view('menu.create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest  $request)
    {

        $data = $request->except('_token','image');
        if ($request->isMethod('post') && $request->file('image')) {
            $file = $request->file('image');
            $upload_folder = 'public/image';
            $filename = date("YmdHis") . "-" . $file->getClientOriginalName(); // image.jpg
            Storage::putFileAs($upload_folder, $file, $filename);
            $data['picture' ] =  'storage/image/' . $filename;
        }
        Menu::create($data);
        return redirect()->route('index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $menu = Menu::find($id);
       $categories = Category::all();
       return view('menu.update', ['menu'=>$menu, 'categories'=>$categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        $data = $request->except('_token','image');
        if ($request->isMethod('post') && $request->file('image')) {
            $file = $request->file('image');
            $upload_folder = 'public/image';
            $filename = date("YmdHis") . "-" . $file->getClientOriginalName(); // image.jpg
            Storage::putFileAs($upload_folder, $file, $filename);
            $data['picture' ] =  'storage/image/' . $filename;
        }
        $menu = Menu::find($id);
        $menu->update($data);

        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
