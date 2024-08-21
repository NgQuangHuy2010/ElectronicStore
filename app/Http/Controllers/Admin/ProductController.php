<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function Index()
    {
        //lấy sản phẩm có mối quan hệ với Category được định nghĩa phương thức có belongsTo trong model Products 
        $data["products"] = Products::with('Category')->get();
        return view("Admin/Product/Index", $data);
    }

    public function Create(Request $request)
    {

        $messages = [
            'name_product.required' => 'Vui lòng điền tên sản phẩm !!',
            'image.required' => 'Vui lòng thêm hình cho sản phẩm này !!!',
            'image.mimes' => 'Vui lòng chọn hình ảnh có định dạng jpeg, png, gif, jpg, ico, webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 4MB.',
            'price_product.required' => 'Vui lòng thêm giá gốc cho sản phẩm !',
            'price_product.numeric' => 'Giá phải là số !',
            'discount.required' => 'Vui lòng thêm giá bán cho sản phẩm !',
            'discount.numeric' => 'Giá phải là số !',
            'model.required' => 'Vui lòng thêm model cho sản phẩm !',
            'idCategory.required' => 'Vui lòng chọn danh mục !!',
            'image_specifications.mimes' => 'Vui lòng chọn hình ảnh có định dạng jpeg, png, gif, jpg, ico, webp.',
            'image_specifications.max' => 'Kích thước hình ảnh không được vượt quá 4MB.'
        ];
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "name_product" => "required",
                'image' => 'required|mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
                'image_specifications' => 'mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
                'price_product' => "required",
                'discount' => "required",
                'model' => "required",
                'idCategory' => "required"
            ], $messages);
            //thay đổi lại số tiền bỏ chữ trước khi đưa vào sql
            $request->merge([
                'price_product' => preg_replace('/[^\d.]/', '', str_replace(',', '', $request->price_product)),
                'discount' => preg_replace('/[^\d.]/', '', str_replace(',', '', $request->discount))
            ]);
            $create_product = new Products();
            $create_product->name_product = $request->name_product;
            $create_product->description = $request->description;
            $create_product->model = $request->model;
            $create_product->price_product = $request->price_product;
            $create_product->discount = $request->discount;
            $create_product->producer = $request->producer;
            $create_product->origin = $request->origin;
            $create_product->images = $request->images;  //images fix sau
            $create_product->status = 1;
            $create_product->idCategory = $request->idCategory;

            if ($request->hasFile("image")) {
                $img = $request->file("image");
                $nameimage = time() . "_" . $img->getClientOriginalName();
                //move vao thu vien public
                $img->move('public/file/img/img_product/', $nameimage);
                //gan ten hinh anh vao cot image
                $create_product->image = $nameimage;
            }

            if ($request->hasFile("image_specifications")) {
                $img = $request->file("image_specifications");
                $name_image_specifications = time() . "_" . $img->getClientOriginalName();
                $img->move('public/file/img/img_product/', $name_image_specifications);
                $create_product->image_specifications = $name_image_specifications;
            }
            $create_product->save();
            toastr()->success('Tạo mới thành công!');
            return redirect()->route("Admin.ProductIndex");

        } else {
            $data["category"] = Category::all();  // lấy danh mục ra view 
            return view("Admin/Product/Create", $data);

        }
    }


    public function Update(Request $request, $id =null)
    {
        $oldata_product["product_old"] = Products::find($id);
        $messages = [
            'name_product.required' => 'Vui lòng điền tên sản phẩm !!',
            'image.mimes' => 'Vui lòng chọn hình ảnh có định dạng jpeg, png, gif, jpg, ico, webp.',
            'image.max' => 'Kích thước hình ảnh không được vượt quá 4MB.',
            'price_product.required' => 'Vui lòng thêm giá gốc cho sản phẩm !',
            'price_product.numeric' => 'Giá phải là số !',
            'discount.required' => 'Vui lòng thêm giá bán cho sản phẩm !',
            'discount.numeric' => 'Giá phải là số !',
            'model.required' => 'Vui lòng thêm model cho sản phẩm !',
            'idCategory.required' => 'Vui lòng chọn danh mục !!',
            'image_specifications.mimes' => 'Vui lòng chọn hình ảnh có định dạng jpeg, png, gif, jpg, ico, webp.',
            'image_specifications.max' => 'Kích thước hình ảnh không được vượt quá 4MB.'
        ];
        if ($request->isMethod("post")) {
            $this->validate($request, [
                "name_product" => "required",
                'image' => 'mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
                'image_specifications' => 'mimes:jpeg,png,gif,jpg,ico,webp|max:4096',
                'price_product' => "required",
                'discount' => "required",
                'model' => "required",
                'idCategory' => "required"
            ], $messages);
            $request->merge([
                'price_product' => preg_replace('/[^\d.]/', '', str_replace(',', '', $request->price_product)),
                'discount' => preg_replace('/[^\d.]/', '', str_replace(',', '', $request->discount))
            ]);
            $update_product = Products::find($id);
            $update_product->name_product = $request->name_product;
            $update_product->description = $request->description;
            $update_product->model = $request->model;
            $update_product->price_product = $request->price_product;
            $update_product->discount = $request->discount;
            $update_product->producer = $request->producer;
            $update_product->origin = $request->origin;
            $update_product->images = $request->images;  //images fix sau
            $update_product->status = 1;
            $update_product->idCategory = $request->idCategory;
            if ($request->hasFile("image")) {
                $img = $request->file("image");
                $nameimage_product = time() . "_" . $img->getClientOriginalName();
                //delete hình cũ
                @unlink('public/file/img/img_product/' . $oldata_product["product_old"]->image);
                //move vao thu vien public
                $img->move('public/file/img/img_product/', $nameimage_product);
                //gắn tên hình ảnh vào cột image db
                $update_product->image = $nameimage_product;
            } else {
                $update_product->image = $oldata_product["product_old"]->image;
            }

            if ($request->hasFile("image_specifications")) {
                $img = $request->file("image_specifications");
                $nameimage_specifications = time() . "_" . $img->getClientOriginalName();
                //delete hình cũ
                @unlink('public/file/img/img_product/' . $oldata_product["product_old"]->image_specifications);
                //move vao thu vien public
                $img->move('public/file/img/img_product/', $nameimage_specifications);
                //gắn tên hình ảnh vào cột image db
                $update_product->image_specifications = $nameimage_specifications;
            } else {
                $update_product->image_specifications = $oldata_product["product_old"]->image_specifications;
            }
            $update_product->save();
            toastr()->success(' Cập nhật thành công !');
            return redirect()->route("Admin.ProductIndex");
        } else {
            $oldata_product["category"] = Category::all();  // lấy danh mục ra view 
            //  dd($oldata_product);
            //trả về mảng con product_old và category trong cùng 1 biến  $oldata_product
            return view("Admin/Product/Update", $oldata_product);
        }

    }


    public function Delete($id)
    {
        try {
            $load = Products::find($id);
            @unlink('public/file/img/img_product/' . $load->image);
            @unlink('public/file/img/img_product/' . $load->image_specifications);
            Products::destroy($id);
            toastr()->success('Xóa thành công!');
            return redirect()->route('Admin.ProductIndex'); 
        } catch (\Throwable $th) {

            return redirect()->route('Admin.ProductIndex'); 
        }
    }

}
