CREATE TABLE login_details (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE work_details (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    job_title VARCHAR(50) NOT NULL,
    company_name VARCHAR(100) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE,
    description TEXT,
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES login_details(id)
);
