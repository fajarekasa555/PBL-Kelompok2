<div id="header" class="header navbar-default">
  <div class="navbar-header">
    <a class="navbar-brand d-flex align-items-center gap-2" href="<?= $route->base_url('dashboard') ?>">
        <img 
            src="public/assets/img/logo/logo-icon.png" 
            alt="DataLab Logo" 
            width="36" 
            height="36"
            style="object-fit: contain;"
        >
        <span class="font-weight-regular" style="font-size: 1.2rem; letter-spacing: .5px;">
            DataTech <b>CMS</b>
        </span>
    </a>
  </div>
  
  <ul class="navbar-nav navbar-right">
    <li class="dropdown navbar-user">
      <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
        <div class="image image-icon bg-black text-grey-darker">
          <i class="fa fa-user"></i>
        </div>
        <span class="d-none d-md-inline"><?php echo isset($user['username'])?htmlspecialchars($user['username']):''; ?></span> <b class="caret"></b>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="<?= $route->base_url('logout') ?>" class="dropdown-item">Log Out</a>
      </div>
    </li>
  </ul>
</div>