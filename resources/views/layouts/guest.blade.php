<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f3e8ff; }
        .card-box {
            background: #fff;
            padding: 28px;
            border-radius: 20px;
            box-shadow: 0 8px 18px rgba(0,0,0,0.08);
            width: 430px;
        }
    </style>
</head>

<body>

<div class="d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="card-box">
        {{ $slot }}
    </div>
</div>

</body>
</html>
