<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Services\FileStorageService;
use Illuminate\Support\ServiceProvider;
use App\Services\CategoryRepository;
use App\Services\ProductRepository;
use App\Services\NewsRepository;
use App\Services\UserRepository;
use App\Models\Setting;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //binding class
        // Mỗi lần gọi, tạo ra một instance mới giúp đảm bảo rằng mỗi Repository được khởi tạo độc lập, tránh các xung đột khi Repository này xử lý trạng thái của Model khác.
        // Dễ bảo trì: Khi cần thay đổi hoặc mở rộng Repository, bạn có thể chỉnh sửa hoặc tạo mới các class con mà không ảnh hưởng đến các phần còn lại của ứng dụng.
        // Độc lập cho từng Model: Mỗi Model có thể có các yêu cầu và logic riêng biệt, nên khởi tạo mới mỗi lần gọi sẽ giúp cách ly các thao tác cụ thể của từng Model.
        $this->app->bind(ProductRepository::class, function ($app) {
            return new ProductRepository(new \App\Models\Product);
        });
        $this->app->bind(CategoryRepository::class, function ($app) {
            return new CategoryRepository(new \App\Models\Category);
        });
        $this->app->bind(NewsRepository::class, function ($app) {
            return new NewsRepository(new \App\Models\News);
        });
        $this->app->bind(UserRepository::class, function ($app) {
            return new UserRepository(new \App\Models\User);
        });
        $this->app->bind(FileStorageService::class);
    }

    /**
     * Bootstrap any application services.
     * thực hiện các thiết lập cần thiết khi ứng dụng được khởi động
     */
    public function boot(): void
    {
        //fix database
        Schema::defaultStringLength(191);
        View::composer('*', function ($view) {
            $logo = Setting::getValue('logo'); // Lấy thông tin về logo từ cơ sở dữ liệu
            $favicon = Setting::getValue('favicon'); // Lấy thông tin về logo từ cơ sở dữ liệu
            $view->with('logo', $logo)->with('favicon', $favicon);
        });
    }
}
