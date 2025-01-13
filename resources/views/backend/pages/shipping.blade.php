<x-admin.layouts.muster>
    <x-slot name="title">Shipping Cost</x-slot>

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
                                <li class="breadcrumb-item active">Shipping cost</li>
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
                                    <h3 class="card-title">Shipping cost</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @if (count($items))
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 45%">Title</th>
                                                    <th style="width: 45%">Cost</th>
                                                    <th style="width: 10%"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $item)
                                                    <tr>
                                                        <td>{{ $item->title }}</td>
                                                        <td>{{ $item->cost }}</td>
                                                        <td>
                                                            <button class="btn btn-xs btn-outline-danger"
                                                                onclick="deleteItem({{ $item->id }})"><i
                                                                    class="fas fa-trash-alt"></i></button>
                                                            <a href="?eid={{ $item->id }}"
                                                                class="btn btn-xs btn-outline-info"><i
                                                                    class="fas fa-edit"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <p class="">Data are not found!</p>
                                    @endif
                                </div>
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title text-capitalize">{{ empty($update) ? 'add' : 'update' }}
                                        shipping cost information</h3>
                                </div>
                                <form
                                    action="{{ empty($update) ? route('admin.setting.shipping.store') : route('admin.setting.shipping.update') }}"
                                    method="post">
                                    @csrf
                                    <input type="text" name="id" value="{{ $update->id ?? null }}" hidden>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Division</label>
                                            <select class="custom-select" name="title">
                                                <option>Select Division</option>
                                                <option {{ !empty($update) && $update->title == 'barisal'? 'selected' : null }} value="barisal">Barisal</option>
                                                <option {{ !empty($update) && $update->title == 'chattogram'? 'selected' : null }} value="chattogram">Chattogram</option>
                                                <option {{ !empty($update) && $update->title == 'dhaka'? 'selected' : null }} value="dhaka">Dhaka</option>
                                                <option {{ !empty($update) && $update->title == 'khulna'? 'selected' : null }} value="khulna">Khulna</option>
                                                <option {{ !empty($update) && $update->title == 'mymensingh'? 'selected' : null }} value="mymensingh">Mymensingh</option>
                                                <option {{ !empty($update) && $update->title == 'rajshahi'? 'selected' : null }} value="rajshahi">Rajshahi</option>
                                                <option {{ !empty($update) && $update->title == 'rangpur'? 'selected' : null }} value="rangpur">Rangpur</option>
                                                <option {{ !empty($update) && $update->title == 'sylhet'? 'selected' : null }} value="sylhet">Sylhet</option>
                                            </select>
                                            @error('type')
                                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Shipping cost</label>
                                            <input type="text" class="form-control" placeholder="Enter shipping cost"
                                                name="cost" value="{{ $update->cost ?? old('cost') }}">
                                            @error('cost')
                                                <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        @if (empty($update))
                                            <button type="reset" class="btn btn-sm btn-outline-danger">Cancel</button>
                                        @else
                                            <a href="{{ route('admin.services.events.index') }}" type="reset"
                                                class="btn btn-sm btn-outline-danger">Cancel</a>
                                        @endif
                                        <button type="submit"
                                            class="btn btn-sm btn-outline-success float-right">{{ empty($update) ? 'Submit' : 'Update' }}</button>
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
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.replace("{{ route('admin.services.events.trash', ['__id__']) }}".replace(
                            '__id__', id));
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        });
                    }
                });
            }
        </script>
    </x-slot>
</x-admin.layouts.muster>
