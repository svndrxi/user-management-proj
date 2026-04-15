const appBaseFromMeta = document
  .querySelector('meta[name="app-base-url"]')
  ?.getAttribute("content");

const APP_BASE = (appBaseFromMeta || window.location.origin).replace(/\/+$/, "");
const API_BASE = `${APP_BASE}/api`;
const CSRF_COOKIE_URL = `${APP_BASE}/sanctum/csrf-cookie`;

function getCookie(name) {
  const cookie = document.cookie
    .split("; ")
    .find((row) => row.startsWith(`${name}=`));

  if (!cookie) return null;
  return decodeURIComponent(cookie.split("=")[1]);
}

async function ensureCsrfCookie() {
  // Check the actual cookie instead of an in-memory flag
  // so stale/expired tokens are always refreshed
  if (getCookie("XSRF-TOKEN")) return;

  const response = await fetch(CSRF_COOKIE_URL, {
    credentials: "include",
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  });

  if (!response.ok) {
    throw new Error(`Failed to initialize CSRF cookie (${response.status}).`);
  }
}

async function request(path, options = {}, _retry = false) {
  const method = (options.method || "GET").toUpperCase();
  const isWrite = ["POST", "PUT", "PATCH", "DELETE"].includes(method);
  const isFormData = typeof FormData !== "undefined" && options.body instanceof FormData;

  if (isWrite) {
    await ensureCsrfCookie();
  }

  const xsrfToken = getCookie("XSRF-TOKEN");

  const csrfTokenMeta = document
    .querySelector('meta[name="csrf-token"]')
    ?.getAttribute("content");

  const response = await fetch(`${API_BASE}${path}`, {
    credentials: "include",
    headers: {
      Accept: "application/json",
      ...(isFormData ? {} : { "Content-Type": "application/json" }),
      "X-Requested-With": "XMLHttpRequest",
      ...(xsrfToken ? { "X-XSRF-TOKEN": xsrfToken } : {}),
      ...(csrfTokenMeta ? { "X-CSRF-TOKEN": csrfTokenMeta } : {}),
      ...(options.headers || {}),
    },
    ...options,
  });

  // CSRF token expired mid-session — refresh cookie and retry once
  if (response.status === 419 && !_retry) {
    await fetch(CSRF_COOKIE_URL, {
      credentials: "include",
      headers: {
        Accept: "application/json",
        "X-Requested-With": "XMLHttpRequest",
      },
    });
    return request(path, options, true);
  }

  const contentType = response.headers.get("content-type") || "";
  const body = contentType.includes("application/json")
    ? await response.json()
    : await response.text();

  if (!response.ok) {
    const message =
      (body && typeof body === "object" && (body.message || body.error)) ||
      `Request failed (${response.status})`;
    const error = new Error(message);
    error.status = response.status;
    error.body = body;
    throw error;
  }

  return body;
}

function toQuery(params = {}) {
  const search = new URLSearchParams();
  Object.entries(params).forEach(([key, value]) => {
    if (value === undefined || value === null || value === "") return;
    search.append(key, String(value));
  });
  const query = search.toString();
  return query ? `?${query}` : "";
}

export const dataSource = {
  users: {
    list(params = {}) {
      return request(`/users${toQuery(params)}`);
    },
    get(id) {
      return request(`/users/${id}`);
    },
    create(payload) {
      return request("/users", {
        method: "POST",
        body: JSON.stringify(payload),
      });
    },
    update(id, payload) {
      return request(`/users/${id}`, {
        method: "PUT",
        body: JSON.stringify(payload),
      });
    },
    archive(id) {
      return request(`/users/${id}`, { method: "DELETE" });
    },
    unarchive(id) {
      return request(`/users/${id}/unarchive`, { method: "POST" });
    },
    softDelete(id) {
      return request(`/users/${id}/soft-delete`, { method: "DELETE" });
    },
  },

  roles: {
    list(params = {}) {
      return request(`/roles${toQuery(params)}`);
    },
    get(id) {
      return request(`/roles/${id}`);
    },
    create(payload) {
      return request("/roles", {
        method: "POST",
        body: JSON.stringify(payload),
      });
    },
    update(id, payload) {
      return request(`/roles/${id}`, {
        method: "PUT",
        body: JSON.stringify(payload),
      });
    },
    remove(id) {
      return request(`/roles/${id}`, { method: "DELETE" });
    },
  },

  offices: {
    list(params = {}) {
      return request(`/offices${toQuery(params)}`);
    },
    get(id) {
      return request(`/offices/${id}`);
    },
    create(payload) {
      return request("/offices", {
        method: "POST",
        body: JSON.stringify(payload),
      });
    },
    update(id, payload) {
      return request(`/offices/${id}`, {
        method: "PUT",
        body: JSON.stringify(payload),
      });
    },
    remove(id) {
      return request(`/offices/${id}`, { method: "DELETE" });
    },
  },

  permissions: {
    list(params = {}) {
      return request(`/permissions${toQuery(params)}`);
    },
    get(id) {
      return request(`/permissions/${id}`);
    },
    create(payload) {
      return request("/permissions", {
        method: "POST",
        body: JSON.stringify(payload),
      });
    },
    update(id, payload) {
      return request(`/permissions/${id}`, {
        method: "PUT",
        body: JSON.stringify(payload),
      });
    },
  },

  activityLogs: {
    list(params = {}) {
      return request(`/activity-logs${toQuery(params)}`);
    },
    get(id) {
      return request(`/activity-logs/${id}`);
    },
    remove(id) {
      return request(`/activity-logs/${id}`, { method: "DELETE" });
    },
  },

  payslips: {
    list(params = {}) {
      return request(`/payslips${toQuery(params)}`);
    },
    get(id) {
      return request(`/payslips/${id}`);
    },
    create(payload) {
      return request("/payslips", {
        method: "POST",
        body: JSON.stringify(payload),
      });
    },
    update(id, payload) {
      return request(`/payslips/${id}`, {
        method: "PUT",
        body: JSON.stringify(payload),
      });
    },
    archive(id) {
      return request(`/payslips/${id}`, { method: "DELETE" });
    },
    unarchive(id) {
      return request(`/payslips/${id}/unarchive`, { method: "POST" });
    },
    softDelete(id) {
      return request(`/payslips/${id}/soft-delete`, { method: "DELETE" });
    },
    import(file) {
      const form = new FormData();
      form.append("file", file);
      return request("/payslips/import", {
        method: "POST",
        body: form,
      });
    },
    sendMail(id, email) {
      return request(`/payslips/${id}/send-mail`, {
        method: "POST",
        body: JSON.stringify({ email }),
      });
    },
  },
};
