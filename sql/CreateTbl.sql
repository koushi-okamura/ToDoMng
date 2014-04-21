create table ToDoList_Tbl(
todolist_key integer not null auto_increment,
todocircle_key integer,
content varchar(50),
closing_day datetime,
primary key(todolist_key)
);


create table ToDoGroup_Tbl(
todogroup_key integer not null auto_increment,
todolist_key integer,
todogroup varchar(15),
checked boolean,
primary key(todogroup_key,todolist_key)
);


create table ToDoCircle_Tbl(
todocircle_key integer not null auto_increment,
todocircle varchar(30),
primary key(todocircle_key)
);
