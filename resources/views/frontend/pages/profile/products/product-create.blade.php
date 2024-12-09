<x-admin.layouts.muster>
    <x-slot name="title">Product list</x-slot>

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
                                <li class="breadcrumb-item"><a href="{{ route('user.product.index') }}">Product</a>
                                </li>
                                <li class="breadcrumb-item active">Create</li>
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
                        <div class="col-lg-12 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">{{ empty($update) ? 'Added' : 'Update' }} product information
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <form
                                        action="{{ empty($update) ? route('user.product.store') : route('user.product.update') }}"
                                        method="post" enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" value="{{ $update->id ?? null }}" name="id" hidden>
                                        <div class="row m-0">
                                            <div class="col-6 p-0 pr-3">
                                                <div class="form-group">
                                                    <label>Title</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter product title" name="title"
                                                        value="{{ $update->title ?? old('title') }}">
                                                    @error('title')
                                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectRounded0">Category</label>
                                                    <select class="custom-select" id="exampleSelectRounded0"
                                                        name="category">
                                                        <option value="">Select category</option>
                                                        @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ isset($update) &&
                                                            $category->id ==
                                                            $update->category_id ? 'selected' : null }}>
                                                            {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category')
                                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleSelectRounded0">Sub Category</label>
                                                    <select class="custom-select" id="exampleSelectRounded0"
                                                        name="sub_category">
                                                        <option value="">Select sub category</option>
                                                        @foreach ($subCategories as $subCat)
                                                        <option value="{{ $subCat->id }}" {{ isset($update) &&
                                                            $category->id ==
                                                            $update->category_id ? 'selected' : null }}>
                                                            {{ $subCat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('sub_category')
                                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <textarea id="summernote-all" class="summernote" data-height="300"
                                                        name="description">{{ $update->description ?? null }}</textarea>
                                                    @error('description')
                                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="col-6 p-0 pl-3">
                                                <div class="form-group">
                                                    <label>Thumbnail <small
                                                            class="text-danger">(208*230)</small></label>
                                                    <div id="thumbnail" class="row m-0" multiple>
                                                        @if (!empty($update))
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview">
                                                                <img loading="lazy"
                                                                    src="{{ asset($update->thumbnail) }}" alt=""
                                                                    class="img-responsive">
                                                                <button type="button" onclick="delImageDom(event)"
                                                                    class="btn btn-sm btn-danger close-btn remove-files m-0">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Images <small class="text-danger">(180*200)</small> <span
                                                            class="text-danger">(You can upload multi
                                                            image.)</span></label>
                                                    <div id="image" class="row m-0" multiple>
                                                        @if (!empty($update))
                                                        @foreach ($update->Images as $image)
                                                        <div class="col-md-4 col-sm-4 col-xs-6">
                                                            <div class="img-upload-preview">
                                                                <img loading="lazy" src="{{ asset($image->image) }}"
                                                                    alt="" class="img-responsive">
                                                                <a href="{{ route('user.product.image.trash', [$image->id]) }}"
                                                                    type="button"
                                                                    class="btn btn-sm btn-danger close-btn remove-files">
                                                                    <i class="fa fa-times"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group row m-0">
                                                    <div class="col-8 p-0">
                                                        <label>Quantity</label>
                                                        <input type="text" class="form-control"
                                                            placeholder="Enter product quantity" name="quantity"
                                                            value="{{ $update->quantity ?? old('quantity') }}">
                                                    </div>
                                                    <div class="col-4 p-0 pl-2">
                                                        <label for="exampleSelectRounded0">Unit</label>
                                                        <select class="custom-select" id="exampleSelectRounded0"
                                                            name="unit">
                                                            <option value="g" {{ isset($update) && $update->unit == 'g'? 'selected' :
                                                                null}}>Gram</option>
                                                            <option value="kg" {{ isset($update) && $update->unit == 'kg'? 'selected' :
                                                                null}}>Kg</option>
                                                        </select>
                                                    </div>
                                                    @error('quantity')
                                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label>Price</label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter product price" name="price"
                                                        value="{{ $update->price ?? old('price') }}">
                                                    @error('price')
                                                    <span class="error invalid-feedback d-block">{{ $message }}</span>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center mt-5">
                                            <button class="btn btn-sm btn-danger px-5 mx-2">Clear</button>
                                            <button class="btn btn-sm btn-success px-5 mx-2">Insert</button>
                                        </div>
                                    </form>
                                </div>
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
            $("#thumbnail").spartanMultiImagePicker({
                fieldName     : 'thumbnail',
                maxCount      : 1,
                rowHeight     : '200px',
                groupClassName: 'col-4',
                maxFileSize   : '',
                dropFileLabel : "Drop Here",
            });
            $("#image").spartanMultiImagePicker({
                fieldName     : 'images[]',
                maxCount      : 5,
                multiple      : true,
                rowHeight     : '200px',
                groupClassName: 'col-4',
                maxFileSize   : '',
                dropFileLabel : "Drop Here",
            });
            const delImageDom = (e) => {
                console.log(e);
                if (e.target.parentNode.parentNode.parentNode.childNodes.length == 4)
                    e.target.parentNode.parentNode.classList.add('d-none');
                else
                    e.target.parentNode.parentNode.parentNode.classList.add('d-none');
            }
        </script>
    </x-slot>
</x-admin.layouts.muster>
