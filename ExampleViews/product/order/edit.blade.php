@extends('master')

@section('content')

<div class="example">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#preview-1022"  role="tab">
            <svg class="icon me-2">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
            </svg>Edit Order</a>
        </li>  
    </ul>
    <div class="tab-content rounded-bottom">
        <form method="post" action="{{ url('order/update') }}">
            @csrf
            <input class="form-control" name="id" id="id" value="{{ $order->id }}" type="hidden">

            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1022">
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Item</label>
                    <div class="col-sm-4">
                        <select class="form-select" name="item_id" id="item_id" onchange="getItemByProduct();">
                            <option selected="">--Select--</option>
                            @foreach($items as $item)
                            <option value="{{ $item->id }}" @if($item->id == $order->item_id) selected="selected" @endif > {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Item</label>
                    <div class="col-sm-4">
                        <select class="form-select" name="product_id" id="product_id">
                            
                            @foreach($products as $product)
                            <option value="{{ $product->id }}" @if($product->id == $order->product_id) selected="selected" @endif > {{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Unit</label>
                    <div class="col-sm-4">
                        <select class="form-select" name="uom">   
                            <option value="pcs" @if($order->uom == 'pcs') selected="selected" @endif >Pcs </option>
                            <option value="box" @if($order->uom == 'box') selected="selected" @endif>Box </option>
                            <option value="unit" @if($order->uom == 'unit') selected="selected" @endif>Unit </option>
                            <option value="kg" @if($order->uom == 'kg') selected="selected" @endif>Kg </option>                       
                            
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Quantity</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_cal" name="qty" id="edit_qty" value="{{ $order->qty  }}" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Price</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_cal" name="price" value="{{ $order->price }}" id="edit_price" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Total</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_total" name="total" value="{{ $order->total }}" id="edit_total" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Discount</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_cal" name="discount" value="{{ $order->discount }}" id="edit_discount" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Grand Total</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_grand_total" name="grand_total" value="{{ $order->grand_total }}" id="edit_grand_total" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Order Date</label>
                    <div class="col-sm-4">
                        <input class="form-control" name="dob" value="{{ $order->dob }}" id="dob" type="text">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Note</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" name="note" id="note" rows="3">{{ $order->note }}</textarea>
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

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script type="text/javascript">

  $('.fn_cal').on('keyup', function(){

        var total_qty = $('#edit_qty').val() ? parseFloat($('#edit_qty').val()) : 0;
        var total_price = $('#edit_price').val() ? parseFloat($('#edit_price').val()) : 0;
        $('.fn_total').val(total_qty * total_price );
        var fn_total = $('#edit_total').val() ? parseFloat($('#edit_total').val()) : 0;
        var fn_discount = $('#edit_discount').val() ? parseFloat($('#edit_discount').val()) : 0;
        $('.fn_grand_total').val(fn_total - fn_discount );
    });

  </script>
  
<script type="text/javascript">
         
    function get_purchase_modal(purchase_id){
         
        $('.fn-item-data').html('<p style="padding: 20px;"><p style="padding: 20px;text-align:center;"><img src="/assets/images/loading.gif" /></p>');
        $.ajax({ 
          headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
          type   : "GET",
          url    : "/asset/purchase/view/"+purchase_id,
          data   : {purchase_id : purchase_id},  
          success: function(response){                                                   
            if(response)
             {
                $('.fn-purchase-data').html(response);
             }
          }
       });
    }
    
    
</script>

<script type="text/javascript">
          //alert('hi');
    function getItemByProduct(){
// alert('hi');
        var item_id = $('#item_id').val();
      
       // console.log(item_id);
        
        $.ajax({ 
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type   : "GET",
            url    : "/order/item_product",
            data   : {item_id : item_id}, 
           //  console.log(data);
            success: function(response){
                $('#product_id').html(response);
            }
       });
    }
    
</script>

@endsection
