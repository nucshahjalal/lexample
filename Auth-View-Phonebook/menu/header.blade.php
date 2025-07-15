<header class="header header-sticky mb-4">
        <div class="container-fluid">
          <button class="header-toggler px-md-0 me-md-3" type="button" onclick="coreui.Sidebar.getInstance(document.querySelector('#sidebar')).toggle()">
            <svg class="icon icon-lg">
              <use xlink:href="{{asset('admin/vendors/@coreui/icons/svg/free.svg#cil-menu')}}"></use>
            </svg>
          </button><a class="header-brand d-md-none" href="#">
            <svg width="118" height="46" alt="CoreUI Logo">
              <use xlink:href="{{asset('admin/assets/brand/coreui.svg#full')}}"></use>
            </svg></a>
          <ul class="header-nav d-none d-md-flex">
            <li class="nav-item"><a class="nav-link" href="#">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Users</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
          </ul>
          <ul class="header-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="{{asset('admin/vendors/@coreui/icons/svg/free.svg#cil-bell')}}"></use>
                </svg></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="{{asset('admin/vendors/@coreui/icons/svg/free.svg#cil-list-rich')}}"></use>
                </svg></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#">
                <svg class="icon icon-lg">
                  <use xlink:href="{{asset('admin/vendors/@coreui/icons/svg/free.svg#cil-envelope-open')}}"></use>
                </svg></a>
            </li>
          </ul>
          <ul class="header-nav ms-3">
            <li class="nav-item dropdown"><a class="nav-link py-0" data-coreui-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                <div class="avatar avatar-md">{{ Auth::user()->name }}</div>
              </a>
              <div class="dropdown-menu dropdown-menu-end pt-0">
                  
                <div class="dropdown-header bg-light py-2">
                    <div class="fw-semibold">Account</div>
                </div><a class="dropdown-item" href="#">
                    
                <svg class="icon me-2">
                    <use xlink:href="{{asset('admin/vendors/@coreui/icons/svg/free.svg#cil-task')}}"></use>
                </svg> Tasks<span class="badge badge-sm bg-danger ms-2">42</span></a><a class="dropdown-item" href="#">

               <?php if(Auth::user()->type == 'admin'){ ?>
                <a class="dropdown-item" href="{{url('/contact')}}">
                    <svg class="icon me-2">
                      <use xlink:href="{{asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                    </svg> Contact
                </a>  
                <?php  } ?>   
                    
                 
                <?php if(Auth::user()->type == 'admin'){ ?>
                <a class="dropdown-item" href="{{url('/home')}}">
                    <svg class="icon me-2">
                      <use xlink:href="{{asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                    </svg> Home
                </a>  
                <?php  } ?>
                    
                <?php if(Auth::user()->type == 'admin'){ ?>
                <a class="dropdown-item" href="{{url('/')}}">
                    <svg class="icon me-2">
                      <use xlink:href="{{asset('admin/vendors/@coreui/icons/svg/free.svg#cil-user')}}"></use>
                    </svg> Logout
                </a>  
                <?php  } ?>    
                        
              </div>
            </li>
          </ul>
        </div>
        <div class="header-divider"></div>
        <div class="container-fluid">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb my-0 ms-2">
              <li class="breadcrumb-item">
                <!-- if breadcrumb is single--><span>Home</span>
              </li>
              <li class="breadcrumb-item active"><span>Dashboard</span></li>
            </ol>
          </nav>
        </div>
      </header>
