// ===== SAMPLE DATA =====
const sampleUsers = [
  { id: 1, empId: '1234-5678', firstName: 'Juan', middleName: 'Cale', lastName: 'Dela Cruz', email: 'juan.delacruz@lra.gov.ph', username: 'j.delacruz27', role: 'Admin', status: 'Active', designation: 'IT Officer III', office: 'Information and Communications Technology Division', createdAt: '2026-02-28 13:09', updatedAt: '2026-03-02 24:00' },
  { id: 2, empId: '1234-8675', firstName: 'Maria', middleName: 'Santos', lastName: 'Reyes', email: 'maria.reyes@lra.gov.ph', username: 'm.reyes01', role: 'User', status: 'Active', designation: 'Administrative Officer', office: 'Administrative Division', createdAt: '2026-01-10 09:30', updatedAt: '2026-02-15 14:22' },
  { id: 3, empId: '1234-7365', firstName: 'Carlos', middleName: 'Lopez', lastName: 'Santos', email: 'carlos.santos@lra.gov.ph', username: 'c.santos12', role: 'User', status: 'Active', designation: 'Records Officer', office: 'Records Management Division', createdAt: '2026-01-15 11:00', updatedAt: '2026-02-20 09:45' },
  { id: 4, empId: '1234-9845', firstName: 'Ana', middleName: 'Cruz', lastName: 'Mendoza', email: 'ana.mendoza@lra.gov.ph', username: 'a.mendoza05', role: 'User', status: 'Inactive', designation: 'Clerk III', office: 'Finance Division', createdAt: '2026-01-20 08:15', updatedAt: '2026-02-28 16:30' },
  { id: 5, empId: '1234-4521', firstName: 'Roberto', middleName: 'Abad', lastName: 'Garcia', email: 'roberto.garcia@lra.gov.ph', username: 'r.garcia88', role: 'Admin', status: 'Active', designation: 'Division Chief', office: 'Legal Division', createdAt: '2025-12-01 10:00', updatedAt: '2026-03-01 11:00' },
  { id: 6, empId: '1234-3312', firstName: 'Liza', middleName: 'Tan', lastName: 'Villanueva', email: 'liza.villanueva@lra.gov.ph', username: 'l.villanueva', role: 'User', status: 'Active', designation: 'Stenographer', office: 'Administrative Division', createdAt: '2025-11-22 13:30', updatedAt: '2026-01-18 10:00' },
  { id: 7, empId: '1234-6698', firstName: 'Mark', middleName: 'Bautista', lastName: 'Ramos', email: 'mark.ramos@lra.gov.ph', username: 'm.ramos99', role: 'User', status: 'Active', designation: 'Programmer III', office: 'Information and Communications Technology Division', createdAt: '2025-10-05 09:00', updatedAt: '2026-02-10 15:20' },
  { id: 8, empId: '1234-7723', firstName: 'Claire', middleName: 'Delos', lastName: 'Santos', email: 'claire.santos@lra.gov.ph', username: 'c.santos22', role: 'User', status: 'Inactive', designation: 'Accountant', office: 'Finance Division', createdAt: '2025-09-12 08:30', updatedAt: '2026-01-25 09:10' },
  { id: 9, empId: '1234-8801', firstName: 'Jose', middleName: 'Espino', lastName: 'Torres', email: 'jose.torres@lra.gov.ph', username: 'j.torres07', role: 'User', status: 'Active', designation: 'Driver', office: 'Administrative Division', createdAt: '2025-08-01 07:45', updatedAt: '2025-12-20 11:30' },
  { id: 10, empId: '1234-9910', firstName: 'Rachel', middleName: 'Aquino', lastName: 'Cruz', email: 'rachel.cruz@lra.gov.ph', username: 'r.cruz44', role: 'User', status: 'Active', designation: 'Paralegal', office: 'Legal Division', createdAt: '2025-07-14 10:15', updatedAt: '2026-02-05 14:00' },
  { id: 11, empId: '1234-1120', firstName: 'Diego', middleName: 'Morales', lastName: 'Navarro', email: 'diego.navarro@lra.gov.ph', username: 'd.navarro77', role: 'Admin', status: 'Active', designation: 'IT Officer II', office: 'Information and Communications Technology Division', createdAt: '2025-06-20 09:00', updatedAt: '2026-01-30 16:00' },
  { id: 12, empId: '1234-2233', firstName: 'Josephine', middleName: 'Dela', lastName: 'Pena', email: 'josephine.pena@lra.gov.ph', username: 'j.pena55', role: 'User', status: 'Active', designation: 'Clerk II', office: 'Records Management Division', createdAt: '2025-05-10 08:00', updatedAt: '2025-12-01 09:00' },
];

const sampleAuditLogs = [
  { empId: '1234-5678', name: 'Juan C. Dela Cruz', role: 'Admin', timestamp: '2026-02-10 15:20', description: 'Successful Login' },
  { empId: '1234-8675', name: 'Maria S. Reyes', role: 'User', timestamp: '2026-02-11 17:20', description: 'Edit Profile' },
  { empId: '1234-7365', name: 'Carlos L. Santos', role: 'User', timestamp: '2026-02-26 10:10', description: 'Viewed Profile' },
  { empId: '1234-9845', name: 'Ana C. Mendoza', role: 'User', timestamp: '2026-03-10 11:20', description: 'Successful Logout' },
  { empId: '1234-4521', name: 'Roberto A. Garcia', role: 'Admin', timestamp: '2026-02-28 14:00', description: 'Added New User' },
  { empId: '1234-3312', name: 'Liza T. Villanueva', role: 'User', timestamp: '2026-03-01 09:05', description: 'Successful Login' },
  { empId: '1234-6698', name: 'Mark B. Ramos', role: 'User', timestamp: '2026-03-02 10:30', description: 'Changed Password' },
  { empId: '1234-7723', name: 'Claire D. Santos', role: 'User', timestamp: '2026-03-03 11:45', description: 'Successful Logout' },
  { empId: '1234-8801', name: 'Jose E. Torres', role: 'User', timestamp: '2026-03-04 07:50', description: 'Successful Login' },
  { empId: '1234-9910', name: 'Rachel A. Cruz', role: 'User', timestamp: '2026-03-04 08:15', description: 'Viewed User List' },
];

// ===== STATE =====
let usersData = [...sampleUsers];
let archivedUsers = [];   // ← archived users live here
let auditData = [...sampleAuditLogs];
let currentPage = 1;
let auditPage = 1;
let archivePage = 1;
const ROWS_PER_PAGE = 8;
let sortField = null;
let sortOrder = 'asc';
let filterRole = 'all';
let searchQuery = '';
let selectedUser = null;

// Archive list filter state
let archiveSortField = null;
let archiveSortOrder = 'asc';
let archiveFilterRole = 'all';

Object.defineProperties(window, {
  currentPage: {
    get: () => currentPage,
    set: (value) => { currentPage = Number(value) || 1; },
  },
  archivePage: {
    get: () => archivePage,
    set: (value) => { archivePage = Number(value) || 1; },
  },
  auditPage: {
    get: () => auditPage,
    set: (value) => { auditPage = Number(value) || 1; },
  },
  searchQuery: {
    get: () => searchQuery,
    set: (value) => { searchQuery = String(value ?? ''); },
  },
});

// ===== NAVIGATION =====
function navigate(pageId) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  document.getElementById(pageId).classList.add('active');
  document.querySelector(`[data-page="${pageId}"]`).classList.add('active');

  // Always reset User Management back to the main list when navigating away and back
  if (pageId === 'userManagementPage') {
    document.getElementById('archiveListPanel').style.display = 'none';
    document.getElementById('userManagementMain').style.display = 'block';
  }
}

// ===== ARCHIVE LIST VIEW =====
// Shows the archive list panel inside the User Management page
function openArchiveList() {
  document.getElementById('userManagementMain').style.display = 'none';
  document.getElementById('archiveListPanel').style.display = 'block';
  archivePage = 1;
  renderArchive();
}

function closeArchiveList() {
  document.getElementById('archiveListPanel').style.display = 'none';
  document.getElementById('userManagementMain').style.display = 'block';
}

// ===== RENDER USER TABLE =====
function getFilteredUsers() {
  let data = [...usersData];
  if (searchQuery) {
    const q = searchQuery.toLowerCase();
    data = data.filter(u =>
      u.empId.toLowerCase().includes(q) ||
      `${u.firstName} ${u.middleName} ${u.lastName}`.toLowerCase().includes(q) ||
      u.username.toLowerCase().includes(q)
    );
  }
  if (filterRole !== 'all') {
    data = data.filter(u => u.role.toLowerCase() === filterRole.toLowerCase());
  }
  if (sortField) {
    data.sort((a, b) => {
      let av = a[sortField] || '', bv = b[sortField] || '';
      if (typeof av === 'string') av = av.toLowerCase(), bv = bv.toLowerCase();
      return sortOrder === 'asc' ? (av > bv ? 1 : -1) : (av < bv ? 1 : -1);
    });
  }
  return data;
}

function renderUsers() {
  const data = getFilteredUsers();
  const totalPages = Math.max(1, Math.ceil(data.length / ROWS_PER_PAGE));
  if (currentPage > totalPages) currentPage = totalPages;
  const pageData = data.slice((currentPage - 1) * ROWS_PER_PAGE, currentPage * ROWS_PER_PAGE);
  const tbody = document.getElementById('userTableBody');
  tbody.innerHTML = '';

  pageData.forEach(u => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${u.empId}</td>
      <td>${u.lastName}, ${u.firstName} ${u.middleName ? u.middleName.charAt(0) + '.' : ''}</td>
      <td>${u.email}</td>
      <td>${u.username}</td>
      <td><span class="badge badge-${u.role.toLowerCase()}">${u.role}</span></td>
      <td><span class="badge badge-status-${u.status.toLowerCase()}">${u.status}</span></td>
      <td>
        <div class="action-btns">
          <button class="btn-view" onclick="openInfoModal(${u.id})" title="View">
            ${iconEye}
          </button>
          <button class="btn-edit" onclick="openEditModal(${u.id})" title="Edit">
            ${iconEdit}
          </button>
          <button class="btn-archive" onclick="openArchiveModal(${u.id})" title="Archive">
            ${iconArchive}
          </button>
        </div>
      </td>
    `;
    tbody.appendChild(tr);
  });

  // Fill empty rows
  const emptyCount = ROWS_PER_PAGE - pageData.length;
  for (let i = 0; i < emptyCount; i++) {
    const tr = document.createElement('tr');
    tr.className = 'empty-row';
    tr.innerHTML = '<td colspan="7"></td>';
    tbody.appendChild(tr);
  }

  renderPagination('userPagination', totalPages, currentPage, (p) => { currentPage = p; renderUsers(); });
}

// ===== RENDER ARCHIVE TABLE =====
function getFilteredArchive() {
  let data = [...archivedUsers];
  const q = document.getElementById('archiveSearch')?.value?.toLowerCase() || '';
  if (q) {
    data = data.filter(u =>
      u.empId.toLowerCase().includes(q) ||
      `${u.firstName} ${u.middleName} ${u.lastName}`.toLowerCase().includes(q) ||
      u.username.toLowerCase().includes(q)
    );
  }
  if (archiveFilterRole !== 'all') {
    data = data.filter(u => u.role.toLowerCase() === archiveFilterRole.toLowerCase());
  }
  if (archiveSortField) {
    data.sort((a, b) => {
      let av = a[archiveSortField] || '', bv = b[archiveSortField] || '';
      if (typeof av === 'string') av = av.toLowerCase(), bv = bv.toLowerCase();
      return archiveSortOrder === 'asc' ? (av > bv ? 1 : -1) : (av < bv ? 1 : -1);
    });
  }
  return data;
}

function renderArchive() {
  const data = getFilteredArchive();
  const totalPages = Math.max(1, Math.ceil(data.length / ROWS_PER_PAGE));
  if (archivePage > totalPages) archivePage = totalPages;
  const pageData = data.slice((archivePage - 1) * ROWS_PER_PAGE, archivePage * ROWS_PER_PAGE);
  const tbody = document.getElementById('archiveTableBody');
  tbody.innerHTML = '';

  pageData.forEach(u => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${u.empId}</td>
      <td>${u.lastName}, ${u.firstName} ${u.middleName ? u.middleName.charAt(0) + '.' : ''}</td>
      <td>${u.email}</td>
      <td>${u.username}</td>
      <td><span class="badge badge-${u.role.toLowerCase()}">${u.role}</span></td>
    `;
    tbody.appendChild(tr);
  });

  // Fill empty rows
  const emptyCount = ROWS_PER_PAGE - pageData.length;
  for (let i = 0; i < emptyCount; i++) {
    const tr = document.createElement('tr');
    tr.className = 'empty-row';
    tr.innerHTML = '<td colspan="5"></td>';
    tbody.appendChild(tr);
  }

  renderPagination('archivePagination', totalPages, archivePage, (p) => { archivePage = p; renderArchive(); });
}

// ===== RENDER AUDIT TABLE =====
function getFilteredAudit() {
  let data = [...auditData];
  const q = document.getElementById('auditSearch')?.value?.toLowerCase() || '';
  const sd = document.getElementById('startDate')?.value;
  const ed = document.getElementById('endDate')?.value;
  const fr = document.getElementById('auditFilterRole')?.value || 'all';

  if (q) data = data.filter(a => a.empId.toLowerCase().includes(q) || a.name.toLowerCase().includes(q));
  if (sd) data = data.filter(a => a.timestamp >= sd);
  if (ed) data = data.filter(a => a.timestamp <= ed + ' 23:59');
  if (fr !== 'all') data = data.filter(a => a.role.toLowerCase() === fr);
  return data;
}

function renderAudit() {
  const data = getFilteredAudit();
  const totalPages = Math.max(1, Math.ceil(data.length / ROWS_PER_PAGE));
  if (auditPage > totalPages) auditPage = totalPages;
  const pageData = data.slice((auditPage - 1) * ROWS_PER_PAGE, auditPage * ROWS_PER_PAGE);
  const tbody = document.getElementById('auditTableBody');
  tbody.innerHTML = '';

  pageData.forEach(a => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${a.empId}</td>
      <td>${a.name}</td>
      <td><span class="badge badge-${a.role.toLowerCase()}">${a.role}</span></td>
      <td>${a.timestamp}</td>
      <td>${a.description}</td>
    `;
    tbody.appendChild(tr);
  });

  const emptyCount = ROWS_PER_PAGE - pageData.length;
  for (let i = 0; i < emptyCount; i++) {
    const tr = document.createElement('tr');
    tr.className = 'empty-row';
    tr.innerHTML = '<td colspan="5"></td>';
    tbody.appendChild(tr);
  }

  renderPagination('auditPagination', totalPages, auditPage, (p) => { auditPage = p; renderAudit(); });
}

// ===== PAGINATION =====
function renderPagination(containerId, totalPages, current, onChange) {
  const container = document.getElementById(containerId);
  container.innerHTML = '';

  const pages = getPaginationRange(current, totalPages);

  // Prev
  const prev = document.createElement('button');
  prev.className = 'pg-btn';
  prev.innerHTML = `<svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>`;
  prev.disabled = current <= 1;
  prev.onclick = () => { if (current > 1) onChange(current - 1); };
  container.appendChild(prev);

  pages.forEach(p => {
    const btn = document.createElement('button');
    btn.className = 'pg-btn' + (p === current ? ' active' : '') + (p === '...' ? '' : '');
    btn.textContent = p;
    if (p !== '...') btn.onclick = () => onChange(p);
    else { btn.disabled = true; btn.style.border = 'none'; btn.style.background = 'none'; }
    container.appendChild(btn);
  });

  // Next
  const next = document.createElement('button');
  next.className = 'pg-btn';
  next.innerHTML = `<svg viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/></svg>`;
  next.disabled = current >= totalPages;
  next.onclick = () => { if (current < totalPages) onChange(current + 1); };
  container.appendChild(next);
}

function getPaginationRange(current, total) {
  if (total <= 6) return Array.from({ length: total }, (_, i) => i + 1);
  if (current <= 3) return [1, 2, 3, 4, '...', total];
  if (current >= total - 2) return [1, '...', total - 3, total - 2, total - 1, total];
  return [1, '...', current - 1, current, current + 1, '...', total];
}

// ===== MODALS =====
function openModal(id) {
  const m = document.getElementById(id);
  m.classList.add('open');
}

function closeModal(id) {
  const m = document.getElementById(id);
  m.classList.remove('open');
}

function openAddModal() {
  document.getElementById('addUserForm').reset();
  openModal('addUserModal');
}

function openEditModal(userId) {
  const user = usersData.find(u => u.id === userId);
  if (!user) return;
  selectedUser = user;
  document.getElementById('editFirstName').value = user.firstName;
  document.getElementById('editMiddleName').value = user.middleName;
  document.getElementById('editLastName').value = user.lastName;
  document.getElementById('editEmail').value = user.email;
  document.getElementById('editEmpId').value = user.empId;
  document.getElementById('editUsername').value = user.username;
  document.getElementById('editDesignation').value = user.designation;
  document.getElementById('editOffice').value = user.office;
  document.getElementById('editRole').value = user.role;
  document.getElementById('editStatus').value = user.status || 'Active';
  openModal('editUserModal');
}

function openInfoModal(userId) {
  const user = usersData.find(u => u.id === userId);
  if (!user) return;
  document.getElementById('infoFirstName').textContent = user.firstName;
  document.getElementById('infoMiddleName').textContent = user.middleName;
  document.getElementById('infoLastName').textContent = user.lastName;
  document.getElementById('infoEmail').textContent = user.email;
  document.getElementById('infoEmpId').textContent = user.empId;
  document.getElementById('infoUsername').textContent = user.username;
  document.getElementById('infoOffice').textContent = user.office;
  document.getElementById('infoDesignation').textContent = user.designation;
  document.getElementById('infoRole').textContent = user.role;
  document.getElementById('infoStatus').textContent = user.status || 'Active';
  document.getElementById('infoCreatedAt').textContent = user.createdAt;
  document.getElementById('infoUpdatedAt').textContent = user.updatedAt;
  openModal('infoModal');
}

// ===== ARCHIVE (replaces delete) =====
function openArchiveModal(userId) {
  selectedUser = usersData.find(u => u.id === userId);
  if (!selectedUser) return;
  document.getElementById('archiveUserName').textContent = `${selectedUser.firstName} ${selectedUser.lastName}`;
  openModal('archiveModal');
}

function confirmArchive() {
  if (!selectedUser) return;
  // Move from active to archived
  archivedUsers.unshift({ ...selectedUser, archivedAt: new Date().toISOString().slice(0, 16).replace('T', ' ') });
  usersData = usersData.filter(u => u.id !== selectedUser.id);
  closeModal('archiveModal');
  renderUsers();
  showToast('User archived successfully.', 'info');
  selectedUser = null;
}

function saveAddUser() {
  const fn = document.getElementById('addFirstName').value.trim();
  const ln = document.getElementById('addLastName').value.trim();
  if (!fn || !ln) { showToast('First name and last name are required.', 'error'); return; }

  const newUser = {
    id: Date.now(),
    empId: document.getElementById('addEmpId').value.trim() || 'N/A',
    firstName: fn,
    middleName: document.getElementById('addMiddleName').value.trim(),
    lastName: ln,
    email: document.getElementById('addEmail').value.trim(),
    username: document.getElementById('addUsername').value.trim(),
    role: document.getElementById('addRole').value || 'User',
    status: 'Active',
    designation: document.getElementById('addDesignation').value.trim(),
    office: document.getElementById('addOffice').value || '',
    createdAt: new Date().toISOString().slice(0, 16).replace('T', ' '),
    updatedAt: new Date().toISOString().slice(0, 16).replace('T', ' '),
  };

  usersData.unshift(newUser);
  closeModal('addUserModal');
  currentPage = 1;
  renderUsers();
  showToast('User account created successfully!', 'success');
}

function saveEditUser() {
  if (!selectedUser) return;
  const idx = usersData.findIndex(u => u.id === selectedUser.id);
  if (idx === -1) return;

  usersData[idx] = {
    ...usersData[idx],
    firstName: document.getElementById('editFirstName').value.trim() || usersData[idx].firstName,
    middleName: document.getElementById('editMiddleName').value.trim(),
    lastName: document.getElementById('editLastName').value.trim() || usersData[idx].lastName,
    email: document.getElementById('editEmail').value.trim(),
    username: document.getElementById('editUsername').value.trim(),
    designation: document.getElementById('editDesignation').value.trim(),
    office: document.getElementById('editOffice').value,
    role: document.getElementById('editRole').value,
    status: document.getElementById('editStatus').value,
    updatedAt: new Date().toISOString().slice(0, 16).replace('T', ' '),
  };

  closeModal('editUserModal');
  renderUsers();
  showToast('User profile updated successfully.', 'success');
  selectedUser = null;
}

// ===== GENERATE PASSWORD =====
function generatePassword() {
  const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$!';
  let pwd = '';
  for (let i = 0; i < 12; i++) pwd += chars[Math.floor(Math.random() * chars.length)];
  document.getElementById('addPassword').value = pwd;
}

// ===== SORT & FILTER DROPDOWNS =====
function toggleDropdown(id) {
  const dd = document.getElementById(id);
  document.querySelectorAll('.dropdown-menu').forEach(d => { if (d.id !== id) d.classList.remove('open'); });
  dd.classList.toggle('open');
}

function setSortField(field, label) {
  if (sortField === field) sortOrder = sortOrder === 'asc' ? 'desc' : 'asc';
  else { sortField = field; sortOrder = 'asc'; }
  document.getElementById('sortLabel').textContent = label + (sortOrder === 'asc' ? ' ↑' : ' ↓');
  document.getElementById('sortMenu').classList.remove('open');
  currentPage = 1;
  renderUsers();
}

function setFilterRole(role, label) {
  filterRole = role;
  document.getElementById('filterLabel').textContent = label;
  document.getElementById('filterMenu').classList.remove('open');
  currentPage = 1;
  renderUsers();
}

function setAuditFilter(role, label) {
  document.getElementById('auditFilterRole').value = role;
  document.getElementById('auditFilterLabel').textContent = label;
  document.getElementById('auditFilterMenu').classList.remove('open');
  auditPage = 1;
  renderAudit();
}

// Archive list sort/filter
function setArchiveSortField(field, label) {
  if (archiveSortField === field) archiveSortOrder = archiveSortOrder === 'asc' ? 'desc' : 'asc';
  else { archiveSortField = field; archiveSortOrder = 'asc'; }
  document.getElementById('archiveSortLabel').textContent = label + (archiveSortOrder === 'asc' ? ' ↑' : ' ↓');
  document.getElementById('archiveSortMenu').classList.remove('open');
  archivePage = 1;
  renderArchive();
}

function setArchiveFilterRole(role, label) {
  archiveFilterRole = role;
  document.getElementById('archiveFilterLabel').textContent = label;
  document.getElementById('archiveFilterMenu').classList.remove('open');
  archivePage = 1;
  renderArchive();
}

// ===== TOAST =====
function showToast(msg, type = 'info') {
  const container = document.getElementById('toastContainer');
  const toast = document.createElement('div');
  toast.className = `toast ${type}`;
  toast.textContent = msg;
  container.appendChild(toast);
  setTimeout(() => { toast.style.opacity = '0'; toast.style.transition = 'opacity 0.4s'; setTimeout(() => toast.remove(), 400); }, 2800);
}

// ===== SVG ICONS =====
const iconEye = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>`;
const iconEdit = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>`;
const iconArchive = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>`;

// ===== CLOSE DROPDOWN ON OUTSIDE CLICK =====
document.addEventListener('click', (e) => {
  if (!e.target.closest('.dropdown')) {
    document.querySelectorAll('.dropdown-menu').forEach(d => d.classList.remove('open'));
  }
});

// ===== CLOSE MODAL ON OVERLAY CLICK =====
document.querySelectorAll('.modal-overlay').forEach(overlay => {
  overlay.addEventListener('click', (e) => {
    if (e.target === overlay) overlay.classList.remove('open');
  });
});

// ===== INIT =====
document.addEventListener('DOMContentLoaded', () => {
  if (document.getElementById('userTableBody')) renderUsers();
  if (document.getElementById('auditTableBody')) renderAudit();

  // Sidebar toggle
  const sidebar     = document.getElementById('sidebar');
  const toggleBtn   = document.getElementById('menu-toggle');
  const mainContent = document.getElementById('mainContent');

  if (!sidebar || !toggleBtn || !mainContent) return;

  if (localStorage.getItem('sidebarCollapsed') === 'true') {
    sidebar.classList.add('collapsed');
    mainContent.classList.add('collapsed');
  }

  toggleBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    mainContent.classList.toggle('collapsed');
    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
  });
});

Object.assign(window, {
  navigate,
  openArchiveList,
  closeArchiveList,
  renderUsers,
  renderArchive,
  renderAudit,
  toggleDropdown,
  setSortField,
  setFilterRole,
  setAuditFilter,
  setArchiveSortField,
  setArchiveFilterRole,
  openAddModal,
  openEditModal,
  openInfoModal,
  openArchiveModal,
  confirmArchive,
  saveAddUser,
  saveEditUser,
  generatePassword,
  closeModal,
});