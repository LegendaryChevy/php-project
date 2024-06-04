drop database user_auth;
create database user_auth;
use user_auth;

GRANT ALL PRIVILEGES ON *.* TO 'legendarychevy'@'localhost' WITH GRANT OPTION;
FLUSH PRIVILEGES;     

create table users(
    id int auto_increment primary key,
    username varchar(50) unique not null,
    password varchar(255) not null,
    created_at timestamp default current_timestamp
);