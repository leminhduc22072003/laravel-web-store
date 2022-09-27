<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('check-admin-writer-permission');
    }

    public function index() {
        $categories = Category::whereNotNull('parent_id_2')->pluck('name', 'id');
        $products = Product::with('category')->get();
        return view('admin.product.list')->with(compact('products', 'categories'));
    }

//    public function filter(Request $request) {
//        $districts = District::pluck('name', 'id');
//        $teachers = Personnel::with('commune','district', 'school');
//        $filter = [];
//        if ($request->district_id) {
//            $filter['district_id'] = $request->district_id;
//        }
//        if ($request->commune_id) {
//            $filter['commune_id'] = $request->commune_id;
//        }
//        $teachers = $teachers->where($filter)->get();
//        return view('admin.education.personnel.list')->with(compact('teachers', 'districts'));
//    }

    public function getForm() {
        $categories = Category::whereNotNull('parent_id_2')->pluck('name', 'id');
        return view('admin.product.form')->with(compact('categories'));
    }

    public function saveForm(Request $request) {
        $rules = [
            'name' => 'required|max:255|unique:products,name',
            'code' => 'required|unique:products,code',
        ];

        $messages = [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự',
            'name.unique' => 'Tên sản phẩm không được trùng nhau',
            'code.required' => 'Mã sản phẩm không được để trống',
            'code.unique' => 'mã sản phẩm không được trùng nhau',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $category = Category::where('id', $request->category_id)->first();
            $data = $request->all();
            $data['category_id'] = $category->parent_id_1;
            $data['category_id_2'] = $category->parent_id_2;
            $data['category_id_3'] = $category->id;
            for ($i = 1; $i < 9; $i++) {
                unset($data['avatar'.$i]);
                if($request->hasFile('avatar'.$i))
                {
                    $image_path = $request->file('avatar'.$i)->store('products', 'public');
                    $data['avatar'.$i] = $image_path;
                }
            }
            Product::create($data);
            return redirect()->route('admin.product.list');
        }
    }

    public function editForm($id) {
        $categories = Category::whereNotNull('parent_id_2')->pluck('name', 'id');
        $product = Product::FindOrFail($id);
        return view('admin.product.edit', compact('categories', 'product'));
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'name' => 'required|max:255|unique:products,name,'. $id,
            'code' => 'required|unique:products,code,'. $id,
        ];

        $messages = [
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự',
            'name.unique' => 'Tên sản phẩm không được trùng nhau',
            'code.required' => 'Mã sản phẩm không được để trống',
            'code.unique' => 'mã sản phẩm không được trùng nhau',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $product = Product::FindOrFail($id);
            $category = Category::where('id', $request->category_id)->first();
            $updateRequest = $request->all();
            $updateRequest['category_id'] = $category->parent_id_1;
            $updateRequest['category_id_2'] = $category->parent_id_2;
            $updateRequest['category_id_3'] = $category->id;
            unset($updateRequest['_token']);
            for ($i = 1; $i < 9; $i++) {
                unset($updateRequest['avatar'.$i]);
                if ($request->hasFile('avatar'.$i)) {
                    //xoa anh cu neu co
                    $currentImg = $product->avatar.$i;
                    if ($currentImg) {
                        Storage::delete('public/' . $currentImg);
                    }
                    //cap nhap anh moi
                    $image = $request->file('avatar'.$i);
                    $pathImage = $image->store('products', 'public');
                    $updateRequest['avatar'.$i] = $pathImage;
                }
            }
            $product->update($updateRequest);
            return redirect()->route('admin.product.list');
        }
    }

//    public function exportData() {
////        field => title
//        $exportFields = [
//            'name' => __('Họ và tên'),
//            'gender' => __('Giới tính'),
//            'birthday' => __('Ngày sinh'),
//            'address' => __('địa chỉ'),
//            'district_id' => __('Quận/ huyện'),
//            'commune_id' => __('Phường/ xã'),
//            'phone' => __('Số điện thoại'),
//            'email' => __('Thư điện tử'),
//            'school_id' => __('Đang học tại trường'),
//            'type_school' => __('Cấp'),
//            'type_teacher' => __('Chức vụ'),
//            'level' => __('Trình độ học vấn'),
//        ];
//        $teachers = Personnel::with('district', 'commune', 'school')->orderBy('created_at', 'desc')->get();
//        $gender = config('base.gender');
//        $type_school = config('base.type_of_school');
//        $level = config('base.level_of_teacher');
//        $type_teacher = config('base.type_of_teacher');
//
//        $data = [];
//        foreach ($teachers as $item) {
//            $item['gender'] = $item->gender ? $gender[$item->gender] : '';
//            $item['district_id'] = $item['district'] ['name'];
//            $item['commune_id'] = $item['commune'] ['name'];
//            $item['school_id'] = $item['school']['name'];
//            $item['type_school'] = $item->type_school ? $type_school[$item->type_school] : '';
//            $item['type_teacher'] = $item->type_teacher ? $type_teacher[$item->type_teacher] : '';
//            $item['level'] = $item->level ? $level[$item->level] : '';
//
//            $item = $item->toArray();
//            $data[] = $item;
//        }
//        $this->downloadExcel('Nhân sự data'.date('Y-m-d'), $exportFields, $data, 'Nhân sự-'.date('Y-m-d').'.xlsx');
//    }

    public function delete($id) {
        Product::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
