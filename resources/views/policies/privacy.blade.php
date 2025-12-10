<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LapCare - Chính sách giao hàng</title>

    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">

    <style>
        .policy-container {
            max-width: 1100px;
            margin: 0px auto;
            padding: 0px;
            background: #fff;
        }
    </style>
</head>

<body>

@include('partials.header')

<div class="policy-container">
    <iframe 
        src="{{ asset('pdf/Chinh_sach_bao_mat_tt.pdf') }}"
        width="100%" 
        height="900px"
        style="border:none;">
    </iframe>
</div>

@include('footer.footer')

</body>
</html>
