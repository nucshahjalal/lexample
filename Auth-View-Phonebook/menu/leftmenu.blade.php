
<div class="sidebar sidebar-dark sidebar-fixed" id="sidebar">
    <div class="sidebar-brand d-none d-md-flex">
      <svg class="sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
        <use xlink:href="#"></use>
      </svg>
      <svg class="sidebar-brand-narrow" width="46" height="46" alt="CoreUI Logo">
        <use xlink:href="#"></use>
      </svg>
    </div>
    <ul class="sidebar-nav" data-coreui="navigation" data-simplebar="">
        <li class="nav-item"><a class="nav-link" href="{{'/dashboard'}}">
            <svg class="nav-icon">
              <use xlink:href="{{'/dashboard'}}"></use>
            </svg> Dashboard
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="#">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Charts</a>
        </li>
        
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Master Setup </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{'/contact/list'}}"> Contact Us </a></li>
                <li class="nav-item"><a class="nav-link" href="{{'/news/list'}}"> News</a></li>
                <li class="nav-item"><a class="nav-link" href="forms/checks-radios.html"> Checks and radios</a></li>
            </ul>
        </li>

        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Accounts </a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="{{'/account/list'}}"> Accounts </a></li>
                <li class="nav-item"><a class="nav-link" href="{{'/account/deposit/list'}}"> Deposit</a></li>
                <li class="nav-item"><a class="nav-link" href="{{'/account/expense/list'}}"> Expense</a></li>
                <li class="nav-item"><a class="nav-link" href="{{'/account/boucher/list'}}"> Boucher</a></li>
            </ul>
        </li>
        
        <li class="nav-group"><a class="nav-link nav-group-toggle" href="#">
            <svg class="nav-icon">
              <use xlink:href="#"></use>
            </svg> Icons</a>
            <ul class="nav-group-items">
                <li class="nav-item"><a class="nav-link" href="icons/coreui-icons-free.html"> CoreUI Icons<span class="badge badge-sm bg-success ms-auto">Free</span></a></li>
                <li class="nav-item"><a class="nav-link" href="icons/coreui-icons-brand.html"> CoreUI Icons - Brand</a></li>
                <li class="nav-item"><a class="nav-link" href="icons/coreui-icons-flag.html"> CoreUI Icons - Flag</a></li>
            </ul>
        </li>
    </ul>
    
    <button class="sidebar-toggler" type="button" data-coreui-toggle="unfoldable"></button>
</div>
