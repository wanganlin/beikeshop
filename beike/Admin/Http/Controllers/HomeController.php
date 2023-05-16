<?php

namespace Beike\Admin\Http\Controllers;

use App\Http\Controllers\Controller;
use Beike\Admin\Repositories\DashboardRepo;
use Beike\Admin\Repositories\Report\OrderReportRepo;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index()
    {
        $data = [
            'products' => DashboardRepo::getProductData(),
            // 'views'        => DashboardRepo::getCustomerViewData(),
            'orders'       => DashboardRepo::getOrderData(),
            'customers'    => DashboardRepo::getCustomerData(),
            'order_totals' => DashboardRepo::getTotalData(),
            'order_trends' => [
                'latest_month' => OrderReportRepo::getLatestMonth(),
                'latest_week'  => OrderReportRepo::getLatestWeek(),
                'latest_year'  => OrderReportRepo::getLatestYear(),
            ],
        ];

        return view('Admin::pages.home', $data);
    }

    /**
     * 通过关键字搜索菜单
     *
     * @return array
     */
    public function menus()
    {
        $keyword = trim(request('keyword'));
        $menus   = [];
        $routes  = Route::getRoutes();
        foreach ($routes as $route) {
            $routeName = $route->getName();
            if (! Str::startsWith($routeName, 'Admin')) {
                continue;
            }

            $method = $route->methods()[0];
            if ($method != 'GET') {
                continue;
            }

            $routeName       = str_replace('Admin.', '', $routeName);
            $permissionRoute = str_replace('.', '_', $routeName);

            try {
                $url = admin_route($routeName);
            } catch (\Exception $e) {
                $url = '';
            }
            if (empty($url)) {
                continue;
            }

            $title = trans("Admin/common.{$permissionRoute}");
            if (stripos($title, 'Admin/common.') !== false) {
                continue;
            }

            if ($keyword && stripos($title, $keyword) !== false) {
                $menus[] = [
                    'route' => $routeName,
                    'url'   => admin_route($routeName),
                    'title' => $title,
                ];
            }
        }

        return $menus;
    }
}
