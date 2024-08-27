
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    <title>Xác thực Email</title>
</head>
<body>
<h3>Xin chào, {{ $user->name }}!</h3>
    <p>Cảm ơn bạn đã đăng ký, vui lòng nhấp vào link dưới để xác thực :</p>
    <p>
        <a href="{{ URL::signedRoute('verification.verify', ['id' => $user->id, 'hash' => sha1($user->email)]) }}"
            class="btn btn-success text-white">
            Xác thực email
        </a>


    </p>

    <p>Trân trọng,<br>The Team</p>
</body>
</html>