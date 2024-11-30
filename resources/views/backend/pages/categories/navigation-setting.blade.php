<x-admin.layouts.muster>
    <x-slot name="title">Navigation setting</x-slot>

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
                                <li class="breadcrumb-item active">navigation setting</li>
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
                        <div class="col-lg-8 col-8">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Navigation setting</h3>

                                    <div class="card-tools">
                                        <form action="" method="get">
                                            <div class="input-group input-group-sm" style="width: 300px;">
                                                <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fas fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @if(count($items))
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 40%">Name</th>
                                                <th style="width: 25%">Navigation status</th>
                                                <th style="width: 25%">Navigation position</th>
                                                <th style="width: 10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                            <tr>
                                                <td class="text-capitalize">{{ $item->name }}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-sm {{ empty($item->nav_status)? 'btn-danger' : 'btn-success'}}" style="width:100%">{{ empty($item->nav_status)? 'Active' : 'Deactive'}}</button>
                                                </td>
                                                <td class="text-center">{{ $item->nav_position }}</td>
                                                <td>
                                                    <a href="?eid={{ $item->id }}" class="btn btn-xs btn-outline-info"><i class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    @else
                                    <p class="">Data are not found!</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title text-capitalize">Navigation setting</h3>
                                </div>
                                <form action="{{ route('admin.setting.navigation.update') }}" method="post">
                                    @csrf
                                    <input type="text" name="id" value="{{ $update->id ?? null}}" hidden>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" placeholder="Enter navigation name" name="name" value="{{ $update->name ?? old('name')}}" autofocus disabled>
                                            @error('name')
                                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Navigation position</label>
                                            <input type="text" class="form-control" placeholder="Enter navigation position" name="position" value="{{ $update->nav_position ?? old('position')}}">
                                            @error('position')
                                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Navigation status</label>
                                            <div class="row m-0">
                                                <div class="col-6 p-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" value="1" {{ isset($update) && $update->nav_status == 1? 'checked' : null}}>
                                                        <label class="form-check-label text-capitalize">Activate</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 p-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" value="0" {{ isset($update) && $update->nav_status == 0? 'checked' : null}}>
                                                        <label class="form-check-label text-capitalize">Deactivate</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @error('status')
                                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('admin.setting.navigation.create') }}" type="reset" class="btn btn-sm btn-outline-danger">Cancel</a>
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
                        window.location.replace("{{ route('admin.category.trash', ['__id__']) }}".replace('__id__', id));
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
