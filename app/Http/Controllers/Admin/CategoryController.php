<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('check-admin-writer-permission');
    }

    public function index() {
        $categories = Category::with('child1', 'child1.child2', 'child1.parent1', 'child1.child2.parent1', 'child1.child2.parent2')
            ->whereNull('parent_id_1')->whereNull('parent_id_2')->orderBy('id', 'asc')->get();
        return view('admin.category.list')->with(compact('categories'));
    }

    public function getForm() {
        $categories = Category::whereNull('parent_id_1')->get();
        return view('admin.category.form')->with(compact('categories'));
    }

    public function saveForm(Request $request) {
        $rules = [
            'name' => 'required|max:255',
            'code' => 'required|unique:categories,code',
            'link' => 'required|unique:categories,link',
        ];

        $messages = [
            'name.required' => 'Tên danh mục không được để trống',
            'name.max' => 'Tên danh mục không được quá 255 ký tự',
            'code.required' => 'Mã danh mục không được để trống',
            'code.unique' => 'Mã danh mục không được trùng',
            'link.required' => 'Link danh mục không được để trống',
            'link.unique' => 'Link danh mục không được trùng',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $data = $request->all();
            Category::create($data);
            return redirect()->route('admin.category.list');
        }
    }

    public function editForm($id) {
        $category = Category::FindOrFail($id);
        $categories1 = Category::whereNull('parent_id_1')->get();
        $categories2 = Category::where('parent_id_1', '=', $category->parent_id_1)->get();
        return view('admin.category.edit', compact('category', 'categories1', 'categories2'));
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'name' => 'required|max:255|unique:categories,name,'. $id,
            'code' => 'required|unique:categories,code,'. $id,
            'link' => 'required|unique:categories,link,'. $id,
        ];

        $messages = [
            'name.required' => 'Tên danh mục không được để trống',
            'name.max' => 'Tên danh mục không được quá 255 ký tự',
            'name.unique' => 'Tên danh mục không được trùng nhau',
            'code.required' => 'Mã danh mục không được để trống',
            'code.unique' => 'mã danh mục không được trùng nhau',
            'link.required' => 'Link danh mục không được để trống',
            'link.unique' => 'Link danh mục không được trùng nhau',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $category = Category::FindOrFail($id);
            $updateRequest = $request->all();
            unset($updateRequest['_token']);
            $category->update($updateRequest);
            return redirect()->route('admin.category.list');
        }
    }

    public function delete($id) {
        Category::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
