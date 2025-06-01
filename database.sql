-- Create the database
CREATE DATABASE IF NOT EXISTS avu_university;
USE avu_university;

-- =========================
-- Administrators Table
-- =========================
CREATE TABLE IF NOT EXISTS administrators (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- hashed
    email VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- Students Table
-- =========================
CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,  -- hashed
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================
-- Staff Table
-- =========================
CREATE TABLE IF NOT EXISTS staff (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    position VARCHAR(100),
    department VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    phone VARCHAR(20)
);

-- =========================
-- Subjects Table
-- =========================
CREATE TABLE IF NOT EXISTS subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    code VARCHAR(20),
    credits INT,
    description TEXT,
    staff_id INT,
    FOREIGN KEY (staff_id) REFERENCES staff(id) ON DELETE SET NULL
);

-- =========================
-- Materials Table
-- =========================
CREATE TABLE IF NOT EXISTS materials (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    subject_id INT,
    type VARCHAR(50),
    description TEXT,
    file_name VARCHAR(100),
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE SET NULL
);

-- =========================
-- Forms Table
-- =========================
CREATE TABLE IF NOT EXISTS forms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100),
    type VARCHAR(50),
    description TEXT,
    file_name VARCHAR(100)
);

-- =========================
-- Default Data Insert
-- =========================

-- Insert admin (password is hashed: password123)
INSERT INTO administrators (username, password, email) VALUES 
('admin', '$2y$10$pbD2N6UhRf0KqFQ7eK0oS.Qcl0B7ljqQK5Z6jJrccXvKojFXyYQd6', 'admin@avu.edu');

-- Insert sample staff
INSERT INTO staff (first_name, last_name, position, department, email, phone) VALUES
('John', 'Doe', 'Professor', 'Computer Science', 'j.doe@avu.edu', '0400000000'),
('Jane', 'Smith', 'Lecturer', 'Mathematics', 'j.smith@avu.edu', '0400000001');

-- Insert sample subjects
INSERT INTO subjects (name, code, credits, description, staff_id) VALUES
('Web Development', 'WD101', 3, 'Intro to full-stack development.', 1),
('Data Science', 'DS202', 4, 'Data analysis and machine learning.', 2);

-- Insert sample materials
INSERT INTO materials (title, subject_id, type, description, file_name) VALUES
('HTML Basics', 1, 'PDF', 'Covers HTML tags and structure.', 'html_basics.pdf'),
('Python for Data', 2, 'DOCX', 'Python libraries for data science.', 'python_data.docx');

-- Insert sample forms
INSERT INTO forms (title, type, description, file_name) VALUES
('Leave Application', 'Student', 'Form to apply for leave.', 'leave_form.pdf'),
('Staff Feedback', 'Staff', 'Anonymous feedback form.', 'feedback.docx');

-- Insert test student (password = test123)
INSERT INTO students (name, email, password) VALUES
('Alex Johnson', 'alex@student.avu.edu', '$2y$10$DFAk32Yp03lQQRxNHQnvBuh2chXLG/HWYNoUPJcSGZa1LZP4qqBsi');
