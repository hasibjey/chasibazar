<x-admin.layouts.muster>
    <x-slot name="title">Sub Category list</x-slot>

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
                                <li class="breadcrumb-item active">Sub category</li>
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
                                    <h3 class="card-title">Sub Category list</h3>

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
                                                <th style="width: 10%">image</th>
                                                <th style="width: 30%">Name</th>
                                                <th style="width: 30%">Category</th>
                                                <th style="width: 15%">Status</th>
                                                <th style="width: 15%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ $item->image }}" alt="" width="80px" height="80px">
                                                </td>
                                                <td class="text-capitalize">{{ $item->name }}</td>
                                                <td class="text-capitalize">{{ $item->Category->name }}</td>
                                                <td class="text-center">
                                                    <form action="{{ route('admin.category.sub.status') }}" method="post">
                                                        @csrf
                                                        <input type="text" value="{{ $item->id }}" name="id" hidden>
                                                        <input type="text" name="status" value="{{ $item->status }}" hidden>
                                                        <div class="custom-control custom-switch">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitch1" {{ $item->status? 'checked' : null}} onchange="$(this).closest('form').submit()">
                                                            <label class="custom-control-label" for="customSwitch1"></label>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-outline-danger" onclick="deleteItem({{ $item->id }})"><i class="fas fa-trash-alt"></i></button>
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
                                    <h3 class="card-title text-capitalize">{{ empty($update)? 'add' : 'update' }} sub category information</h3>
                                </div>
                                <form action="{{ empty($update)? route('admin.category.sub.store') : route('admin.category.sub.update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="id" value="{{ $update->id ?? null}}" hidden>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" class="form-control" placeholder="Enter name" name="name" value="{{ $update->name ?? old('name')}}" autofocus>
                                            @error('name')
                                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="exampleSelectRounded0">Category</label>
                                            <select class="custom-select" id="exampleSelectRounded0" name="category">
                                                <option class="null">Select category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ isset($update) && $category->id == $update->category_id? 'selected' : null}}>{{ $category->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>description</label>
                                            <textarea id="summernote" class="summernote" data-height="200" name="description">{{ $update->description ?? null }}</textarea>
                                            @error('description')
                                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Image <small class="text-danger">(300*220)</small></label>
                                            <input type="file" class="form-control imageFile" name="image" accept="image/*" hidden onchange="imageUpload(event)">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <img src="{{ empty($update) ? asset('backend/dist/img/photo_upload.png') : asset($update->image) }}" alt="" class="image border rounded p-2" width="100%" onclick="imageField(event)">
                                                </div>
                                            </div>
                                            @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Status</label>
                                            <div class="row m-0">
                                                <div class="col-6 p-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" value="1" {{ isset($update) && $update->status == 1? 'checked' : null}}>
                                                        <label class="form-check-label text-capitalize">Activate</label>
                                                    </div>
                                                </div>
                                                <div class="col-6 p-0">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio" name="status" value="0" {{ isset($update) && $update->status == 0? 'checked' : null}}>
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
                                        @if(empty($update))
                                        <button type="reset" class="btn btn-sm btn-outline-danger">Cancel</button>
                                        @else
                                        <a href="{{ route('admin.category.index') }}" type="reset" class="btn btn-sm btn-outline-danger">Cancel</a>
                                        @endif
                                        <button type="submit" class="btn btn-sm btn-outline-success float-right">{{ empty($update)? 'Submit' : 'Update'}}</button>
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
                        window.location.replace("{{ route('admin.category.sub.trash', ['__id__']) }}".replace('__id__', id));
                        Swal.fire({
                            title: "Deleted!"
                            , text: "Your file has been deleted."
                            , icon: "success"
                        });
                    }
                });
            }

            function imageField(e) {
                $(e.target).parent().parent().parent().children("input").click();
            }

            function imageUpload(e) {
                var file = e.target.files[0];
                var reader = new FileReader();
                reader.onloadend = function() {
                    $(e.target)
                        .siblings(".row")
                        .children()
                        .children("img")
                        .attr("src", reader.result);
                };
                reader.readAsDataURL(file);
            }

        </script>
    </x-slot>
</x-admin.layouts.muster>
