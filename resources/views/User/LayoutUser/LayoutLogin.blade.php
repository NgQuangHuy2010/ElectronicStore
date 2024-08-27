

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"  />
    <title>Ecommerce</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/User')}}/img/attachment_101759249.png">
    <!-- <link rel="icon" type="image/png" sizes="16x16"
          href="~/FE/img/Remove-bg.ai_1718535780539.png"> -->
</head>
<body>
<div class="bg-primary d-flex align-items-center justify-content-between py-3 px-5 " style="height: 80px;">
    <div>
        <a href="{{Route("User.Home")}}" class="text-white text-decoration-none fs-4"><i class="fa-solid fa-left-long"></i> Trở về</a>
    </div>
    <div class="d-flex align-items-center">
        <img src="{{asset('public/User')}}/img/logo.png" class="me-2" alt="Logo" style="height: 40px;">
    </div>
</div>

@yield('content')
</body>
</html>