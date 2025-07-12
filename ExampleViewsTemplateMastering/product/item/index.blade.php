@extends('master')

@section('content')

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="car"></div>
            <div class="card mb-4">
            <div class="card-header"><strong>{{ __('messages.product_item_information') }}</strong><a class="nav-link active" href="{{ url('item/create') }}"><span style="text-align: right !important">{{ __('messages.add') }}</span></a></div>
            <div class="card-body">
              <div class="example">
                <ul class="nav nav-tabs" role="tablist">
                  <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab"                  href="#preview-557" role="tab">
                      <svg class="icon me-2">
                        <use xlink:href="#"></use> 
                      </svg>Item List</a>
                    </li>
                </ul>
                <div class="tab-content rounded-bottom">
                  <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-557">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Name</th>
                          <th scope="col">Note</th>
                          <th scope="col">Status</th>
                          <th scope="col">Action</th>
                          <th colspan="3">
                            List Of Item
                            <a class="btn btn-warning float-end" href="{{ url('item-export') }}">Export Data</a>
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($items as $item)
                          <tr>
                            <th scope="row">{{ $loop->index+1 }}</th>
                            <td>{{ $item->name_note }}</td>
                            <td>{{ $item->note }}</td>
                            <td>{{ $item->status == 1 ? 'Active' : 'InActive' }}</td>
                            <td>
                              <a href="{{ url('item/edit', $item->id) }}">Edit</a>
                              <a href="{{ url('item/delete', $item->id) }}">Delete</a>
                              
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