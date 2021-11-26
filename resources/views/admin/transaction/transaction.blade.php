@extends('layouts.admin-panel')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4><i class="fas fa-shopping-cart"></i> Transaction</h4>
                    <form>
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search"
                                value="{{ old('search') }}">
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
                                <th>Invoice</th>
                                <th>Name</th>
                                <th>Date Order</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            @if (isset($check))
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($transactions as $transaction)
                                <tr>
                                    <td>{{$no++}}</td>
                                    <td>{{$transaction->invoice_code}}</td>
                                    <td>{{$transaction->user->name}}</td>
                                    <td>{{$transaction->created_at->format('d-m-Y')}}</td>
                                    @if ($transaction->status == 0)
                                        <td>Processed</td>
                                    @elseif($transaction->status == 1)
                                        <td>Being sent</td>
                                    @elseif($transaction->status == 2)
                                        <td>Has Arrived</td>
                                    @endif
                                    <td>
                                        <a href="{{ route('transactions.detail', $transaction->id) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="8">
                                        <p class="text-center text-danger font-italic">There is no transactions</p>
                                    </td>
                                </tr>
                            @endif
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        <nav class="d-inline-block">
                            <ul class="pagination mb-0">
                                {{ $transactions->links() }}
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
        $('.hapus').click(function() {
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
