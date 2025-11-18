<?php
$currentRoute = $_GET['route'] ?? 'dashboard';
?>

<div id="sidebar" class="sidebar sidebar-transparent">
  <div data-scrollbar="true" data-height="100%">

    <ul class="nav">
      <li class="nav-profile">
        <a href="javascript:;" data-toggle="nav-profile">
          <div class="cover with-shadow"></div>
          <div class="image">
            <img src="<?= $route->base_url('public/assets/img/user/user-13.jpg') ?>" alt="User Profile" />
          </div>
          <div class="info">
            <!-- <b class="caret pull-right"></b> -->
            <?= isset($_SESSION['user']['username']) ? htmlspecialchars($_SESSION['user']['username']) : '' ?>
            <small><?= isset($_SESSION['user']['role_name']) ? htmlspecialchars($_SESSION['user']['role_name']) : '' ?></small>
          </div>
        </a>
      </li>

      <!-- <li>
        <ul class="nav nav-profile">
          <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
          <li><a href="#"><i class="fa fa-pencil-alt"></i> Send Feedback</a></li>
          <li><a href="#"><i class="fa fa-question-circle"></i> Help</a></li>
        </ul>
      </li> -->
    </ul>

    <ul class="nav">
      <li class="nav-header">Navigation</li>

      <!-- Dashboard -->
      <li class="<?= $currentRoute === 'dashboard' ? 'active' : '' ?>">
        <a href="<?= $route->base_url('dashboard') ?>">
          <i class="fa fa-th-large"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="<?= $currentRoute === 'informasi' ? 'active' : '' ?>">
        <a href="">
          <i class="fa fa-home"></i>
          <span>Informasi Lab</span>
        </a>
      </li>

      <li class="has-sub <?= in_array($currentRoute, ['publications', 'members', 'social_media', 'educations', 'experties', 'certifications', 'courses']) ? 'active expand' : '' ?>">
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-user"></i>
          <span>Anggota Lab</span>
        </a>
        <ul class="sub-menu">
          <li class="<?= $currentRoute === 'members' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('members') ?>">Anggota</a>
          </li>
          <li class="<?= $currentRoute === 'social_media' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('social_media') ?>">Sosial Media</a>
          </li>
          <li class="<?= $currentRoute === 'educations' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('educations') ?>">Pendidikan</a>
          </li>
          <li class="<?= $currentRoute === 'certifications' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('certifications') ?>">Sertifikasi</a>
          </li>
          <li class="<?= $currentRoute === 'courses' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('courses') ?>">Mata Kuliah</a>
          </li>
          <li class="<?= $currentRoute === 'publications' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('publications') ?>">Publikasi</a>
          </li>
          <li class="<?= $currentRoute === 'experties' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('experties') ?>">Keahlian</a>
          </li>
        </ul>
      </li>

      <!-- Master -->
      <li class="has-sub <?= in_array($currentRoute, ['facilities', 'lab-courses', 'research-focus', 'activities', 'projects']) ? 'active expand' : '' ?>">
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-database"></i>
          <span>Content</span>
        </a>
        <ul class="sub-menu">
          <li><a href="">Fasilitas</a></li>
          <li class="<?= $currentRoute === 'lab-courses' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('lab-courses') ?>">Mata Kuliah</a>
          </li>
          <li class="<?= $currentRoute === 'research-focuses' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('research-focuses') ?>">Fokus Riset</a>
          </li>
          <li class="<?= $currentRoute === 'activities' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('activities') ?>">Kegiatan</a>
          </li>
          <li><a href="#">Proyek</a></li>
        </ul>
      </li>

      <!-- User Management -->
      <li class="has-sub <?= in_array($currentRoute, ['roles', 'users']) ? 'active expand' : '' ?>">
        <a href="javascript:;">
          <b class="caret"></b>
          <i class="fa fa-user-cog"></i>
          <span>User Management</span>
        </a>
        <ul class="sub-menu">
          <li class="<?= $currentRoute === 'users' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('users') ?>">Users</a>
          </li>
          <li class="<?= $currentRoute === 'roles' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('roles') ?>">Roles</a>
          </li>
        </ul>
      </li>


      <!-- Minify button -->
      <li>
        <a href="javascript:;" class="sidebar-minify-btn" data-click="sidebar-minify">
          <i class="fa fa-angle-double-left"></i>
        </a>
      </li>
    </ul>
  </div>
</div>
<div class="sidebar-bg"></div>
