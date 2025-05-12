<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Kết quả thanh toán VNPAY</h2>
                    
                    @if($code == '00')
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4">
                            <strong class="font-bold">{{ $message }}</strong>
                        </div>
                    @else
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4">
                            <strong class="font-bold">{{ $message }}</strong>
                        </div>
                    @endif

                    <div class="mt-4">
                        <h3 class="text-lg font-semibold mb-2">Chi tiết giao dịch:</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <p><span class="font-medium">Mã đơn hàng:</span> {{ $data['vnp_TxnRef'] }}</p>
                                <p><span class="font-medium">Số tiền:</span> {{ number_format($data['vnp_Amount']/100) }} VND</p>
                                <!-- <p><span class="font-medium">Nội dung:</span> {{ $data['vnp_OrderInfo'] }}</p> -->
                            </div>
                            <div>
                                <p><span class="font-medium">Mã giao dịch VNPAY:</span> {{ $data['vnp_TransactionNo'] }}</p>
                                <p><span class="font-medium">Mã ngân hàng:</span> {{ $data['vnp_BankCode'] }}</p>
                                <p><span class="font-medium">Thời gian:</span> 
                                    {{ \Carbon\Carbon::createFromFormat('YmdHis', $data['vnp_PayDate'])->format('d/m/Y H:i:s') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('cart.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Quay lại giỏ hàng
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>