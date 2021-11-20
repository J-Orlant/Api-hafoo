@extends('layouts.admin-panel')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4><i class="fas fa-bos-open"></i> Products</h4>
                    <a href="{{ route('products.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i>
                        Product</a>
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
                                <th>Topping</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            @if (isset($check))
                            @php
                                $no = 1
                            @endphp
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>
                                            <img src="{{asset('storage/' . $product->image)}}" class="img-thumbnail img-fluid rounded d-lg-block d-none" style="object-fit: cover; width: 85px; height: 70px;" alt="">
                                            <img src="{{asset('storage/' . $product->image)}}" class="img-thumbnail img-fluid rounded d-block d-lg-none" style="object-fit: cover; width: 120px; height: 60px;" alt="">
                                        </td>
                                        <td>{{ Str::limit($product->name, '20', '...') }}</td>
                                        <td>
                                            @if ($product->topping)
                                                {{ Str::limit($product->topping, '20', '...') }}
                                            @else
                                                <p class="text-danger font-italic">No Topping</p>
                                            @endif
                                        </td>
                                        <td>
                                            @if (empty($product->category->id) || $product->category->id == 0)
                                                <p class="text-danger font-italic">No category</p>
                                            @else
                                                {{ $product->category->name }}
                                            @endif
                                        </td>
                                        <td>Rp. {{ number_format($product->price) }}</td>
                                        <td>{!! Str::limit($product->description, '30', '...') !!}</td>
                                        <td>
                                            <a href="{{ route('products.edit', $product->slug) }}"
                                                class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                            <form class="form d-inline"
                                                action="{{ route('products.delete', $product->slug) }}" method="post">
                                                @csrf
                                                @method('delete')
                                            </form>
                                            <button form=".form" class="btn btn-danger hapus"><i class="fas fa-trash"></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">
                                        <p class="text-center text-danger font-italic">There is no product</p>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                {{ $products->links() }}
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
                        'Your product has been deleted.',
                        'success',
                        $('.form').submit()
                    )
                }
            })
        })        
    </script>
@endsection
