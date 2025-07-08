@extends('master')

@section('content')

<div class="example">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><a class="nav-link active" data-coreui-toggle="tab" href="#preview-1022"  role="tab">
            <svg class="icon me-2">
            <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-media-play"></use>
            </svg>Add Order</a>
        </li>  
    </ul>
    <div class="tab-content rounded-bottom">
        <form method="post" action="{{ url('order/store') }}">
            @csrf
            <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1022">
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Item</label>
                    <div class="col-sm-4">
                        <select class="form-select" name="item_id" id="add_item_id" onchange="getItemByProduct();">
                            <option value="0">--Select--</option>
                            @foreach($items as $item)
                            <option value="{{ $item->id }}"> {{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Product</label>
                    <div class="col-sm-4">
                        <select class="form-select" name="product_id" id="product_id">
                            <option value="">--Select--</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Unit</label>
                    <div class="col-sm-4">
                        <select class="form-select" name="uom"> 
                            <option selected="">--Select--</option>  
                            <option value="pcs">Pcs </option>
                            <option value="box">Box </option>
                            <option value="unit">Unit </option>
                            <option value="kg">Kg </option>                       
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Quantity</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_cal" name="qty" id="add_qty" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Price</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_cal" name="price" id="add_price" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Total</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_total" name="total" id="add_total" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Discount</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_cal" name="discount" id="add_discount" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Grand Total</label>
                    <div class="col-sm-4">
                        <input class="form-control fn_grand_total" name="grand_total" id="add_grand_total" type="number">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Order Date</label>
                    <div class="col-sm-4">
                        <input class="form-control" name="dob" id="dob" type="text">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label" for="inputPassword">Note</label>
                    <div class="col-sm-4">
                        <textarea class="form-control" name="note" id="note" rows="3"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-12">
              <div class="col-8">
              </div>
              <div class="col-4">
                <button class="btn btn-primary" type="submit">Submit</button>
                <a class="nav-link active" class="btn btn-info" href="{{ url('order') }}" role="tab">
                    <svg class="icon me-2">
                    </svg> Cancel</a>
              </div>
            </div>
        </form>
        
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<script type="text/javascript">

  $('.fn_cal').on('keyup', function(){

        var total_qty = $('#add_qty').val() ? parseFloat($('#add_qty').val()) : 0;
        var total_price = $('#add_price').val() ? parseFloat($('#add_price').val()) : 0;
        $('.fn_total').val(total_qty * total_price );
        var fn_total = $('#add_total').val() ? parseFloat($('#add_total').val()) : 0;
        var fn_discount = $('#add_discount').val() ? parseFloat($('#add_discount').val()) : 0;
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
 
        var item_id = $('#add_item_id').val();
      
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
