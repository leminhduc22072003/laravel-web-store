<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactSocialNetworkController extends Controller
{
    public function __construct()
    {
        $this->middleware('check-admin-writer-permission');
    }

    public function index() {
        $categories = Category::with('parent')->get();
        return view('admin.category.list')->with(compact('categories'));
    }

    public function getForm() {
        $categories = Category::whereNull('category_id')->get();
        return view('admin.category.form')->with(compact('categories'));
    }

    public function saveForm(Request $request) {
        $rules = [
            'name' => 'required|max:255',
        ];

        $messages = [
            'name.required' => 'Tên danh mục không được để trống',
            'name.max' => 'Tên danh mục không được quá 255 ký tự',
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
        $categories = Category::whereNull('category_id')->get();
        return view('admin.category.edit', compact('category', 'categories'));
    }

    public function updateForm(Request $request, $id) {
        $rules = [
            'name' => 'required|max:255',
        ];

        $messages = [
            'name.required' => 'Tên danh mục không được để trống',
            'name.max' => 'Tên danh mục không được quá 255 ký tự',
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            // tra ve true neu validate bi loi
            return redirect()->back()->withErrors($validator)->withInput($request->input());
        } else {
            $updateRequest = $request->all();
            unset($updateRequest['_token']);
            Category::where('id', '=', $id)->update($updateRequest);
            return redirect()->route('admin.category.list');
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
        Category::FindOrFail($id)->delete();
        return redirect()->back();
    }
}
