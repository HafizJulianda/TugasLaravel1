<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <script src="https://unpkg.com/feather-icons"></script>
</head>
<body>
    @if ($errors->any())
        <script>
            alert('{{ $errors->first() }}');
        </script>
    @endif
    <div class="logo">
        <h1>E-Shop Admin Hafiz</h1>
    </div>
    <div class="login">
        <form action="{{ route('postLogin') }}" method="POST">
            @csrf
            <table class="table">
                <tr>
                    <td>
                        <div class="input-wrapper">
                            <input type="text" name="username" id="username" placeholder="Username" required>
                            <i data-feather="user"></i>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-password">
                            <input type="password" name="password" id="password" placeholder="Password" required>
                            <i data-feather="lock"></i>
                        </div>
                    </td>
                </tr>
            </table>
            <br>
            <button class="btn-login" type="submit" name="login">Login</button>
        </form>
    </div>
    <script>
        feather.replace();
    </script>
</body>
</html>
