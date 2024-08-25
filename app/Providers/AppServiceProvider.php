<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Products;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Lấy tất cả danh mục
        $category = Category::all();
    
        // Tạo một mảng để lưu danh sách producers cho từng danh mục
        $producersByCategory = [];
    
        // Lặp qua từng danh mục để lấy danh sách producers
        foreach ($category as $Category) {
            $producersByCategory[$Category->id] = Products::where('idCategory', $Category->id)
                ->distinct()
                ->pluck('producer')
                ->toArray(); // Chuyển đổi thành mảng
        }
    
        // Chia sẻ dữ liệu với tất cả các view
        view()->share('ListCategory', $category);
        view()->share('ProducersByCategory', $producersByCategory);
         // Debugging
    // dd($category);
    }
    
}
