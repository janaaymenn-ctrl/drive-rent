-- Create Database
CREATE DATABASE IF NOT EXISTS drive_rent_db;
USE drive_rent_db;

-- Users Table
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  full_name VARCHAR(100) NOT NULL,
  email VARCHAR(100) UNIQUE NOT NULL,
  phone VARCHAR(20),
  password VARCHAR(255) NOT NULL,
  address VARCHAR(255),
  city VARCHAR(50),
  state VARCHAR(50),
  zip_code VARCHAR(10),
  user_type ENUM('customer', 'admin') DEFAULT 'customer',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Vehicles Table
CREATE TABLE vehicles (
  id INT PRIMARY KEY AUTO_INCREMENT,
  vehicle_name VARCHAR(100) NOT NULL,
  vehicle_type VARCHAR(50) NOT NULL,
  brand VARCHAR(50),
  model VARCHAR(50),
  year INT,
  price_per_day DECIMAL(10, 2) NOT NULL,
  description TEXT,
  image_url VARCHAR(255),
  status ENUM('available', 'unavailable', 'maintenance') DEFAULT 'available',
  capacity INT DEFAULT 5,
  transmission VARCHAR(20),
  fuel_type VARCHAR(20),
  color VARCHAR(30),
  mileage INT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Bookings Table
CREATE TABLE bookings (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT NOT NULL,
  vehicle_id INT NOT NULL,
  pickup_date DATE NOT NULL,
  return_date DATE NOT NULL,
  pickup_location VARCHAR(100),
  return_location VARCHAR(100),
  total_price DECIMAL(10, 2),
  status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
  payment_status ENUM('unpaid', 'paid') DEFAULT 'unpaid',
  special_requirements TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
  FOREIGN KEY (vehicle_id) REFERENCES vehicles(id) ON DELETE CASCADE
);

-- Payments Table
CREATE TABLE payments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  booking_id INT NOT NULL,
  user_id INT NOT NULL,
  amount DECIMAL(10, 2) NOT NULL,
  payment_method VARCHAR(50),
  transaction_id VARCHAR(100),
  payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status ENUM('success', 'failed', 'pending') DEFAULT 'pending',
  FOREIGN KEY (booking_id) REFERENCES bookings(id) ON DELETE CASCADE,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Payroll Reports Table
CREATE TABLE payroll_reports (
  id INT PRIMARY KEY AUTO_INCREMENT,
  report_date DATE NOT NULL,
  total_revenue DECIMAL(10, 2),
  total_bookings INT,
  completed_bookings INT,
  pending_bookings INT,
  average_booking_value DECIMAL(10, 2),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Testimonials Table
CREATE TABLE testimonials (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  message TEXT NOT NULL,
  rating INT DEFAULT 5,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Create Indexes
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_vehicle_status ON vehicles(status);
CREATE INDEX idx_booking_user ON bookings(user_id);
CREATE INDEX idx_booking_vehicle ON bookings(vehicle_id);
CREATE INDEX idx_booking_dates ON bookings(pickup_date, return_date);
CREATE INDEX idx_payment_booking ON payments(booking_id);