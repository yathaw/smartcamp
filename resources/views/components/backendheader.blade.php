@php
    $authRole = Auth::user()->getRoleNames()[0];
    $authuser = Auth::user();
@endphp
<!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center">
            @if($authuser->school->name)
                <img src="{{ asset($authuser->school->logo) }}" alt="">
                <span class="d-none d-lg-block"> {{ $authuser->school->name }} </span>
            @else
                <img src="{{ asset('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">SMART CAMP</span>
            @endif
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>
    <!-- End Logo -->
    
    <nav class="header-nav ms-auto">
        <ul class="d-flex align-items-center">
            <li class="nav-item d-block d-lg-none">
                <a class="nav-link nav-icon search-bar-toggle " href="#">
                <i class="bi bi-search"></i>
                </a>
            </li>
            <!-- End Search Icon-->
            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-translate"></i>
                </a><!-- End Messages Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages mb-0 pb-0">
                    <li class="dropdown-header">
                        {{ __("Choose Language")}}
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="{{route('lang','en')}}" class="align-items-center">
                            <svg width="35" height="35" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512.002 512.002" style="enable-background:new 0 0 512.002 512.002;" xml:space="preserve">
                                <path style="fill:#41479B;" d="M503.172,423.725H8.828c-4.875,0-8.828-3.953-8.828-8.828V97.104c0-4.875,3.953-8.828,8.828-8.828
                                    h494.345c4.875,0,8.828,3.953,8.828,8.828v317.793C512,419.772,508.047,423.725,503.172,423.725z"/>
                                <path style="fill:#F5F5F5;" d="M512,97.104c0-4.875-3.953-8.828-8.828-8.828h-39.495l-163.54,107.147V88.276h-88.276v107.147
                                    L48.322,88.276H8.828C3.953,88.276,0,92.229,0,97.104v22.831l140.309,91.927H0v88.276h140.309L0,392.066v22.831
                                    c0,4.875,3.953,8.828,8.828,8.828h39.495l163.54-107.147v107.147h88.276V316.578l163.54,107.147h39.495
                                    c4.875,0,8.828-3.953,8.828-8.828v-22.831l-140.309-91.927H512v-88.276H371.691L512,119.935V97.104z"/>
                                <g>
                                    <polygon style="fill:#FF4B55;" points="512,229.518 282.483,229.518 282.483,88.276 229.517,88.276 229.517,229.518 0,229.518 
                                        0,282.483 229.517,282.483 229.517,423.725 282.483,423.725 282.483,282.483 512,282.483   "/>
                                    <path style="fill:#FF4B55;" d="M178.948,300.138L0.25,416.135c0.625,4.263,4.14,7.59,8.577,7.59h12.159l190.39-123.586h-32.428
                                        V300.138z"/>
                                    <path style="fill:#FF4B55;" d="M346.388,300.138H313.96l190.113,123.404c4.431-0.472,7.928-4.09,7.928-8.646v-7.258
                                        L346.388,300.138z"/>
                                    <path style="fill:#FF4B55;" d="M0,106.849l161.779,105.014h32.428L5.143,89.137C2.123,90.54,0,93.555,0,97.104V106.849z"/>
                                    <path style="fill:#FF4B55;" d="M332.566,211.863L511.693,95.586c-0.744-4.122-4.184-7.309-8.521-7.309h-12.647L300.138,211.863
                                        H332.566z"/>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>
                                        
                            <h4 class="ms-2 my-auto">{{ __("English")}}</h4>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="{{route('lang','mm')}}">
                            <svg width="35" height="35" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                                <path style="fill:#FF4B55;" d="M0,311.908h512v102.988c0,4.875-3.953,8.828-8.828,8.828H8.828c-4.875,0-8.828-3.953-8.828-8.828
                                    V311.908z"/>
                                <path style="fill:#FFE15A;" d="M8.828,88.276h494.345c4.875,0,8.828,3.953,8.828,8.828v102.988H0V97.103
                                    C0,92.228,3.953,88.276,8.828,88.276z"/>
                                <rect y="200.09" style="fill:#73AF00;" width="512" height="111.81"/>
                                <path style="fill:#F5F5F5;" d="M261.032,144.959l26.435,79.263l83.552,0.648c5.097,0.04,7.21,6.543,3.111,9.571l-67.214,49.635
                                    l25.203,79.663c1.537,4.86-3.996,8.879-8.142,5.916L256,321.068l-67.976,48.587c-4.147,2.964-9.679-1.056-8.142-5.916l25.203-79.663
                                    l-67.214-49.635c-4.1-3.028-1.987-9.533,3.111-9.571l83.552-0.648l26.435-79.263C252.58,140.124,259.42,140.124,261.032,144.959z"/>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>
                            <h4 class="ms-2 my-auto">{{ __("Myanmar")}}</h4>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="{{route('lang','jp')}}">
                            <svg width="35" height="35" viewBox="1 -79 511.999 511" xmlns="http://www.w3.org/2000/svg">
                                <path d="m397.242188 353.601562h97.101562c9.75 0 17.65625-7.902343 17.65625-17.652343v-317.792969c0-9.753906-7.90625-17.65625-17.65625-17.65625h-476.6875c-9.753906 0-17.65625 7.90625-17.65625 17.65625v317.792969c0 9.75 7.902344 17.652343 17.65625 17.652343zm0 0" fill="#e6e7e8"/>
                                <path d="m353.101562 177.050781c0 53.628907-43.472656 97.105469-97.101562 97.105469s-97.101562-43.476562-97.101562-97.105469c0-53.628906 43.472656-97.101562 97.101562-97.101562s97.101562 43.472656 97.101562 97.101562zm0 0" fill="#c03a2b"/>
                            </svg>
                            <h4 class="ms-2 my-auto">{{ __("Japan")}}</h4>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="{{route('lang','cn')}}">
                            <svg width="35" height="35" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                                <path style="fill:#FF4B55;" d="M503.172,423.725H8.828c-4.875,0-8.828-3.953-8.828-8.828V97.104c0-4.875,3.953-8.828,8.828-8.828
                                    h494.345c4.875,0,8.828,3.953,8.828,8.828v317.793C512,419.773,508.047,423.725,503.172,423.725z"/>
                                <g>
                                    <path style="fill:#FFE15A;" d="M85.007,140.733l8.416,25.234l26.6,0.206c3.444,0.026,4.872,4.422,2.101,6.467l-21.398,15.801
                                        l8.023,25.362c1.038,3.284-2.7,5.999-5.502,3.997l-21.64-15.469l-21.64,15.468c-2.802,2.003-6.54-0.714-5.502-3.997l8.023-25.362
                                        l-21.398-15.8c-2.771-2.046-1.343-6.441,2.101-6.467l26.6-0.206l8.416-25.234C79.297,137.465,83.918,137.465,85.007,140.733z"/>
                                    <path style="fill:#FFE15A;" d="M181.599,146.951l6.035,8.23l9.739-3.046c1.261-0.394,2.298,1.044,1.526,2.115l-5.962,8.281
                                        l5.906,8.321c0.765,1.077-0.282,2.508-1.54,2.105l-9.719-3.111l-6.089,8.189c-0.788,1.06-2.473,0.506-2.478-0.814l-0.045-10.205
                                        l-9.67-3.261c-1.251-0.423-1.246-2.195,0.009-2.609l9.69-3.196l0.114-10.204C179.129,146.427,180.818,145.886,181.599,146.951z"/>
                                    <path style="fill:#FFE15A;" d="M144.857,122.421l10.145,1.102l4.328-9.241c0.561-1.196,2.321-0.991,2.591,0.302l2.086,9.988
                                        l10.126,1.26c1.311,0.163,1.66,1.901,0.513,2.558l-8.855,5.07l1.931,10.02c0.25,1.298-1.295,2.166-2.274,1.279l-7.559-6.855
                                        l-8.932,4.932c-1.156,0.639-2.461-0.563-1.919-1.768l4.183-9.308l-7.452-6.972C142.805,123.89,143.544,122.279,144.857,122.421z"/>
                                    <path style="fill:#FFE15A;" d="M160.895,221.314l-6.035,8.23l-9.739-3.046c-1.261-0.394-2.298,1.044-1.526,2.115l5.962,8.281
                                        l-5.906,8.321c-0.765,1.077,0.282,2.508,1.54,2.105l9.719-3.111l6.089,8.189c0.788,1.06,2.473,0.506,2.478-0.814l0.045-10.205
                                        l9.67-3.261c1.252-0.423,1.246-2.195-0.009-2.609l-9.69-3.196l-0.114-10.204C163.363,220.791,161.676,220.248,160.895,221.314z"/>
                                    <path style="fill:#FFE15A;" d="M197.635,198.263l-10.145,1.102l-4.328-9.241c-0.561-1.196-2.321-0.991-2.591,0.302l-2.087,9.988
                                        l-10.126,1.26c-1.311,0.163-1.66,1.901-0.513,2.558l8.855,5.07l-1.931,10.02c-0.25,1.298,1.295,2.166,2.274,1.279l7.559-6.855
                                        l8.932,4.932c1.156,0.639,2.461-0.563,1.919-1.768l-4.183-9.308l7.452-6.972C199.689,199.732,198.95,198.121,197.635,198.263z"/>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>
                            <h4 class="ms-2 my-auto">{{ __("China")}}</h4>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item">
                        <a href="{{route('lang','de')}}">
                            <svg width="35" height="35" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512.001 512.001" style="enable-background:new 0 0 512.001 512.001;" xml:space="preserve">
                                <path style="fill:#464655;" d="M512,200.093H0V97.104c0-4.875,3.953-8.828,8.828-8.828h494.345c4.875,0,8.828,3.953,8.828,8.828
                                    L512,200.093L512,200.093z"/>
                                <path style="fill:#FFE15A;" d="M503.172,423.725H8.828c-4.875,0-8.828-3.953-8.828-8.828V311.909h512v102.988
                                    C512,419.773,508.047,423.725,503.172,423.725z"/>
                                <rect y="200.091" style="fill:#FF4B55;" width="512" height="111.81"/>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>
                            <h4 class="ms-2 my-auto">{{ __("Germany")}}</h4>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="message-item mb-0">
                        <a href="{{route('lang','fr')}}">
                            <svg width="35" height="35" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve">
                                <path style="fill:#41479B;" d="M170.667,423.721H8.828c-4.875,0-8.828-3.953-8.828-8.828V97.1c0-4.875,3.953-8.828,8.828-8.828
                                    h161.839V423.721z"/>
                                <rect x="170.67" y="88.277" style="fill:#F5F5F5;" width="170.67" height="335.45"/>
                                <path style="fill:#FF4B55;" d="M503.172,423.721H341.333V88.273h161.839c4.875,0,8.828,3.953,8.828,8.828v317.793
                                    C512,419.77,508.047,423.721,503.172,423.721z"/>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                                <g>
                                </g>
                            </svg>
                            <h4 class="ms-2 my-auto">{{ __("France")}}</h4>
                        </a>
                    </li>
                </ul>
                <!-- End Messages Dropdown Items -->
            </li>
            <!-- End Language Nav -->

            <li class="nav-item dropdown">
                <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                <i class="bi bi-bell"></i>
                <span class="badge bg-primary badge-number">4</span>
                </a><!-- End Notification Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                    <li class="dropdown-header">
                        You have 4 new notifications
                        <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="notification-item">
                        <i class="bi bi-exclamation-circle text-warning"></i>
                        <div>
                            <h4>Lorem Ipsum</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>30 min. ago</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="notification-item">
                        <i class="bi bi-x-circle text-danger"></i>
                        <div>
                            <h4>Atque rerum nesciunt</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>1 hr. ago</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="notification-item">
                        <i class="bi bi-check-circle text-success"></i>
                        <div>
                            <h4>Sit rerum fuga</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>2 hrs. ago</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="notification-item">
                        <i class="bi bi-info-circle text-primary"></i>
                        <div>
                            <h4>Dicta reprehenderit</h4>
                            <p>Quae dolorem earum veritatis oditseno</p>
                            <p>4 hrs. ago</p>
                        </div>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li class="dropdown-footer">
                        <a href="#">Show all notifications</a>
                    </li>
                </ul>
                <!-- End Notification Dropdown Items -->
            </li>
            <!-- End Notification Nav -->
            
            <li class="nav-item dropdown pe-3">
                <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                <img src="{{ asset($authuser->profile_photo_path) }}" alt="Profile" class="rounded-circle">
                <span class="d-none d-md-block dropdown-toggle ps-2">{{ $authuser->name }}</span>
                </a><!-- End Profile Iamge Icon -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                    <li class="dropdown-header">
                        <h6>{{ $authuser->name }}</h6>
                        <span>{{ $authRole }}</span>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                        <i class="bi bi-person"></i>
                        <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="users-profile.html">
                        <i class="bi bi-gear"></i>
                        <span>Account Settings</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="pages-faq.html">
                        <i class="bi bi-question-circle"></i>
                        <span>Need Help?</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center" href="#">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Sign Out</span>
                        </a>
                    </li>
                </ul>
                <!-- End Profile Dropdown Items -->
            </li>
            <!-- End Profile Nav -->
        </ul>
    </nav>
    <!-- End Icons Navigation -->
</header>
<!-- End Header -->
<!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- All User -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="">
            <i class="bi bi-grid"></i>
            <span>{{ __("Dashboard")}}</span>
            </a>
        </li>

        <!-- Software Admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="">
            <i class='bi bi-building'></i>
            <span>{{ __("School")}}</span>
            </a>
        </li>

        <!-- Software Admin -->
        <li class="nav-item ">
            <a class="nav-link @if(Request::segment(2) != 'plan') collapsed @endif " href="{{ route('master.plan.index') }}">
            <i class='bi bi-tags'></i>
            <span>{{ __("Pricing Plan")}}</span>
            </a>
        </li>

        <!-- Software Admin -->
        @php 
            $components = ["role", "grade", "expensetype", "schooltype", "bank", "blood", "religion", "city", "state", "country"];

            $classroutine = ["scheduletype", "holiday", "schedule"];
        @endphp
        <li class="nav-item">
            <a class="nav-link @if(!in_array(Request::segment(2),$components)) collapsed @endif " data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
            <i class="bi bi-menu-button-wide"></i><span>{{ __("Components")}}</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse @if(in_array(Request::segment(2),$components)) show @endif" data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('master.role.index') }}" class="@if(Request::segment(2) == $components[0]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Role")}}</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('master.grade.index') }}" class="@if(Request::segment(2) == $components[1]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Grade")}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('master.expensetype.index') }}" class="@if(Request::segment(2) == $components[2]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Expense Type")}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('master.schooltype.index') }}" class="@if(Request::segment(2) == $components[3]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("School Type")}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('master.bank.index') }}" class="@if(Request::segment(2) == $components[4]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Bank")}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('master.blood.index') }}" class="@if(Request::segment(2) == $components[5]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Blood")}}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('master.religion.index') }}" class="@if(Request::segment(2) == $components[6]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Religion")}}</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{ route('master.city.index') }}" class="@if(Request::segment(2) == $components[7]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("City")}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('master.state.index') }}" class="@if(Request::segment(2) == $components[8]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("State")}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('master.country.index') }}" class="@if(Request::segment(2) == $components[9]) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Country")}}</span>
                    </a>
                </li>
            </ul>
        </li>
        
        <!-- School Admin / Principal / Staff -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="">
            <i class="bi bi-bar-chart"></i>
            <span>{{ __("Report")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="">
            <i class="bi bi-cash-coin"></i>
            <span>{{ __("Installment")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="">
            <i class="bi bi-receipt"></i>
            <span>{{ __("Expense")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="">
            <i class="bi bi-person-check"></i>
            <span>{{ __("Attendance")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="">
            <i class="bi bi-hourglass"></i>
            <span>{{ __("Exam")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="">
            <i class="bi bi-clipboard-check"></i>
            <span>{{ __("Result")}}</span>
            </a>
        </li>


        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#student-nav" data-bs-toggle="collapse" href="#">
                <i class='bx bx-user'></i>
                <span>{{ __("Students")}}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="student-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="">
                    <i class="bi bi-circle"></i><span>{{ __("All Students")}}</span>
                    </a>
                </li>

                <li>
                    <a href="">
                    <i class="bi bi-circle"></i><span>{{ __("Admission Form")}}</span>
                    </a>
                </li>
                <li>
                    <a href="">
                    <i class="bi bi-circle"></i><span>{{ __("Transfer Form")}}</span>
                    </a>
                </li>
                <li>
                    <a href="">
                    <i class="bi bi-circle"></i><span>{{ __("Resignation Form")}}</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link @if(!in_array(Request::segment(2),$classroutine)) collapsed @endif " data-bs-target="#class-nav" data-bs-toggle="collapse" href="#">
                <i class='bi bi-calendar4-range'></i>
                <span>{{ __("Class Routine")}}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="class-nav" class="nav-content collapse @if(in_array(Request::segment(2),$classroutine)) show @endif " data-bs-parent="#sidebar-nav">

                <li>
                    <a href="">
                        <i class="bi bi-circle"></i><span>{{ __("Timetable")}}</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link @if(Request::segment(2) != 'schedule') collapsed @endif " href="{{ route('master.schedule.create') }}">
                        <i class="bi bi-circle"></i><span>{{ __("Add New Routine")}}</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link @if(Request::segment(2) != 'holiday') collapsed @endif " href="{{ route('master.holiday.index') }}">
                        <i class="bi bi-circle"></i><span>{{ __("Holiday")}}</span>
                    </a>
                </li>

                <li>
                    <a class="nav-link @if(Request::segment(2) != 'scheduletype') collapsed @endif " href="{{ route('master.scheduletype.index') }}">
                        <i class="bi bi-circle"></i><span>{{ __("Schedule Type")}}</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) != 'section') collapsed @endif " href="{{ route('master.section.index') }}">
            <i class="bi bi-award"></i>
            <span>{{ __("Section")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) != 'period') collapsed @endif " href="{{ route('master.period.index') }}">
            <i class="bi bi-calendar4-week"></i>
            <span>{{ __("Period Year")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) != 'staff') collapsed @endif" data-bs-target="#staff-nav" data-bs-toggle="collapse" href="#">
                <i class='bi bi-person-badge'></i>
                <span>{{ __("Staff")}}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="staff-nav" class="nav-content collapse @if(Request::segment(2) == 'staff' ) show @endif" data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('master.staff.index') }}" class="@if(Request::segment(2) == 'staff' && Request::segment(3) == null) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("All Staff")}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('master.staff.create') }}" class="@if(Request::segment(2) == 'staff' && Request::segment(3) == 'create') active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Add New Staff")}}</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- School Admin | Pricipal -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) != 'department') collapsed @endif" href="{{ route('master.department.index') }}">
            <i class="bi bi-people"></i>
            <span>{{ __("Position & Departments")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) != 'syllabus') collapsed @endif" data-bs-target="#syllabus-nav" data-bs-toggle="collapse" href="#">
                <i class="bi bi-journal-bookmark"></i>
                <span>{{ __("Syllabus")}}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="syllabus-nav" class="nav-content collapse @if(Request::segment(2) == 'syllabus' ) show @endif" data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('master.syllabus.index') }}" class="@if(Request::segment(2) == 'syllabus' && Request::segment(3) == null) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("All Syllabi")}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('master.syllabus.create') }}" class="@if(Request::segment(2) == 'syllabus' && Request::segment(3) == 'create') active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Add New Syllabus")}}</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) != 'curriculum') collapsed @endif" data-bs-target="#curriculum-nav" data-bs-toggle="collapse" href="#">
                <i class='bi bi-layout-text-window-reverse'></i>
                <span>{{ __("Curriculum")}}</span>
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="curriculum-nav" class="nav-content collapse @if(Request::segment(2) == 'curriculum' ) show @endif" data-bs-parent="#sidebar-nav">

                <li>
                    <a href="{{ route('master.curriculum.index') }}" class="@if(Request::segment(2) == 'curriculum' && Request::segment(3) == null) active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("All Curricula")}}</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('master.curriculum.create') }}" class="@if(Request::segment(2) == 'curriculum' && Request::segment(3) == 'create') active @endif">
                    <i class="bi bi-circle"></i><span>{{ __("Add New Curriculum")}}</span>
                    </a>
                </li>
            </ul>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) != 'grade') collapsed @endif " href="{{ route('master.grade.index') }}" href="{{ route('master.grade.index') }}">
            <i class="bi bi-tags"></i>
            <span>{{ __("Grades")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) != 'subject') collapsed @endif " href="{{ route('master.subject.index') }}">
            <i class="bi bi-tags"></i>
            <span>{{ __("Subject")}}</span>
            </a>
        </li>

        <!-- School Admin -->
        <li class="nav-item">
            <a class="nav-link @if(Request::segment(2) != 'subjecttype') collapsed @endif " href="{{ route('master.subjecttype.index') }}">
            <i class="bi bi-tags"></i>
            <span>{{ __("Subject Type")}}</span>
            </a>
        </li>

        
    </ul>
</aside>
<!-- End Sidebar-->