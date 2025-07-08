<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
      <div class="sidebar-brand d-none d-md-flex">
        <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#full"></use>
        </svg>
        <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
          <use xlink:href="assets/brand/coreui.svg#signet"></use>
        </svg>
      </div>
      <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{ url('/template')}}">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-speedometer"></use>
            </svg> Template<span class="badge badge-sm bg-info ms-auto"></span></a></li>
        <li class="nav-title">Module</li>
          <li class="nav-item"><a class="nav-link" href="{{ url('bkash') }}">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Bkash Payment </a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('stripe') }}">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Stripe Payment </a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('item') }}">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Item List </a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('product') }}">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Product List</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('order') }}">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Order List</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('lang') }}">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Language</a>
          </li>
          <li class="nav-item"><a class="nav-link" href="{{ url('qrcode') }}">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Qrcode Generate</a>
          </li>
        
        <li class="nav-title">Inventory</li>     
       
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="vendors/@coreui/icons/svg/free.svg#cil-puzzle"></use>
            </svg> Item</a>
          <ul class="nav-group-items">
           
            <li class="nav-item"><a class="nav-link" href="{{ url('item') }}"><span class="nav-icon"></span>Item List</a>
            </li> 
          </ul>

            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <x-responsive-nav-link :href="route('logout')"
                      onclick="event.preventDefault();
                                  this.closest('form').submit();">
                <span style="color:white;text-decoration:none;"> {{ __('Log Out') }}</span>
              </x-responsive-nav-link>
            </form>  
        </li>
           
        </a>
      </li>
      
      </ul>
      <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
    </div>