-- create database called mockwebdb (or put whatever you like )
CREATE DATABASE mockwebdb;

-- after creating the db use it to store our tables
USE mockwebdb;

-- table for registered users - customer
CREATE TABLE customer (
    customer_id VARCHAR(10) PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    address TEXT,
    district VARCHAR(100),
    postal_code VARCHAR(10),
    nic_number VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    profile_picture_path VARCHAR(255),
    nic_scan_path VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- table for registered users - staff_membder
CREATE TABLE staff_member (
    staff_id VARCHAR(10) PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    date_of_birth DATE NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    address TEXT,
    district VARCHAR(100),
    postal_code VARCHAR(10),
    nic_number VARCHAR(20) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    contact_number VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    position VARCHAR(100) NOT NULL,
    branch VARCHAR(100) NOT NULL,
    profile_picture_path VARCHAR(255),
    nic_scan_path VARCHAR(255),
    resume_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

