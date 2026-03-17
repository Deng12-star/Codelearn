-- Create the database
CREATE DATABASE IF NOT EXISTS codelearn;
USE codelearn;

-- Courses table
CREATE TABLE IF NOT EXISTS courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(255) NOT NULL UNIQUE,
    image_url VARCHAR(255)
);

-- Videos table
CREATE TABLE IF NOT EXISTS videos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT NOT NULL,
    title VARCHAR(255) NOT NULL,
    thumbnail_url VARCHAR(255),
    view_count INT DEFAULT 0,
    likes INT DEFAULT 0,
    comments INT DEFAULT 0,
    video_url VARCHAR(255) NOT NULL,
    FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

-- Seed data for courses
INSERT INTO courses (course_name, image_url) VALUES 
('Python', 'assets/python.png'),
('PHP', 'assets/php.png'),
('JavaScript', 'assets/javascript.png');

-- Seed data for videos (Python course)
-- Assuming course_id 1 is Python
INSERT INTO videos (course_id, title, thumbnail_url, view_count, likes, comments, video_url) VALUES 
(1, 'Python Tutorial for Beginners', 'https://img.youtube.com/vi/rfscVS0vtbw/maxresdefault.jpg', 12000000, 450000, 12000, 'https://www.youtube.com/watch?v=rfscVS0vtbw'),
(1, 'Python Crash Course', 'https://img.youtube.com/vi/Z1Yd7upQsXY/maxresdefault.jpg', 3500000, 120000, 4500, 'https://www.youtube.com/watch?v=Z1Yd7upQsXY'),
(1, 'Learn Python in 6 Hours', 'https://img.youtube.com/vi/H1VlE1A2vT0/maxresdefault.jpg', 2100000, 85000, 3200, 'https://www.youtube.com/watch?v=H1VlE1A2vT0'),
(1, 'Advanced Python Course', 'https://img.youtube.com/vi/k6U-X6u_X7U/maxresdefault.jpg', 1500000, 60000, 1500, 'https://www.youtube.com/watch?v=k6U-X6u_X7U'),
(1, 'Python for Data Science', 'https://img.youtube.com/vi/Xn7K8A4N8P0/maxresdefault.jpg', 1100000, 40000, 1100, 'https://www.youtube.com/watch?v=Xn7K8A4N8P0');

-- Seed data for videos (PHP & JS - Optional but good for variety)
INSERT INTO videos (course_id, title, thumbnail_url, view_count, likes, comments, video_url) VALUES 
(2, 'PHP for Beginners', 'https://img.youtube.com/vi/OK_JCtrrv-c/maxresdefault.jpg', 500000, 15000, 900, 'https://www.youtube.com/watch?v=OK_JCtrrv-c'),
(3, 'JavaScript Course', 'https://img.youtube.com/vi/W6NZfCO5SIk/maxresdefault.jpg', 8000000, 250000, 15000, 'https://www.youtube.com/watch?v=W6NZfCO5SIk');
