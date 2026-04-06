-- Name: Patrick Sullivan
-- Date: April 5, 2026
-- Description: SQL schema and sample data for the client site database.
USE patricks_client_site_db;

CREATE TABLE visitors (
    visitor_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL,
    age INT NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE contact_submissions (
    submission_id INT AUTO_INCREMENT PRIMARY KEY,
    visitor_id INT NOT NULL,
    reason VARCHAR(50) NOT NULL,
    message TEXT NOT NULL,
    submitted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    CONSTRAINT fk_visitor
        FOREIGN KEY (visitor_id) REFERENCES visitors(visitor_id)
        ON DELETE CASCADE
);

INSERT INTO visitors (name, age, email)
VALUES
('Jane Doe', 29, 'jane@example.com'),
('Michael Smith', 41, 'michael@example.com');

INSERT INTO contact_submissions (visitor_id, reason, message)
VALUES
(1, 'consultation', 'I would like to schedule a consultation.'),
(2, 'question', 'Can you provide more information about the services provided?');