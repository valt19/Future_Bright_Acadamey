CREATE DATABASE IF NOT EXISTS school_website;
USE school_website;

CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(180) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS school_settings (
    id INT AUTO_INCREMENT PRIMARY KEY,
    school_name VARCHAR(255) NOT NULL,
    school_tagline VARCHAR(255) DEFAULT NULL,
    school_email VARCHAR(180) DEFAULT NULL,
    school_phone VARCHAR(80) DEFAULT NULL,
    school_address VARCHAR(255) DEFAULT NULL,
    school_vision TEXT DEFAULT NULL,
    school_mission TEXT DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    summary TEXT,
    content LONGTEXT,
    image_path VARCHAR(255) DEFAULT NULL,
    is_published TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    is_published TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT,
    event_date DATE,
    event_time TIME,
    location VARCHAR(255) DEFAULT NULL,
    is_published TINYINT(1) DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS gallery (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    caption TEXT,
    image_path VARCHAR(255) NOT NULL,
    category VARCHAR(120) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS messages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    email VARCHAR(180) NOT NULL,
    phone VARCHAR(80) DEFAULT NULL,
    message TEXT NOT NULL,
    status ENUM('unread', 'read') DEFAULT 'unread',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO admins (name, email, password_hash)
VALUES ('Super Admin', 'admin@example.com', '$2y$10$KJ2mAnQ7M3tm0X0xq9w4vO2d9j4f9cZWS4aS/0mXw3A.ZrUO1/VzO')
ON DUPLICATE KEY UPDATE email = email;

INSERT INTO school_settings (school_name, school_tagline, school_email, school_phone, school_address, school_vision, school_mission)
VALUES (
    'Future Bright Academy',
    'Learning with Purpose and Heart',
    'info@futurebrightacademy.edu',
    '+1 (555) 123-4567',
    '123 Learning Avenue, Town Center, Country',
    'To inspire confident learners and responsible global citizens.',
    'To provide quality education in a nurturing and inclusive environment.'
)
ON DUPLICATE KEY UPDATE school_name = school_name;
