@extends('layouts.admin-panel')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4><i class="fas fa-edit"></i> Edit Category</h4>
                </div>
                <form action="{{ route('categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label>Name Category</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-th"></i>
                                    </div>
                                </div>
                                <input type="text" id="name" name="name" class="form-control" value="{{ $category->name }}"
                                    placeholder="Name Category">
                            </div>
                            @error('name') <div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                        <div class="form-group">
                            <label>Icon Category</label>
                            <img src="{{ asset('storage/' . $category->image) }}" alt="" class="img-preview img-fluid mb-2 col-sm-3 d-block" style="object-fit: cover">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <div class="input-group-text">
                                        <i class="fas fa-images"></i>
                                    </div>
                                </div>
                                <input type="file" id="image" name="image" class="form-control"
                                    value="{{ old('slug') }}" onchange="previewImage()">
                            </div>
                            @error('image') <div class="text-danger">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="form-group ml-4">
                        <button class="btn btn-primary mt-1"><i class="fas fa-edit"></i> Edit Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop
@section('script')
    <script>
        function previewImage(){
            const img = document.querySelector('#image')
            const imgPreview = document.querySelector('.img-preview')
            
            const oFReader = new FileReader()
            oFReader.readAsDataURL(img.files[0])

            oFReader.onload = function(oFREvent){
                imgPreview.src = oFREvent.target.result
            }
        }
    </script>
@endsection
