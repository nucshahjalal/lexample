@extends('master')

@section('content')

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="car"></div>
            <div class="card mb-4">
            <div class="card-header"><strong>Product  Information</strong><a class="nav-link active" href="{{ url('product/create') }}"><span style="text-align: right !important">Crate</span></a></div>
            <div class="card-body">
              <div class="example">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"                  href="#preview-557" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="#"></use>
                      </svg>Product List</a>
                    </li>
                </ul>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-557">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Item</th>
                          <th scope="col">Name</th>
                          <th scope="col">Note</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($products as $item)
                          <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $item->item }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->note }}</td>
                            <td>{{ $item->status == 1 ? 'Active' : 'InActive' }}</td>
                            <td>
                              <a href="{{ url('product/edit', $item->id) }}">Edit</a>
                              <a href="{{ url('product/delete', $item->id) }}">Delete</a>
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
