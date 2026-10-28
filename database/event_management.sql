-- Event Management System
-- Milestone 2: MySQL schema and sample data
-- Tested design target: MySQL 8.0+
CREATE DATABASE IF NOT EXISTS event_management_system
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE event_management_system;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS reviews;
DROP TABLE IF EXISTS registrations;
DROP TABLE IF EXISTS events;
DROP TABLE IF EXISTS venues;
DROP TABLE IF EXISTS categories;
DROP TABLE IF EXISTS users;
SET FOREIGN_KEY_CHECKS = 1;

CREATE TABLE users (
    user_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(120) NOT NULL,
    email VARCHAR(190) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    role ENUM('user', 'admin') NOT NULL DEFAULT 'user',
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE categories (
    category_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE venues (
    venue_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(150) NOT NULL,
    address VARCHAR(255) NOT NULL,
    city VARCHAR(100) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

CREATE TABLE events (
    event_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    category_id INT UNSIGNED NOT NULL,
    venue_id INT UNSIGNED NOT NULL,
    title VARCHAR(180) NOT NULL,
    description TEXT NOT NULL,
    event_date DATETIME NOT NULL,
    created_by INT UNSIGNED NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_events_category
        FOREIGN KEY (category_id) REFERENCES categories(category_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_events_venue
        FOREIGN KEY (venue_id) REFERENCES venues(venue_id)
        ON UPDATE CASCADE ON DELETE RESTRICT,
    CONSTRAINT fk_events_creator
        FOREIGN KEY (created_by) REFERENCES users(user_id)
        ON UPDATE CASCADE ON DELETE SET NULL,
    INDEX idx_events_date (event_date),
    INDEX idx_events_category (category_id),
    INDEX idx_events_venue (venue_id)
) ENGINE=InnoDB;

CREATE TABLE registrations (
    registration_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    event_id INT UNSIGNED NOT NULL,
    registration_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    status ENUM('registered', 'cancelled', 'attended') NOT NULL DEFAULT 'registered',
    CONSTRAINT fk_registrations_user
        FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_registrations_event
        FOREIGN KEY (event_id) REFERENCES events(event_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT uq_registration_user_event UNIQUE (user_id, event_id),
    INDEX idx_registrations_event (event_id)
) ENGINE=InnoDB;

CREATE TABLE reviews (
    review_id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT UNSIGNED NOT NULL,
    event_id INT UNSIGNED NOT NULL,
    rating TINYINT UNSIGNED NOT NULL,
    comment TEXT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_reviews_user
        FOREIGN KEY (user_id) REFERENCES users(user_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT fk_reviews_event
        FOREIGN KEY (event_id) REFERENCES events(event_id)
        ON UPDATE CASCADE ON DELETE CASCADE,
    CONSTRAINT uq_review_user_event UNIQUE (user_id, event_id),
    CONSTRAINT chk_reviews_rating CHECK (rating BETWEEN 1 AND 5),
    INDEX idx_reviews_event (event_id)
) ENGINE=InnoDB;

-- Sample data. All three sample accounts use the password: SamplePassword123!
-- These are local testing credentials only; do not use them in a deployed environment.
INSERT INTO users (user_id, full_name, email, password_hash, role) VALUES
(1, 'Sample Admin', 'admin@example.com', '$2y$12$zuLfwaq2xnlQac4Klb0qoe459cnTqvyxiwh8MHkUGi8cobguHXlce', 'admin'),
(2, 'Sample User', 'user@example.com', '$2y$12$zuLfwaq2xnlQac4Klb0qoe459cnTqvyxiwh8MHkUGi8cobguHXlce', 'user'),
(3, 'Another User', 'another@example.com', '$2y$12$zuLfwaq2xnlQac4Klb0qoe459cnTqvyxiwh8MHkUGi8cobguHXlce', 'user');

INSERT INTO categories (category_id, name, description) VALUES
(1, 'Technology', 'Technology talks, meetups, and innovation events.'),
(2, 'Education', 'Workshops and learning opportunities.'),
(3, 'Community', 'Local community gatherings and activities.');

INSERT INTO venues (venue_id, name, address, city) VALUES
(1, 'Main Conference Hall', '1 University Street', 'Sarajevo'),
(2, 'Workshop Room', '2 Campus Road', 'Sarajevo'),
(3, 'Community Centre', '10 City Square', 'Mostar');

INSERT INTO events (event_id, category_id, venue_id, title, description, event_date, created_by) VALUES
(1, 1, 1, 'Tech & Innovation Meetup', 'A meetup for technology enthusiasts and innovators.', '2026-11-15 17:00:00', 1),
(2, 2, 2, 'Learning Workshop', 'A workshop focused on practical skills.', '2026-11-20 10:00:00', 1),
(3, 3, 3, 'Community Gathering', 'An opportunity to connect with the local community.', '2026-11-25 16:00:00', 1);

INSERT INTO registrations (registration_id, user_id, event_id, status) VALUES
(1, 2, 1, 'registered'),
(2, 3, 2, 'registered');

INSERT INTO reviews (review_id, user_id, event_id, rating, comment) VALUES
(1, 2, 1, 5, 'A useful and engaging event.'),
(2, 3, 2, 4, 'Good workshop with practical information.');
