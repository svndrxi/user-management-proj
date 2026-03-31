import { dataSource } from './data-source';

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

// ===== SAMPLE PAYSLIP DATA =====
/** 
const samplePayslips = [
  { id: 1, empId: '1234-5678', firstName: 'Juan', middleName: 'Cale', lastName: 'Dela Cruz', month: 'January', payDate: '2026-01-15' },
  { id: 2, empId: '1234-8675', firstName: 'Maria', middleName: 'Santos', lastName: 'Reyes', month: 'February', payDate: '2026-02-15' },
  { id: 3, empId: '1234-7365', firstName: 'Carlos', middleName: 'Lopez', lastName: 'Santos', month: 'March', payDate: '2026-03-15' },
  { id: 4, empId: '1234-9845', firstName: 'Ana', middleName: 'Cruz', lastName: 'Mendoza', month: 'April', payDate: '2026-04-15' },
];
**/

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
let usersData = [];
let archivedUsers = [];   // ← archived users live here
let auditData = [];
let currentPage = 1;
let auditPage = 1;
let archivePage = 1;
const ROWS_PER_PAGE = 8;
let sortField = null;
let sortOrder = 'asc';
let filterRole = 'all';
let searchQuery = '';
let selectedUser = null;
let selectedArchivedUser = null;
let selectedUserIds = new Set();
let selectedArchivedUserIds = new Set();
const REQUIRED_EMAIL_DOMAIN = 'lra.gov.ph';
let addEmailDomainToastShown = false;
const duplicateToastShown = {
  addEmpId: false,
  addUsername: false,
  addEmail: false,
  editEmpId: false,
  editUsername: false,
  editEmail: false,
};

// Archive list filter state
let archiveSortField = null;
let archiveSortOrder = 'asc';
let archiveFilterRole = 'all';
let rolesData = [];
let officesData = [];

// ===== PAYSLIP STATE =====
let payslipsData = [];
let archivedPayslips = [];
let payslipPage = 1;
let payslipArchivePage = 1;
let payslipSearchQuery = '';
let payslipDepartmentFilter = '';
let payslipMonthFilter = '';
let payslipYearFilter = '';
let selectedPayslip = null;
let selectedArchivedPayslip = null;
let selectedPayslipIds = new Set();
let selectedArchivedPayslipIds = new Set();

function parseDateTime(value) {
  if (!value) return null;
  const normalized = typeof value === 'string' && /^\d{4}-\d{2}-\d{2} \d{2}:\d{2}/.test(value)
    ? value.replace(' ', 'T')
    : value;
  const date = new Date(normalized);
  return Number.isNaN(date.getTime()) ? null : date;
}

function formatDateTime(value) {
  const date = parseDateTime(value);
  if (!date) return value || '';
  return date.toLocaleString(undefined, {
    year: 'numeric',
    month: 'short',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
  });
}

function normalizeUser(u) {
  const isInactive = u.is_active === false || u.is_active === 0 || u.is_active === '0';

  return {
    id: u.id,
    empId: u.employee_id,
    firstName: u.first_name,
    middleName: u.middle_name || '',
    lastName: u.last_name,
    designation: u.designation || '',
    email: u.email,
    username: u.username,
    role: u.role?.name || '',
    roleId: u.role_id ?? u.role?.id ?? null,
    status: isInactive ? 'Inactive' : 'Active',
    office: u.office?.name || '',
    officeId: u.office_id ?? u.office?.id ?? null,
    createdAt: formatDateTime(u.created_at),
    updatedAt: formatDateTime(u.updated_at),
  };
}

function normalizeAuditLog(log) {
  const fullName = log.user
    ? `${log.user.first_name} ${log.user.last_name}`.trim()
    : 'System';
  return {
    empId: log.user?.employee_id || '-',
    name: fullName,
    role: log.user?.role?.name || '-',
    timestampRaw: log.created_at || log.timestamp || '',
    timestamp: formatDateTime(log.created_at || log.timestamp),
    description: log.description || log.action || '',
  };
}

function monthFromPayDate(dateStr) {
  if (!dateStr) return '';
  const normalized = String(dateStr).slice(0, 10);
  const d = new Date(normalized + 'T00:00:00');
  if (isNaN(d.getTime())) return '';
  return d.toLocaleString('en-US', { month: 'long' });
}

function normalizePayslip(p) {
  const payPeriod = String(p.pay_period || p.payPeriod || p.payroll_date || p.payrollDate || '').slice(0, 10);

  return {
    id: p.id,
    empId: p.employee_id || p.emp_id || '',
    name: p.name || '',
    department: p.department || '',
    designation: p.designation || '',
    payPeriod,
  };
}

function hydrateRoleOfficeSelects() {
  const roleSelectIds = ['addRole', 'editRole'];
  const officeSelectIds = ['addOffice', 'editOffice'];

  roleSelectIds.forEach((id) => {
    const el = document.getElementById(id);
    if (!el) return;
    const current = el.value;
    el.innerHTML = '<option value="">Select Account Role</option>';
    rolesData.forEach((role) => {
      const opt = document.createElement('option');
      opt.value = String(role.id);
      opt.textContent = role.name;
      el.appendChild(opt);
    });
    el.value = current;
  });

  officeSelectIds.forEach((id) => {
    const el = document.getElementById(id);
    if (!el) return;
    const current = el.value;
    el.innerHTML = '<option value="">Select Office/Department/Division</option>';
    officesData.forEach((office) => {
      const opt = document.createElement('option');
      opt.value = String(office.id);
      opt.textContent = office.name;
      el.appendChild(opt);
    });
    el.value = current;
  });
}

async function loadReferenceData() {
  const [rolesRes, officesRes] = await Promise.all([
    dataSource.roles.list({ per_page: 100 }),
    dataSource.offices.list({ per_page: 100 }),
  ]);
  rolesData = rolesRes.data || [];
  officesData = officesRes.data || [];
  hydrateRoleOfficeSelects();
}

async function loadUsersFromApi() {
  const res = await dataSource.users.list({ per_page: 200 });
  usersData = (res.data || []).map(normalizeUser);
  renderUsers();
}

async function loadArchivedUsersFromApi() {
  const res = await dataSource.users.list({ per_page: 200, only_archived: 1 });
  archivedUsers = (res.data || []).map(normalizeUser);
  renderArchive();
}

async function loadAuditFromApi() {
  const res = await dataSource.activityLogs.list({ per_page: 200 });
  auditData = (res.data || []).map(normalizeAuditLog);
  renderAudit();
}

async function loadPayslipsFromApi() {
  const res = await dataSource.payslips.list({ per_page: 200 });
  payslipsData = (res.data || []).map(normalizePayslip);
  updateFilterUI();
  renderPayslips();
}

async function loadArchivedPayslipsFromApi() {
  const res = await dataSource.payslips.list({ per_page: 200, only_archived: 1 });
  archivedPayslips = (res.data || []).map(normalizePayslip);
  renderArchivedPayslips();
}

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
  payslipPage: {
    get: () => payslipPage,
    set: (value) => { payslipPage = Number(value) || 1; },
  },
  payslipArchivePage: {
    get: () => payslipArchivePage,
    set: (value) => { payslipArchivePage = Number(value) || 1; },
  },
  searchQuery: {
    get: () => searchQuery,
    set: (value) => { searchQuery = String(value ?? ''); },
  },
  payslipSearchQuery: {
    get: () => payslipSearchQuery,
    set: (value) => { payslipSearchQuery = String(value ?? ''); },
  },
});

function getPageTitle(pageId) {
  const titles = {
    profilePage: 'LRA Profile',
    userManagementPage: 'LRA Users',
    payslipManagementPage: 'LRA Payslips',
    auditLogsPage: 'LRA Activity Logs',
  };

  return titles[pageId] || 'LRA User Management System';
}

function updatePageTitle(pageId) {
  document.title = getPageTitle(pageId);
}

function roleToBadgeClass(role) {
  return String(role ?? '')
    .toLowerCase()
    .trim()
    .replace(/\s+/g, '-')
    .replace(/[^a-z0-9-]/g, '');
}

// ===== NAVIGATION =====
function navigate(pageId) {
  document.querySelectorAll('.page').forEach(p => p.classList.remove('active'));
  document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
  document.getElementById(pageId).classList.add('active');
  document.querySelector(`[data-page="${pageId}"]`).classList.add('active');
  updatePageTitle(pageId);
  localStorage.setItem('activePage', pageId);
  localStorage.removeItem('activeSubPanel');

  // Always reset User Management back to the main list when navigating away and back
  if (pageId === 'userManagementPage') {
    document.getElementById('archiveListPanel').style.display = 'none';
    document.getElementById('userManagementMain').style.display = 'block';
  }
  // Always reset Payslip Management back to main list when navigating
  if (pageId === 'payslipManagementPage') {
    document.getElementById('payslipArchivePanel').style.display = 'none';
    document.getElementById('payslipManagementMain').style.display = 'block';
  }
}

// ===== ARCHIVE LIST VIEW =====
// Shows the archive list panel inside the User Management page
async function openArchiveList() {
  document.getElementById('userManagementMain').style.display = 'none';
  document.getElementById('archiveListPanel').style.display = 'block';
  archivePage = 1;
  renderArchive();
  updateBulkActionUI();
  localStorage.setItem('activeSubPanel', 'userArchiveList');
}

function closeArchiveList() {
  document.getElementById('archiveListPanel').style.display = 'none';
  document.getElementById('userManagementMain').style.display = 'block';
  updateBulkActionUI();
  localStorage.removeItem('activeSubPanel');
}

function getVisibleUserRows() {
  const data = getFilteredUsers();
  const totalPages = Math.max(1, Math.ceil(data.length / ROWS_PER_PAGE));
  if (currentPage > totalPages) currentPage = totalPages;
  return data.slice((currentPage - 1) * ROWS_PER_PAGE, currentPage * ROWS_PER_PAGE);
}

function getVisibleArchivedRows() {
  const data = getFilteredArchive();
  const totalPages = Math.max(1, Math.ceil(data.length / ROWS_PER_PAGE));
  if (archivePage > totalPages) archivePage = totalPages;
  return data.slice((archivePage - 1) * ROWS_PER_PAGE, archivePage * ROWS_PER_PAGE);
}

function setBulkActionsVisible(element, isVisible) {
  if (!element) return;

  const currentlyVisible = element.style.display !== 'none';

  if (isVisible && !currentlyVisible) {
    element.style.display = 'flex';

    // Let the browser paint first so the transition can animate in.
    requestAnimationFrame(() => {
      element.classList.add('bulk-actions-visible');
    });
  }

  if (!isVisible && currentlyVisible) {
    element.classList.remove('bulk-actions-visible');
    element.style.display = 'none';
  }
}

function updateBulkActionUI() {
  const userBulk = document.getElementById('userBulkActions');
  const userCount = document.getElementById('userSelectedCount');
  const archiveBulk = document.getElementById('archiveBulkActions');
  const archiveCount = document.getElementById('archiveSelectedCount');
  const payslipBulk = document.getElementById('payslipBulkActions');
  const payslipCount = document.getElementById('payslipSelectedCount');
  const payslipArchiveBulk = document.getElementById('payslipArchiveBulkActions');
  const payslipArchiveCount = document.getElementById('payslipArchiveSelectedCount');

  if (userBulk && userCount) {
    setBulkActionsVisible(userBulk, selectedUserIds.size > 0);
    userCount.textContent = `${selectedUserIds.size} selected`;
  }

  if (archiveBulk && archiveCount) {
    setBulkActionsVisible(archiveBulk, selectedArchivedUserIds.size > 0);
    archiveCount.textContent = `${selectedArchivedUserIds.size} selected`;
  }

  if (payslipBulk && payslipCount) {
    setBulkActionsVisible(payslipBulk, selectedPayslipIds.size > 0);
    payslipCount.textContent = `${selectedPayslipIds.size} selected`;
  }

  if (payslipArchiveBulk && payslipArchiveCount) {
    setBulkActionsVisible(payslipArchiveBulk, selectedArchivedPayslipIds.size > 0);
    payslipArchiveCount.textContent = `${selectedArchivedPayslipIds.size} selected`;
  }
}

function updateSelectAllState(checkboxId, selectedSet, visibleRows) {
  const checkbox = document.getElementById(checkboxId);
  if (!checkbox) return;

  const visibleIds = visibleRows.map((u) => u.id);
  const selectedVisibleCount = visibleIds.filter((id) => selectedSet.has(id)).length;
  const hasVisible = visibleIds.length > 0;

  checkbox.checked = hasVisible && selectedVisibleCount === visibleIds.length;
  checkbox.indeterminate = hasVisible && selectedVisibleCount > 0 && selectedVisibleCount < visibleIds.length;
}

function toggleUserSelection(userId, checked) {
  if (checked) selectedUserIds.add(userId);
  else selectedUserIds.delete(userId);

  updateSelectAllState('userSelectAllCheckbox', selectedUserIds, getVisibleUserRows());
  updateBulkActionUI();
}

function toggleArchivedSelection(userId, checked) {
  if (checked) selectedArchivedUserIds.add(userId);
  else selectedArchivedUserIds.delete(userId);

  updateSelectAllState('archiveSelectAllCheckbox', selectedArchivedUserIds, getVisibleArchivedRows());
  updateBulkActionUI();
}

function toggleSelectAllVisibleUsers(checked) {
  const visibleRows = getVisibleUserRows();
  visibleRows.forEach((u) => {
    if (checked) selectedUserIds.add(u.id);
    else selectedUserIds.delete(u.id);
  });
  renderUsers();
  updateBulkActionUI();
}

function toggleSelectAllVisibleArchived(checked) {
  const visibleRows = getVisibleArchivedRows();
  visibleRows.forEach((u) => {
    if (checked) selectedArchivedUserIds.add(u.id);
    else selectedArchivedUserIds.delete(u.id);
  });
  renderArchive();
  updateBulkActionUI();
}

function clearUserSelection() {
  selectedUserIds.clear();
  renderUsers();
  updateBulkActionUI();
}

function clearArchivedSelection() {
  selectedArchivedUserIds.clear();
  renderArchive();
  updateBulkActionUI();
}

function bulkArchiveSelectedUsers() {
  if (selectedUserIds.size === 0) return;

  const selectedUsers = usersData.filter((u) => selectedUserIds.has(u.id));
  if (selectedUsers.length === 0) {
    selectedUserIds.clear();
    updateBulkActionUI();
    renderUsers();
    return;
  }

  const bulkArchiveCount = document.getElementById('bulkArchiveCount');
  if (bulkArchiveCount) bulkArchiveCount.textContent = `${selectedUsers.length} selected user(s)`;

  openModal('bulkArchiveModal');
}

async function confirmBulkArchive() {
  if (selectedUserIds.size === 0) {
    closeModal('bulkArchiveModal');
    return;
  }

  const selectedIds = Array.from(selectedUserIds);
  closeModal('bulkArchiveModal');

  try {
    await Promise.all(selectedIds.map((id) => dataSource.users.archive(id)));
    selectedUserIds.clear();
    selectedArchivedUserIds.clear();
    await Promise.all([loadUsersFromApi(), loadArchivedUsersFromApi()]);
    updateBulkActionUI();
    showToast(`${selectedIds.length} user(s) archived successfully.`, 'info');
  } catch (e) {
    showToast(e.message || 'Failed to archive selected users.', 'error');
  }
}

function bulkUnarchiveSelectedUsers() {
  if (selectedArchivedUserIds.size === 0) return;

  const selectedUsers = archivedUsers.filter((u) => selectedArchivedUserIds.has(u.id));
  if (selectedUsers.length === 0) {
    selectedArchivedUserIds.clear();
    updateBulkActionUI();
    renderArchive();
    return;
  }

  const bulkUnarchiveCount = document.getElementById('bulkUnarchiveCount');
  if (bulkUnarchiveCount) bulkUnarchiveCount.textContent = `${selectedUsers.length} selected user(s)`;

  openModal('bulkUnarchiveModal');
}

async function confirmBulkUnarchive() {
  if (selectedArchivedUserIds.size === 0) {
    closeModal('bulkUnarchiveModal');
    return;
  }

  closeModal('bulkUnarchiveModal');

  const selectedIds = Array.from(selectedArchivedUserIds);

  try {
    await Promise.all(selectedIds.map((id) => dataSource.users.unarchive(id)));
    selectedUserIds.clear();
    selectedArchivedUserIds.clear();
    await Promise.all([loadUsersFromApi(), loadArchivedUsersFromApi()]);
    updateBulkActionUI();
    showToast(`${selectedIds.length} user(s) unarchived successfully.`, 'success');
  } catch (e) {
    showToast(e.message || 'Failed to unarchive selected users.', 'error');
  }
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
      <td>
        <input
          type="checkbox"
          class="table-select-checkbox"
          onchange="toggleUserSelection(${u.id}, this.checked)"
          ${selectedUserIds.has(u.id) ? 'checked' : ''}
        />
      </td>
      <td>${u.empId}</td>
      <td>${u.lastName}, ${u.firstName} ${u.middleName ? u.middleName.charAt(0) + '.' : ''}</td>
      <td>${u.email}</td>
      <td>${u.username}</td>
      <td><span class="badge badge-${roleToBadgeClass(u.role)}">${u.role}</span></td>
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
          <button class="btn-delete" onclick="openDeleteUserModal(${u.id})" title="Delete">
            ${iconTrash}
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
    tr.innerHTML = '<td colspan="8"></td>';
    tbody.appendChild(tr);
  }

  updateSelectAllState('userSelectAllCheckbox', selectedUserIds, pageData);
  updateBulkActionUI();

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
      <td>
        <input
          type="checkbox"
          class="table-select-checkbox"
          onchange="toggleArchivedSelection(${u.id}, this.checked)"
          ${selectedArchivedUserIds.has(u.id) ? 'checked' : ''}
        />
      </td>
      <td>${u.empId}</td>
      <td>${u.lastName}, ${u.firstName} ${u.middleName ? u.middleName.charAt(0) + '.' : ''}</td>
      <td>${u.email}</td>
      <td>${u.username}</td>
      <td><span class="badge badge-${roleToBadgeClass(u.role)}">${u.role}</span></td>
      <td>
        <div class="action-btns">
          <button class="btn-unarchive" onclick="openUnarchiveModal(${u.id})" title="Unarchive">Unarchive</button>
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

  updateSelectAllState('archiveSelectAllCheckbox', selectedArchivedUserIds, pageData);
  updateBulkActionUI();

  renderPagination('archivePagination', totalPages, archivePage, (p) => { archivePage = p; renderArchive(); });
}

function openUnarchiveModal(userId) {
  selectedArchivedUser = archivedUsers.find(u => u.id === userId);
  if (!selectedArchivedUser) return;

  document.getElementById('unarchiveUserName').textContent = `${selectedArchivedUser.firstName} ${selectedArchivedUser.lastName}`;
  openModal('unarchiveModal');
}

async function confirmUnarchive() {
  if (!selectedArchivedUser) return;

  closeModal('unarchiveModal');

  try {
    await dataSource.users.unarchive(selectedArchivedUser.id);
    selectedArchivedUserIds.delete(selectedArchivedUser.id);
    selectedArchivedUser = null;
    await Promise.all([loadUsersFromApi(), loadArchivedUsersFromApi()]);
    showToast('User unarchived successfully.', 'success');
  } catch (e) {
    showToast(e.message || 'Failed to unarchive user.', 'error');
  }
}

function unarchiveUser() {}

// ===== RENDER AUDIT TABLE =====
function getFilteredAudit() {
  let data = [...auditData];
  const q = document.getElementById('auditSearch')?.value?.toLowerCase() || '';
  const sd = document.getElementById('startDate')?.value;
  const ed = document.getElementById('endDate')?.value;
  const fr = document.getElementById('auditFilterRole')?.value || 'all';

  if (q) data = data.filter(a => a.empId.toLowerCase().includes(q) || a.name.toLowerCase().includes(q));
  if (sd) {
    const start = new Date(`${sd}T00:00:00`);
    data = data.filter((a) => {
      const d = parseDateTime(a.timestampRaw || a.timestamp);
      return d ? d >= start : true;
    });
  }
  if (ed) {
    const end = new Date(`${ed}T23:59:59`);
    data = data.filter((a) => {
      const d = parseDateTime(a.timestampRaw || a.timestamp);
      return d ? d <= end : true;
    });
  }
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
  addEmailDomainToastShown = false;
  Object.keys(duplicateToastShown).forEach((key) => { duplicateToastShown[key] = false; });
  clearFormValidation('add');
  updateFormButtons();
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
  document.getElementById('editOffice').value = String(user.officeId ?? '');
  document.getElementById('editRole').value = String(user.roleId ?? '');
  document.getElementById('editStatus').value = user.status || 'Active';
  duplicateToastShown.editEmpId = false;
  duplicateToastShown.editUsername = false;
  duplicateToastShown.editEmail = false;
  clearFormValidation('edit');
  updateFormButtons();
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

async function confirmArchive() {
  if (!selectedUser) return;

  try {
    await dataSource.users.archive(selectedUser.id);
    selectedUserIds.delete(selectedUser.id);
    closeModal('archiveModal');
    selectedUser = null;
    await Promise.all([loadUsersFromApi(), loadArchivedUsersFromApi()]);
    updateBulkActionUI();
    showToast('User archived successfully.', 'info');
  } catch (e) {
    showToast(e.message || 'Failed to archive user.', 'error');
  }
}

// ===== DELETE USER =====
let userToDelete = null;

function openDeleteUserModal(userId) {
  userToDelete = usersData.find(u => u.id === userId);
  if (!userToDelete) return;
  document.getElementById('deleteUserName').textContent = `${userToDelete.firstName} ${userToDelete.lastName}`;
  openModal('deleteUserModal');
}

async function confirmDeleteUser() {
  if (!userToDelete) return;

  closeModal('deleteUserModal');

  try {
    const res = await dataSource.users.softDelete(userToDelete.id);
    selectedUserIds.delete(userToDelete.id);
    selectedArchivedUserIds.delete(userToDelete.id);
    userToDelete = null;
    await Promise.all([loadUsersFromApi(), loadArchivedUsersFromApi()]);
    updateBulkActionUI();
    showToast(res?.message || 'User deleted successfully.', 'success');
  } catch (e) {
    showToast(e.message || 'Failed to delete user.', 'error');
  }
}

function formatPersonName(value, trimEdges = true) {
  const formatted = String(value ?? '')
    .toLowerCase()
    .replace(/(^|[\s'-])([a-z])/g, (match, separator, letter) => `${separator}${letter.toUpperCase()}`);

  return trimEdges ? formatted.trim() : formatted;
}

function normalizeNameInput(fieldId, trimEdges = false) {
  const input = document.getElementById(fieldId);
  if (!input) return;

  const formatted = formatPersonName(input.value, trimEdges);
  if (input.value !== formatted) input.value = formatted;
}

async function saveAddUser() {
  if (!validateAddForm(true)) {
    showToast('Please complete all required fields correctly.', 'error');
    return;
  }

  const fn = formatPersonName(document.getElementById('addFirstName').value);
  const mn = formatPersonName(document.getElementById('addMiddleName').value);
  const ln = formatPersonName(document.getElementById('addLastName').value);

  document.getElementById('addFirstName').value = fn;
  document.getElementById('addMiddleName').value = mn;
  document.getElementById('addLastName').value = ln;

  const addRoleId = Number(document.getElementById('addRole').value);
  const addOfficeId = Number(document.getElementById('addOffice').value);

  if (!addRoleId || !addOfficeId) {
    showToast('Please select valid role and office.', 'error');
    return;
  }

  try {
    await dataSource.users.create({
      employee_id: document.getElementById('addEmpId').value.trim(),
      first_name: fn,
      middle_name: mn || null,
      last_name: ln,
      designation: document.getElementById('addDesignation').value.trim() || null,
      username: document.getElementById('addUsername').value.trim(),
      email: document.getElementById('addEmail').value.trim(),
      password: document.getElementById('addPassword').value.trim(),
      office_id: addOfficeId,
      role_id: addRoleId,
      is_active: true,
    });

    closeModal('addUserModal');
    currentPage = 1;
    await loadUsersFromApi();
    showToast('User account created successfully!', 'success');
  } catch (e) {
    showToast(e.message || 'Failed to create user.', 'error');
  }
}

async function saveEditUser() {
  const editSaveBtn = document.getElementById('editUserSaveBtn');
  if (editSaveBtn?.disabled) return;

  if (!validateEditForm(true)) {
    showToast('Please complete all required fields correctly.', 'error');
    return;
  }

  try {
    if (!selectedUser) return;

    const editFirstName = formatPersonName(document.getElementById('editFirstName').value);
    const editMiddleName = formatPersonName(document.getElementById('editMiddleName').value);
    const editLastName = formatPersonName(document.getElementById('editLastName').value);

    document.getElementById('editFirstName').value = editFirstName;
    document.getElementById('editMiddleName').value = editMiddleName;
    document.getElementById('editLastName').value = editLastName;

    const editRoleId = Number(document.getElementById('editRole').value);
    const editOfficeId = Number(document.getElementById('editOffice').value);
    if (!editRoleId || !editOfficeId) {
      showToast('Please select valid role and office.', 'error');
      return;
    }

    await dataSource.users.update(selectedUser.id, {
      employee_id: document.getElementById('editEmpId').value.trim(),
      first_name: editFirstName,
      middle_name: editMiddleName || null,
      last_name: editLastName,
      designation: document.getElementById('editDesignation').value.trim() || null,
      username: document.getElementById('editUsername').value.trim(),
      email: document.getElementById('editEmail').value.trim(),
      office_id: editOfficeId,
      role_id: editRoleId,
      is_active: (document.getElementById('editStatus').value || 'Active') === 'Active',
    });

    closeModal('editUserModal');
    await loadUsersFromApi();
    showToast('User profile updated successfully.', 'success');
    selectedUser = null;
  } catch (e) {
    showToast(e.message || 'Failed to update user.', 'error');
  }
}

// ===== GENERATE PASSWORD =====
function generatePassword() {
  const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@#$!';
  let pwd = '';
  for (let i = 0; i < 12; i++) pwd += chars[Math.floor(Math.random() * chars.length)];
  document.getElementById('addPassword').value = pwd;
  validateAddForm(true);
  updateFormButtons();
}

function getFieldErrorElement(fieldId) {
  let err = document.querySelector(`.field-error[data-for="${fieldId}"]`);
  if (err) return err;

  const input = document.getElementById(fieldId);
  if (!input) return null;

  const group = input.closest('.form-group');
  if (!group) return null;

  err = document.createElement('div');
  err.className = 'field-error';
  err.setAttribute('data-for', fieldId);
  group.appendChild(err);
  return err;
}

function setFieldError(fieldId, message) {
  const input = document.getElementById(fieldId);
  const err = getFieldErrorElement(fieldId);
  if (!input || !err) return;

  if (message) {
    input.classList.add('field-invalid');
    err.innerHTML = `<span class="field-error-icon" aria-hidden="true">!</span><span class="field-error-text">${message}</span>`;
  } else {
    input.classList.remove('field-invalid');
    err.innerHTML = '';
  }
}

function validateRequired(fieldId, label) {
  const input = document.getElementById(fieldId);
  if (!input) return true;
  if (!input.value.trim()) {
    setFieldError(fieldId, `${label} is required. Please provide a valid value.`);
    return false;
  }
  setFieldError(fieldId, '');
  return true;
}

function normalizeValue(value) {
  return String(value ?? '').trim().toLowerCase();
}

function hasDuplicate(field, value, excludeUserId = null) {
  const normalized = normalizeValue(value);
  if (!normalized) return false;

  return usersData.some((u) => {
    if (excludeUserId !== null && u.id === excludeUserId) return false;
    return normalizeValue(u[field]) === normalized;
  });
}

function validateUniqueField(fieldId, userField, label, excludeUserId = null) {
  const input = document.getElementById(fieldId);
  if (!input) return true;

  const value = input.value.trim();
  if (!value) return true;

  const duplicate = hasDuplicate(userField, value, excludeUserId);
  if (duplicate) {
    setFieldError(fieldId, `${label} already exists. Please use a different ${label}.`);
    return false;
  }

  return true;
}

function validateEmailField(fieldId) {
  const input = document.getElementById(fieldId);
  if (!input) return true;

  const value = input.value.trim();
  if (!value) {
    setFieldError(fieldId, 'Email is required. Please enter your official email address.');
    return false;
  }

  const validFormat = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
  if (!validFormat) {
    setFieldError(fieldId, 'Invalid email format. Use a valid address like name@lra.gov.ph.');
    return false;
  }

  const lower = value.toLowerCase();
  // Allow editing seeded/legacy users without forcing an email change first.
  if (
    fieldId === 'editEmail' &&
    selectedUser &&
    lower === String(selectedUser.email || '').trim().toLowerCase()
  ) {
    setFieldError(fieldId, '');
    return true;
  }

  if (!lower.endsWith(`@${REQUIRED_EMAIL_DOMAIN}`)) {
    setFieldError(fieldId, `Email should use @${REQUIRED_EMAIL_DOMAIN} only.`);
    return false;
  }

  if (fieldId === 'addEmail') addEmailDomainToastShown = false;
  setFieldError(fieldId, '');
  return true;
}

function notifyWrongAddEmailDomain() {
  const input = document.getElementById('addEmail');
  if (!input) return;

  const value = input.value.trim().toLowerCase();
  const atIndex = value.indexOf('@');

  // Don't show domain toast while the user is still typing the required domain.
  let wrongDomain = false;
  if (atIndex > 0 && atIndex < value.length - 1) {
    const localPart = value.slice(0, atIndex);
    const domainPart = value.slice(atIndex + 1);
    const required = REQUIRED_EMAIL_DOMAIN.toLowerCase();
    const isExactRequired = domainPart === required;
    const isTypingRequiredDomain = required.startsWith(domainPart);
    const isCompleteDomain = /^[a-z0-9.-]+\.[a-z]{2,}$/.test(domainPart);

    wrongDomain = Boolean(localPart) && isCompleteDomain && !isExactRequired && !isTypingRequiredDomain;
  }

  if (wrongDomain && !addEmailDomainToastShown) {
    showToast(`Invalid email domain. Email should use @${REQUIRED_EMAIL_DOMAIN} only.`, 'error');
    addEmailDomainToastShown = true;
  }

  if (!wrongDomain) {
    addEmailDomainToastShown = false;
  }
}

function notifyDuplicateField(fieldId, userField, label, excludeUserId = null) {
  const input = document.getElementById(fieldId);
  if (!input) return;

  const value = input.value.trim();
  const duplicate = value && hasDuplicate(userField, value, excludeUserId);

  if (duplicate && !duplicateToastShown[fieldId]) {
    showToast(`Duplicate ${label}. Please use a different ${label}.`, 'error');
    duplicateToastShown[fieldId] = true;
  }

  if (!duplicate) {
    duplicateToastShown[fieldId] = false;
  }
}

function validateAddForm(showErrors = true) {
  const checks = [
    ['addFirstName', 'First Name'],
    ['addLastName', 'Last Name'],
    ['addEmpId', 'Employee ID'],
    ['addUsername', 'Username'],
    ['addPassword', 'Password'],
    ['addDesignation', 'Designation / Position'],
    ['addOffice', 'Office / Department / Division'],
    ['addRole', 'Account Role'],
  ];

  let valid = true;
  checks.forEach(([fieldId, label]) => {
    const ok = validateRequired(fieldId, label);
    if (!ok && !showErrors) setFieldError(fieldId, '');
    valid = ok && valid;
  });

  const emailOk = validateEmailField('addEmail');
  if (!emailOk && !showErrors) setFieldError('addEmail', '');
  valid = emailOk && valid;

  const uniqueEmpIdOk = validateUniqueField('addEmpId', 'empId', 'Employee ID');
  if (!uniqueEmpIdOk && !showErrors) setFieldError('addEmpId', '');
  valid = uniqueEmpIdOk && valid;

  const uniqueUsernameOk = validateUniqueField('addUsername', 'username', 'Username');
  if (!uniqueUsernameOk && !showErrors) setFieldError('addUsername', '');
  valid = uniqueUsernameOk && valid;

  const uniqueEmailOk = validateUniqueField('addEmail', 'email', 'Email');
  if (!uniqueEmailOk && !showErrors) setFieldError('addEmail', '');
  valid = uniqueEmailOk && valid;

  return valid;
}

function validateAddField(fieldId, showErrors = true) {
  const labels = {
    addFirstName: 'First Name',
    addLastName: 'Last Name',
    addEmpId: 'Employee ID',
    addUsername: 'Username',
    addPassword: 'Password',
    addDesignation: 'Designation / Position',
    addOffice: 'Office / Department / Division',
    addRole: 'Account Role',
  };

  if (fieldId === 'addEmail') {
    const ok = validateEmailField('addEmail');
    if (!ok && !showErrors) setFieldError('addEmail', '');
    if (!ok) return ok;

    const uniqueEmailOk = validateUniqueField('addEmail', 'email', 'Email');
    if (!uniqueEmailOk && !showErrors) setFieldError('addEmail', '');
    return uniqueEmailOk;
  }

  if (fieldId === 'addEmpId') {
    const requiredOk = validateRequired('addEmpId', 'Employee ID');
    if (!requiredOk) return false;
    const uniqueEmpIdOk = validateUniqueField('addEmpId', 'empId', 'Employee ID');
    if (!uniqueEmpIdOk && !showErrors) setFieldError('addEmpId', '');
    return uniqueEmpIdOk;
  }

  if (fieldId === 'addUsername') {
    const requiredOk = validateRequired('addUsername', 'Username');
    if (!requiredOk) return false;
    const uniqueUsernameOk = validateUniqueField('addUsername', 'username', 'Username');
    if (!uniqueUsernameOk && !showErrors) setFieldError('addUsername', '');
    return uniqueUsernameOk;
  }

  {
    const label = labels[fieldId];
    if (!label) return true;
    const ok = validateRequired(fieldId, label);
    if (!ok && !showErrors) setFieldError(fieldId, '');
    return ok;
  }
}

function validateEditForm(showErrors = true) {
  const checks = [
    ['editFirstName', 'First Name'],
    ['editLastName', 'Last Name'],
    ['editUsername', 'Username'],
    ['editDesignation', 'Designation / Position'],
    ['editOffice', 'Office / Department / Division'],
    ['editRole', 'Account Role'],
    ['editStatus', 'Status'],
  ];

  let valid = true;
  checks.forEach(([fieldId, label]) => {
    const ok = validateRequired(fieldId, label);
    if (!ok && !showErrors) setFieldError(fieldId, '');
    valid = ok && valid;
  });

  const emailOk = validateEmailField('editEmail');
  if (!emailOk && !showErrors) setFieldError('editEmail', '');
  valid = emailOk && valid;

  const excludeId = selectedUser?.id ?? null;
  const uniqueEmpIdOk = validateUniqueField('editEmpId', 'empId', 'Employee ID', excludeId);
  if (!uniqueEmpIdOk && !showErrors) setFieldError('editEmpId', '');
  valid = uniqueEmpIdOk && valid;

  const uniqueUsernameOk = validateUniqueField('editUsername', 'username', 'Username', excludeId);
  if (!uniqueUsernameOk && !showErrors) setFieldError('editUsername', '');
  valid = uniqueUsernameOk && valid;

  const uniqueEmailOk = validateUniqueField('editEmail', 'email', 'Email', excludeId);
  if (!uniqueEmailOk && !showErrors) setFieldError('editEmail', '');
  valid = uniqueEmailOk && valid;

  return valid;
}

function validateEditField(fieldId, showErrors = true) {
  const labels = {
    editFirstName: 'First Name',
    editLastName: 'Last Name',
    editUsername: 'Username',
    editDesignation: 'Designation / Position',
    editOffice: 'Office / Department / Division',
    editRole: 'Account Role',
    editStatus: 'Status',
  };

  if (fieldId === 'editEmail') {
    const ok = validateEmailField('editEmail');
    if (!ok && !showErrors) setFieldError('editEmail', '');
    if (!ok) return ok;

    const uniqueEmailOk = validateUniqueField('editEmail', 'email', 'Email', selectedUser?.id ?? null);
    if (!uniqueEmailOk && !showErrors) setFieldError('editEmail', '');
    return uniqueEmailOk;
  }

  if (fieldId === 'editEmpId') {
    const uniqueEmpIdOk = validateUniqueField('editEmpId', 'empId', 'Employee ID', selectedUser?.id ?? null);
    if (!uniqueEmpIdOk && !showErrors) setFieldError('editEmpId', '');
    return uniqueEmpIdOk;
  }

  if (fieldId === 'editUsername') {
    const requiredOk = validateRequired('editUsername', 'Username');
    if (!requiredOk) return false;
    const uniqueUsernameOk = validateUniqueField('editUsername', 'username', 'Username', selectedUser?.id ?? null);
    if (!uniqueUsernameOk && !showErrors) setFieldError('editUsername', '');
    return uniqueUsernameOk;
  }

  const label = labels[fieldId];
  if (!label) return true;
  const ok = validateRequired(fieldId, label);
  if (!ok && !showErrors) setFieldError(fieldId, '');
  return ok;
}

function clearFormValidation(prefix) {
  document.querySelectorAll(`.field-error[data-for^="${prefix}"]`).forEach(el => {
    el.textContent = '';
  });
  document.querySelectorAll(`[id^="${prefix}"]`).forEach(el => {
    el.classList.remove('field-invalid');
  });
}

function updateFormButtons() {
  const addBtn = document.getElementById('addUserSaveBtn');
  const editBtn = document.getElementById('editUserSaveBtn');

  if (addBtn) addBtn.disabled = !validateAddForm(false);
  if (editBtn) editBtn.disabled = !validateEditForm(false);
}

function bindValidationEvents() {
  const nameFields = [
    'addFirstName', 'addMiddleName', 'addLastName',
    'editFirstName', 'editMiddleName', 'editLastName',
  ];

  nameFields.forEach((fieldId) => {
    const el = document.getElementById(fieldId);
    if (!el) return;

    el.addEventListener('input', () => {
      normalizeNameInput(fieldId, false);
    });

    el.addEventListener('blur', () => {
      normalizeNameInput(fieldId, true);
    });
  });

  const addFields = [
    'addFirstName', 'addLastName', 'addEmail', 'addEmpId',
    'addUsername', 'addPassword', 'addDesignation', 'addOffice', 'addRole',
  ];
  const editFields = [
    'editFirstName', 'editLastName', 'editEmail', 'editUsername',
    'editDesignation', 'editOffice', 'editRole', 'editStatus',
  ];

  [...addFields, ...editFields].forEach((fieldId) => {
    const el = document.getElementById(fieldId);
    if (!el) return;

    const eventType = el.tagName === 'SELECT' ? 'change' : 'input';
    el.addEventListener(eventType, () => {
      if (fieldId.startsWith('add')) validateAddField(fieldId, true);
      else validateEditField(fieldId, true);
      if (fieldId === 'addEmail') notifyWrongAddEmailDomain();
      if (fieldId === 'addEmpId') notifyDuplicateField('addEmpId', 'empId', 'Employee ID');
      if (fieldId === 'addUsername') notifyDuplicateField('addUsername', 'username', 'Username');
      if (fieldId === 'addEmail') notifyDuplicateField('addEmail', 'email', 'Email');
      if (fieldId === 'editEmpId') notifyDuplicateField('editEmpId', 'empId', 'Employee ID', selectedUser?.id ?? null);
      if (fieldId === 'editUsername') notifyDuplicateField('editUsername', 'username', 'Username', selectedUser?.id ?? null);
      if (fieldId === 'editEmail') notifyDuplicateField('editEmail', 'email', 'Email', selectedUser?.id ?? null);
      updateFormButtons();
    });

    el.addEventListener('blur', () => {
      if (fieldId.startsWith('add')) validateAddField(fieldId, true);
      else validateEditField(fieldId, true);
      if (fieldId === 'addEmail') notifyWrongAddEmailDomain();
      if (fieldId === 'addEmpId') notifyDuplicateField('addEmpId', 'empId', 'Employee ID');
      if (fieldId === 'addUsername') notifyDuplicateField('addUsername', 'username', 'Username');
      if (fieldId === 'addEmail') notifyDuplicateField('addEmail', 'email', 'Email');
      if (fieldId === 'editEmpId') notifyDuplicateField('editEmpId', 'empId', 'Employee ID', selectedUser?.id ?? null);
      if (fieldId === 'editUsername') notifyDuplicateField('editUsername', 'username', 'Username', selectedUser?.id ?? null);
      if (fieldId === 'editEmail') notifyDuplicateField('editEmail', 'email', 'Email', selectedUser?.id ?? null);
      updateFormButtons();
    });
  });
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

function getFormattedDateTime() {
  return new Date().toLocaleString('en-PH', {
    year: 'numeric',
    month: 'short',
    day: '2-digit',
    hour: '2-digit',
    minute: '2-digit',
    second: '2-digit',
    hour12: true,
  });
}

function renderLastVisited() {
  const stamp = getFormattedDateTime();
  const adminEl = document.getElementById('adminLastVisited');
  const userEl = document.getElementById('userLastVisited');

  if (adminEl) adminEl.textContent = stamp;
  if (userEl) userEl.textContent = stamp;
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

// ===== PAYSLIP FUNCTIONS =====

function openPayslipArchiveList() {
  document.getElementById('payslipManagementMain').style.display = 'none';
  document.getElementById('payslipArchivePanel').style.display = 'block';
  payslipArchivePage = 1;
  renderArchivedPayslips();
  updateBulkActionUI();
  localStorage.setItem('activeSubPanel', 'payslipArchiveList');
}

function closePayslipArchiveList() {
  document.getElementById('payslipArchivePanel').style.display = 'none';
  document.getElementById('payslipManagementMain').style.display = 'block';
  updateBulkActionUI();
  localStorage.removeItem('activeSubPanel');
}

function formatPayDate(dateStr) {
  if (!dateStr) return '';
  const d = new Date(dateStr + 'T00:00:00');
  if (isNaN(d.getTime())) return dateStr;
  return d.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
}

function getFilteredPayslips() {
  let data = [...payslipsData];
  const q = (document.getElementById('payslipSearch')?.value || payslipSearchQuery).toLowerCase();
  if (q) {
    data = data.filter(p =>
      p.empId.toLowerCase().includes(q) ||
      (p.name || '').toLowerCase().includes(q) ||
      (p.department || '').toLowerCase().includes(q) ||
      (p.designation || '').toLowerCase().includes(q)
    );
  }
  
  // Apply department filter
  if (payslipDepartmentFilter) {
    data = data.filter(p => p.department === payslipDepartmentFilter);
  }
  
  // Apply month/year filters independently.
  if (payslipMonthFilter || payslipYearFilter) {
    data = data.filter((p) => {
      if (!p.payPeriod) return false;
      const [payYear, payMonth] = String(p.payPeriod).split('-');
      const monthMatches = !payslipMonthFilter || payMonth === payslipMonthFilter;
      const yearMatches = !payslipYearFilter || payYear === payslipYearFilter;
      return monthMatches && yearMatches;
    });
  }
  
  return data;
}

function renderPayslips() {
  const data = getFilteredPayslips();
  const totalPages = Math.max(1, Math.ceil(data.length / ROWS_PER_PAGE));
  if (payslipPage > totalPages) payslipPage = totalPages;
  const pageData = data.slice((payslipPage - 1) * ROWS_PER_PAGE, payslipPage * ROWS_PER_PAGE);
  const tbody = document.getElementById('payslipTableBody');
  if (!tbody) return;
  tbody.innerHTML = '';

  pageData.forEach(p => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>
        <input
          type="checkbox"
          class="table-select-checkbox"
          onchange="togglePayslipSelection(${p.id}, this.checked)"
          ${selectedPayslipIds.has(p.id) ? 'checked' : ''}
        />
      </td>
      <td>${p.empId}</td>
      <td>${p.name || ''}</td>
      <td>${p.department || ''}</td>
      <td>${p.designation || ''}</td>
      <td>${formatPayDate(p.payPeriod)}</td>
      <td>
        <div class="action-btns">
          <button class="btn-edit" onclick="openEditPayslipModal(${p.id})" title="Edit">
            ${iconEdit}
          </button>
          <button class="btn-print" onclick="printPayslip(${p.id})" title="Print Payslip">
            ${iconPrint}
          </button>
          <button class="btn-archive" onclick="openArchivePayslipModal(${p.id})" title="Archive">
            ${iconArchive}
          </button>
          <button class="btn-delete" onclick="openDeletePayslipModal(${p.id})" title="Delete">
            ${iconTrash}
          </button>
        </div>
      </td>
    `;
    tbody.appendChild(tr);
  });

  const emptyCount = ROWS_PER_PAGE - pageData.length;
  for (let i = 0; i < emptyCount; i++) {
    const tr = document.createElement('tr');
    tr.className = 'empty-row';
    tr.innerHTML = '<td colspan="7"></td>';
    tbody.appendChild(tr);
  }

  updateSelectAllState('payslipSelectAllCheckbox', selectedPayslipIds, pageData);
  updateBulkActionUI();

  renderPagination('payslipPagination', totalPages, payslipPage, (p) => { payslipPage = p; renderPayslips(); });
}

function getFilteredArchivedPayslips() {
  let data = [...archivedPayslips];
  const q = (document.getElementById('payslipArchiveSearch')?.value || '').toLowerCase();
  if (q) {
    data = data.filter(p =>
      p.empId.toLowerCase().includes(q) ||
      (p.name || '').toLowerCase().includes(q) ||
      (p.department || '').toLowerCase().includes(q) ||
      (p.designation || '').toLowerCase().includes(q)
    );
  }
  return data;
}

function renderArchivedPayslips() {
  const data = getFilteredArchivedPayslips();
  const totalPages = Math.max(1, Math.ceil(data.length / ROWS_PER_PAGE));
  if (payslipArchivePage > totalPages) payslipArchivePage = totalPages;
  const pageData = data.slice((payslipArchivePage - 1) * ROWS_PER_PAGE, payslipArchivePage * ROWS_PER_PAGE);
  const tbody = document.getElementById('payslipArchiveTableBody');
  if (!tbody) return;
  tbody.innerHTML = '';

  pageData.forEach(p => {
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>
        <input
          type="checkbox"
          class="table-select-checkbox"
          onchange="toggleArchivedPayslipSelection(${p.id}, this.checked)"
          ${selectedArchivedPayslipIds.has(p.id) ? 'checked' : ''}
        />
      </td>
      <td>${p.empId}</td>
      <td>${p.name || ''}</td>
      <td>${p.department || ''}</td>
      <td>${p.designation || ''}</td>
      <td>${formatPayDate(p.payPeriod)}</td>
      <td>
        <div class="action-btns">
          <button class="btn-unarchive" onclick="openUnarchivePayslipModal(${p.id})">Unarchive</button>
        </div>
      </td>
    `;
    tbody.appendChild(tr);
  });

  const emptyCount = ROWS_PER_PAGE - pageData.length;
  for (let i = 0; i < emptyCount; i++) {
    const tr = document.createElement('tr');
    tr.className = 'empty-row';
    tr.innerHTML = '<td colspan="7"></td>';
    tbody.appendChild(tr);
  }

  updateSelectAllState('payslipArchiveSelectAllCheckbox', selectedArchivedPayslipIds, pageData);
  updateBulkActionUI();

  renderPagination('payslipArchivePagination', totalPages, payslipArchivePage, (p) => { payslipArchivePage = p; renderArchivedPayslips(); });
}

// ===== PAYSLIP FILTERS =====
function getUniqueDepartments() {
  const departments = new Set();
  payslipsData.forEach(p => {
    if (p.department) departments.add(p.department);
  });
  return Array.from(departments).sort();
}

function getAvailableYears() {
  const years = new Set();
  payslipsData.forEach(p => {
    if (p.payPeriod) {
      const [year, month] = p.payPeriod.split('-');
      if (year && month) {
        years.add(year);
      }
    }
  });
  return Array.from(years).sort().reverse();
}

function getAllMonths() {
  return [
    { value: '01', label: 'January' },
    { value: '02', label: 'February' },
    { value: '03', label: 'March' },
    { value: '04', label: 'April' },
    { value: '05', label: 'May' },
    { value: '06', label: 'June' },
    { value: '07', label: 'July' },
    { value: '08', label: 'August' },
    { value: '09', label: 'September' },
    { value: '10', label: 'October' },
    { value: '11', label: 'November' },
    { value: '12', label: 'December' },
  ];
}

function getMonthLabel(monthValue) {
  if (!monthValue) return 'All Months';
  const match = getAllMonths().find((month) => month.value === monthValue);
  return match ? match.label : monthValue;
}

function togglePayslipDepartmentFilter() {
  const dropdown = document.getElementById('payslipDepartmentDropdown');
  if (!dropdown) {
    console.warn('payslipDepartmentDropdown not found');
    return;
  }
  
  const isVisible = dropdown.style.display === 'block';
  dropdown.style.display = isVisible ? 'none' : 'block';
  
  if (!isVisible) {
    populateDepartmentFilter();
  }
  closeOtherDropdown('department');
}

function togglePayslipMonthYearFilter() {
  const dropdown = document.getElementById('payslipMonthYearDropdown');
  if (!dropdown) {
    console.warn('payslipMonthYearDropdown not found');
    return;
  }
  
  const isVisible = dropdown.style.display === 'block';
  dropdown.style.display = isVisible ? 'none' : 'block';
  
  if (!isVisible) {
    populateMonthYearFilter();
  }
  closeOtherDropdown('month');
}

function closeOtherDropdown(keep) {
  if (keep !== 'department') {
    const deptDropdown = document.getElementById('payslipDepartmentDropdown');
    if (deptDropdown) deptDropdown.style.display = 'none';
  }
  if (keep !== 'month') {
    const monthDropdown = document.getElementById('payslipMonthYearDropdown');
    if (monthDropdown) monthDropdown.style.display = 'none';
  }
}

function populateDepartmentFilter() {
  const dropdown = document.getElementById('payslipDepartmentDropdown');
  if (!dropdown) return;
  
  const departments = getUniqueDepartments();
  dropdown.innerHTML = '';
  
  const allOption = document.createElement('div');
  allOption.style.cssText = 'padding:10px 12px;cursor:pointer;white-space:nowrap;font-size:13.5px;';
  allOption.textContent = 'All Departments';
  if (!payslipDepartmentFilter) {
    allOption.className = 'selected';
  }
  allOption.onclick = (e) => {
    e.stopPropagation();
    payslipDepartmentFilter = '';
    payslipPage = 1;
    updateFilterUI();
    renderPayslips();
    dropdown.style.display = 'none';
    populateDepartmentFilter();
  };
  dropdown.appendChild(allOption);
  
  departments.forEach(dept => {
    const option = document.createElement('div');
    option.style.cssText = 'padding:10px 12px;cursor:pointer;white-space:nowrap;font-size:13.5px;';
    option.textContent = dept;
    if (dept === payslipDepartmentFilter) {
      option.className = 'selected';
    }
    option.onclick = (e) => {
      e.stopPropagation();
      payslipDepartmentFilter = dept;
      payslipPage = 1;
      updateFilterUI();
      renderPayslips();
      dropdown.style.display = 'none';
      populateDepartmentFilter();
    };
    dropdown.appendChild(option);
  });
}

function populateMonthYearFilter() {
  const dropdown = document.getElementById('payslipMonthYearDropdown');
  if (!dropdown) return;

  const months = getAllMonths();
  const years = getAvailableYears();
  dropdown.innerHTML = '';

  const createHeader = (text) => {
    const header = document.createElement('div');
    header.style.cssText = 'padding:8px 12px;font-size:12px;font-weight:700;color:#5f6a7a;background:#f6f8fb;cursor:default;';
    header.textContent = text;
    return header;
  };

  const createOption = (text, selected, onClick) => {
    const option = document.createElement('div');
    option.style.cssText = 'padding:10px 12px;cursor:pointer;white-space:nowrap;font-size:13.5px;';
    option.textContent = text;
    if (selected) option.className = 'selected';
    option.onclick = onClick;
    return option;
  };

  dropdown.appendChild(createHeader('Month'));

  const allMonthsOption = createOption('All Months', !payslipMonthFilter, (e) => {
    e.stopPropagation();
    payslipMonthFilter = '';
    payslipPage = 1;
    updateFilterUI();
    renderPayslips();
    populateMonthYearFilter();
  });
  dropdown.appendChild(allMonthsOption);

  months.forEach(({ value, label }) => {
    const option = createOption(label, value === payslipMonthFilter, (e) => {
      e.stopPropagation();
      payslipMonthFilter = value;
      payslipPage = 1;
      updateFilterUI();
      renderPayslips();
      populateMonthYearFilter();
    });
    dropdown.appendChild(option);
  });

  dropdown.appendChild(createHeader('Year'));

  const allYearsOption = createOption('All Years', !payslipYearFilter, (e) => {
    e.stopPropagation();
    payslipYearFilter = '';
    payslipPage = 1;
    updateFilterUI();
    renderPayslips();
    populateMonthYearFilter();
  });
  dropdown.appendChild(allYearsOption);

  years.forEach((year) => {
    const option = createOption(year, year === payslipYearFilter, (e) => {
      e.stopPropagation();
      payslipYearFilter = year;
      payslipPage = 1;
      updateFilterUI();
      renderPayslips();
      populateMonthYearFilter();
    });
    dropdown.appendChild(option);
  });
}

function clearPayslipFilters() {
  payslipDepartmentFilter = '';
  payslipMonthFilter = '';
  payslipYearFilter = '';
  payslipPage = 1;
  updateFilterUI();
  renderPayslips();
  
  // Close dropdowns
  const deptDropdown = document.getElementById('payslipDepartmentDropdown');
  const monthDropdown = document.getElementById('payslipMonthYearDropdown');
  if (deptDropdown) deptDropdown.style.display = 'none';
  if (monthDropdown) monthDropdown.style.display = 'none';
}

function updateFilterUI() {
  const deptBtn = document.getElementById('payslipDepartmentFilterBtn');
  const deptBtnLabel = document.getElementById('payslipDepartmentFilterLabel');
  const monthBtn = document.getElementById('payslipMonthYearFilterBtn');
  const monthBtnLabel = document.getElementById('payslipMonthYearFilterLabel');
  const clearBtn = document.getElementById('payslipClearFiltersBtn');
  
  if (!deptBtn || !monthBtn || !clearBtn) {
    console.warn('Filter buttons not found in DOM');
    return;
  }
  
  // Show/hide filter buttons if we have data
  const hasData = payslipsData && payslipsData.length > 0;
  
  if (hasData) {
    deptBtn.style.display = 'flex';
    monthBtn.style.display = 'flex';
  } else {
    deptBtn.style.display = 'none';
    monthBtn.style.display = 'none';
  }
  
  // Update button styles to indicate active filters
  if (payslipDepartmentFilter) {
    deptBtn.style.backgroundColor = '#0a5ba8';
    deptBtn.style.color = '#fff';
    deptBtn.style.borderColor = '#0a5ba8';
  } else {
    deptBtn.style.backgroundColor = '';
    deptBtn.style.color = '';
    deptBtn.style.borderColor = '';
  }
  
  if (payslipMonthFilter || payslipYearFilter) {
    monthBtn.style.backgroundColor = '#0a5ba8';
    monthBtn.style.color = '#fff';
    monthBtn.style.borderColor = '#0a5ba8';
  } else {
    monthBtn.style.backgroundColor = '';
    monthBtn.style.color = '';
    monthBtn.style.borderColor = '';
  }

  if (monthBtnLabel) {
    const hasMonth = Boolean(payslipMonthFilter);
    const hasYear = Boolean(payslipYearFilter);

    if (!hasMonth && !hasYear) {
      monthBtnLabel.textContent = 'Month & Year';
    } else if (hasMonth && hasYear) {
      monthBtnLabel.textContent = `${getMonthLabel(payslipMonthFilter)} / ${payslipYearFilter}`;
    } else if (hasMonth) {
      monthBtnLabel.textContent = getMonthLabel(payslipMonthFilter);
    } else {
      monthBtnLabel.textContent = payslipYearFilter;
    }
  }

  if (deptBtnLabel) {
    deptBtnLabel.textContent = payslipDepartmentFilter || 'Department';
  }
  
  // Show clear button only when filters are applied
  const hasFilters = Boolean(payslipDepartmentFilter || payslipMonthFilter || payslipYearFilter);
  clearBtn.style.display = hasFilters ? 'block' : 'none';
}

// ===== EDIT PAYSLIP MODAL =====
function openEditPayslipModal(payslipId) {
  const p = payslipsData.find(ps => ps.id === payslipId);
  if (!p) return;
  selectedPayslip = p;
  document.getElementById('editPayslipName').value = p.name || '';
  document.getElementById('editPayslipEmpId').value = p.empId;
  document.getElementById('editPayslipDepartment').value = p.department || '';
  document.getElementById('editPayslipDesignation').value = p.designation || '';
  document.getElementById('editPayslipPayPeriod').value = p.payPeriod || '';
  openModal('editPayslipModal');
}

async function saveEditPayslip() {
  if (!selectedPayslip) return;
  const name = document.getElementById('editPayslipName').value.trim();
  const empId = document.getElementById('editPayslipEmpId').value.trim();
  const department = document.getElementById('editPayslipDepartment').value.trim();
  const designation = document.getElementById('editPayslipDesignation').value.trim();
  const payPeriod = document.getElementById('editPayslipPayPeriod').value;

  if (!name || !empId || !designation || !payPeriod) {
    showToast('Please fill in all required fields.', 'error');
    return;
  }

  try {
    await dataSource.payslips.update(selectedPayslip.id, {
      employee_id: empId,
      name,
      department: department || null,
      designation,
      pay_period: payPeriod,
    });

    closeModal('editPayslipModal');
    selectedPayslip = null;
    await Promise.all([loadPayslipsFromApi(), loadArchivedPayslipsFromApi()]);
    updateBulkActionUI();
    showToast('Payslip updated successfully.', 'success');
  } catch (e) {
    showToast(e.message || 'Failed to update payslip.', 'error');
  }
}

// ===== ARCHIVE PAYSLIP =====
function openArchivePayslipModal(payslipId) {
  selectedPayslip = payslipsData.find(ps => ps.id === payslipId);
  if (!selectedPayslip) return;
  document.getElementById('archivePayslipName').textContent =
    `${selectedPayslip.name || selectedPayslip.empId} (${formatPayDate(selectedPayslip.payPeriod)})`;
  openModal('archivePayslipModal');
}

async function confirmArchivePayslip() {
  if (!selectedPayslip) return;

  try {
    await dataSource.payslips.archive(selectedPayslip.id);
    selectedPayslipIds.delete(selectedPayslip.id);
    closeModal('archivePayslipModal');
    selectedPayslip = null;
    await Promise.all([loadPayslipsFromApi(), loadArchivedPayslipsFromApi()]);
    updateBulkActionUI();
    showToast('Payslip archived successfully.', 'info');
  } catch (e) {
    showToast(e.message || 'Failed to archive payslip.', 'error');
  }
}

// ===== DELETE PAYSLIP =====
let payslipToDelete = null;

function openDeletePayslipModal(payslipId) {
  payslipToDelete = payslipsData.find(ps => ps.id === payslipId);
  if (!payslipToDelete) return;
  document.getElementById('deletePayslipName').textContent =
    `${payslipToDelete.name || payslipToDelete.empId}`;
  openModal('deletePayslipModal');
}

async function confirmDeletePayslip() {
  if (!payslipToDelete) return;

  closeModal('deletePayslipModal');

  try {
    await dataSource.payslips.softDelete(payslipToDelete.id);
    selectedPayslipIds.delete(payslipToDelete.id);
    selectedArchivedPayslipIds.delete(payslipToDelete.id);
    payslipToDelete = null;
    await Promise.all([loadPayslipsFromApi(), loadArchivedPayslipsFromApi()]);
    updateBulkActionUI();
    showToast('Payslip deleted successfully.', 'success');
  } catch (e) {
    showToast(e.message || 'Failed to delete payslip.', 'error');
  }
}

// ===== UNARCHIVE PAYSLIP =====
function openUnarchivePayslipModal(payslipId) {
  selectedArchivedPayslip = archivedPayslips.find(ps => ps.id === payslipId);
  if (!selectedArchivedPayslip) return;
  document.getElementById('unarchivePayslipName').textContent =
    `${selectedArchivedPayslip.name || selectedArchivedPayslip.empId} (${formatPayDate(selectedArchivedPayslip.payPeriod)})`;
  openModal('unarchivePayslipModal');
}

async function confirmUnarchivePayslip() {
  if (!selectedArchivedPayslip) return;

  try {
    await dataSource.payslips.unarchive(selectedArchivedPayslip.id);
    selectedArchivedPayslipIds.delete(selectedArchivedPayslip.id);
    closeModal('unarchivePayslipModal');
    selectedArchivedPayslip = null;
    await Promise.all([loadPayslipsFromApi(), loadArchivedPayslipsFromApi()]);
    updateBulkActionUI();
    showToast('Payslip unarchived successfully.', 'success');
  } catch (e) {
    showToast(e.message || 'Failed to unarchive payslip.', 'error');
  }
}

// ===== BULK PAYSLIP FUNCTIONS =====
function getVisiblePayslipRows() {
  const data = getFilteredPayslips();
  const totalPages = Math.max(1, Math.ceil(data.length / ROWS_PER_PAGE));
  if (payslipPage > totalPages) payslipPage = totalPages;
  return data.slice((payslipPage - 1) * ROWS_PER_PAGE, payslipPage * ROWS_PER_PAGE);
}

function getVisibleArchivedPayslipRows() {
  const data = getFilteredArchivedPayslips();
  const totalPages = Math.max(1, Math.ceil(data.length / ROWS_PER_PAGE));
  if (payslipArchivePage > totalPages) payslipArchivePage = totalPages;
  return data.slice((payslipArchivePage - 1) * ROWS_PER_PAGE, payslipArchivePage * ROWS_PER_PAGE);
}

function togglePayslipSelection(payslipId, checked) {
  if (checked) selectedPayslipIds.add(payslipId);
  else selectedPayslipIds.delete(payslipId);
  updateSelectAllState('payslipSelectAllCheckbox', selectedPayslipIds, getVisiblePayslipRows());
  updateBulkActionUI();
}

function toggleArchivedPayslipSelection(payslipId, checked) {
  if (checked) selectedArchivedPayslipIds.add(payslipId);
  else selectedArchivedPayslipIds.delete(payslipId);
  updateSelectAllState('payslipArchiveSelectAllCheckbox', selectedArchivedPayslipIds, getVisibleArchivedPayslipRows());
  updateBulkActionUI();
}

function toggleSelectAllVisiblePayslips(checked) {
  const visibleRows = getVisiblePayslipRows();
  visibleRows.forEach((p) => {
    if (checked) selectedPayslipIds.add(p.id);
    else selectedPayslipIds.delete(p.id);
  });
  renderPayslips();
  updateBulkActionUI();
}

function toggleSelectAllVisibleArchivedPayslips(checked) {
  const visibleRows = getVisibleArchivedPayslipRows();
  visibleRows.forEach((p) => {
    if (checked) selectedArchivedPayslipIds.add(p.id);
    else selectedArchivedPayslipIds.delete(p.id);
  });
  renderArchivedPayslips();
  updateBulkActionUI();
}

function clearPayslipSelection() {
  selectedPayslipIds.clear();
  renderPayslips();
  updateBulkActionUI();
}

function clearArchivedPayslipSelection() {
  selectedArchivedPayslipIds.clear();
  renderArchivedPayslips();
  updateBulkActionUI();
}

function bulkArchiveSelectedPayslips() {
  if (selectedPayslipIds.size === 0) return;
  const selectedItems = payslipsData.filter((p) => selectedPayslipIds.has(p.id));
  if (selectedItems.length === 0) {
    selectedPayslipIds.clear();
    updateBulkActionUI();
    renderPayslips();
    return;
  }
  const count = document.getElementById('bulkArchivePayslipCount');
  if (count) count.textContent = `${selectedItems.length} selected payslip(s)`;
  openModal('bulkArchivePayslipModal');
}

async function confirmBulkArchivePayslips() {
  if (selectedPayslipIds.size === 0) {
    closeModal('bulkArchivePayslipModal');
    return;
  }
  closeModal('bulkArchivePayslipModal');

  const selectedIds = Array.from(selectedPayslipIds);

  try {
    await Promise.all(selectedIds.map((id) => dataSource.payslips.archive(id)));
    selectedPayslipIds.clear();
    selectedArchivedPayslipIds.clear();
    await Promise.all([loadPayslipsFromApi(), loadArchivedPayslipsFromApi()]);
    updateBulkActionUI();
    showToast(`${selectedIds.length} payslip(s) archived successfully.`, 'info');
  } catch (e) {
    showToast(e.message || 'Failed to archive selected payslips.', 'error');
  }
}

function bulkUnarchiveSelectedPayslips() {
  if (selectedArchivedPayslipIds.size === 0) return;
  const selectedItems = archivedPayslips.filter((p) => selectedArchivedPayslipIds.has(p.id));
  if (selectedItems.length === 0) {
    selectedArchivedPayslipIds.clear();
    updateBulkActionUI();
    renderArchivedPayslips();
    return;
  }
  const count = document.getElementById('bulkUnarchivePayslipCount');
  if (count) count.textContent = `${selectedItems.length} selected payslip(s)`;
  openModal('bulkUnarchivePayslipModal');
}

async function confirmBulkUnarchivePayslips() {
  if (selectedArchivedPayslipIds.size === 0) {
    closeModal('bulkUnarchivePayslipModal');
    return;
  }
  closeModal('bulkUnarchivePayslipModal');

  const selectedIds = Array.from(selectedArchivedPayslipIds);

  try {
    await Promise.all(selectedIds.map((id) => dataSource.payslips.unarchive(id)));
    selectedPayslipIds.clear();
    selectedArchivedPayslipIds.clear();
    await Promise.all([loadPayslipsFromApi(), loadArchivedPayslipsFromApi()]);
    updateBulkActionUI();
    showToast(`${selectedIds.length} payslip(s) unarchived successfully.`, 'success');
  } catch (e) {
    showToast(e.message || 'Failed to unarchive selected payslips.', 'error');
  }
}

// ===== IMPORT PAYSLIP =====
function openImportModal() {
  document.getElementById('importFileInput').value = '';
  document.getElementById('importFileName').textContent = '';
  document.getElementById('importDropArea').classList.remove('drag-over');
  openModal('importPayslipModal');
}

function handleImportFileSelect(input) {
  const file = input.files[0];
  if (!file) return;
  const allowed = ['.xlsx', '.xls', '.csv'];
  const ext = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();
  if (!allowed.includes(ext)) {
    showToast('Invalid file type. Please select an .xlsx, .xls, or .csv file.', 'error');
    input.value = '';
    document.getElementById('importFileName').textContent = '';
    return;
  }
  document.getElementById('importFileName').textContent = `📎 ${file.name}`;
}

function handleImportDrop(event) {
  event.preventDefault();
  document.getElementById('importDropArea').classList.remove('drag-over');
  const file = event.dataTransfer.files[0];
  if (!file) return;
  const ext = file.name.slice(file.name.lastIndexOf('.')).toLowerCase();
  if (!['.xlsx', '.xls', '.csv'].includes(ext)) {
    showToast('Invalid file type. Please drop an .xlsx, .xls, or .csv file.', 'error');
    return;
  }
  document.getElementById('importFileName').textContent = `📎 ${file.name}`;
  // Transfer the file into the file input for reference
  const dt = new DataTransfer();
  dt.items.add(file);
  document.getElementById('importFileInput').files = dt.files;
}

async function confirmImport() {
  const input = document.getElementById('importFileInput');
  if (!input.files || !input.files[0]) {
    showToast('Please select a file to import.', 'error');
    return;
  }

  const file = input.files[0];

  try {
    const res = await dataSource.payslips.import(file);
    closeModal('importPayslipModal');
    await Promise.all([loadPayslipsFromApi(), loadArchivedPayslipsFromApi()]);

    const result = res?.data ?? res;
    const created = Number(result?.created || 0);
    const skipped = Number(result?.skipped || 0);
    const failed = Number(result?.failed || 0);

    const parts = [];

    if (created > 0) {
      parts.push(`${created} ${created === 1 ? 'record' : 'records'} successfully created.`);
    }
    if (skipped > 0) {
      parts.push(`${skipped} ${skipped === 1 ? 'record' : 'records'} skipped due to missing required fields.`);
    }
    if (failed > 0) {
      parts.push(`${failed} ${failed === 1 ? 'record' : 'records'} failed due to validation errors.`);
    }

    const message = parts.length ? parts.join(' ') : 'No records were imported.';

    showToast(message, failed ? 'info' : 'success');
  } catch (e) {
    showToast(e.message || 'Failed to import payslips.', 'error');
  }
}

// ===== PRINT PAYSLIP =====
function escapeHtml(value) {
  return String(value ?? '')
    .replace(/&/g, '&amp;')
    .replace(/</g, '&lt;')
    .replace(/>/g, '&gt;')
    .replace(/\"/g, '&quot;')
    .replace(/'/g, '&#39;');
}

function toNumber(value) {
  if (value === null || value === undefined) return null;
  if (typeof value === 'number') return Number.isFinite(value) ? value : null;
  const s = String(value).trim();
  if (!s) return null;
  const normalized = s.replace(/,/g, '').replace(/[^\d.-]/g, '');
  const n = Number(normalized);
  return Number.isFinite(n) ? n : null;
}

function formatMoney(value) {
  const n = toNumber(value);
  if (n === null) return '';
  return new Intl.NumberFormat('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).format(n);
}

function formatMoneyBlankZero(value) {
  const n = toNumber(value);
  if (n === null || n === 0) return '';
  return formatMoney(n);
}

function formatLongDate(isoDate) {
  if (!isoDate) return '';
  const normalized = String(isoDate).slice(0, 10);
  const d = new Date(`${normalized}T00:00:00`);
  if (Number.isNaN(d.getTime())) return normalized;
  return d.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
}

function formatPayPeriodLabel(isoDate) {
  if (!isoDate) return '';
  const normalized = String(isoDate).slice(0, 10);
  const d = new Date(`${normalized}T00:00:00`);
  if (Number.isNaN(d.getTime())) return normalized;
  return d.toLocaleDateString('en-US', { year: 'numeric', month: 'long' });
}

function computePayoutDate(payPeriodIso, day) {
  if (!payPeriodIso) return '';
  const normalized = String(payPeriodIso).slice(0, 10);
  const d = new Date(`${normalized}T00:00:00`);
  if (Number.isNaN(d.getTime())) return '';
  d.setDate(day);
  return d.toISOString().slice(0, 10);
}

function getPayslipTemplateParts() {
  const templateElement = document.getElementById('payslipPrintTemplate');
  if (!templateElement) {
    showToast('Payslip print template is missing in the page.', 'error');
    return null;
  }

  const templateHtml = String(templateElement.innerHTML || '').trim();
  if (!templateHtml) {
    showToast('Payslip print template is empty.', 'error');
    return null;
  }

  const styleMatch = templateHtml.match(/<style[^>]*>([\s\S]*?)<\/style>/i);
  const bodyMatch = templateHtml.match(/<body[^>]*>([\s\S]*?)<\/body>/i);

  return {
    styleCss: styleMatch ? styleMatch[1] : '',
    bodyTemplate: bodyMatch ? bodyMatch[1] : templateHtml,
  };
}

function renderPayslipPrintBody(bodyTemplate, payslipRecord) {
  let renderedBody = String(bodyTemplate || '');
  const p = payslipRecord || {};

  const payPeriodIso = String(p.pay_period || p.payPeriod || '').slice(0, 10);

  const pay15Iso = p['15th_dop'] ? String(p['15th_dop']).slice(0, 10) : computePayoutDate(payPeriodIso, 14);
  const pay30Iso = p['30th_dop'] ? String(p['30th_dop']).slice(0, 10) : computePayoutDate(payPeriodIso, 28);

  const tokenValues = {
    employee_id: p.employee_id || '',
    name: p.name || '',
    department: p.department || '',
    designation: p.designation || '',
    pay_period_label: formatPayPeriodLabel(payPeriodIso),

    monthly_salary: formatMoneyBlankZero(p.monthly_salary),
    pera: formatMoneyBlankZero(p.pera),
    gross_amount: formatMoneyBlankZero(p.gross_amount),

    gsis_premium: formatMoneyBlankZero(p.gsis_premium),
    tax_withheld: formatMoneyBlankZero(p.tax_withheld),
    philhealth: formatMoneyBlankZero(p.philhealth),
    hdmf_premium: formatMoneyBlankZero(p.hdmf_premium),

    conso_loan: formatMoneyBlankZero(p.conso_loan),
    policy_loan: formatMoneyBlankZero(p.policy_loan),
    hdmf_loan: formatMoneyBlankZero(p.hdmf_loan),
    opt_pol_ln: formatMoneyBlankZero(p.opt_pol_ln),
    uoli: formatMoneyBlankZero(p.uoli),
    gfal_ii: formatMoneyBlankZero(p.gfal_ii),
    mpl: formatMoneyBlankZero(p.mpl),
    mpl_lite: formatMoneyBlankZero(p.mpl_lite),
    comp_ln: formatMoneyBlankZero(p.comp_ln),
    emer_ln: formatMoneyBlankZero(p.emer_ln),
    ecash_adv: formatMoneyBlankZero(p.ecash_adv),
    rel: formatMoneyBlankZero(p.rel),
    fip_g: formatMoneyBlankZero(p.fip_g),
    sri_g: formatMoneyBlankZero(p.sri_g),
    mri_h: formatMoneyBlankZero(p.mri_h),
    educ_ln: formatMoneyBlankZero(p.educ_ln),

    hdmf_cal: formatMoneyBlankZero(p.hdmf_cal),
    hdmg_hsng: formatMoneyBlankZero(p.hdmg_hsng),
    mri_n: formatMoneyBlankZero(p.mri_n),
    landbank_loan: formatMoneyBlankZero(p.landbank_loan),
    lraea: formatMoneyBlankZero(p.lraea),
    gabay: formatMoneyBlankZero(p.gabay),
    nards: formatMoneyBlankZero(p.nards),
    lraecc: formatMoneyBlankZero(p.lraecc),
    nhfmc: formatMoneyBlankZero(p.nhfmc),

    total_deductions: formatMoneyBlankZero(p.total_deductions),
    net_pay: formatMoneyBlankZero(p.net_pay),
    '15th_dop': formatLongDate(pay15Iso),
    '30th_dop': formatLongDate(pay30Iso),
    pay_15th: formatMoneyBlankZero(p.pay_15th),
    pay_30th: formatMoneyBlankZero(p.pay_30th),
  };

  Object.entries(tokenValues).forEach(([key, value]) => {
    renderedBody = renderedBody.split(`__${key}__`).join(escapeHtml(value));
  });

  const dynamicFields = [
    ['hdmf_loan', 'HDMF Loan'],
    ['mp2', 'MP2'],
    ['fip_g', 'FIP-G'],
    ['sri_g', 'SRI-G'],
    ['fire_h', 'FIRE-H'],
    ['fire_n', 'FIRE-N'],
    ['honor_disallow', 'HONOR DISALLOW'],
    ['ltcp_disallow', 'LTCP DISALLOW'],
    ['lwop', 'LWOP'],
    ['mri_h', 'MRI-H'],
    ['mri_n', 'MRI-N'],
    ['fine', 'FINE'],
    ['help', 'HELP'],
    ['pvb_ln', 'PVB LN'],
    ['aom_2013_014', 'AOM 2013-014'],
    ['cna_2009', 'CNA 2009'],
    ['dorm_fee', 'DORM FEE'],
  ];

  const dynamicRowsHtml = dynamicFields
    .map(([field, label]) => {
      const raw = toNumber(p[field]);
      if (raw === null || raw <= 0) return '';
      const value = formatMoney(raw);
      return `
      <tr>
        <td class="c1"></td>
        <td class="c2" style="padding-left: 50px">${escapeHtml(label)}</td>
        <td class="c3">${escapeHtml(value)}</td>
      </tr>`;
    })
    .filter(Boolean)
    .join('');

  return renderedBody.split('<!--__DYNAMIC_FIELDS__-->').join(dynamicRowsHtml);
}

function openPayslipPrintWindow(renderedBodies, styleCss) {
  const printWin = window.open('', '_blank', 'width=850,height=750');
  if (!printWin) {
    showToast('Please allow popups to print the payslip.', 'error');
    return false;
  }

  const pagesHtml = renderedBodies
    .map((body, index) => `${body}${index < renderedBodies.length - 1 ? '<div class="bulk-page-break"></div>' : ''}`)
    .join('');

  const printHtml = `<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LRA Payslip Print</title>
  <style>${styleCss || ''}</style>
  <style>
    .bulk-page-break {
      page-break-after: always;
      break-after: page;
      height: 0;
    }
  </style>
</head>
<body>
${pagesHtml}
</body>
</html>`;

  printWin.document.write(printHtml);
  printWin.document.close();
  printWin.focus();

  const triggerPrint = () => {
    try {
      printWin.focus();
      printWin.print();
    } catch (_) {
      showToast('Print dialog was blocked. Please use Ctrl+P in the payslip window.', 'info');
    }
  };

  printWin.addEventListener('load', triggerPrint, { once: true });
  setTimeout(triggerPrint, 350);
  return true;
}

async function printPayslip(payslipId) {
  const templateParts = getPayslipTemplateParts();
  if (!templateParts) return;

  let record;
  try {
    record = await dataSource.payslips.get(payslipId);
  } catch (e) {
    showToast(e.message || 'Failed to load payslip from server.', 'error');
    return;
  }

  const payslipData = record?.data ?? record ?? {};
  const renderedBody = renderPayslipPrintBody(templateParts.bodyTemplate, payslipData);
  openPayslipPrintWindow([renderedBody], templateParts.styleCss);
}

async function bulkPrintSelectedPayslips() {
  if (selectedPayslipIds.size === 0) return;

  const templateParts = getPayslipTemplateParts();
  if (!templateParts) return;

  const selectedIds = Array.from(selectedPayslipIds);
  const failedIds = [];

  const records = await Promise.all(
    selectedIds.map(async (id) => {
      try {
        const response = await dataSource.payslips.get(id);
        return response?.data ?? response ?? {};
      } catch (_) {
        failedIds.push(id);
        return null;
      }
    })
  );

  const printablePayslips = records.filter(Boolean);
  if (printablePayslips.length === 0) {
    showToast('Failed to load selected payslips for printing.', 'error');
    return;
  }

  const renderedBodies = printablePayslips.map((p) => renderPayslipPrintBody(templateParts.bodyTemplate, p));
  const opened = openPayslipPrintWindow(renderedBodies, templateParts.styleCss);

  if (opened) {
    showToast(`${printablePayslips.length} payslip(s) ready for print.`, 'success');
    if (failedIds.length > 0) {
      showToast(`${failedIds.length} selected payslip(s) could not be loaded.`, 'info');
    }
  }
}

// ===== SVG ICONS =====
const iconEye = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>`;
const iconEdit = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>`;
const iconArchive = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/></svg>`;
const iconPrint = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/></svg>`;
const iconTrash = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>`;

// ===== CLOSE DROPDOWN ON OUTSIDE CLICK =====
document.addEventListener('click', (e) => {
  if (!e.target.closest('.dropdown')) {
    document.querySelectorAll('.dropdown-menu').forEach(d => d.classList.remove('open'));
  }
});

// Close payslip filter dropdowns when clicking outside
document.addEventListener('click', (e) => {
  const deptBtn = document.getElementById('payslipDepartmentFilterBtn');
  const deptDropdown = document.getElementById('payslipDepartmentDropdown');
  const monthBtn = document.getElementById('payslipMonthYearFilterBtn');
  const monthDropdown = document.getElementById('payslipMonthYearDropdown');
  
  if (deptBtn && deptDropdown && !deptBtn.contains(e.target) && !deptDropdown.contains(e.target)) {
    deptDropdown.style.display = 'none';
  }
  if (monthBtn && monthDropdown && !monthBtn.contains(e.target) && !monthDropdown.contains(e.target)) {
    monthDropdown.style.display = 'none';
  }
});

// ===== INIT =====
document.addEventListener('DOMContentLoaded', async () => {
  bindValidationEvents();
  updateFormButtons();
  renderLastVisited();

  // Capture sub-panel state BEFORE navigate() clears it
  const savedSubPanel = localStorage.getItem('activeSubPanel');

  // Restore last visited page immediately to avoid any flash of wrong page
  const savedPage = localStorage.getItem('activePage');
  if (savedPage && document.getElementById(savedPage) && document.querySelector(`[data-page="${savedPage}"]`)) {
    navigate(savedPage);
  } else {
    const activePage = document.querySelector('.page.active')?.id;
    updatePageTitle(activePage || 'profilePage');
  }

  if (document.getElementById('userTableBody')) {
    try {
      await loadReferenceData();
      await Promise.all([loadUsersFromApi(), loadArchivedUsersFromApi()]);
    } catch (e) {
      showToast(e.message || 'Failed to load users from server.', 'error');
      renderUsers();
    }
  }
  if (document.getElementById('auditTableBody')) {
    try {
      await loadAuditFromApi();
    } catch (e) {
      showToast(e.message || 'Failed to load activity logs from server.', 'error');
      renderAudit();
    }
  }

  if (document.getElementById('payslipTableBody')) {
    try {
      await Promise.all([loadPayslipsFromApi(), loadArchivedPayslipsFromApi()]);
    } catch (e) {
      showToast(e.message || 'Failed to load payslips from server.', 'error');
      renderPayslips();
      renderArchivedPayslips();
    }
  }

  // Restore archive sub-panel if it was active on last reload
  if (savedSubPanel === 'userArchiveList') {
    // Re-save it because navigate() removed it, then open the panel
    localStorage.setItem('activeSubPanel', 'userArchiveList');
    document.getElementById('userManagementMain').style.display = 'none';
    document.getElementById('archiveListPanel').style.display = 'block';
    renderArchive();
    updateBulkActionUI();
  } else if (savedSubPanel === 'payslipArchiveList') {
    localStorage.setItem('activeSubPanel', 'payslipArchiveList');
    document.getElementById('payslipManagementMain').style.display = 'none';
    document.getElementById('payslipArchivePanel').style.display = 'block';
    renderArchivedPayslips();
    updateBulkActionUI();
  }

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

  // Initialize dropdowns
  const deptFilterBtn = document.getElementById('payslipDepartmentFilterBtn');
  const monthFilterBtn = document.getElementById('payslipMonthYearFilterBtn');
  const deptDropdown = document.getElementById('payslipDepartmentDropdown');
  const monthDropdown = document.getElementById('payslipMonthYearDropdown');
  
  if (deptDropdown) deptDropdown.style.display = 'none';
  if (monthDropdown) monthDropdown.style.display = 'none';
  
  if (deptDropdown) {
    deptDropdown.addEventListener('click', (e) => {
      e.stopPropagation();
    });
  }
  if (monthDropdown) {
    monthDropdown.addEventListener('click', (e) => {
      e.stopPropagation();
    });
  }

  updateFilterUI();
});

Object.assign(window, {
  dataSource,
  loadUsersFromApi,
  loadArchivedUsersFromApi,
  loadAuditFromApi,
  navigate,
  openArchiveList,
  closeArchiveList,
  renderUsers,
  renderArchive,
  renderAudit,
  toggleUserSelection,
  toggleArchivedSelection,
  toggleSelectAllVisibleUsers,
  toggleSelectAllVisibleArchived,
  clearUserSelection,
  clearArchivedSelection,
  bulkArchiveSelectedUsers,
  confirmBulkArchive,
  bulkUnarchiveSelectedUsers,
  confirmBulkUnarchive,
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
  openDeleteUserModal,
  confirmDeleteUser,
  openUnarchiveModal,
  confirmUnarchive,
  unarchiveUser,
  saveAddUser,
  saveEditUser,
  generatePassword,
  closeModal,
  openPayslipArchiveList,
  closePayslipArchiveList,
  renderPayslips,
  renderArchivedPayslips,
  openEditPayslipModal,
  saveEditPayslip,
  openArchivePayslipModal,
  confirmArchivePayslip,
  openDeletePayslipModal,
  confirmDeletePayslip,
  openUnarchivePayslipModal,
  confirmUnarchivePayslip,
  openImportModal,
  handleImportFileSelect,
  handleImportDrop,
  confirmImport,
  printPayslip,
  togglePayslipSelection,
  toggleArchivedPayslipSelection,
  toggleSelectAllVisiblePayslips,
  toggleSelectAllVisibleArchivedPayslips,
  clearPayslipSelection,
  bulkPrintSelectedPayslips,
  clearArchivedPayslipSelection,
  bulkArchiveSelectedPayslips,
  confirmBulkArchivePayslips,
  bulkUnarchiveSelectedPayslips,
  confirmBulkUnarchivePayslips,
  togglePayslipDepartmentFilter,
  togglePayslipMonthYearFilter,
  clearPayslipFilters,
});
