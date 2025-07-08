@extends('master')

@section('content')

<div class="example">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#preview-1022"  role="tab">
            <svg class="icon me-2">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
            </svg>Edit Product</a>
        </li>  
    </ul>
    <div class="tab-content rounded-bottom">
        <form method="post" action="{{ url('product/update') }}">
            @csrf
            <input class="form-control" name="id" id="name" value="{{ $product->id }}" type="hidden">

            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1022">
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Item</label>
                    <div class="col-sm-4">
                        <select class="form-select" name="item_id">
                            <option selected="">--Select--</option>
                            @foreach($items as $item)
                            <option value="{{ $item->id }}" @if($item->id == $product->item_id) selected="selected" @endif > {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Name</label>
                    <div class="col-sm-4">
                        <input class="form-control" name="name" id="name" value="{{ $product->name }}" type="text">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Note</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" name="note" id="note" rows="3">{{ $product->note }}</textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
              <div class="col-8">
              </div>
              <div class="col-4">
                <button class="btn btn-primary" type="submit">Submit</button>
              </div>
            </div>
        </form>
        
    </div>
</div>

@endsection
