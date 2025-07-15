
@extends('master')

@section('title')
    Appartment Management || Home Page
@endsection

@section('content')



    <div class="col-12">
      <div class="card mb-4">
        <div class="card-body">
          <div class="example">
            <div class="tab-content rounded-bottom">
                <div class="tab-pane p-3 active preview" role="tabpanel" id="preview-1022">
                    <form method="post" action="">
                        
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label" for="name">Name</label>
                            <div class="col-sm-5">
                                <input class="form-control" id="name" name="name" type="text">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label" for="amount">Amount</label>
                            <div class="col-sm-5">
                                <input class="form-control" id="amount" name="amount" type="number">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label" for="note">Note</label>
                            <div class="col-sm-5">
                                <textarea class="form-control" id="note" name="note" rows="3"></textarea>
                            </div>
                        </div>
                    
                        <div class="mb-3 row">
                            <button class="btn btn-info mb-3" type="submit">Submit</button>
                        </div>
                        
                    </form>
               </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection

