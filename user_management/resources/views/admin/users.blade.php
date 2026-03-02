<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Admin Panel – User Management</title>
</head>
<body>

<!-- TOP BAR -->
<div id="topbar">
  <span id="topbar-title">Admin Panel</span>
  <span id="topbar-breadcrumb">Home &rsaquo; User Management</span>
  <span id="topbar-right">
    <span id="topbar-datetime"></span>
    &nbsp;|&nbsp;
    <span id="topbar-user">Logged in as: <strong>Admin</strong></span>
    &nbsp;|&nbsp;
    <a href="#">Logout</a>
  </span>
</div>

<div id="layout">

  <!-- SIDEBAR -->
  <nav id="sidebar">
    <ul>
      <li><a href="#">Home</a></li>
      <li><a href="#" class="active">User Management</a></li>
    </ul>
  </nav>

  <!-- MAIN CONTENT -->
  <main id="content">
    <h1>User Management</h1>

    <!-- TOOLBAR -->
    <div id="toolbar">
      <button onclick="openModal('add')">+ Add User</button>
      &nbsp;
      <input type="text" id="searchInput" placeholder="Search users..." oninput="filterTable()" />
      &nbsp;
      <label>
        <input type="checkbox" id="showDeleted" onchange="filterTable()" /> Show Deleted
      </label>
    </div>

    <!-- USER TABLE -->
    <table id="userTable" border="1" cellpadding="6" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th>ID</th>
          <th>Employee ID</th>
          <th>First Name</th>
          <th>Middle Name</th>
          <th>Last Name</th>
          <th>Email</th>
          <th>Username</th>
          <th>Designation / Position</th>
          <th>Office / Dept / Division</th>
          <th>Account Role</th>
          <th>Created At</th>
          <th>Updated At</th>
          <th>Status</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="tableBody"></tbody>
    </table>

  </main>
</div>

<!-- MODAL -->
<div id="modal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
  <div style="background:#fff; margin:40px auto; padding:24px; max-width:620px; max-height:85vh; overflow-y:auto;">
    <h2 id="modalTitle">Add User</h2>

    <form id="userForm" onsubmit="submitForm(event)">
      <input type="hidden" id="formId" />
      <input type="hidden" id="formIndex" />

      <fieldset>
        <legend>Identity</legend>
        <label>Employee ID*<br/><input type="text" id="fEmployeeId" required /></label><br/><br/>
        <label>First Name*<br/><input type="text" id="fFirstName" required /></label><br/><br/>
        <label>Middle Name<br/><input type="text" id="fMiddleName" /></label><br/><br/>
        <label>Last Name*<br/><input type="text" id="fLastName" required /></label><br/><br/>
        <label>Designation / Position<br/><input type="text" id="fDesignation" /></label>
      </fieldset>

      <br/>

      <fieldset>
        <legend>Account</legend>
        <label>Email*<br/><input type="email" id="fEmail" required /></label><br/><br/>
        <label>Username*<br/><input type="text" id="fUsername" required /></label><br/><br/>
        <label id="passwordLabel">Password*<br/><input type="password" id="fPassword" /></label>
      </fieldset>

      <br/>

      <fieldset>
        <legend>Office / Department / Division</legend>
        <label>Select Office*<br/>
          <select id="fOffice" required>
            <option value="">-- Select --</option>
          </select>
        </label>
        <br/><br/>
        <div id="officeDetail" style="font-size:0.9em; color:#555;"></div>
      </fieldset>

      <br/>

      <fieldset>
        <legend>Account Role</legend>
        <label>Select Role*<br/>
          <select id="fRole" required>
            <option value="">-- Select --</option>
          </select>
        </label>
        <br/><br/>
        <div id="roleDetail" style="font-size:0.9em; color:#555;"></div>
      </fieldset>

      <br/>
      <button type="submit">Save</button>
      &nbsp;
      <button type="button" onclick="closeModal()">Cancel</button>
    </form>
  </div>
</div>

<!-- VIEW MODAL -->
<div id="viewModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5);">
  <div style="background:#fff; margin:60px auto; padding:24px; max-width:500px; max-height:80vh; overflow-y:auto;">
    <h2>User Details</h2>
    <div id="viewContent"></div>
    <br/>
    <button onclick="closeViewModal()">Close</button>
  </div>
</div>

<script>
// ──────────────────────────────────────────────
// SEED DATA
// ──────────────────────────────────────────────
const offices = [
  { id: 1, officeCode: "OFC-001", name: "Information Technology", description: "IT Department", createdAt: "2023-01-10", updatedAt: "2023-01-10" },
  { id: 2, officeCode: "OFC-002", name: "Human Resources", description: "HR Division", createdAt: "2023-01-10", updatedAt: "2023-01-10" },
  { id: 3, officeCode: "OFC-003", name: "Finance", description: "Finance Office", createdAt: "2023-01-10", updatedAt: "2023-01-10" },
];

const roles = [
  { id: 1, roleCode: "ROLE-ADM", name: "Administrator", description: "Full system access", createdAt: "2023-01-10", updatedAt: "2023-01-10" },
  { id: 2, roleCode: "ROLE-MGR", name: "Manager", description: "Departmental access", createdAt: "2023-01-10", updatedAt: "2023-01-10" },
  { id: 3, roleCode: "ROLE-STF", name: "Staff", description: "Basic access", createdAt: "2023-01-10", updatedAt: "2023-01-10" },
];

let users = [
  {
    id: 1, employeeId: "EMP-0001", firstName: "Juan", middleName: "D.", lastName: "dela Cruz",
    email: "juan@example.com", username: "jdelacruz", password: "hashed_pw",
    designation: "Systems Administrator", officeId: 1, roleId: 1,
    createdAt: "2024-06-01 09:00", updatedAt: "2024-06-01 09:00", deleted: false
  },
  {
    id: 2, employeeId: "EMP-0002", firstName: "Maria", middleName: "S.", lastName: "Santos",
    email: "maria@example.com", username: "msantos", password: "hashed_pw",
    designation: "HR Officer", officeId: 2, roleId: 2,
    createdAt: "2024-06-02 10:00", updatedAt: "2024-06-02 10:00", deleted: false
  },
];
let nextId = 3;

// ──────────────────────────────────────────────
// HELPERS
// ──────────────────────────────────────────────
function now() {
  return new Date().toISOString().replace('T',' ').substring(0,16);
}

function getOffice(id) { return offices.find(o => o.id === id); }
function getRole(id) { return roles.find(r => r.id === id); }

// ──────────────────────────────────────────────
// TOP BAR CLOCK
// ──────────────────────────────────────────────
function updateClock() {
  document.getElementById('topbar-datetime').textContent = new Date().toLocaleString();
}
setInterval(updateClock, 1000);
updateClock();

// ──────────────────────────────────────────────
// POPULATE DROPDOWNS
// ──────────────────────────────────────────────
function populateDropdowns() {
  const offSel = document.getElementById('fOffice');
  const rolSel = document.getElementById('fRole');
  offSel.innerHTML = '<option value="">-- Select --</option>';
  rolSel.innerHTML = '<option value="">-- Select --</option>';
  offices.forEach(o => {
    offSel.innerHTML += `<option value="${o.id}">[${o.officeCode}] ${o.name}</option>`;
  });
  roles.forEach(r => {
    rolSel.innerHTML += `<option value="${r.id}">[${r.roleCode}] ${r.name}</option>`;
  });
}

document.getElementById('fOffice').addEventListener('change', function() {
  const o = getOffice(parseInt(this.value));
  document.getElementById('officeDetail').innerHTML = o
    ? `<b>Code:</b> ${o.officeCode} | <b>Desc:</b> ${o.description}` : '';
});

document.getElementById('fRole').addEventListener('change', function() {
  const r = getRole(parseInt(this.value));
  document.getElementById('roleDetail').innerHTML = r
    ? `<b>Code:</b> ${r.roleCode} | <b>Desc:</b> ${r.description}` : '';
});

// ──────────────────────────────────────────────
// RENDER TABLE
// ──────────────────────────────────────────────
function renderTable() {
  const search = document.getElementById('searchInput').value.toLowerCase();
  const showDeleted = document.getElementById('showDeleted').checked;
  const tbody = document.getElementById('tableBody');
  tbody.innerHTML = '';

  users.forEach((u, idx) => {
    if (!showDeleted && u.deleted) return;
    const fullName = `${u.firstName} ${u.lastName}`.toLowerCase();
    if (search && !fullName.includes(search) && !u.email.toLowerCase().includes(search) && !u.username.toLowerCase().includes(search)) return;

    const office = getOffice(u.officeId);
    const role = getRole(u.roleId);
    const statusLabel = u.deleted ? '<span style="color:red">[Deleted]</span>' : '<span style="color:green">Active</span>';

    tbody.innerHTML += `
      <tr style="${u.deleted ? 'background:#fff0f0;' : ''}">
        <td>${u.id}</td>
        <td>${u.employeeId}</td>
        <td>${u.firstName}</td>
        <td>${u.middleName}</td>
        <td>${u.lastName}</td>
        <td>${u.email}</td>
        <td>${u.username}</td>
        <td>${u.designation}</td>
        <td>${office ? office.name : '—'}</td>
        <td>${role ? role.name : '—'}</td>
        <td>${u.createdAt}</td>
        <td>${u.updatedAt}</td>
        <td>${statusLabel}</td>
        <td>
          <button onclick="viewUser(${idx})">View</button>
          ${!u.deleted ? `<button onclick="openModal('edit', ${idx})">Edit</button>` : ''}
          ${!u.deleted
            ? `<button onclick="softDelete(${idx})" style="color:red">Delete</button>`
            : `<button onclick="restore(${idx})" style="color:green">Restore</button>`}
        </td>
      </tr>`;
  });
}

// ──────────────────────────────────────────────
// FILTER
// ──────────────────────────────────────────────
function filterTable() { renderTable(); }

// ──────────────────────────────────────────────
// SOFT DELETE / RESTORE
// ──────────────────────────────────────────────
function softDelete(idx) {
  if (!confirm('Soft-delete this user? The record will be retained.')) return;
  users[idx].deleted = true;
  users[idx].updatedAt = now();
  renderTable();
}

function restore(idx) {
  users[idx].deleted = false;
  users[idx].updatedAt = now();
  renderTable();
}

// VIEW USER
function viewUser(idx) {
  const u = users[idx];
  const office = getOffice(u.officeId);
  const role = getRole(u.roleId);
  document.getElementById('viewContent').innerHTML = `
    <table border="1" cellpadding="5" cellspacing="0">
      <tr><th>ID</th><td>${u.id}</td></tr>
      <tr><th>Employee ID</th><td>${u.employeeId}</td></tr>
      <tr><th>Full Name</th><td>${u.firstName} ${u.middleName} ${u.lastName}</td></tr>
      <tr><th>Email</th><td>${u.email}</td></tr>
      <tr><th>Username</th><td>${u.username}</td></tr>
      <tr><th>Designation</th><td>${u.designation}</td></tr>
      <tr><th>Office</th><td>${office ? `[${office.officeCode}] ${office.name}` : '—'}</td></tr>
      <tr><th>Role</th><td>${role ? `[${role.roleCode}] ${role.name}` : '—'}</td></tr>
      <tr><th>Created At</th><td>${u.createdAt}</td></tr>
      <tr><th>Updated At</th><td>${u.updatedAt}</td></tr>
      <tr><th>Status</th><td>${u.deleted ? 'Deleted' : 'Active'}</td></tr>
    </table>`;
  document.getElementById('viewModal').style.display = 'block';
}
function closeViewModal() { document.getElementById('viewModal').style.display = 'none'; }

// MODAL OPEN / CLOSE
function openModal(mode, idx) {
  populateDropdowns();
  document.getElementById('modal').style.display = 'block';
  document.getElementById('officeDetail').innerHTML = '';
  document.getElementById('roleDetail').innerHTML = '';

  if (mode === 'add') {
    document.getElementById('modalTitle').textContent = 'Add User';
    document.getElementById('userForm').reset();
    document.getElementById('formId').value = '';
    document.getElementById('formIndex').value = '';
    document.getElementById('passwordLabel').querySelector('input').required = true;
    document.getElementById('passwordLabel').querySelector('label, span') // label text
    document.getElementById('fPassword').required = true;
  } else {
    const u = users[idx];
    document.getElementById('modalTitle').textContent = 'Edit User';
    document.getElementById('formId').value = u.id;
    document.getElementById('formIndex').value = idx;
    document.getElementById('fEmployeeId').value = u.employeeId;
    document.getElementById('fFirstName').value = u.firstName;
    document.getElementById('fMiddleName').value = u.middleName;
    document.getElementById('fLastName').value = u.lastName;
    document.getElementById('fEmail').value = u.email;
    document.getElementById('fUsername').value = u.username;
    document.getElementById('fPassword').value = '';
    document.getElementById('fPassword').required = false;
    document.getElementById('fDesignation').value = u.designation;
    document.getElementById('fOffice').value = u.officeId;
    document.getElementById('fRole').value = u.roleId;

    // show office/role details
    const o = getOffice(u.officeId);
    const r = getRole(u.roleId);
    if (o) document.getElementById('officeDetail').innerHTML = `<b>Code:</b> ${o.officeCode} | <b>Desc:</b> ${o.description}`;
    if (r) document.getElementById('roleDetail').innerHTML = `<b>Code:</b> ${r.roleCode} | <b>Desc:</b> ${r.description}`;
  }
}

function closeModal() {
  document.getElementById('modal').style.display = 'none';
}

// SUBMIT FORM (ADD / EDIT)
function submitForm(e) {
  e.preventDefault();
  const idx = document.getElementById('formIndex').value;
  const isEdit = idx !== '';

  const entry = {
    employeeId: document.getElementById('fEmployeeId').value.trim(),
    firstName: document.getElementById('fFirstName').value.trim(),
    middleName: document.getElementById('fMiddleName').value.trim(),
    lastName: document.getElementById('fLastName').value.trim(),
    email: document.getElementById('fEmail').value.trim(),
    username: document.getElementById('fUsername').value.trim(),
    designation: document.getElementById('fDesignation').value.trim(),
    officeId: parseInt(document.getElementById('fOffice').value),
    roleId: parseInt(document.getElementById('fRole').value),
    updatedAt: now(),
  };

  const pw = document.getElementById('fPassword').value;

  if (isEdit) {
    const u = users[parseInt(idx)];
    Object.assign(u, entry);
    if (pw) u.password = 'hashed_' + pw;
  } else {
    entry.id = nextId++;
    entry.password = 'hashed_' + pw;
    entry.createdAt = now();
    entry.deleted = false;
    users.push(entry);
  }

  closeModal();
  renderTable();
}

// INIT
renderTable();
</script>

</body>
</html>