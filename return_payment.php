<?php
$vnp_HashSecret = "EBAHADUGCOEWYXCMYZRMTMLSHGKNRPBN"; //Chuỗi bí mật
$vnp_SecureHash = $_GET['vnp_SecureHash'];
$inputData = array();
foreach ($_GET as $key => $value) {
    if (substr($key, 0, 4) == "vnp_") {
        $inputData[$key] = $value;
    }
}

unset($inputData['vnp_SecureHash']);
ksort($inputData);
$i = 0;
$hashData = "";
foreach ($inputData as $key => $value) {
    if ($i == 1) {
        $hashData = $hashData . '&' . urlencode($key) . "=" . urlencode($value);
    } else {
        $hashData = $hashData . urlencode($key) . "=" . urlencode($value);
        $i = 1;
    }
}

$vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashData);
// echo $secureHash . PHP_EOL;2
// echo $vnp_SecureHash . PHP_EOL;

// if ($secureHash == $vnp_SecureHash) {
    if($_GET['vnp_ResponseCode'] == "00") {
        echo 'Đã thanh toán phí dịch vụ';
    } else {
        echo 'Lỗi trong quá trình thanh toán phí dịch vụ';
    }
// }