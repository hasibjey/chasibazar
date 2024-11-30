@php
    $auth = Backend::GetAdmin();
@endphp
<x-admin.layouts.muster>
    <x-slot name="title">Admins list</x-slot>

    <main>
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right text-capitalize">
                                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item active">{{ $auth->name }}</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <!-- Small boxes (Stat box) -->
                    <div class="row border p-3 rounded">
                        <div class="col-lg-6 col-6">
                            <strong>You can change your information</strong>
                        </div>
                        <div class="col-lg-6 col-6">
                            <form action="{{ route('admin.profile.update') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <div class="border rounded-full">

                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Full name</label>
                                    <input type="text" class="form-control" value="{{ $auth->name }}" name="name">
                                    @error('name')
                                        <span class="form-text invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>Email address</label>
                                    <input type="text" class="form-control" value="{{ $auth->email }}" disabled>
                                </div>
                                <div class="mt-5 text-right">
                                    <button class="btn btn-outline-info px-3">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="row border p-3 rounded mt-3">
                        <div class="col-lg-6 col-6">
                            <strong>You can change your password</strong>
                        </div>
                        <div class="col-lg-6 col-6">
                            <form action="{{ route('admin.profile.password.update') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label>Current password</label>
                                    <input type="password" class="form-control" placeholder="Current password" name="current_password">
                                    @error('current_password')
                                        <span class="form-text invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>New password</label>
                                    <input type="password" class="form-control" placeholder="New password" name="password">
                                    @error('password')
                                        <span class="form-text invalid-feedback d-block">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label>New password confirmation</label>
                                    <input type="password" class="form-control" placeholder="New password confirmation" name="password_confirmation">
                                </div>
                                <div class="mt-5 text-right">
                                    <button class="btn btn-outline-info px-3">Change</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    </main>

    <x-slot name="js">
        <script>
            function deleteItem(id) {
                Swal.fire({
                    title: "Are you sure?"
                    , text: "You won't be able to revert this!"
                    , icon: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: "#3085d6"
                    , cancelButtonColor: "#d33"
                    , confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace("/admin/setting/admin/trash/" + id);
                        Swal.fire({
                            title: "Deleted!"
                            , text: "Your file has been deleted."
                            , icon: "success"
                        });
                    }
                });
            }

        </script>
    </x-slot>
</x-admin.layouts.muster>
