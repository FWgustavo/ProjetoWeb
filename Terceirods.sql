create database if not exists TerceiroDS;

use TerceiroDS;

create table if not exists Usuario(
nome varchar(50),
id int auto_increment,
email varchar(50),
senha varchar(50),
primary key(id)
);

insert into Usuario(nome,email,senha) values('Gustavo', 'gu@gmail.com',sha1('123'));