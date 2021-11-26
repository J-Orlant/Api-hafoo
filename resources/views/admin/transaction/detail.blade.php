@extends('layouts.admin-panel')
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4><i class="fas fa-e"></i> Detail Transaction</h4>
                    <h4 class="title">Invoice Code : {{ $transaction->invoice_code }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-borderless" border="0">
                        <tr>
                            <td>
                                <p class="h5 m-0" style="font-weight: bold;">Transaction Data</p>
                            </td>
                        </tr>
                        <tr>
                            <td>Username/Name </td>
                            <td>{{ $transaction->user->username }} / {{ $transaction->user->name }} </td>
                            <td>Email </td>
                            <td>{{ $transaction->user->email }} </td>
                        </tr>
                        <tr>
                            <td>Address </td>
                            <td>{{ $transaction->address }} </td>
                            <td>Total Quantity </td>
                            <td>{{ $transaction->total_quantity }} </td>
                        </tr>
                        <tr>
                            <td>Total Price </td>
                            <td>{{ $transaction->total_price }} </td>
                            <td>Shpping Price </td>
                            <td>{{ $transaction->shipping_price }} </td>
                        </tr>
                    </table>
                    <div class="table-responsive ">
                        <p class="h5 m-4" style="font-weight: bold;">Ordered Products</p>

                        <table class="table table-bordered table-md">
                            <tr>
                                <th>No</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Topping</th>
                                <th>Category</th>
                                <th>Price</th>
                            </tr>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($orders as $order)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>
                                        <img src="{{ asset('storage/' . $order->product->image) }}"
                                            class="img-thumbnail img-fluid rounded d-lg-block d-none"
                                            style="object-fit: cover; width: 85px; height: 70px;" alt="">
                                        <img src="{{ asset('storage/' . $order->product->image) }}"
                                            class="img-thumbnail img-fluid rounded d-block d-lg-none"
                                            style="object-fit: cover; width: 120px; height: 60px;" alt="">
                                    </td>
                                    <td>{{ Str::limit($order->product->name, '20', '...') }}</td>
                                    <td>
                                        @if ($order->product->topping)
                                            {{ Str::limit($order->product->topping, '20', '...') }}
                                        @else
                                            <p class="text-danger font-italic">No Topping</p>
                                        @endif
                                    </td>
                                    <td>
                                        @if (empty($order->product->category->id) || $order->product->category->id == 0)
                                            <p class="text-danger font-italic">No category</p>
                                        @else
                                            {{ $order->product->category->name }}
                                        @endif
                                    </td>
                                    <td>Rp. {{ number_format($order->product->price) }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                    <div class="card-footer text-right">
                        <?php
                            $status = '';
                        if ($transaction->status == 0){
                            $status = 'Send Order';
                        } else if($transaction->status == 1){
                            $status = 'Has Arrived';
                        } ?>
                        @if ($transaction->status <=1)
                        <a href="{{ route('transactions.status.update', $transaction->id) }}" class="btn btn-primary" type="button">{{$status}}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
