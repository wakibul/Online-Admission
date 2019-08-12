<div class="header py-4">
          <div class="container">
            <div class="d-flex">
              <a class="header-brand" href="./index.html">
                <img src="./demo/brand/tabler.svg" class="header-brand-img" alt="tabler logo">
              </a>
              <div class="d-flex order-lg-2 ml-auto">
               
                
                <div class="dropdown">
                  <a href="#" class="nav-link pr-0 leading-none" data-toggle="dropdown">
                    <span class="avatar" style="background-image: url(./demo/faces/female/25.jpg)"></span>
                    <span class="ml-2 d-none d-lg-block">
                      <span class="text-default"><?php echo $_SESSION['username'];?></span>
                      <small class="text-muted d-block mt-1"><?php echo $_SESSION['UserGrp'];?></small>
                    </span>
                  </a>
                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                    <!-- <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-user"></i> Profile
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-settings"></i> Settings
                    </a>
                    <a class="dropdown-item" href="#">
                      <span class="float-right"><span class="badge badge-primary">6</span></span>
                      <i class="dropdown-icon fe fe-mail"></i> Inbox
                    </a>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-send"></i> Message
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">
                      <i class="dropdown-icon fe fe-help-circle"></i> Need help?
                    </a> -->
                    <a class="dropdown-item" href="logout">
                      <i class="dropdown-icon fe fe-log-out"></i> Sign out
                    </a>
                  </div>
                </div>
              </div>
              <a href="#" class="header-toggler d-lg-none ml-3 ml-lg-0" data-toggle="collapse" data-target="#headerMenuCollapse">
                <span class="header-toggler-icon"></span>
              </a>
            </div>
          </div>
        </div>
        <div class="header collapse d-lg-flex p-0" id="headerMenuCollapse">
          <div class="container">
            <div class="row align-items-center">
             
              <div class="col-lg order-lg-first">
                <ul class="nav nav-tabs border-0 flex-column flex-lg-row">
                  <li class="nav-item">
                    <a href="./index.html" class="nav-link active"><i class="fe fe-home"></i> Home</a>
                  </li>
                  <li class="nav-item">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-box"></i> Interface</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./cards.html" class="dropdown-item ">Cards design</a>
                      <a href="./charts.html" class="dropdown-item ">Charts</a>
                      <a href="./pricing-cards.html" class="dropdown-item ">Pricing cards</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-calendar"></i> Components</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./maps.html" class="dropdown-item ">Maps</a>
                      <a href="./icons.html" class="dropdown-item ">Icons</a>
                      <a href="./store.html" class="dropdown-item ">Store</a>
                      <a href="./blog.html" class="dropdown-item ">Blog</a>
                      <a href="./carousel.html" class="dropdown-item ">Carousel</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="javascript:void(0)" class="nav-link" data-toggle="dropdown"><i class="fe fe-file"></i> Pages</a>
                    <div class="dropdown-menu dropdown-menu-arrow">
                      <a href="./profile.html" class="dropdown-item ">Profile</a>
                      <a href="./login.html" class="dropdown-item ">Login</a>
                      <a href="./register.html" class="dropdown-item ">Register</a>
                      <a href="./forgot-password.html" class="dropdown-item ">Forgot password</a>
                      <a href="./400.html" class="dropdown-item ">400 error</a>
                      <a href="./401.html" class="dropdown-item ">401 error</a>
                      <a href="./403.html" class="dropdown-item ">403 error</a>
                      <a href="./404.html" class="dropdown-item ">404 error</a>
                      <a href="./500.html" class="dropdown-item ">500 error</a>
                      <a href="./503.html" class="dropdown-item ">503 error</a>
                      <a href="./email.html" class="dropdown-item ">Email</a>
                      <a href="./empty.html" class="dropdown-item ">Empty page</a>
                      <a href="./rtl.html" class="dropdown-item ">RTL mode</a>
                    </div>
                  </li>
                  <li class="nav-item dropdown">
                    <a href="./form-elements.html" class="nav-link"><i class="fe fe-check-square"></i> Forms</a>
                  </li>
                  <li class="nav-item">
                    <a href="./gallery.html" class="nav-link"><i class="fe fe-image"></i> Gallery</a>
                  </li>
                  <li class="nav-item">
                    <a href="./docs/index.html" class="nav-link"><i class="fe fe-file-text"></i> Documentation</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>