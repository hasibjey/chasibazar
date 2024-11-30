<x-admin.auth.muster>
    <x-slot name="title">Login</x-slot>

    <main>
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <p class="h1 m-0 text-capitalize"><b>login</b></p>
            </div>
            <div class="card-body">

                <form action="{{ route('admin.login.store') }}" method="post" class="pt-3">
                    @csrf
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="email" class="form-control" placeholder="Email address" name="email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        @error('email')
                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="input-group">
                            <input type="password" class="form-control" placeholder="Password" name="password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="row pt-3">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

                <p class="mt-3 text-center">
                    <a href="{{ route('admin.password.reset') }}">I forgot my password</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
    </main>
</x-admin.auth.muster>
