create table ToDoList_Tbl(
todolist_key integer not null auto_increment,
todogroup_key integer,
content varchar(50),
closing_day datetime,
primary key(todolist_key)
);

create table ToDoGrp_Tbl(
todogroup_key integer not null auto_increment,
todogroup varchar(15),
checked boolean,
primary key(todogroup_key)
);
