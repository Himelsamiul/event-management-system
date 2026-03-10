<!doctype html>
<html lang="en">

<head>
     <title>Admin Login</title>
    <link rel="stylesheet" href="{{ url('csslogin/style.css') }}">
    <style>
        /* Custom styles for the Remember Me checkbox */
        .checkbox-wrap {
            position: relative;
            display: inline-block;
            padding-left: 30px;
            cursor: pointer;
        }

        .checkbox-wrap input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkbox-wrap .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            height: 20px;
            width: 20px;
            background-color: #ccc;
            border-radius: 5px;
        }

        /* When the checkbox is checked, change the background color */
        .checkbox-wrap input:checked ~ .checkmark {
            background-color: #0d6efd; /* Blue color */
            border-color: #0d6efd;
        }

        /* Add the tick mark when checked */
        .checkbox-wrap input:checked ~ .checkmark:after {
            content: "";
            position: absolute;
            top: 4px;
            left: 8px;
            width: 5px;
            height: 10px;
            border: solid white;
            border-width: 0 3px 3px 0;
            transform: rotate(45deg);
        }
    </style>
</head>

<body class="img js-fullheight" style="background-image: url('/imageslogin/tintin.jpg');">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h6 class="heading-section"> <strong>Login to Eventre</strong></h6>
                </div>
            </div>
            @notifyCss
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center"></h3>
                        <form action="{{ route('admin.do.login') }}" method="post" class="signin-form">
                            @csrf
                            <div class="form-group">
                                <input name="email" type="email" style="background:maroon;" class="form-control" placeholder="Enter Email" required>
                            </div>
                            <div class="form-group">
                                <input name="password" style="background:maroon;" id="password-field" type="password" class="form-control" placeholder="Password" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" style="width:50%;" class="form-control btn btn-primary submit px-3">Sign In</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label style="color:white;" class="checkbox-wrap checkbox-primary">Remember Me
                                        <input type="checkbox"> <!-- No checked attribute -->
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color:white;">Forgot Password?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @include('notify::components.notify')
            @notifyJs
        </div>
    </section>

    <script src="{{ url('jslogin/jquery.min.js') }}"></script>
    <script src="{{ url('jslogin/popper.js') }}"></script>
    <script src="{{ url('jslogin/bootstrap.min.js') }}"></script>
    <script src="{{ url('jslogin/main.js') }}"></script>

</body>

</html>
