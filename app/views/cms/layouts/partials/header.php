<div id="header" class="header navbar-default">
  <div class="navbar-header">
    <a href="<?= $route->base_url('dashboard') ?>" class="navbar-brand">
      <b>Content</b> Management System
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