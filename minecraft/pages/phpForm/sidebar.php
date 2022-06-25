  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Marketing Tool</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Minecraft</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

          <!-- 매장관리 -->
          <!--메뉴오픈한걸default하려면 <li class="nav-item menu-open"> -->
          <!--파랑색 하이라이트뜨게하는거 <a href="#" class="nav-link active"> -->
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="nav-icon fas fa-table"></i>
              <p>
                매장 관리
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../mineShop/index.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>매장 목록</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../mineShop/new.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>매장 등록</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../mineShop/edit.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>매장 수정</p>
                </a>
              </li>
            </ul>
          </li>

          <!-- 키워드 관리 -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                키워드 관리
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../mineSearch/index1.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>키워드 목록</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../mineSearch/new.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>키워드 등록</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../mineSearch/edit.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>키워드 수정</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
                <a href="../mineStat/rankLine1.php" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>통계</p>
                </a>
          </li>
          <li class="nav-item">
                <a href="../mineStat/keywordScore.php" class="nav-link">
                  <i class="nav-icon fas fa-chart-pie"></i>
                  <p>키워드점수</p>
                </a>
          </li>
         
    

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>