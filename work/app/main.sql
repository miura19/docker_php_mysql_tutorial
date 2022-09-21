create table todos(
    id int not null auto_increment,
    is_done bool default false,
    title text,
    primary key (id)
);

insert into todos (title) values ('aaa');
insert into todos (title,is_done) values ('bbb',true);
insert into todos (title) values ('ccc');

select * from todos;