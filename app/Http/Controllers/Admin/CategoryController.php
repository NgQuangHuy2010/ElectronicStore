<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function Index()
    {
        $data["category"] = Category::get();
        return view("Admin/Category/Index", $data);
    }
    public function Create(Request $request)
    {
        $messages = [
            'name.required' => 'Vui lòng điền tên danh mục !!',
            'image.required' => 'Vui lòng thêm hình cho danh mục này !!!',
            'image.mimes' => 'Vui lòng chọn hình ảnh có định dạng jpeg, png, gif, jpg, ico, webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 4MB.',
        ];
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "name" => "required",
                'image' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
            ], $messages);
            $category = new Category();
            $category->name = $request->name;
            if ($request->hasFile("image")) {
                $img = $request->file("image");
                $nameimage = time() . "_" . $img->getClientOriginalName();
                //move vao thu vien public
                $img->move('public/file/img/img_category/', $nameimage);
                //gan ten hinh anh vao cot image
                $category->image = $nameimage;
            }
            $category->save();
            toastr()->success('Tạo mới thành công!');
            return redirect()->route("Admin.CategoryIndex");
        }
        return view("Admin/Category/Create");
    }

    public function Update(Request $request, $id = null)
    {
        $olddata["category_old"] = Category::find($id);
        $messages = [
            'name.required' => 'Vui lòng điền tên danh mục !!',
            'image.mimes' => 'Vui lòng chọn hình ảnh có định dạng jpeg, png, gif, jpg, ico, webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 4MB.',
        ];
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "name" => "required",
                'image' => 'mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
                'image.max' => 'Kích thước hình ảnh không được vượt quá 4MB.',
            ], $messages);
            $category = Category::find($id);
            $category->name = $request->name;
            if ($request->hasFile("image")) {
                $img = $request->file("image");
                $nameimage = time() . "_" . $img->getClientOriginalName();
                //delete hình cũ
                @unlink('public/file/img/img_category/' . $olddata["category_old"]->image);
                //move vao thu vien public
                $img->move('public/file/img/img_category/', $nameimage);
                //gắn tên hình ảnh vào cột image db
                $category->image = $nameimage;
            } else {
                $category->image = $olddata["category_old"]->image;
            }
            $category->save();
            toastr()->success(' Cập nhật thành công !');
            return redirect()->route("Admin.CategoryIndex");
        } else {
            // dd($olddata);
            return view("Admin/Category/Update", $olddata);
        }

    }
    public function Delete($id)
    {
        try {
            if (Products::where('idCategory', $id)->exists()) {
        
                toastr()->error('Đang có sản phẩm trong danh mục này !!!');
                return redirect()->route('Admin.CategoryIndex');
            }
            $load = Category::find($id);
            @unlink('public/file/img/img_category/' . $load->image);
            Category::destroy($id);
            toastr()->success('Xóa thành công!');
            return redirect()->route('Admin.CategoryIndex'); //chuyen ve trang category
        } catch (\Throwable $th) {

            return redirect()->route('Admin.CategoryIndex'); //chuyen ve trang category
        }
    }
}
