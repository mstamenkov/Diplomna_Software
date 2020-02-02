
USE ALARM_SYSTEM;
SELECT * FROM users WHERE username = 'tonipelovski19';
#Create table userModules(
#	recordId int primary key auto_increment,
 #   moduleId INT not null,
#    userId INT not null,
 #   
#    foreign key (moduleId) references modules(id) ON update cascade,
 #   foreign key (userId) references users(id) On update cascade
#);

#insert into users(username,password) values('mitko','ggg');
#insert into users(username,password) values('gosho','ggg');
#insert into modules(id,userId) values(43653546,1);
#insert into userModules(moduleId,userId) values(43653546,1);

#select * from userModules where userId