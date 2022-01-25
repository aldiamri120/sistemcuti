<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="/assets/images/favicon.ico">

    <!-- App css -->
    <link href="/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <link href="/assets/css/app-modern.min.css" rel="stylesheet" type="text/css" id="light-style" />
    <link href="/assets/css/app-modern-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" />
    <!-- cdn jquery -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>


</head>

<body class="authentication-bg pb-0" data-layout-config='{"darkMode":true}'>

    <div class="auth-fluid">
        <!--Auth fluid left content -->
        <div class="auth-fluid-form-box">
            <div class="align-items-center d-flex h-100">
                <div class="card-body">

                    <!-- Logo -->
                    <div class="auth-brand text-center text-lg-start mb-5">
                        <h1>Login</h1>
                    </div>

                    <!-- title-->
                    <?php if (!empty(session()->getFlashdata('error'))) : ?>
                    <div class="alert alert-danger alert-dismissible bg-danger text-white border-0 fade show"
                        role="alert">
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        <strong>Failed - </strong> <?php echo session()->getFlashdata('error'); ?>
                    </div>
                    <?php endif; ?>
                    <h4 class="mt-0">Sign In</h4>
                    <p class="text-muted mb-4">Enter your NIP and password to access account.</p>

                    <!-- form -->
                    <form action="/api/login" method="POST">
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">NIP</label>
                            <input class="form-control" type="text" id="nip" name="nip" required
                                placeholder="Enter NIP">
                        </div>
                        <div class="mb-3">
                            <label for="emailaddress" class="form-label">Password</label>
                            <input class="form-control" type="password" name="password" id="password" required
                                placeholder="Enter password">
                        </div>
                        <div class="d-grid mb-0 text-center">
                            <button class="btn btn-primary" type="submit" id="login"><i class="mdi mdi-login"></i> Log
                                In
                            </button>
                        </div>
                    </form>
                    <!-- end form-->




                </div> <!-- end .card-body -->
            </div> <!-- end .align-items-center.d-flex.h-100-->
        </div>
        <!-- end auth-fluid-form-box-->

        <!-- Auth fluid right content -->
        <div class="auth-fluid-right text-center">
            <div class="auth-user-testimonial">
                <h2 class="mb-3">APLIKASI SISTEM CUTI</h2>
                <p class="lead"><i class="mdi mdi-format-quote-open"></i>Your Coorporate<i
                        class="mdi mdi-format-quote-close"></i>
                </p>
                <p>
                    <?= date('d-m-Y') ?>
                </p>
            </div> <!-- end auth-user-testimonial-->
        </div>
        <!-- end Auth fluid right content -->
    </div>
    <!-- end auth-fluid-->

    <!-- bundle -->
    <script src="/assets/js/vendor.min.js"></script>
    <script src="/assets/js/app.min.js"></script>

</body>

</html>