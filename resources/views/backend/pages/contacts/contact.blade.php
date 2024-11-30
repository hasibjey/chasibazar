<x-admin.layouts.muster>
    <x-slot name="title">Contact information</x-slot>

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
                                <li class="breadcrumb-item active">Contact information</li>
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
                    <div class="row">
                        <div class="col-lg-6 col-12 offset-lg-3">
                            <div class="card card-info">
                                <div class="card-header text-center">
                                    <h3 class="card-title text-capitalize text-center">Contact information</h3>
                                </div>
                                <form action="{{ route('admin.contact.update') }}" method="post">
                                    @csrf
                                    <input type="text" name="id" value="{{ $item->id ?? null}}" hidden>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Email address</label>
                                            <input type="email" class="form-control" placeholder="Enter email address" name="email" value="{{ $item->email ?? old('email')}}">
                                            @error('email')
                                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Phone number</label>
                                            <input type="text" class="form-control" placeholder="Enter phone number" name="phone" value="{{ $item->phone ?? old('phone')}}">
                                            @error('phone')
                                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Alter phone number</label>
                                            <input type="text" class="form-control" placeholder="Enter alter phone number" name="alter_phone" value="{{ $item->alterPhone ?? old('alter_phone')}}">
                                            @error('alter_phone')
                                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Whatsapp phone number</label>
                                            <input type="text" class="form-control" placeholder="Enter whatsapp phone number" name="whatsapp_number" value="{{ $item->whatsapp ?? old('whatsapp_number')}}">
                                            @error('whatsapp_number')
                                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Calling hours</label>
                                            <input type="text" class="form-control" placeholder="Enter calling hours" name="calling_hours" value="{{ $item->calling_hours ?? old('calling_hours')}}">
                                            @error('calling_hours')
                                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="reset" class="btn btn-sm btn-outline-danger">Clear</button>
                                        <button type="submit" class="btn btn-sm btn-outline-success float-right">Update</button>
                                    </div>
                                </form>
                            </div>
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
