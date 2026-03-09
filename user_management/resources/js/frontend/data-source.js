const API_BASE = "/api";

function getCookie(name) {
  const cookie = document.cookie
    .split("; ")
    .find((row) => row.startsWith(`${name}=`));

  if (!cookie) return null;
  return decodeURIComponent(cookie.split("=")[1]);
}

async function ensureCsrfCookie() {
  await fetch("/sanctum/csrf-cookie", {
    credentials: "include",
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  });
}

async function request(path, options = {}) {
  const method = (options.method || "GET").toUpperCase();
  const isWrite = ["POST", "PUT", "PATCH", "DELETE"].includes(method);

  if (isWrite) {
    await ensureCsrfCookie();
  }

  const xsrfToken = getCookie("XSRF-TOKEN");
  const csrfMetaToken =
    document.querySelector('meta[name="csrf-token"]')?.getAttribute("content") || null;

  const response = await fetch(`${API_BASE}${path}`, {
    credentials: "include",
    headers: {
      Accept: "application/json",
      "Content-Type": "application/json",
      "X-Requested-With": "XMLHttpRequest",
      ...(xsrfToken ? { "X-XSRF-TOKEN": xsrfToken } : {}),
      ...(csrfMetaToken ? { "X-CSRF-TOKEN": csrfMetaToken } : {}),
      ...(options.headers || {}),
    },
    ...options,
  });

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
};
