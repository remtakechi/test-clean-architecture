<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'User Management')</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: sans-serif; background: #f5f5f5; color: #333; }
        .container { max-width: 960px; margin: 0 auto; padding: 24px 16px; }
        header { background: #1a1a2e; color: #fff; padding: 14px 0; margin-bottom: 32px; }
        header .container { display: flex; align-items: center; gap: 24px; padding-top: 0; padding-bottom: 0; }
        header a { color: #ccc; text-decoration: none; font-size: 14px; }
        header a:hover { color: #fff; }
        header .brand { font-size: 18px; font-weight: bold; color: #fff; }
        h1 { font-size: 22px; margin-bottom: 20px; }
        h2 { font-size: 18px; margin-bottom: 16px; }
        .alert { padding: 12px 16px; border-radius: 4px; margin-bottom: 20px; font-size: 14px; }
        .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-error { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        table { width: 100%; border-collapse: collapse; background: #fff; border-radius: 6px; overflow: hidden; box-shadow: 0 1px 4px rgba(0,0,0,.08); }
        th, td { padding: 12px 14px; text-align: left; border-bottom: 1px solid #eee; font-size: 14px; }
        th { background: #f0f0f0; font-weight: 600; color: #555; }
        tr:last-child td { border-bottom: none; }
        .badge { display: inline-block; padding: 2px 8px; border-radius: 12px; font-size: 12px; font-weight: 600; }
        .badge-admin { background: #e8f0fe; color: #1a73e8; }
        .badge-member { background: #e6f4ea; color: #188038; }
        .btn { display: inline-block; padding: 8px 16px; border-radius: 4px; font-size: 13px; font-weight: 500; text-decoration: none; cursor: pointer; border: none; }
        .btn-primary { background: #1a73e8; color: #fff; }
        .btn-primary:hover { background: #1558b0; }
        .btn-secondary { background: #fff; color: #555; border: 1px solid #ccc; }
        .btn-secondary:hover { background: #f5f5f5; }
        .btn-danger { background: #d93025; color: #fff; }
        .btn-danger:hover { background: #b0261e; }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        form { background: #fff; padding: 24px; border-radius: 6px; box-shadow: 0 1px 4px rgba(0,0,0,.08); max-width: 520px; }
        .form-group { margin-bottom: 18px; }
        label { display: block; font-size: 13px; font-weight: 600; margin-bottom: 5px; color: #444; }
        input[type=text], input[type=email], input[type=password], select {
            width: 100%; padding: 8px 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 14px;
        }
        input:focus, select:focus { outline: none; border-color: #1a73e8; box-shadow: 0 0 0 2px rgba(26,115,232,.15); }
        .error-text { color: #d93025; font-size: 12px; margin-top: 4px; }
        .actions { display: flex; gap: 8px; }
        .detail-table { background: #fff; border-radius: 6px; box-shadow: 0 1px 4px rgba(0,0,0,.08); overflow: hidden; }
        .detail-table tr th { width: 160px; background: #f8f8f8; }
        .page-actions { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
    </style>
</head>
<body>
<header>
    <div class="container">
        <span class="brand">Clean Architecture</span>
        <a href="{{ route('users.index') }}">Users</a>
    </div>
</header>
<div class="container">
    @yield('content')
</div>
</body>
</html>
