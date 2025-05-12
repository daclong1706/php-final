<?php
return [
    'tmn_code' => env('VNPAY_TMN_CODE', '0F8ZPSBC'),
    'hash_secret' => env('VNPAY_HASH_SECRET', 'BWNPKL6FPBW4GV8IILGR0HO54LNRGS14'),
    // url of payment
    'url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
    'api_url' => 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html',
    'return_url' => 'http://127.0.0.1:8000/vnpay/return',
];
