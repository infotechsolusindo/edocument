/*!
alter table user_jabatan rename user_group;

alter table user_group 
    change idjabatan idgroup int not null, 
    add namagroup varchar(20);

alter table user_group
    change namagroup gname varchar(20),
    add gpath varchar(30);

alter table user_group drop column userid;

alter table _spool
    modify procname varchar(50) not null,
    add data blob after procname;
*/
alter table user_departemen
modify userid varchar(30) not null unique;


