@extends('master')

@section('content')

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="car"></div>
            <div class="card mb-4">
            <div class="card-header"><strong>Order  Information</strong><a class="nav-link active" href="#"></a></div>
            <div class="card-body">
              <div class="example">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"  href="{{ url('order') }}" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="#"></use>
                      </svg> List</a>
                    </li>
                    <li class="nav-item"><a class="nav-link active"       data-coreui-toggle="tab"     href="{{ url('order/create') }}" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="#"></use>
                      </svg> Create</a>
                    </li>
                </ul>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-557">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Item</th>
                          <th scope="col">Product</th>
                        <th scope="col">Quantity</th>
                          <th scope="col">Price</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($orders as $order)
                          <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $order->item }}</td>
                            <td>{{ $order->product }}</td>
                            <td>{{ $order->qty }}</td>
                            <td>{{ $order->price }}</td>
                            <td>{{ $order->status == 1 ? 'Active' : 'InActive' }}</td>
                            <td>
                              <a href="{{ url('order/edit', $order->id) }}">Edit</a>
                              <a href="{{ url('order/delete', $order->id) }}">Delete</a>
                            </td>
                          </tr>
                        @endforeach
                                 
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

@endsection
