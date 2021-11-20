@extends('layouts.admin-panel')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4><i class="fas fa-plus"></i> Add Products</h4>
            </div>
            <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name Product</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-box-open"></i>
                                        </div>
                                    </div>
                                    <input type="text" id="name" name="name" class="form-control" value="{{old('name')}}" placeholder="Name Product">
                                </div>
                                @error('name') <div class="text-danger">{{$message}}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label>Slug Product</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </div>
                                    <input readonly type="text" id="slug" name="slug" class="form-control" value="{{old('slug')}}" placeholder="Slug Product">
                                </div>
                                @error('slug') <div class="text-danger">{{$message}}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label>Topping Product</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-tags"></i>
                                        </div>
                                    </div>
                                    <input type="text" name="topping" class="form-control" value="{{old('topping')}}" placeholder="Topping Product">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Price Product</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-money-bill-wave"></i>
                                        </div>
                                    </div>  
                                    <input type="number" name="price" class="form-control" value="{{old('price')}}" placeholder="Price Product">
                                </div>
                                @error('price') <div class="text-danger">{{$message}}</div>@enderror
                            </div>
                            <div class="form-group">
                                <label>Category Product</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-th"></i>
                                        </div>
                                    </div>  
                                    <select class="form-control" name="category_id">
                                        @if ($check)
                                        @foreach ($categories as $category)
                                        @if (old('category_id') == $category->id)
                                            <option value="{{$category->id}}" selected>{{$category->name}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endif
                                        @endforeach
                                        @else
                                            <option value="0" class="font-italic" selected>There is no category</option>
                                        @endif
                                    </select>
                                    @error('category_id') <div class="text-danger">{{$message}}</div>@enderror
                                </div>
                            </div>
                            <div class="form-group">
                                <label>Image Product</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            <i class="fas fa-images"></i>
                                        </div>
                                    </div>
                                    <input type="file" id="image" name="image" class="form-control">
                                </div>
                                @error('image') <div class="text-danger">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group mx-4">
                    <label>Description Product</label>
                    @error('description') <div class="text-danger">{{$message}}</div>@enderror
                    <textarea id="summernote" name="description">{{ old('description') }}</textarea>
                    <button class="btn btn-primary mt-4"><i class="fas fa-plus"></i> Add Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@stop
@section('script')
<script>
    $('#summernote').summernote({
        placeholder: 'Describe your product',
        tabsize: 3,
        height: 120,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert'],
            ['view', ['codeview']]
        ]
    });
</script>
<script>
    const name = document.querySelector('#name')
    const slug = document.querySelector('#slug')

    name.addEventListener('change', function() {
        fetch('/admin-panel/products/createSlug?name=' + name.value)
            .then(response => response.json())
            .then(data => slug.value = data.slug)
    })
</script>
@stop