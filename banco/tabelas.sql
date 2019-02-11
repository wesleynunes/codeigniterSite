--
-- CRIAR BANCO DE DADOS
--
CREATE DATABASE IF NOT EXISTS site; 

USE site;
--
-- CRIAR TABELA USUARIOS
--
CREATE TABLE IF NOT EXISTS usuarios(
	id_usuario 		tinyint(11) 	not null auto_increment,
	usuario 		varchar(50) 	not null,	
	email 			varchar(100) 	not null, 
	senha 			varchar(120) 	not null,
    arquivo			varchar(120) 	not null,
    data_criacao 	datetime 		not null,
    data_alteracao 	datetime 		not null,
	PRIMARY KEY(id_usuario),
    UNIQUE INDEX usuario_UNIQUE (usuario ASC),
	UNIQUE INDEX email_UNIQUE (email ASC)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


CREATE TABLE IF NOT EXISTS `uploaded_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_dir` varchar(120) NOT NULL,
  `date_uploaded` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;




INSERT INTO `site`.`usuarios` (`usuario`, `email`, `senha`, `arquivo`, `data_criacao`, `data_alteracao`) 
VALUES ('wes','wesley@wfuturo.com', MD5('123'), 'teste.jpg', '2019-02-08', '2019-02-08');

select * from `site`.`usuarios`;


select * from `site`.`uploaded_images`;
