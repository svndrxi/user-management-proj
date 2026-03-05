<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LRA User Management System</title>
  @vite(['resources/css/app.css', 'resources/js/frontend/home.js'])
</head>
<body>

<div id="mainApp" class="app-wrapper">

  <!-- HEADER -->
  <header class="app-header">
    <div class="header-logo">
      <img src="{{ Vite::asset('resources/images/frontend/lra_logo.png') }}" alt="LRA Logo" onerror="this.style.display='none'">
      <div class="header-logo-text">
        <span class="org-name">Land Registration<br>Authority</span>
      </div>
    </div>
    <button class="btn-logout" onclick="document.getElementById('logoutForm').submit();">
      <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
      </svg>
      Log out
    </button>
  </header>

  <!-- LAYOUT -->
  <div class="layout">

    <!-- SIDEBAR -->
    <aside class="sidebar" id="sidebar">
      <div class="sidebar-toggle">
        <button id="menu-toggle">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
          </svg>
        </button>
      </div>
      <nav class="sidebar-nav">
        <div class="nav-item active" data-page="profilePage" data-label="Profile" onclick="navigate('profilePage')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span class="nav-label">Profile</span>
        </div>
      </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content" id="mainContent">

      <!-- PROFILE PAGE -->
      <section id="profilePage" class="page active">
        <h1 class="page-title">Profile Overview</h1>
        <div class="profile-card">
          <div class="profile-header">
            <div class="profile-avatar">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd"/>
              </svg>
            </div>
            <h2 class="profile-name">Doe, Jane F.</h2>
          </div>
          <div class="profile-divider"></div>
          <div class="profile-body">
            <p class="profile-section-title">Personal Information</p>
            <div class="profile-info-card">
              <div class="profile-info-grid">
                <div class="info-field">
                  <label>Username:</label>
                  <span class="info-value">j_doe01</span>
                </div>
                <div class="info-field">
                  <label>Office/Department/Division:</label>
                  <span class="info-value">Information and Communication Technology Division</span>
                </div>
                <div class="info-field">
                  <label>Email:</label>
                  <span class="info-value">j.doe@lra.gov.ph</span>
                </div>
                <div class="info-field">
                  <label>Account Role:</label>
                  <span class="info-value">User</span>
                </div>
                <div class="info-field">
                  <label>Employee ID:</label>
                  <span class="info-value">1234-5678</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>
  </div>
</div>

<!-- TOAST -->
<div class="toast-container" id="toastContainer"></div>

<form id="logoutForm" method="POST" action="{{ route('frontend.logout') }}" style="display:none;">
  @csrf
</form>

</body>
</html>