<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gerencial Eletrica Faria</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('./img/logoTransformador.png' )}}" type="image/x-icon">
    <!-- Custom styles -->
    <link rel="stylesheet" href="{{ asset('css/style.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/test.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/produto.css') }}">
    <link rel="stylesheet" href="{{ asset('css/os.css') }}">
    <link rel="preconnect" href="{{ asset('https://fonts.googleapis.com')}}">
    <link rel="preconnect" href="{{ asset('https://fonts.gstatic.com')}}" crossorigin>
    <link rel="stylesheet" href="{{ asset('https://fonts.googleapis.com/css2?family=SUSE:wght@100..800&display=swap')}}">
    <link rel="stylesheet" href="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css')}}" />
</head>
<body>
    <div class="layer"></div>
    <!-- ! Body -->
    <div class="page-flex">
        <!-- ! Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-start">
                <div class="sidebar-head">
                    <a href="/" class="logo-wrapper" title="Home">
                        <span class="sr-only">Home</span>
                        <img class="logo1" src="img/logoTransformador.png" alt="logo1">
                        <div class="logo-text">
                            <span class="logo-title">Eletrica</span>
                            <span class="logo-subtitle">FARIA</span>
                        </div>
                    </a>
                    <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                        <span class="sr-only">Toggle menu</span>
                        <span class="icon menu-toggle" aria-hidden="true"></span>
                    </button>
                </div>
                <div class="sidebar-body">
                      <ul class="sidebar-body-menu">
                          <li>
                              <a class="active" href="/">
                                  <span class="icon home" aria-hidden="true"></span>Dashboard
                              </a>
                          </li>
                          <li>
                              <a href="OrdemServiços">
                                  <span class="icon document" aria-hidden="true"></span>Ordem de Serviço
                              </a>
                          </li>
                          <li>
                              <a href="/clientes">
                                  <span class="icon user-3" aria-hidden="true"></span>Clientes
                              </a>
                          </li>
                          <li>
                            <a href="produtos">
                                <span class="icon folder" aria-hidden="true"></span>Produtos
                            </a>
                          </li>
                          <li>
                              <a class="show-cat-btn" href="##">
                                  <span class="icon image" aria-hidden="true"></span>Orçamentos
                              </a>
                          </li>
                          <li>
                              <a class="show-cat-btn" href="##">
                                  <span aria-hidden="true"></span>Funcionarios
                              </a>
                          </li>
                          <li>
                              <a href="comments.html">
                                  <span class="icon message" aria-hidden="true"></span>Comments
                              </a>
                              <span class="msg-counter">7</span>
                          </li>
                          <li>
                              <a class="show-cat-btn" href="##">
                                  <span class="icon category" aria-hidden="true"></span>Extensions
                              </a>
                          </li>
                      </ul>
                      <ul class="sidebar-body-menu">
                          <li>
                              <ul class="cat-sub-menu">
                              </ul>
                          </li>

                      </ul>
                </div>
            </div>
            <div class="sidebar-footer">
              <a href="##" class="sidebar-user">
                  <span class="sidebar-user-img">
                      <picture><source srcset="./img/avatar/avatar-illustrated-01.webp" type="image/webp"><img src="./img/avatar/avatar-illustrated-01.png" alt="User name"></picture>
                  </span>
                  <div class="sidebar-user-info">
                      <span class="sidebar-user__title">Nafisa Sh.</span>
                      <span class="sidebar-user__subtitle">Support manager</span>
                  </div>
              </a>
          </div>
          </aside>
          <div class="main-wrapper">
            <!-- ! Main nav -->
            <nav class="main-nav--bg">
                <div class="container main-nav">
                    <div class="main-nav-start">
                        <div class="search-wrapper">
                            <h1>M.A. DE FARIA ELÉTRICA </h1>
                        </div>
                    </div>
                    <div class="main-nav-end">
                        <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                            <span class="sr-only">Toggle menu</span>
                            <span class="icon menu-toggle--gray" aria-hidden="true"></span>
                        </button>
                        <div class="lang-switcher-wrapper">
                            <button class="lang-switcher transparent-btn" type="button">
                                EN
                                <i data-feather="chevron-down" aria-hidden="true"></i>
                            </button>
                            <ul class="lang-menu dropdown">
                                <li><a href="##">English</a></li>
                                <li><a href="##">French</a></li>
                                <li><a href="##">Uzbek</a></li>
                            </ul>
                        </div>
                        <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
                            <span class="sr-only">Switch theme</span>
                            <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
                            <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
                        </button>
                        <div class="notification-wrapper">
                            <button class="gray-circle-btn dropdown-btn" title="To messages" type="button">
                                <span class="sr-only">To messages</span>
                                <span class="icon notification active" aria-hidden="true"></span>
                            </button>
                            <ul class="users-item-dropdown notification-dropdown dropdown">
                                <li>
                                    <a href="##">
                                        <div class="notification-dropdown-icon info">
                                            <i data-feather="check"></i>
                                        </div>
                                        <div class="notification-dropdown-text">
                                            <span class="notification-dropdown__title">System just updated</span>
                                            <span class="notification-dropdown__subtitle">The system has been successfully upgraded. Read more
                                                here.
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="##">
                                        <div class="notification-dropdown-icon danger">
                                            <i data-feather="info" aria-hidden="true"></i>
                                        </div>
                                        <div class="notification-dropdown-text">
                                            <span class="notification-dropdown__title">The cache is full!</span>
                                            <span class="notification-dropdown__subtitle">Unnecessary caches take up a lot of memory space and
                                                interfere ...
                                            </span>
                                        </div>
                                    </a>
                                </li>
                                <li>
                                    <a href="##">
                                        <div class="notification-dropdown-icon info">
                                            <i data-feather="check" aria-hidden="true"></i>
                                        </div>
                                        <div class="notification-dropdown-text">
                                            <span class="notification-dropdown__title">New Subscriber here!</span>
                                            <span class="notification-dropdown__subtitle">A new subscriber has subscribed.</span>
                                        </div>
                                    </a>
                                </li>
                                <li><a class="link-to-page" href="##">Go to Notifications page</a></li>
                            </ul>
                        </div>
                        <div class="nav-user-wrapper">
                            <button href="##" class="nav-user-btn dropdown-btn" title="My profile" type="button">
                                <span class="sr-only">My profile</span>
                                <span class="nav-user-img">
                                    <picture>
                                        <source srcset="./img/avatar/avatar-illustrated-02.webp" type="image/webp">
                                        <img src="./img/avatar/avatar-illustrated-02.png" alt="User name">
                                    </picture>
                                </span>
                            </button>
                            <ul class="users-item-dropdown nav-user-dropdown dropdown">
                                <li>
                                    <a href="##">
                                        <i data-feather="user" aria-hidden="true"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="##">
                                        <i data-feather="settings" aria-hidden="true"></i>
                                        <span>Account settings</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="danger" href="##">
                                        <i data-feather="log-out" aria-hidden="true"></i>
                                        <span>Log out</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

          @yield('conteudo')

        </div>
    </div>

    <!-- Select2 library -->
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js') }}"></script>
    <!-- Chart library -->
    <script src="{{ asset('plugins/chart.min.js') }}"></script>
    <!-- Icons library -->
    <script src="{{ asset('plugins/feather.min.js') }}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('js/script.js') }}"></script>

</body>
</html>
