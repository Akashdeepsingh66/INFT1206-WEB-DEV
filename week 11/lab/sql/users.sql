CREATE DATABASE Lab8

CREATE TABLE users (
                       id SERIAL PRIMARY KEY,
                       name VARCHAR(100),
                       email VARCHAR(100),
                       country VARCHAR(50)
);