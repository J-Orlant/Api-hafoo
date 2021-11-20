@extends('layouts.admin-panel')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4><i class="fas fa-th"></i> Category</h4>
                <a href="{{ route('categories.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                    Category</a>
                <form>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search" value="{{ old('search') }}">
                        <div class="input-group-btn">
                            <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-md">
                        <tr>
                            <th>No</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                        @if (isset($check))
                        @php
                            $no = 1
                        @endphp
                            @foreach ($categories as $category)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>
                                        <img src="{{asset('storage/' . $category->image)}}" class="img-thumbnail img-fluid rounded" style="object-fit: cover;" width="65" alt="">
                                    </td>
                                    <td>{{ Str::limit($category->name, '20', '...') }}</td>
                                    <td>
                                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                        <form class="form d-inline"
                                            action="{{ route('categories.delete', $category->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                        </form>
                                        <button form=".form" class="btn btn-danger hapus"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4">
                                    <p class="text-center text-danger font-italic">There is no category</p>
                                </td>
                            </tr>
                        @endif
                    </table>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                        <ul class="pagination mb-0">
                            {{ $categories->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
@section('script')
    <script>
        $('.hapus').click(function(){
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your category has been deleted.',
                        'success',
                        $('.form').submit()
                    )
                }
            })
        })        
    </script>
@endsection