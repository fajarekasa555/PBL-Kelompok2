<div id="sidebar" class="sidebar">
  <div data-scrollbar="true" data-height="100%">

    <ul class="nav">
      <li class="nav-profile">
        <a href="javascript:;" data-toggle="nav-profile">
          <div class="cover with-shadow"></div>
          <div class="image">
            <img src="public/assets/img/user/user-13.jpg" alt="" />
          </div>
          <div class="info">
            <b class="caret pull-right"></b>
            <?php echo isset($user['username'])?htmlspecialchars($user['username']):''; ?>
            <small><?php echo isset($user['role_name'])?htmlspecialchars($user['role_name']):''; ?></small>
          </div>
        </a>
      </li>
      <li>
        <ul class="nav nav-profile">
          <li><a href="javascript:;"><i class="fa fa-cog"></i> Settings</a></li>
          <li><a href="javascript:;"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
          <li><a href="javascript:;"><i class="fa fa-question-circle"></i> Helps</a></li>
        </ul>
      </li>
    </ul>

    <ul class="nav">
      <li class="nav-header">Navigation</li>
      <li class="active">
        <a href="index.php?page=dashboard">
          <i class="fa fa-th-large"></i>
          <span>Dashboard</span>
        </a>
      </li>
      <li class="has-sub">
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-database"></i> 
          <span>Master</span>
        </a>
        <ul class="sub-menu">
          <li><a href="javascript:;">Menu 1.2</a></li>
          <li><a href="javascript:;">Menu 1.3</a></li>
        </ul>
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-cog"></i> 
          <span>Setting</span>
        </a>
        <ul class="sub-menu">
          <li class="has-sub">
            <a href="javascript:;">
              <b class="caret"></b>
              Menu 1.1
            </a>
            <ul class="sub-menu">
              <li class="has-sub">
                <a href="javascript:;">
                  <b class="caret"></b>
                  Menu 2.1
                </a>
                <ul class="sub-menu">
                  <li><a href="javascript:;">Menu 3.1</a></li>
                  <li><a href="javascript:;">Menu 3.2</a></li>
                </ul>
              </li>
              <li><a href="javascript:;">Menu 2.2</a></li>
              <li><a href="javascript:;">Menu 2.3</a></li>
            </ul>
          </li>
          <li><a href="javascript:;">Menu 1.2</a></li>
          <li><a href="javascript:;">Menu 1.3</a></li>
        </ul>
      </li>
      <li><a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify"><i class="fa fa-angle-double-left"></i></a></li>
    </ul>
  </div>
</div>
<div class="sidebar-bg"></div>
