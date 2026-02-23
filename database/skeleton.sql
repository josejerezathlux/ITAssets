-- IT Assets Manager – database skeleton (structure only, no data)
-- Run this on a new MySQL server to create the database and tables.
-- Existing data is not removed; use for fresh installs only.

CREATE DATABASE IF NOT EXISTS devices CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE devices;

CREATE TABLE IF NOT EXISTS roles (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL UNIQUE,
  label VARCHAR(255) NULL,
  permissions JSON NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS users (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  role_id BIGINT UNSIGNED NULL,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL UNIQUE,
  email_verified_at TIMESTAMP NULL,
  password VARCHAR(255) NOT NULL,
  remember_token VARCHAR(100) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS password_reset_tokens (
  email VARCHAR(255) NOT NULL PRIMARY KEY,
  token VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS sessions (
  id VARCHAR(255) NOT NULL PRIMARY KEY,
  user_id BIGINT UNSIGNED NULL,
  ip_address VARCHAR(45) NULL,
  user_agent TEXT NULL,
  payload LONGTEXT NOT NULL,
  last_activity INT NOT NULL,
  INDEX sessions_user_id_index (user_id)
);

CREATE TABLE IF NOT EXISTS departments (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL UNIQUE,
  code VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS asset_categories (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL UNIQUE,
  slug VARCHAR(255) NOT NULL UNIQUE,
  icon VARCHAR(64) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS rooms (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  location VARCHAR(255) NULL,
  code VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL
);

CREATE TABLE IF NOT EXISTS map_rooms (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  room_id BIGINT UNSIGNED NULL,
  x INT NOT NULL DEFAULT 0,
  y INT NOT NULL DEFAULT 0,
  width INT UNSIGNED NOT NULL DEFAULT 100,
  height INT UNSIGNED NOT NULL DEFAULT 80,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS employees (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  department_id BIGINT UNSIGNED NULL,
  email VARCHAR(255) NULL,
  phone VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS assets (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  asset_tag VARCHAR(255) NOT NULL UNIQUE,
  asset_category_id BIGINT UNSIGNED NOT NULL,
  serial_number VARCHAR(255) NULL,
  make VARCHAR(255) NULL,
  model VARCHAR(255) NULL,
  purchase_date DATE NULL,
  vendor VARCHAR(255) NULL,
  cost DECIMAL(12,2) NULL,
  warranty_expiry DATE NULL,
  status ENUM('in_use','in_stock','in_repair','retired','lost') NOT NULL DEFAULT 'in_stock',
  condition VARCHAR(255) NULL,
  room_id BIGINT UNSIGNED NULL,
  assigned_employee_id BIGINT UNSIGNED NULL,
  notes TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  deleted_at TIMESTAMP NULL,
  FOREIGN KEY (asset_category_id) REFERENCES asset_categories(id) ON DELETE CASCADE,
  FOREIGN KEY (room_id) REFERENCES rooms(id) ON DELETE SET NULL,
  FOREIGN KEY (assigned_employee_id) REFERENCES employees(id) ON DELETE SET NULL,
  INDEX assets_serial_number_index (serial_number)
);

CREATE TABLE IF NOT EXISTS map_placements (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  asset_id BIGINT UNSIGNED NOT NULL,
  x INT NOT NULL DEFAULT 0,
  y INT NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  UNIQUE KEY map_placements_asset_id_unique (asset_id),
  FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS asset_fields (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  asset_category_id BIGINT UNSIGNED NOT NULL,
  name VARCHAR(255) NOT NULL,
  key VARCHAR(255) NOT NULL,
  input_type VARCHAR(255) NOT NULL DEFAULT 'text',
  options JSON NULL,
  is_required TINYINT(1) NOT NULL DEFAULT 0,
  sort_order INT UNSIGNED NOT NULL DEFAULT 0,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  UNIQUE KEY asset_fields_category_key_unique (asset_category_id, `key`),
  FOREIGN KEY (asset_category_id) REFERENCES asset_categories(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS asset_field_values (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  asset_id BIGINT UNSIGNED NOT NULL,
  asset_field_id BIGINT UNSIGNED NOT NULL,
  value TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  UNIQUE KEY asset_field_values_asset_field_unique (asset_id, asset_field_id),
  FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE CASCADE,
  FOREIGN KEY (asset_field_id) REFERENCES asset_fields(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS asset_assignments (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  asset_id BIGINT UNSIGNED NOT NULL,
  employee_id BIGINT UNSIGNED NOT NULL,
  checked_out_at DATETIME NOT NULL,
  checked_in_at DATETIME NULL,
  status VARCHAR(255) NOT NULL DEFAULT 'checked_out',
  performed_by BIGINT UNSIGNED NULL,
  notes TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE CASCADE,
  FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE,
  FOREIGN KEY (performed_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS maintenance_logs (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  asset_id BIGINT UNSIGNED NOT NULL,
  date DATE NOT NULL,
  performed_by BIGINT UNSIGNED NULL,
  type ENUM('repair','upgrade','inspection') NOT NULL,
  notes TEXT NULL,
  attachment_path VARCHAR(255) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE CASCADE,
  FOREIGN KEY (performed_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS activity_logs (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  event VARCHAR(255) NOT NULL,
  user_id BIGINT UNSIGNED NULL,
  asset_id BIGINT UNSIGNED NULL,
  old_values JSON NULL,
  new_values JSON NULL,
  ip_address VARCHAR(45) NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL,
  FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS attachments (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  asset_id BIGINT UNSIGNED NOT NULL,
  filename VARCHAR(255) NOT NULL,
  path VARCHAR(255) NOT NULL,
  mime_type VARCHAR(255) NULL,
  size BIGINT UNSIGNED NULL,
  uploaded_by BIGINT UNSIGNED NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  FOREIGN KEY (asset_id) REFERENCES assets(id) ON DELETE CASCADE,
  FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS digital_assets (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  type VARCHAR(255) NOT NULL DEFAULT 'subscription',
  vendor VARCHAR(255) NULL,
  product_name VARCHAR(255) NULL,
  sku VARCHAR(255) NULL,
  description TEXT NULL,
  license_key_reference VARCHAR(255) NULL,
  status VARCHAR(255) NOT NULL DEFAULT 'active',
  start_date DATE NULL,
  end_date DATE NULL,
  renewal_date DATE NULL,
  next_billing_date DATE NULL,
  billing_cycle VARCHAR(255) NULL,
  cost DECIMAL(12,2) NULL,
  currency VARCHAR(3) NOT NULL DEFAULT 'USD',
  quantity INT UNSIGNED NOT NULL DEFAULT 1,
  auto_renew TINYINT(1) NOT NULL DEFAULT 0,
  terms_url VARCHAR(255) NULL,
  portal_url VARCHAR(255) NULL,
  category VARCHAR(255) NULL,
  notes TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX digital_assets_sku_index (sku)
);

CREATE TABLE IF NOT EXISTS digital_asset_assignments (
  id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
  digital_asset_id BIGINT UNSIGNED NOT NULL,
  assignable_type VARCHAR(255) NOT NULL,
  assignable_id BIGINT UNSIGNED NOT NULL,
  assigned_at DATE NULL,
  notes TEXT NULL,
  created_at TIMESTAMP NULL,
  updated_at TIMESTAMP NULL,
  INDEX digital_asset_assignments_assignable_index (assignable_type, assignable_id),
  FOREIGN KEY (digital_asset_id) REFERENCES digital_assets(id) ON DELETE CASCADE
);
