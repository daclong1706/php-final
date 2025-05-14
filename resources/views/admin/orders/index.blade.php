<div class="container">
    <h2 class="text-xl font-bold mb-4">Danh sách chi tiết đơn hàng</h2>

    <div class="mt-4 text-right font-semibold text-green-700">
        Tổng tiền đã thanh toán: {{ number_format($totalPaidAmount, 0, ',', '.') }} VND
    </div>

    <table class="table-auto w-full border border-gray-300 mt-4">
        <thead>
            <tr class="bg-gray-100">
                <th class="text-left px-6 py-3 border">#</th>
                <th class="text-left px-6 py-3 border">Tên khóa học</th>
                <th class="text-left px-6 py-3 border">Đơn hàng</th>
                <th class="text-left px-6 py-3 border">Người dùng</th>
                <th class="text-left px-6 py-3 border">Số tiền</th>
                <th class="text-left px-6 py-3 border">Trạng thái</th>
                <th class="text-left px-6 py-3 border">Thời gian thanh toán</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderDetails as $index => $detail)
            <tr class="hover:bg-gray-50">
                <td class="px-6 py-3 border">{{ $index + 1 }}</td>
                <td class="px-6 py-3 border">{{ $detail->course->name ?? 'N/A' }}</td>
                <td class="px-6 py-3 border">{{ $detail->order_id }}</td>
                <td class="px-6 py-3 border">{{ $detail->user->name ?? 'Không rõ' }}</td>
                <td class="px-6 py-3 border text-right">{{ number_format($detail->order->amount ?? 0, 0, ',', '.') }} VND</td>
                <td class="px-6 py-3 border">
                    <span class="{{ $detail->order->status == 1 ? 'text-green-600 font-medium' : 'text-red-600' }}">
                        {{ $detail->order->status == 1 ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                    </span>
                </td>
                <td class="px-6 py-3 border">
                    {{ $detail->order->payment_time ? $detail->order->payment_time->format('d/m/Y H:i') : 'Chưa thanh toán' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
