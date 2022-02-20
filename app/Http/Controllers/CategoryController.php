<?php

namespace App\Http\Controllers;

use App\Http\Requests\Category\StoreRequest;
use App\Http\Requests\Category\UpdateRequest;
use App\Models\Category;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use function PHPUnit\Framework\isEmpty;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        $categories = Category::paginate(5);
        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {

        if ($request->isMethod('post') && $request->file('image')) {
            $file = $request->file('image');
            $upload_folder = 'public/image';
            $filename = date("YmdHis") . "-" . $file->getClientOriginalName(); // image.jpg
            Storage::putFileAs($upload_folder, $file, $filename);
        }
        $category = ['name' => $request->name, 'picture' => 'storage/image/' . $filename];
        Category::create($category);
        return redirect()->route('category.index');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('categories.update', ['category' => $category]);
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

        if ($request->isMethod('post') && $request->file('image')) {
            $file = $request->file('image');
            $upload_folder = 'public/image';
            $filename = date("YmdHis") . "-" . $file->getClientOriginalName(); // image.jpg
            Storage::putFileAs($upload_folder, $file, $filename);
            $data['picture' ] =  'storage/image/' . $filename;
        }
        $category = Category::find($id);
        $category->update($data);

        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $categoryId = Menu::where('category_id', $id)->get();
        if ($categoryId->isEmpty()) {
            $category = Category::find($id);
            $category->delete();
        }

        return redirect()->back();
    }
}
