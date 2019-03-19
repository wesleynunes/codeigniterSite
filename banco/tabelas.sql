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
    arquivo			varchar(120), 	
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



CREATE TABLE IF NOT EXISTS categorias(
	id_categoria		int(11) 		not null auto_increment,
    categoria			varchar(100)	not null,
	data_criacao 		datetime, 		
    data_alteracao 		datetime, 		
    primary key(id_categoria),
    unique index categoria_UNIQUE (categoria asc)
)ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;


--
-- Table structure for table `ci_sessions`
--

CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `user_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Table structure for table `tbl_roles`
--

CREATE TABLE roles (
  id_role 	tinyint(4) NOT NULL COMMENT 'role id',
  role	 	varchar(50) NOT NULL COMMENT 'role text',
  primary key(id_role)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_roles`
--

INSERT INTO `roles` (`id_role`, `role`) VALUES
(1, 'Admin'),
(2, 'Manager'),
(3, 'Employee');
    


INSERT INTO `site`.`usuarios` (`usuario`, `email`, `senha`, `arquivo`, `data_criacao`, `data_alteracao`) 
VALUES ('wes','wesley@wfuturo.com', MD5('123'), 'teste.jpg', '2019-02-08', '2019-02-08');


INSERT INTO `site`.`categorias` (`categoria`,`data_criacao`, `data_alteracao`) 
VALUES ('eletronica','2019-02-13', '2019-02-13');


INSERT INTO `site`.`categorias` (`categoria`,`data_criacao`, `data_alteracao`) 
VALUES ('informatica','2019-02-13', '2019-02-13');



select * from `site`.`usuarios`;

select * from `site`.`uploaded_images`;

select * from site.categorias;
