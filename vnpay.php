<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
date_default_timezone_set('Asia/Ho_Chi_Minh');

$vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
$vnp_Returnurl = "http://localhost:8000/return_payment.php";
$vnp_TmnCode = "UDOPNWS1"; //Mã website tại VNPAY 
$vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật

	
// Ngân hàng: NCB
// Số thẻ: 9704198526191432198
// Tên chủ thẻ:NGUYEN VAN A
// Ngày phát hành:07/15
// Mật khẩu OTP:123456
// https://sandbox.vnpayment.vn/apis/vnpay-demo/#th%C3%B4ng-tin-th%E1%BA%BB-test    
$vnp_TxnRef = 32222222; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
$vnp_OrderInfo = $_POST['OrderDescription'];
$vnp_OrderType = $_POST['ordertype'];
$vnp_Amount = $_POST['Amount'] * 100;
$vnp_Locale = $_POST['language'];
$vnp_BankCode = $_POST['bankcode'];
$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
//Add Params of 2.0.1 Version
$vnp_ExpireDate = $_POST['txtexpire'];
// //Billing
// $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
// $vnp_Bill_Email = $_POST['txt_billing_email'];
// $fullName = trim($_POST['txt_billing_fullname']);
// if (isset($fullName) && trim($fullName) != '') {
//     $name = explode(' ', $fullName);
//     $vnp_Bill_FirstName = array_shift($name);
//     $vnp_Bill_LastName = array_pop($name);
// }
// $vnp_Bill_Address=$_POST['txt_inv_addr1'];
// $vnp_Bill_City=$_POST['txt_bill_city'];
// $vnp_Bill_Country=$_POST['txt_bill_country'];
// $vnp_Bill_State=$_POST['txt_bill_state'];
// // Invoice
// $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
// $vnp_Inv_Email=$_POST['txt_inv_email'];
// $vnp_Inv_Customer=$_POST['txt_inv_customer'];
// $vnp_Inv_Address=$_POST['txt_inv_addr1'];
// $vnp_Inv_Company=$_POST['txt_inv_company'];
// $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
// $vnp_Inv_Type=$_POST['cbo_inv_type'];


$inputData = array(
    "vnp_Version" => "2.0.0",
    "vnp_TmnCode" => $vnp_TmnCode,
    "vnp_Amount" => $vnp_Amount,
    "vnp_Command" => "pay",
    "vnp_CreateDate" => date('YmdHis'),
    "vnp_CurrCode" => "VND",
    "vnp_IpAddr" => $vnp_IpAddr,
    "vnp_Locale" => $vnp_Locale,
    "vnp_OrderInfo" => $vnp_OrderInfo,
    "vnp_OrderType" => $vnp_OrderType,
    "vnp_ReturnUrl" => $vnp_Returnurl,
    "vnp_TxnRef" => $vnp_TxnRef,
);

if (isset($vnp_BankCode) && $vnp_BankCode != "") {
    $inputData['vnp_BankCode'] = $vnp_BankCode;
}
ksort($inputData);
$query = "";
$i = 0;
$hashdata = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashdata .= '&' . $key . "=" . $value;
    } else {
        $hashdata .= $key . "=" . $value;
        $i = 1;
    }
    $query .= urlencode($key) . "=" . urlencode($value) . '&';
}

$vnp_Url = $vnp_Url . "?" . $query;
if (isset($vnp_HashSecret)) {
    // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
    $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
    $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
}
header("Location: $vnp_Url");
die();



