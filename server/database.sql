DROP DATABASE IF EXISTS ALARM_SYSTEM;
CREATE DATABASE ALARM_SYSTEM;
USE ALARM_SYSTEM;

CREATE TABLE users(
	id INT primary key auto_increment,
    username VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL
    
);

CREATE TABLE modules(
    id INT primary key not null
);

CREATE TABLE moduleData(
	id INT primary key auto_increment,
    userId INT not null,
    latitude DECIMAL(10, 8) not null,
    longitude DECIMAL(11, 8) NOT NULL,
    imuEvent INT not null
);

Create table userModules(
	recordId int primary key auto_increment,
    moduleId INT not null,
    userId INT not null,
    
    foreign key (moduleId) references modules(id) ON update cascade,
    foreign key (userId) references users(id) On update cascade
);

#insert into users(username,password) values('mitko','ggg');
#insert into users(username,password) values('gosho','ggg');
insert into modules values(43653546);
insert into userModules(moduleId,userId) values(43653546,1);