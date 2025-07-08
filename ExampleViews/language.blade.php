@extends('master')

@section('content')

<div class="body flex-grow-1 px-3">
    <div class="container-lg">
        <div class="car"></div>
            <div class="card mb-4">
            <div class="card-header"><strong> <h4>{{ __('messages.language_information') }}</h4></strong></div>
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
                          <th scope="col">Select Language :</th>
                        </tr>
                      </thead>
                      <tbody>
                     
                        <tr>
                            <td>

                                <div class="col-md-4">
                                    <select class="form-control changeLang" name = "lang">
                                        <option value="en" {{ session()->get('locale') == 'en' ? 'selected' : '' }}>English</option>
                                        <option value="bn" {{ session()->get('locale') == 'bn' ? 'selected' : '' }}>Bangla</option>
                                        <option value="sp" {{ session()->get('locale') == 'sp' ? 'selected' : '' }}>Spanish</option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                       
                                 
                      </tbody>
                    </table>
                    
                    <h3>{{ __('messages.title') }}</h3>
                    <h4>{{ __('messages.hellow_world') }}</h4>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script type="text/javascript">

        var url = "{{ route('changeLang') }}";
        
        $(".changeLang").change(function(){
            window.location.href = url + "?lang="+ $(this).val();
        });

    </script>

@endsection

