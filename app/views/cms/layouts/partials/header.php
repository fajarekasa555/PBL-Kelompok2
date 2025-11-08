<div id="header" class="header navbar-default">
  <div class="navbar-header">
    <a href="index.html" class="navbar-brand"><span class="navbar-logo"></span> <b>Content</b> Management System</a>
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
        <a href="index.php?page=auth&action=logout" class="dropdown-item">Log Out</a>
      </div>
    </li>
  </ul>
</div>