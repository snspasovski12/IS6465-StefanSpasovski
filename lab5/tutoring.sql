
-- Part 1: Create Tables

-- Create the students table
CREATE TABLE IF NOT EXISTS students (
    student_id INTEGER PRIMARY KEY,
    student_name TEXT NOT NULL,
    student_email TEXT NOT NULL UNIQUE
);

-- Create the tutoring_requests table
CREATE TABLE IF NOT EXISTS tutoring_requests (
    request_id INTEGER PRIMARY KEY,
    student_id INTEGER NOT NULL,
    course TEXT NOT NULL,
    topic TEXT NOT NULL,
    preferred_date TEXT NOT NULL,
    preferred_time TEXT NOT NULL,
    status TEXT NOT NULL DEFAULT 'Open',
    created_at TEXT NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES students(student_id)
);


-- Part 2: Insert Students and Tutoring Requests

-- Insert two students
INSERT INTO students (student_name, student_email)
VALUES ('Jordan Lee', 'jordan.lee@example.edu');

INSERT INTO students (student_name, student_email)
VALUES ('Avery Patel', 'avery.patel@example.edu');


-- Insert three tutoring requests
INSERT INTO tutoring_requests
(student_id, course, topic, preferred_date, preferred_time)
VALUES (1, 'IS 6465', 'Forms', '2026-11-05', '10:00');

INSERT INTO tutoring_requests
(student_id, course, topic, preferred_date, preferred_time)
VALUES (1, 'IS 6465', 'SQL SELECT', '2026-11-06', '14:00');

INSERT INTO tutoring_requests
(student_id, course, topic, preferred_date, preferred_time)
VALUES (2, 'IS 6465', 'SQLite CRUD', '2026-11-07', '11:00');



-- Part 3: Read the Stored Data

-- 1. Display all students
SELECT * FROM students;

-- 2. Display all tutoring requests
SELECT * FROM tutoring_requests;

-- 3. Display only Open requests
SELECT * FROM tutoring_requests
WHERE status = 'Open';

-- 4. Display one request by request_id
SELECT * FROM tutoring_requests
WHERE request_id = 1;

-- 5. Display requests with student information
SELECT
    r.request_id,
    s.student_name,
    s.student_email,
    r.course,
    r.topic,
    r.preferred_date,
    r.preferred_time,
    r.status
FROM tutoring_requests AS r
JOIN students AS s
ON r.student_id = s.student_id
ORDER BY r.preferred_date;



-- Part 4: Update One Request

-- Update Jordan's first request
UPDATE tutoring_requests
SET topic = 'HTML Forms'
WHERE request_id = 1;

-- Cancel Avery's request
UPDATE tutoring_requests
SET status = 'Cancelled'
WHERE request_id = 3;


-- Part 5: Delete One Test Request

-- Insert a test request
INSERT INTO tutoring_requests
(student_id, course, topic, preferred_date, preferred_time)
VALUES (1, 'IS 6465', 'Delete Practice', '2026-11-10', '13:00');

-- Delete only the test request
DELETE FROM tutoring_requests
WHERE request_id = 4;

-- Verify the remaining requests
SELECT * FROM tutoring_requests;
