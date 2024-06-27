<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="/css/style.css">
    <title>Modern Login Page | AsmrProg</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-in">
            <form>
                <h1>Login</h1>
                <span>Masukan username dan password</span>
                <br>
                <div class="username-container">
                    <input type="username" placeholder="Username">
                </div>
                <div class="password-container">
                    <input type="password" placeholder="Password">
                    <i class="fa fa-eye-slash" id="togglePassword" style="cursor: pointer;"></i>
                </div>
                <br>
                <button>Login</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-right">
                    <img src="logo.png" alt="">
                    <br>
                    <h1>STOK BARANG</h1>
                    <span>PT. OLEAN PERMATA TELEMATIKA</span>
                </div>
            </div>
        </div>
    </div>

    <script src="/js/script.js"></script>
</body>

</html>