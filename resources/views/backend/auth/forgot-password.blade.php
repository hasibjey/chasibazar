<x-admin.auth.muster>
    <x-slot name="title">Forgot Password</x-slot>

    <main>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <p class="h1 m-0"><b>Forgot Password</b></p>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Lost your password? Please enter your email address. You will receive a code to create a new password via email</p>
                <form action="recover-password.html" method="post">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email address">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-3 mb-1 text-center">
                    <a href="login.html">Login</a>
                </p>
            </div>
            <!-- /.login-card-body -->
        </div>
    </main>
</x-admin.auth.muster>
