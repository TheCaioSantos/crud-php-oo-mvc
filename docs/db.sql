create database crudphpoo /*!40100 DEFAULT CHARACTER SET utf8 */;

use crudphpoo;

create table usuario(
	id_usuario int(11) primary key AUTO_INCREMENT not null,
	nome_usuario varchar(50),
	nick_usuario varchar(20) unique,
	senha_usuario varchar(32)
)engine=innodb CHARSET=utf8;

create table funcionario(
	id_funcionario int(11) primary key AUTO_INCREMENT not null,
	nome_funcionario varchar(50),
	modo_de_trabalho_funcionario enum('Local','Home Office'),
	data_inicio_funcionario date,
	id_usuario int(11),
	id_cargo int(11)
)engine=innodb CHARSET=utf8;

create table cargo(
	id_cargo int(11) primary key AUTO_INCREMENT not null,
	nome_cargo varchar(50)
)engine=innodb CHARSET=utf8;

ALTER TABLE funcionario ADD CONSTRAINT fk_funcionario_1 
FOREIGN KEY(id_usuario) REFERENCES usuario (id_usuario);

ALTER TABLE funcionario ADD CONSTRAINT fk_funcionario_2 
FOREIGN KEY(id_cargo) REFERENCES cargo (id_cargo);

INSERT INTO usuario VALUES 
(default, 'Administrador', 'admin', md5('123'));

INSERT INTO cargo VALUES 
(default, 'Back-end'),
(default, 'Front-end'),
(default, 'Full-Stack'),
(default, 'Gerente');

INSERT INTO funcionario VALUES 
(default, 'Adriano Alves', 'Home Office', '2001-01-01', '1', '3'),
(default, 'Gustavo Medeiros', 'Local', '2010-01-01', '1', '4'),
(default, 'Camila Fernandes', 'Local', '2015-01-01', '1', '1'),
(default, 'Fabiana Bezerra', 'Local', '2004-01-01', '1', '1'),
(default, 'Pedro Herique', 'Home Office', '2014-01-01', '1', '2'),
(default, 'João Silva', 'Home Office', '2003-01-01', '1', '1'),
(default, 'Francisco de Assis', 'Local', '2002-01-01', '1', '4'),
(default, 'Fellipe Silva', 'Local', '2020-01-01', '1', '2'),
(default, 'Aline dos Santos', 'Home Office', '2000-10-05', '1', '3'),
(default, 'Caio Santos', 'Local', '2021-01-01', '1', '1');