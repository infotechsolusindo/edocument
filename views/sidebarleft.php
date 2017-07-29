      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">

              	  <p class="centered"><a href="profile.html"><img src="public/assets/img/ui-sam.jpg" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['nama']; ?></h5>
                  <h6 class="centered">DEPT: <?php echo $_SESSION['departemen']->name; ?></h6>
                  <li class="mt">
                  <a class="btn" href="?url=auth/profile/changepassword"><b>Ubah Password</b></a>
                  <a class="active" href="<?php echo SITE_ROOT; ?>">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
                    <?php echo $data['modules']; ?>
                  </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
