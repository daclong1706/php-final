<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use Illuminate\View\View;

class OrderController extends Controller
{
    /**
     * Hiển thị danh sách tất cả các chi tiết đơn hàng
     */
    public function index(): View
    {
        $orderDetails = OrderDetail::with(['order', 'course', 'user'])
            ->orderByDesc('id')
            ->get();

        // $totalPaidAmount = $orderDetails->filter(function ($detail) {
        //     return $detail->order->status == 1;
        // })->sum(function ($detail) {
        //     return $detail->order->amount ?? 0;
        // });
        $totalPaidAmount = $orderDetails->filter(function ($detail) {
            return $detail->order && $detail->order->status == 1;
        })
            ->unique(function ($detail) {
                return $detail->order_id;
            })
            ->sum(function ($detail) {
                return $detail->order->amount ?? 0;
            });

        return view('admin.orders.index', compact('orderDetails', 'totalPaidAmount'));
    }
}
