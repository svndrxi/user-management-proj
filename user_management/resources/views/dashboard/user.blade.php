<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="app-base-url" content="{{ url('/') }}" />
  <meta name="auth-employee-id" content="{{ auth()->user()?->employee_id ?? '' }}" />
  <title>LRA User Management System</title>
  @vite(['resources/css/app.css', 'resources/js/frontend/home.js'])
</head>
<body>
@php
  $authUser = auth()->user();
  $middleInitial = $authUser?->middle_name ? strtoupper(substr($authUser->middle_name, 0, 1)).'.' : '';
  $fullName = trim(($authUser?->last_name ?? '').', '.($authUser?->first_name ?? '').' '.$middleInitial);
@endphp

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
        <div class="nav-item" data-page="profilePage" data-label="Profile" onclick="navigate('profilePage')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
          </svg>
          <span class="nav-label">Profile</span>
        </div>
        <div class="nav-item active" data-page="payslipManagementPage" data-label="Payslip Management" onclick="navigate('payslipManagementPage')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <span class="nav-label">My Payslips</span>
        </div>
      </nav>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="main-content" id="mainContent">

      <!-- PROFILE PAGE -->
      <section id="profilePage" class="page">
        <h1 class="page-title">Profile Overview</h1>
        <div class="profile-card">
          <div class="profile-header">
            <div class="profile-avatar">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0021.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 003.065 7.097A9.716 9.716 0 0012 21.75a9.716 9.716 0 006.685-2.653zm-12.54-1.285A7.486 7.486 0 0112 15a7.486 7.486 0 015.855 2.812A8.224 8.224 0 0112 20.25a8.224 8.224 0 01-5.855-2.438zM15.75 9a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" clip-rule="evenodd"/>
              </svg>
            </div>
            <div class="profile-identity">
              <h2 class="profile-name">{{ $fullName !== ',' ? $fullName : 'N/A' }}</h2>
              <p class="profile-role">User</p>
            </div>
          </div>
          <div class="profile-divider"></div>
          <div class="profile-body">
            <p class="profile-section-title">Personal Information</p>
            <div class="profile-info-card">
              <div class="profile-info-grid">
                <div class="info-field">
                  <label>Username:</label>
                  <span class="info-value">{{ $authUser?->username ?? 'N/A' }}</span>
                </div>
                <div class="info-field">
                  <label>Office/Department/Division:</label>
                  <span class="info-value">{{ $authUser?->office?->name ?? 'N/A' }}</span>
                </div>
                <div class="info-field">
                  <label>Email:</label>
                  <span class="info-value">{{ $authUser?->email ?? 'N/A' }}</span>
                </div>
                <div class="info-field">
                  <label>Employee ID:</label>
                  <span class="info-value">{{ $authUser?->employee_id ?? 'N/A' }}</span>
                </div>
                <div class="info-field">
                  <label>Last Visited:</label>
                  <span class="info-value" id="userLastVisited">-</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- MY PAYSLIPS PAGE -->
      <section id="payslipManagementPage" class="page active">
        <h1 class="page-title">My Payslips</h1>

        <div id="payslipManagementMain" class="user-payslip-shell">
          <div class="user-payslip-toolbar">
            <div class="user-search-box">
              <input
                type="text"
                id="payslipSearch"
                placeholder="Search By Month/Year"
                oninput="payslipSearchQuery=this.value; payslipPage=1; renderPayslips();"
              />
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>

            <div class="filter-wrapper user-filter-wrap user-filter-actions">
              <button class="btn-clear-filters" id="payslipClearFiltersBtn" onclick="clearPayslipFilters()" style="display:none;">
                Clear
              </button>
              <button class="btn-filter" id="payslipMonthYearFilterBtn" onclick="togglePayslipMonthYearFilter()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span id="payslipMonthYearFilterLabel">Month &amp; Year</span>
              </button>
              <div id="payslipMonthYearDropdown" class="filter-dropdown"></div>
            </div>
          </div>

          <div id="userPayslipList" class="user-payslip-list"></div>
          <div class="pagination" id="userPayslipPagination"></div>
        </div>
      </section>

    </main>
  </div>
</div>

<!-- VIEW PAYSLIP MODAL -->
<div class="modal-overlay" id="viewPayslipModal">
  <div class="modal modal-payslip-view">
    <div class="modal-header"><h3 class="modal-title">Payslip</h3></div>
    <div class="modal-body payslip-view-body">
      <div class="payslip-preview-shell">
        <iframe id="viewPayslipFrame" class="payslip-preview-iframe" title="Payslip Preview"></iframe>
      </div>
    </div>
    <div class="modal-footer payslip-view-footer">
      <div style="display: flex; gap: 10px;">
        <button class="btn-view-payslip-action" onclick="printViewedPayslip()">Print</button>
        <button class="btn-view-payslip-action" onclick="downloadViewedPayslipPdf()">Download PDF</button>
      </div>
      <button class="btn-save-view" onclick="closeModal('viewPayslipModal')">Back</button>
    </div>
  </div>
</div>

<!-- TOAST -->
<div class="toast-container" id="toastContainer"></div>

<form id="logoutForm" method="POST" action="{{ route('frontend.logout') }}" style="display:none;">
  @csrf
</form>

</body>
</html>
