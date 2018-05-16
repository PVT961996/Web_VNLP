<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>Xác nhận tài khoản email</h2>

<div>
    <p>Cảm ơn bạn đã đăng ký tài khoản.</p>
    <p>Hãy click vào link này để xác nhận:</p>
    {{ URL::to('register/verify/' . $confirmation_code) }}.<br/>

</div>

</body>
</html>