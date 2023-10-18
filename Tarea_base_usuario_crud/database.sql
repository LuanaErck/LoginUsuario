
create database myDB;

use myDB;

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL auto_increment,
  `correo` varchar(100),
  `contraseña` varchar(100),
  PRIMARY KEY  (`id`)
);



