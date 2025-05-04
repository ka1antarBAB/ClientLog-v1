# create table users(
#   id int auto_increment primary key ,
#   username varchar(100) not null ,
#   phone_number varchar(20) not null unique ,
#     email varchar(100),
#     address text,
#     source varchar(100),
#     category ENUM('A', 'B', 'C') default 'C',
#     created_at timestamp default current_timestamp
# );
#
# create table notes (
#     id int auto_increment primary key ,
#     user_id int not null ,
#     title varchar(100),
#     note text not null ,
#     contact_date datetime default current_timestamp,
#     foreign key (user_id) references users(id) on delete cascade
# );

# create table admins(
#     id INT auto_increment primary key ,
#     username varchar(50) not null unique ,
#     password varchar(255) not null ,
#     fullname varchar(100)
# );