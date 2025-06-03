USE system-management;

INSERT INTO users (email, password, first_name, last_name, role, created_at, updated_at) 
VALUES 
('test@test.com', '$2y$12$VYCKivWbWoFLGF/tWlNRRu5GEWUPH0rZblGWgIrBfBSeaxc0WDIje', 'Admin', 'Admin', 'admin', NOW(), NOW());
