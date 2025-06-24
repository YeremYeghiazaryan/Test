<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
            integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function getCookie(name) {
            let cookies = document.cookie.split(';');
            for (let c of cookies) {
                let [key, value] = c.trim().split('=');
                if (key === name) return decodeURIComponent(value);
            }
            return null;
        }

        $.ajax({
            method: "GET",
            headers: {
                Authorization: "Bearer " + getCookie('auth_token')
            },
            url: '{{route('authenticate')}}',
            success: function (response) {
                if (response.user) {
                    window.location.href = '/dashboard';
                } else {
                    $('body').removeClass('d-none')
                }
            },
            error: function () {
                window.location.href = '/login';
            }
        });
    </script>
</head>
<body class="d-none">

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card card-registration row g-0 border-0">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img1.webp"
                                 alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;"/>
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <div class="d-flex align-items-center mb-3 pb-1">
                                    <i class="fas fa-cubes fa-2x me-3" style="color: #ff6219;"></i>
                                    <span class="h1 fw-bold mb-0">Login</span>
                                </div>
                                <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your
                                    account</h5>
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="email" id="email" name="email"
                                           class="form-control form-control-lg"/>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                <div data-mdb-input-init class="form-outline mb-4">
                                    <input type="password" id="password" name="password"
                                           class="form-control form-control-lg"/>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <button data-mdb-button-init data-mdb-ripple-init
                                        id="btnLogin" class="btn bg-primary text-white btn-lg btn-block"
                                        type="submit">Login
                                </button>


                                <button id="google-login" class="btn btn-danger">
                                    <img src="https://developers.google.com/identity/images/g-logo.png" alt="Google"
                                         style="width:20px; margin-right:8px;">
                                    Login with Google
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

<script>
    $("#btnLogin").click(function () {
        $.ajax({
            url: '{{route('login-user')}}',
            method: "POST",
            contentType: 'application/json',
            data: JSON.stringify({
                email: $('#email').val(),
                password: $('#password').val()
            }),
            success: function () {
                window.location.href = '/dashboard';
            },
            error: function () {
                alert("Error-Login");
            }
        });
    });

    $('#google-login').on('click', function () {
        const width = 500;
        const height = 600;
        const left = (screen.width - width) / 2;
        const top = (screen.height - height) / 2;

        const popup = window.open(
            '{{ route('google-redirect') }}',
            'googleLogin',
            `width=${width},height=${height},top=${top},left=${left}`
        );
    });
    window.addEventListener('message', function (event) {
        if (event.origin !== window.location.origin) return;
        const {code} = event.data;
        if (code) {
            $.ajax({
                url: '{{route('google-login')}}',
                method: 'POST',
                data: {code: code},
                success: function () {
                    window.location.reload()
                },
                error: function () {
                    alert('Login failed');
                }
            });
        }

    });
</script>





