<x-admin.layouts.muster>
    <x-slot name="title">Service list</x-slot>

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
                                <li class="breadcrumb-item active">Services</li>
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
                                    <h3 class="card-title">Service list</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    @if(count($items))
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th style="width: 30%">Title</th>
                                                <th style="width: 60%">Description</th>
                                                <th style="width: 10%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($items as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td>{!! $item->description !!}</td>
                                                <td>
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
                                <!-- /.card-body -->
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-4 col-4">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title text-capitalize">Update service information</h3>
                                </div>
                                <form action="{{ route('admin.services.update') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <input type="text" name="id" value="{{ $update->id ?? null}}" hidden>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Service title</label>
                                            <input type="text" class="form-control" name="title" value="{{ $update->title ?? old('title')}}">
                                            @error('title')
                                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea id="summernote" class="summernote" data-height="200" name="description">{{ $update->description ?? null }}</textarea>
                                            @error('description')
                                            <span class="error invalid-feedback d-block">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Image <small class="text-danger">(500*580)</small></label>
                                            <input type="file" class="form-control imageFile" name="image" accept="image/*" hidden onchange="imageUpload(event)">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <img src="{{ empty($update) ? asset('backend/dist/img/photo_upload.png') : asset($update->image) }}" alt="image" class="image border rounded p-2" width="100%" onclick="imageField(event)">
                                                </div>
                                            </div>
                                            @error('image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label>Hero Image <small class="text-danger">(1550*250)</small></label>
                                            <input type="file" class="form-control imageFile" name="hero_image" accept="image/*" hidden onchange="imageUpload(event)">
                                            <div class="row">
                                                <div class="col-sm-12 col-md-6">
                                                    <img src="{{ empty($update) ? asset('backend/dist/img/photo_upload.png') : asset($update->hero_image) }}" alt="Hero image" class="image border rounded p-2" width="100%" onclick="imageField(event)">
                                                </div>
                                            </div>
                                            @error('hero_image')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <a href="{{ route('admin.services.index') }}" type="reset" class="btn btn-sm btn-outline-danger">Cancel</a>
                                        <button type="submit" class="btn btn-sm btn-outline-success float-right" {{ isset($update)? null : 'disabled'}}>Update</button>
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
                        window.location.replace("{{ route('admin.setting.admin.trash', ['__id__']) }}".replace('__id__', id));
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
