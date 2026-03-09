<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta name="app-base-url" content="{{ url('/') }}" />
  <title> LRA User Management System</title>
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
        <div class="nav-item active" data-page="userManagementPage" data-label="User Management" onclick="navigate('userManagementPage')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/>
          </svg>
          <span class="nav-label">User Management</span>
        </div>
        <div class="nav-item" data-page="auditLogsPage" data-label="Audit Logs" onclick="navigate('auditLogsPage')">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
          </svg>
          <span class="nav-label">Activity Logs</span>
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
              <p class="profile-role">Admin</p>
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
                  <span class="info-value" id="adminLastVisited">-</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- USER MANAGEMENT PAGE -->
      <section id="userManagementPage" class="page active">

        <!-- ── MAIN USER LIST ── -->
        <div id="userManagementMain">
          <h1 class="page-title">User Management</h1>
          <div class="toolbar">
            <div class="search-box">
              <input type="text" id="userSearch" placeholder="Enter Name or Employee ID..."
                oninput="searchQuery=this.value; currentPage=1; renderUsers();" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
            <div class="dropdown">
              <button class="btn-sort" onclick="toggleDropdown('sortMenu')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                </svg>
                Sort by&nbsp;<span id="sortLabel"></span>
              </button>
              <ul class="dropdown-menu" id="sortMenu">
                <li onclick="setSortField('empId','Employee ID')">Employee ID</li>
                <li onclick="setSortField('lastName','Name')">Name</li>
                <li onclick="setSortField('role','Role')">Role</li>
                <li onclick="setSortField('email','Email')">Email</li>
              </ul>
            </div>
            <div class="dropdown">
              <button class="btn-filter" onclick="toggleDropdown('filterMenu')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-5.414 5.414A1 1 0 0015 12.828V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-8.172a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z"/>
                </svg>
                Filter by&nbsp;<span id="filterLabel">All</span>
              </button>
              <ul class="dropdown-menu" id="filterMenu">
                <li onclick="setFilterRole('all','All')">All</li>
                <li onclick="setFilterRole('admin','Admin')">Admin</li>
                <li onclick="setFilterRole('system admin','System Admin')">System Admin</li>
                <li onclick="setFilterRole('user','User')">User</li>
              </ul>
            </div>
            <div class="toolbar-right" style="display:flex;gap:10px;align-items:center;">
              <div id="userBulkActions" class="bulk-actions" style="display:none;">
                <span class="bulk-count" id="userSelectedCount">0 selected</span>
                <button class="btn-bulk-clear" onclick="clearUserSelection()">Clear</button>
                <button class="btn-bulk-archive" onclick="bulkArchiveSelectedUsers()">Archive</button>
              </div>
               <!-- New User button -->
              <button class="btn-new-user" onclick="openAddModal()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                </svg>
                New User
              </button>
              <!-- Archive List button -->
              <button class="btn-archive-list" onclick="openArchiveList()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
                Archive List
              </button>
            </div>
          </div>
          <div class="table-container">
            <table class="data-table">
              <thead>
                <tr>
                  <th style="width:44px;">
                    <input type="checkbox" id="userSelectAllCheckbox" onchange="toggleSelectAllVisibleUsers(this.checked)" />
                  </th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Status</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="userTableBody"></tbody>
            </table>
          </div>
          <div class="pagination" id="userPagination"></div>
        </div>

        <!-- ── ARCHIVE LIST PANEL (shown in-place when Archive List is clicked) ── -->
        <div id="archiveListPanel">
          <h1 class="page-title">Archived Users</h1>
          <div class="toolbar">
            <div class="search-box">
              <input type="text" id="archiveSearch" placeholder="Enter Name or Employee ID..."
                oninput="archivePage=1; renderArchive();" />
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
              </svg>
            </div>
            <div class="dropdown">
              <button class="btn-sort" onclick="toggleDropdown('archiveSortMenu')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/>
                </svg>
                Sort by&nbsp;<span id="archiveSortLabel"></span>
              </button>
              <ul class="dropdown-menu" id="archiveSortMenu">
                <li onclick="setArchiveSortField('empId','Employee ID')">Employee ID</li>
                <li onclick="setArchiveSortField('lastName','Name')">Name</li>
                <li onclick="setArchiveSortField('role','Role')">Role</li>
                <li onclick="setArchiveSortField('email','Email')">Email</li>
              </ul>
            </div>
            <div class="dropdown">
              <button class="btn-filter" onclick="toggleDropdown('archiveFilterMenu')">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-5.414 5.414A1 1 0 0015 12.828V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-8.172a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z"/>
                </svg>
                Filter by&nbsp;<span id="archiveFilterLabel">All</span>
              </button>
              <ul class="dropdown-menu" id="archiveFilterMenu">
                <li onclick="setArchiveFilterRole('all','All')">All</li>
                <li onclick="setArchiveFilterRole('admin','Admin')">Admin</li>
                <li onclick="setArchiveFilterRole('system admin','System Admin')">System Admin</li>
                <li onclick="setArchiveFilterRole('user','User')">User</li>
              </ul>
            </div>
            <div class="toolbar-right" style="display:flex;gap:10px;align-items:center;">
              <div id="archiveBulkActions" class="bulk-actions" style="display:none;">
                <span class="bulk-count" id="archiveSelectedCount">0 selected</span>
                <button class="btn-bulk-clear" onclick="clearArchivedSelection()">Clear Selection</button>
                <button class="btn-bulk-unarchive" onclick="bulkUnarchiveSelectedUsers()">Unarchive Selected</button>
              </div>
              <button class="btn-back" onclick="closeArchiveList()">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11 17l-5-5m0 0l5-5m-5 5h12"/>
                </svg>
                Back
              </button>
            </div>
          </div>
          <div class="table-container">
            <table class="data-table">
              <thead>
                <tr>
                  <th style="width:44px;">
                    <input type="checkbox" id="archiveSelectAllCheckbox" onchange="toggleSelectAllVisibleArchived(this.checked)" />
                  </th>
                  <th>Employee ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Username</th>
                  <th>Role</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody id="archiveTableBody"></tbody>
            </table>
          </div>
          <div class="pagination" id="archivePagination"></div>
        </div>

      </section>

      <!-- AUDIT LOGS PAGE -->
      <section id="auditLogsPage" class="page">
        <h1 class="page-title">Activity Logs</h1>
        <div class="audit-toolbar">
          <div class="search-box">
            <input type="text" id="auditSearch" placeholder="Enter Name or Employee ID..."
              oninput="auditPage=1; renderAudit();" />
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
          </div>
          <span class="date-label">Start Date</span>
          <div class="date-input-wrap">
            <input type="date" id="startDate" onchange="auditPage=1; renderAudit();" />
          </div>
          <span class="date-label">End Date</span>
          <div class="date-input-wrap">
            <input type="date" id="endDate" onchange="auditPage=1; renderAudit();" />
          </div>
          <input type="hidden" id="auditFilterRole" value="all" />
          <div class="dropdown">
            <button class="btn-filter" onclick="toggleDropdown('auditFilterMenu')">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707l-5.414 5.414A1 1 0 0015 12.828V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-8.172a1 1 0 00-.293-.707L3.293 6.707A1 1 0 013 6V4z"/>
              </svg>
              Filter By&nbsp;<span id="auditFilterLabel">All</span>
            </button>
            <ul class="dropdown-menu" id="auditFilterMenu">
              <li onclick="setAuditFilter('all','All')">All</li>
              <li onclick="setAuditFilter('admin','Admin')">Admin</li>
              <li onclick="setAuditFilter('user','User')">User</li>
            </ul>
          </div>
        </div>
        <div class="table-container">
          <table class="data-table">
            <thead>
              <tr>
                <th>Employee ID</th>
                <th>Name</th>
                <th>Role</th>
                <th>Timestamp</th>
                <th>Description</th>
              </tr>
            </thead>
            <tbody id="auditTableBody"></tbody>
          </table>
        </div>
        <div class="pagination" id="auditPagination"></div>
      </section>

    </main>
  </div>
</div>

<!-- ADD USER MODAL -->
<div class="modal-overlay" id="addUserModal">
  <div class="modal modal-wide">
    <div class="modal-header"><h3 class="modal-title">Add User</h3></div>
    <div class="modal-body">
      <form id="addUserForm" onsubmit="return false;">
        <div class="form-grid">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" id="addFirstName" placeholder="First Name" />
          </div>
          <div class="form-group">
            <label>Middle Name</label>
            <input type="text" id="addMiddleName" placeholder="Middle Name" />
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" id="addLastName" placeholder="Last Name" />
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" id="addEmail" placeholder="Email" />
          </div>
          <div class="form-group full-width">
            <label>Employee ID</label>
            <input type="text" id="addEmpId" placeholder="Employee ID" />
          </div>
          <div class="form-group full-width">
            <label>Username</label>
            <input type="text" id="addUsername" placeholder="Username" />
          </div>
          <div class="form-group full-width">
            <label>Password</label>
            <div class="password-row">
              <input type="text" id="addPassword" placeholder="Password" class="pwd-input" />
              <button type="button" class="btn-generate" onclick="generatePassword()">Generate Password</button>
            </div>
          </div>
          <div class="form-group full-width">
            <label>Designation / Position</label>
            <select id="addDesignation">
              <option value="">Select Designation/Position</option>
              <option value="IT Officer III">IT Officer III</option>
              <option value="IT Officer II">IT Officer II</option>
              <option value="Administrative Officer">Administrative Officer</option>
              <option value="Records Officer">Records Officer</option>
              <option value="Clerk III">Clerk III</option>
              <option value="Clerk II">Clerk II</option>
              <option value="Division Chief">Division Chief</option>
              <option value="Stenographer">Stenographer</option>
              <option value="Programmer III">Programmer III</option>
              <option value="Accountant">Accountant</option>
              <option value="Paralegal">Paralegal</option>
              <option value="Driver">Driver</option>
            </select>
          </div>
          <div class="form-group full-width">
            <label>Office / Department / Division</label>
            <select id="addOffice">
              <option value="">Select Office/Department/Division</option>
              <option>Information and Communications Technology Division</option>
              <option>Administrative Division</option>
              <option>Finance Division</option>
              <option>Legal Division</option>
              <option>Records Management Division</option>
            </select>
          </div>
          <div class="form-group full-width">
            <label>Account Role</label>
            <select id="addRole">
              <option value="">Select Account Role</option>
              <option value="User">User</option>
              <option value="Admin">Admin</option>
              <option value="System Admin">System Admin</option>
            </select>
          </div>
        </div>
      </form>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal('addUserModal')">Cancel</button>
      <button id="addUserSaveBtn" class="btn-create" onclick="saveAddUser()">Create Account</button>
    </div>
  </div>
</div>

<!-- EDIT USER MODAL -->
<div class="modal-overlay" id="editUserModal">
  <div class="modal modal-wide">
    <div class="modal-header"><h3 class="modal-title">Edit Profile</h3></div>
    <div class="modal-body">
      <div class="form-grid">
        <div class="form-group">
          <label>First Name</label>
          <input type="text" id="editFirstName" placeholder="First Name" />
        </div>
        <div class="form-group">
          <label>Middle Name</label>
          <input type="text" id="editMiddleName" placeholder="Middle Name" />
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" id="editLastName" placeholder="Last Name" />
        </div>
        <div class="form-group">
          <label>Email</label>
          <input type="email" id="editEmail" placeholder="Email" />
        </div>
        <div class="form-group full-width">
          <label>Employee ID</label>
          <input type="text" id="editEmpId" readonly style="opacity:0.7;cursor:not-allowed;" />
        </div>
        <div class="form-group full-width">
          <label>Username</label>
          <input type="text" id="editUsername" placeholder="Username" />
        </div>
        <div class="form-group full-width">
          <label>Designation / Position</label>
          <select id="editDesignation">
            <option value="">Select Designation/Position</option>
            <option value="IT Officer III">IT Officer III</option>
            <option value="IT Officer II">IT Officer II</option>
            <option value="Administrative Officer">Administrative Officer</option>
            <option value="Records Officer">Records Officer</option>
            <option value="Clerk III">Clerk III</option>
            <option value="Clerk II">Clerk II</option>
            <option value="Division Chief">Division Chief</option>
            <option value="Stenographer">Stenographer</option>
            <option value="Programmer III">Programmer III</option>
            <option value="Accountant">Accountant</option>
            <option value="Paralegal">Paralegal</option>
            <option value="Driver">Driver</option>
          </select>
        </div>
        <div class="form-group full-width">
          <label>Office / Department / Division</label>
          <select id="editOffice">
            <option value="">Select</option>
            <option>Information and Communications Technology Division</option>
            <option>Administrative Division</option>
            <option>Finance Division</option>
            <option>Legal Division</option>
            <option>Records Management Division</option>
          </select>
        </div>
        <div class="form-group full-width">
          <label>Account Role</label>
          <select id="editRole">
            <option value="User">User</option>
            <option value="Admin">Admin</option>
            <option value="System Admin">System Admin</option>
          </select>
        </div>
        <div class="form-group full-width">
          <label>Status</label>
          <select id="editStatus">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
          </select>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn-cancel" onclick="closeModal('editUserModal')">Cancel</button>
      <button id="editUserSaveBtn" class="btn-save" onclick="saveEditUser()">Save</button>
    </div>
  </div>
</div>

<!-- INFO / VIEW MODAL -->
<div class="modal-overlay" id="infoModal">
  <div class="modal modal-wide">
    <div class="modal-header"><h3 class="modal-title">Information Overview</h3></div>
    <div class="modal-body">
      <div class="info-grid">
        <div class="info-field-view">
          <label>First Name</label>
          <div class="field-val" id="infoFirstName"></div>
        </div>
        <div class="info-field-view">
          <label>Middle Name</label>
          <div class="field-val" id="infoMiddleName"></div>
        </div>
        <div class="info-field-view">
          <label>Last Name</label>
          <div class="field-val" id="infoLastName"></div>
        </div>
        <div class="info-field-view">
          <label>Email</label>
          <div class="field-val" id="infoEmail"></div>
        </div>
        <div class="info-field-view">
          <label>Employee ID</label>
          <div class="field-val" id="infoEmpId"></div>
        </div>
        <div class="info-field-view">
          <label>Username</label>
          <div class="field-val" id="infoUsername"></div>
        </div>
        <div class="info-field-view full-width">
          <label>Office / Department / Division</label>
          <div class="field-val" id="infoOffice"></div>
        </div>
        <div class="info-field-view">
          <label>Designation / Position</label>
          <div class="field-val" id="infoDesignation"></div>
        </div>
        <div class="info-field-view">
          <label>Account Role</label>
          <div class="field-val" id="infoRole"></div>
        </div>
        <div class="info-field-view">
          <label>Status</label>
          <div class="field-val" id="infoStatus"></div>
        </div>
        <hr class="info-divider" />
        <div class="timestamps">
          <div class="ts-item">
            <label>Joined Date</label>
            <span id="infoCreatedAt"></span>
          </div>
          <div class="ts-item">
            <label>Last Updated</label>
            <span id="infoUpdatedAt"></span>
          </div>
        </div>
      </div>
    </div>
    <div class="modal-footer">
      <button class="btn-save" onclick="closeModal('infoModal')">Back</button>
    </div>
  </div>
</div>

<!-- ARCHIVE CONFIRM MODAL -->
<div class="modal-overlay" id="archiveModal">
  <div class="modal modal-delete" style="max-width:400px;">
    <div class="modal-body">
      <div class="archive-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
        </svg>
      </div>
      <p class="delete-msg">Archive User Account</p>
      <p class="delete-sub">Are you sure you want to archive <strong id="archiveUserName"></strong>? The account will be moved to the Archive List.</p>
    </div>
    <div class="modal-footer" style="justify-content:center;">
      <button class="btn-cancel" onclick="closeModal('archiveModal')">Cancel</button>
      <button class="btn-confirm-archive" onclick="confirmArchive()">Archive</button>
    </div>
  </div>
</div>

<!-- UNARCHIVE CONFIRM MODAL -->
<div class="modal-overlay" id="unarchiveModal">
  <div class="modal modal-delete" style="max-width:400px;">
    <div class="modal-body">
      <div class="unarchive-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h5l2 2h11v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 17V11m0 0l-3 3m3-3l3 3"/>
        </svg>
      </div>
      <p class="delete-msg">Unarchive User Account</p>
      <p class="delete-sub">Are you sure you want to unarchive <strong id="unarchiveUserName"></strong>? The account will be moved back to the active user list.</p>
    </div>
    <div class="modal-footer" style="justify-content:center;">
      <button class="btn-cancel" onclick="closeModal('unarchiveModal')">Cancel</button>
      <button class="btn-confirm-unarchive" onclick="confirmUnarchive()">Unarchive</button>
    </div>
  </div>
</div>

<!-- BULK ARCHIVE CONFIRM MODAL -->
<div class="modal-overlay" id="bulkArchiveModal">
  <div class="modal modal-delete" style="max-width:430px;">
    <div class="modal-body">
      <div class="archive-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
        </svg>
      </div>
      <p class="delete-msg">Archive Selected Accounts</p>
      <p class="delete-sub">Are you sure you want to archive <strong id="bulkArchiveCount">0 selected user(s)</strong>? The selected accounts will be moved to the Archive List.</p>
    </div>
    <div class="modal-footer" style="justify-content:center;">
      <button class="btn-cancel" onclick="closeModal('bulkArchiveModal')">Cancel</button>
      <button class="btn-confirm-archive" onclick="confirmBulkArchive()">Archive Selected</button>
    </div>
  </div>
</div>

<!-- BULK UNARCHIVE CONFIRM MODAL -->
<div class="modal-overlay" id="bulkUnarchiveModal">
  <div class="modal modal-delete" style="max-width:430px;">
    <div class="modal-body">
      <div class="unarchive-icon">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h5l2 2h11v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z"/>
          <path stroke-linecap="round" stroke-linejoin="round" d="M12 17V11m0 0l-3 3m3-3l3 3"/>
        </svg>
      </div>
      <p class="delete-msg">Unarchive Selected Accounts</p>
      <p class="delete-sub">Are you sure you want to unarchive <strong id="bulkUnarchiveCount">0 selected user(s)</strong>? The selected accounts will return to the active user list.</p>
    </div>
    <div class="modal-footer" style="justify-content:center;">
      <button class="btn-cancel" onclick="closeModal('bulkUnarchiveModal')">Cancel</button>
      <button class="btn-confirm-unarchive" onclick="confirmBulkUnarchive()">Unarchive Selected</button>
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
