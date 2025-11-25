<?php
$currentRoute = $_GET['route'] ?? 'dashboard';
?>

<style>
/* ================== SIDEBAR CLEAN & PROFESSIONAL ================== */

/* Sidebar Base */
#sidebar.sidebar {
    background: linear-gradient(180deg, #0a4275 0%, #001a33 100%) !important;
    box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
    width: 220px;
}

#sidebar .sidebar-bg {
    background: linear-gradient(180deg, #0a4275 0%, #001a33 100%) !important;
}

/* ================== REMOVE ALL LIST STYLES ================== */
#sidebar ul,
#sidebar ul li,
#sidebar .nav,
#sidebar .nav li,
#sidebar .sub-menu,
#sidebar .sub-menu li {
    list-style: none !important;
    list-style-type: none !important;
    list-style-image: none !important;
    list-style-position: outside !important;
    margin: 0 !important;
    padding-left: 0 !important;
}

#sidebar ul::before,
#sidebar ul::after,
#sidebar li::before,
#sidebar li::after {
    content: none !important;
    display: none !important;
}

/* ================== PROFILE SECTION - CLEAN ================== */
#sidebar .nav-profile {
    margin: 0;
    padding: 0;
}

#sidebar .nav-profile > a {
    background: rgba(0, 0, 0, 0.2) !important;
    padding: 1.5rem 1.25rem !important;
    display: block !important;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
    text-decoration: none;
}

#sidebar .nav-profile > a:hover {
    background: rgba(0, 0, 0, 0.3) !important;
}

#sidebar .nav-profile .cover {
    display: none !important;
}

#sidebar .nav-profile .image {
    width: 50px !important;
    height: 50px !important;
    border-radius: 50% !important;
    overflow: hidden;
    border: 2px solid rgba(100, 181, 246, 0.5);
    margin: 0 auto 0.75rem !important;
    display: block !important;
    float: none !important;
}

#sidebar .nav-profile .image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

#sidebar .nav-profile .info {
    text-align: center !important;
    color: white !important;
    display: block !important;
    clear: both;
    padding: 0 !important;
}

#sidebar .nav-profile .info b,
#sidebar .nav-profile .info > span:not(small) {
    display: block !important;
    font-size: 1rem !important;
    font-weight: 600 !important;
    color: white !important;
    margin-bottom: 0.25rem !important;
}

#sidebar .nav-profile .info small {
    display: block !important;
    font-size: 0.75rem !important;
    color: rgba(255, 255, 255, 0.6) !important;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

#sidebar .nav-profile .info .caret {
    display: none !important;
}

/* Remove dropdown profile menu if exists */
#sidebar .nav-profile .nav {
    display: none !important;
}

/* ================== NAV HEADER ================== */
#sidebar .nav-header {
    color: rgba(100, 181, 246, 0.8) !important;
    font-weight: 600 !important;
    font-size: 0.7rem !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    padding: 1.5rem 1.5rem 0.75rem !important;
    margin: 0 !important;
}

/* ================== MAIN MENU ITEMS ================== */
#sidebar .nav > li {
    position: relative;
    margin: 0 !important;
}

#sidebar .nav > li > a {
    color: rgba(255, 255, 255, 0.85) !important;
    padding: 0.9rem 1.5rem !important;
    display: flex !important;
    align-items: center !important;
    transition: all 0.3s ease !important;
    font-size: 0.9rem !important;
    border-left: 3px solid transparent;
}

#sidebar .nav > li > a > i {
    color: rgba(255, 255, 255, 0.7) !important;
    margin-right: 1rem !important;
    width: 20px !important;
    text-align: center !important;
    font-size: 1rem !important;
    transition: all 0.3s ease !important;
}

#sidebar .nav > li > a > span {
    flex: 1;
}

#sidebar .nav > li > a .caret {
    color: rgba(255, 255, 255, 0.5) !important;
    margin-left: auto !important;
    transition: all 0.3s ease !important;
    border: none !important;
    width: auto !important;
    height: auto !important;
}

#sidebar .nav > li > a .caret::before {
    content: '\f105' !important;
    font-family: 'Font Awesome 5 Free' !important;
    font-weight: 900 !important;
    font-size: 0.75rem !important;
}

#sidebar .nav > li.expand > a .caret::before {
    content: '\f107' !important;
}

/* Hover State */
#sidebar .nav > li > a:hover,
#sidebar .nav > li > a:focus {
    background: rgba(100, 181, 246, 0.1) !important;
    color: #64b5f6 !important;
    border-left-color: #64b5f6 !important;
}

#sidebar .nav > li > a:hover > i,
#sidebar .nav > li > a:focus > i {
    color: #64b5f6 !important;
}

/* Active State */
#sidebar .nav > li.active > a,
#sidebar .nav > li.active > a:hover,
#sidebar .nav > li.active > a:focus {
    background: rgba(100, 181, 246, 0.15) !important;
    color: #64b5f6 !important;
    font-weight: 600 !important;
    border-left-color: #64b5f6 !important;
}

#sidebar .nav > li.active > a > i {
    color: #64b5f6 !important;
}

/* ================== SUBMENU - CLEAN & ORGANIZED ================== */
#sidebar .nav > li.has-sub > .sub-menu {
    background: rgba(0, 0, 0, 0.2) !important;
    padding: 0.5rem 0 !important;
    margin: 0 !important;
    list-style: none !important;
    list-style-type: none !important;
}

#sidebar .nav > li.has-sub > .sub-menu > li {
    position: relative;
    margin: 0 !important;
    list-style: none !important;
    list-style-type: none !important;
}

#sidebar .nav > li.has-sub > .sub-menu > li::before {
    display: none !important;
    content: none !important;
}

#sidebar .nav > li.has-sub > .sub-menu > li > a {
    color: rgba(255, 255, 255, 0.75) !important;
    padding: 0.75rem 1.5rem 0.75rem 3.5rem !important;
    font-size: 0.85rem !important;
    transition: all 0.3s ease !important;
    display: block !important;
    border-left: 3px solid transparent;
    position: relative;
}

#sidebar .nav > li.has-sub > .sub-menu > li > a::before {
    content: '•';
    position: absolute;
    left: 2.75rem;
    color: rgba(255, 255, 255, 0.4);
    font-size: 1rem;
}

#sidebar .nav > li.has-sub > .sub-menu > li > a:hover,
#sidebar .nav > li.has-sub > .sub-menu > li > a:focus {
    background: rgba(100, 181, 246, 0.1) !important;
    color: #64b5f6 !important;
    border-left-color: transparent;
}

#sidebar .nav > li.has-sub > .sub-menu > li > a:hover::before,
#sidebar .nav > li.has-sub > .sub-menu > li > a:focus::before {
    color: #64b5f6;
}

#sidebar .nav > li.has-sub > .sub-menu > li.active > a {
    background: rgba(100, 181, 246, 0.15) !important;
    color: #64b5f6 !important;
    font-weight: 500 !important;
    border-left-color: #64b5f6 !important;
}

#sidebar .nav > li.has-sub > .sub-menu > li.active > a::before {
    color: #64b5f6 !important;
}

/* Expand State */
#sidebar .nav > li.has-sub.expand > a {
    background: rgba(100, 181, 246, 0.08) !important;
}

/* ================== SIDEBAR MINIFY BUTTON ================== */
#sidebar .sidebar-minify-btn {
    background: transparent !important;
    color: rgba(255, 255, 255, 0.7) !important;
    border-top: 1px solid rgba(255, 255, 255, 0.1) !important;
    padding: 1rem !important;
    transition: all 0.3s ease !important;
    text-align: center !important;
    margin-top: 1rem !important;
}

#sidebar .sidebar-minify-btn:hover {
    background: rgba(100, 181, 246, 0.1) !important;
    color: #64b5f6 !important;
}

#sidebar .sidebar-minify-btn i {
    transition: transform 0.3s ease;
}

/* ================== SCROLLBAR ================== */
#sidebar .slimScrollDiv::-webkit-scrollbar {
    width: 5px;
}

#sidebar .slimScrollDiv::-webkit-scrollbar-track {
    background: transparent;
}

#sidebar .slimScrollDiv::-webkit-scrollbar-thumb {
    background: rgba(100, 181, 246, 0.3);
    border-radius: 4px;
}

#sidebar .slimScrollDiv::-webkit-scrollbar-thumb:hover {
    background: rgba(100, 181, 246, 0.5);
}

/* ================== RESPONSIVE ================== */
@media (max-width: 991px) {
    #sidebar {
        margin-left: -220px;
    }
    
    #content {
        margin-left: 0 !important;
    }
    
    .page-sidebar-toggled #sidebar {
        margin-left: 0;
    }
}

/* ================== MINIFIED SIDEBAR STATE ================== */
.page-sidebar-minified #sidebar {
    width: 60px !important;
}

.page-sidebar-minified #content {
    margin-left: 60px !important;
}

.page-sidebar-minified #sidebar .nav > li > a > span,
.page-sidebar-minified #sidebar .nav > li > a .caret,
.page-sidebar-minified #sidebar .nav-profile .info,
.page-sidebar-minified #sidebar .nav-header {
    display: none !important;
}

.page-sidebar-minified #sidebar .nav > li > a {
    padding: 1rem !important;
    justify-content: center !important;
}

.page-sidebar-minified #sidebar .nav > li > a > i {
    margin-right: 0 !important;
    font-size: 1.2rem !important;
}

.page-sidebar-minified #sidebar .nav-profile .image {
    margin: 1rem auto !important;
}
</style>

<div id="sidebar" class="sidebar">
  <div data-scrollbar="true" data-height="100%">
    <ul class="nav-header">Navigation</ul>
    <ul class="nav">
      <!-- Dashboard -->
      <li class="<?= $currentRoute === 'dashboard' ? 'active' : '' ?>">
        <a href="<?= $route->base_url('dashboard') ?>">
          <i class="fa fa-th-large"></i>
          <span>Dashboard</span>
        </a>
      </li>

      <li class="<?= $currentRoute === 'lab_information' ? 'active' : '' ?>">
        <a href="<?= $route->base_url('lab_information') ?>">
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
      <li class="has-sub <?= in_array($currentRoute, ['facilities', 'lab-courses', 'research-focuses', 'activities', 'projects', 'vision', 'mission']) ? 'active expand' : '' ?>">
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
          <li class="<?= $currentRoute === 'projects' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('projects') ?>">Project</a>
          </li>
          <li class="<?= $currentRoute === 'vision' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('vision') ?>">Visi</a>
          </li>
          <li class="<?= $currentRoute === 'mission' ? 'active' : '' ?>">
            <a href="<?= $route->base_url('mission') ?>">Misi</a>
          </li>
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