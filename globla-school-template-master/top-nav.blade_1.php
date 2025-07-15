<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>  
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown"
                       data-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('/assets/images/default-user.png') }}" alt="">John Doe
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:;"> <i class="fa fa-user"></i> Profile</a>
                        <a class="dropdown-item" href="javascript:;"><i class="fa fa-gear"></i> Settings</a>
                        <a class="dropdown-item" href="javascript:;"><i class="fa fa-help"></i> Help</a>
                        <a class="dropdown-item" href="javascript:;"><i class="fa fa-edit"></i> Update</a>
                        <a class="dropdown-item" href="javascript:void();"><i class="fa fa-power-off" style="float: left;"></i>                         
                            <form method="POST" action="{{ route('logout') }}" style="margin-top: -4px;">
                                @csrf
                                <button type="submit" class="" aria-hidden="true" style="border:0;margin:0;background: transparent;">Log Out</button>
                            </form>                        
                        </a>
                    </div>
                </li>  

                <li role="presentation_" class="nav-item dropdown open">
                    
                    @$language = get_language_list();                    
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                       data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-language"></i>
                        <span class="badge bg-green">@if (count($language) > 0)  {{ count($language) }} @endif</span>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">
                            <span class="flag">
                                <img src="{{ asset('/assets/images/flags/us_flag.jpg') }}" alt="img">
                            </span>
                            English
                        </a>
                        <a class="dropdown-item" href="#">
                            <span class="flag">
                                <img src="{{ asset('/assets/images/flags/spain_flag.jpg') }}" alt="img">
                            </span>
                            Spanish
                        </a>
                        <a class="dropdown-item" href="#">
                            <span class="flag">
                                <img src="{{ asset('/assets/images/flags/argentina_flag.jpg') }}" alt="img">
                            </span>
                            Argentina
                        </a>
                        <a class="dropdown-item" href="#">
                            <span class="flag">
                                <img src="{{ asset('/assets/images/flags/canada_flag.jpg') }}" alt="img">
                            </span>
                            Canada
                        </a>
                        <a class="dropdown-item" href="#">
                            <span class="flag">
                                <img src="{{ asset('/assets/images/flags/china_flag.jpg') }}" alt="img">
                            </span>
                            China
                        </a>
                        <a class="dropdown-item" href="#">
                            <span class="flag">
                                <img src="{{ asset('/assets/images/flags/french_flag.jpg') }}" alt="img">
                            </span>
                            France
                        </a>
                    </div>
                </li>

                <li role="presentation" class="nav-item dropdown open">
                    <a href="javascript:;" class="dropdown-toggle info-number" id="navbarDropdown1"
                       data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-envelope-o"></i>
                        <span class="badge bg-green">6</span>
                    </a>
                    <ul class="dropdown-menu list-unstyled msg_list" role="menu" aria-labelledby="navbarDropdown1">
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="{{ asset('/assets/images/default-user.png') }}" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were
                                    where...
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="dropdown-item">
                                <span class="image"><img src="{{ asset('/assets/images/default-user.png') }}" alt="Profile Image" /></span>
                                <span>
                                    <span>John Smith</span>
                                    <span class="time">3 mins ago</span>
                                </span>
                                <span class="message">
                                    Film festivals used to be do-or-die moments for movie makers. They were
                                    where...
                                </span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <div class="text-center">
                                <a class="dropdown-item">
                                    <strong>See All Alerts</strong>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </li>
                    </ul>
                </li>  

                <li role="presentation_" class="nav-item dropdown open">
                    <a href="javascript:;" title="Front Website" class="dropdown-toggle info-number" id="navbarDropdown1"
                       data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-globe"></i>
                    </a>
                </li>

                <li role="presentation_" class="nav-item dropdown open">
                    <a href="javascript:;" title="Front Website" class="dropdown-toggle info-number" id="navbarDropdown1"
                       data-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-calendar"></i>
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
                        <div class="ay-dropdown">
                            <span class="flag">
                                <i class="fa fa-calendar"></i>
                            </span>
                            Academic Session
                        </div>
                        <a class="dropdown-item" href="#">                            
                            2001 - 2002
                        </a>
                        <a class="dropdown-item" href="#">                            
                            2002 - 2003
                        </a>
                        <a class="dropdown-item" href="#">                            
                            2003 - 2004
                        </a>
                        <a class="dropdown-item" href="#">                            
                            2004 - 2005
                        </a>
                    </div>
                </li>

            </ul>
        </nav>
    </div>
</div>