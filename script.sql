-- Select the database
USE blog_db;

-- Create the posts table if it doesn't exist
CREATE TABLE IF NOT EXISTS posts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    author VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Insert data into the posts table and ignore if there's a duplicate
INSERT IGNORE INTO posts (id, title, content, author, created_at, updated_at) VALUES
(1, 'title1', 'content1', 'author1', '2024-08-11', NULL),
(2, 'title2', 'content2', 'author2', '2024-08-12', NULL),
(3, 'title3', 'content3', 'author3', '2024-08-13', '2024-08-13'),
(4, 'title4', 'content4', 'author4', '2024-08-14', '2024-08-15');

