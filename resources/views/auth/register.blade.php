<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shetab | Registration</title>
    <link rel="icon" href="{{ asset('uploads/favicon.png') }}" type="image/x-icon">
    <link href="{{ asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/login.css') }}">
</head>

<body>
    <div class="container h-100">
        <div class="row align-items-center justify-content-center h-100">
            <div class="col-md-6 col-lg-4">
                <div class="register_card">
                    <div class="text-center brand_logo_container_register">
                        <img src="{{ asset('uploads/login-logo.png') }}" class="brand_logo" alt="Logo">
                    </div>
                    
                    <form class="form_container" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="fname" class="form-label">First Name</label>
                            <input type="text" name="fname" class="form-control" placeholder="Enter first name">
                        </div>
                        <div class="mb-3">
                            <label for="lname" class="form-label">Last Name</label>
                            <input type="text" name="lname" class="form-control" placeholder="Enter last name">
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" name="phone" class="form-control" placeholder="Enter phone number">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="Enter email">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" placeholder="Enter password">
                        </div>
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="customControlInline">
                            <label class="form-check-label" for="customControlInline">Remember me</label>
                        </div>
                        <div class="gap-2 pb-5 d-grid">
                            <button type="submit" class="btn btn-primary">Register</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>