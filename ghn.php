<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Tạo Đơn hàng lên GHN</title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body style="font-size: 0.9rem;">
<div class="container">


    <div class="clearfix" style="padding-bottom: 1rem;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="/tryitnow/">DEMO</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    
                        <li class="nav-item">
                            <a class="nav-link " href="/tryitnow/">Danh sách </a> </li>
                           <li class="nav-item">  <a class="nav-link active" href="/tryitnow/Home/CreateOrder">Tạo mới <span class="sr-only">(current)</span></a></li>

                </ul>
            </div>
        </nav>
         



    </div>
<h3>Tạo mới đơn h&#224;ng</h3>
<div class="table-responsive">

<button type="button" class="btn btn-primary">Thực hiện đẩy đơn hàng lên giao hàng nhanh</button>

<h1 class="text-center result-message"></h1>

<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<link href="https://pay.vnpay.vn/lib/vnpay/vnpay.css" rel="stylesheet" />
<script src="https://pay.vnpay.vn/lib/vnpay/vnpay.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        function createOrder() {
            var settings = {
                "url": "https://dev-online-gateway.ghn.vn/shiip/public-api/v2/shipping-order/create",
                "method": "POST",
                "timeout": 0,
                "headers": {
                    "ShopId": "86185",
                    "Token": "e9a9e926-a1ef-11ec-ac64-422c37c6de1b",
                    "Content-Type": "application/json"
                },
                "data": JSON.stringify({
                    "payment_type_id": 2,
                    "note": "Tintest 123",
                    "required_note": "KHONGCHOXEMHANG",
                    "return_phone": "0332190444",
                    "return_address": "39 NTT",
                    "return_district_id": 1442,
                    "return_ward_code": "",
                    "client_order_code": "",
                    "to_name": "TinTest124",
                    "to_phone": "0987654321",
                    "to_address": "72 Thành Thái, Phường 14, Quận 10, Hồ Chí Minh, Vietnam",
                    "to_ward_code": "20308",
                    "to_district_id": 1442,
                    "cod_amount": 200000,
                    "content": "Theo New York Times",
                    "weight": 200,
                    "length": 1,
                    "width": 19,
                    "height": 10,
                    "pick_station_id": 1444,
                    "deliver_station_id": null,
                    "insurance_value": 10000000,
                    "service_id": 0,
                    "service_type_id": 2,
                    "coupon": null,
                    "pick_shift": [
                    2
                    ],
                    "items": [
                    {
                        "name": "Áo Polo",
                        "code": "Polo123",
                        "quantity": 1,
                        "price": 200000,
                        "length": 12,
                        "width": 12,
                        "height": 12,
                        "category": {
                        "level1": "Áo"
                        }
                    }
                    ]
                    }),
                };

                $.ajax(settings).done(function (response) {
                    if(response.code == 200) {
                        $('.result-message').html(response.message_display);
                    }
                });
        }

        $('button').click(function () {
            createOrder();
        })
    })
</script>
</body>
</html>