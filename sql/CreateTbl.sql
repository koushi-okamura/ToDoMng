create table ToDoList_Tbl(
keyid integer not null auto_increment,
group varchar(15),
content varchar(50),
closing_day datetime,
primary key(keyid)
);

create table ToDoGrp_Tbl(
group varchar(15),
primary key(group)
);