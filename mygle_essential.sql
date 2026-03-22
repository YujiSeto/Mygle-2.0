	(5560,14,1508407,'Xinguara','PA'),
	(5561,5,2933604,'Xique-Xique','BA'),
	(5562,15,2517407,'ZabelÃª','PB'),
	(5563,25,3557154,'Zacarias','SP'),
	(5564,10,2114007,'ZÃ© Doca','MA'),
	(5565,24,4219853,'ZortÃ©a','SC');




# Dump da tabela clients
# ------------------------------------------------------------



CREATE TABLE `clients` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `address2` varchar(100) DEFAULT NULL,
  `address_number` varchar(50) DEFAULT NULL,
  `address_neighb` varchar(100) DEFAULT NULL,
  `address_city` varchar(50) DEFAULT NULL,
  `address_citycode` int(11) DEFAULT NULL,
  `address_state` varchar(50) DEFAULT NULL,
  `address_country` varchar(50) DEFAULT NULL,
  `address_countrycode` int(11) DEFAULT NULL,
  `address_zipcode` varchar(50) DEFAULT NULL,
  `stars` int(11) NOT NULL DEFAULT '3',
  `internal_obs` text,
  `cpf` varchar(20) DEFAULT NULL,
  `cnpj` varchar(20) DEFAULT NULL,
  `foreignid` varchar(20) DEFAULT NULL,
  `iedest` int(11) DEFAULT NULL,
  `ie` int(11) DEFAULT NULL,
  `isuf` varchar(20) DEFAULT NULL,
  `im` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;








# Dump da tabela companies
# ------------------------------------------------------------



CREATE TABLE `companies` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `nfe_number` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `companies` (`id`, `name`, `nfe_number`)
VALUES
	(1,'Mygle',10000010);




# Dump da tabela inventory
# ------------------------------------------------------------



CREATE TABLE `inventory` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `price` float NOT NULL,
  `quant` int(11) NOT NULL,
  `min_quant` int(11) NOT NULL,
  `cEAN` varchar(20) DEFAULT NULL,
  `NCM` int(11) DEFAULT NULL,
  `EXTIPI` varchar(20) DEFAULT NULL,
  `CFOP` int(11) DEFAULT NULL,
  `uCom` varchar(5) DEFAULT NULL,
  `cEANTrib` float DEFAULT NULL,
  `uTrib` varchar(10) DEFAULT NULL,
  `vFrete` int(11) DEFAULT NULL,
  `vSeg` int(11) DEFAULT NULL,
  `vDesc` int(11) DEFAULT NULL,
  `vOutro` int(11) DEFAULT NULL,
  `indTot` int(11) DEFAULT NULL,
  `xPed` int(11) DEFAULT NULL,
  `nItemPed` int(11) DEFAULT NULL,
  `nFCI` varchar(20) DEFAULT NULL,
  `cst` varchar(5) DEFAULT NULL,
  `pPIS` varchar(10) DEFAULT NULL,
  `pCOFINS` varchar(10) DEFAULT NULL,
  `csosn` int(11) DEFAULT NULL,
  `pICMS` varchar(10) DEFAULT NULL,
  `orig` int(11) DEFAULT NULL,
  `modBC` varchar(10) DEFAULT NULL,
  `vICMSDeson` varchar(10) DEFAULT NULL,
  `pRedBC` varchar(10) DEFAULT NULL,
  `modBCST` varchar(10) DEFAULT NULL,
  `pMVAST` varchar(10) DEFAULT NULL,
  `pRedBCST` varchar(10) DEFAULT NULL,
  `vBCSTRet` varchar(10) DEFAULT NULL,
  `vICMSSTRet` varchar(10) DEFAULT NULL,
  `qBCProd` varchar(10) DEFAULT NULL,
  `vAliqProd` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




# Dump da tabela inventory_history
# ------------------------------------------------------------



CREATE TABLE `inventory_history` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `action` varchar(3) NOT NULL DEFAULT '',
  `date_action` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




# Dump da tabela permission_groups
# ------------------------------------------------------------



CREATE TABLE `permission_groups` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  `params` varchar(200) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `permission_groups` (`id`, `id_company`, `name`, `params`)
VALUES
	(1,1,'Administradores','1,2,7,9,10,11,12,13,14,15,16,18');




# Dump da tabela permission_params
# ------------------------------------------------------------



CREATE TABLE `permission_params` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `permission_params` (`id`, `id_company`, `name`)
VALUES
	(1,1,'logout'),
	(2,1,'permissions_view'),
	(7,1,'nomedapermissao'),
	(9,1,'users_view'),
	(10,1,'clients_view'),
	(11,1,'clients_edit'),
	(12,1,'inventory_view'),
	(13,1,'inventory_add'),
	(14,1,'inventory_edit'),
	(15,1,'sales_view'),
	(16,1,'sales_edit'),
	(18,1,'report_view');




# Dump da tabela purchases
# ------------------------------------------------------------



CREATE TABLE `purchases` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_purchase` datetime NOT NULL,
  `total_price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela purchases_products
# ------------------------------------------------------------



CREATE TABLE `purchases_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_purchase` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '',
  `quant` int(11) NOT NULL,
  `purchase_price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump da tabela sales
# ------------------------------------------------------------



CREATE TABLE `sales` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_sale` datetime NOT NULL,
  `total_price` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  `nfe_key` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




# Dump da tabela sales_products
# ------------------------------------------------------------



CREATE TABLE `sales_products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `id_sale` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quant` int(11) NOT NULL,
  `sale_price` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




# Dump da tabela users
# ------------------------------------------------------------



CREATE TABLE `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `id_group` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



INSERT INTO `users` (`id`, `id_company`, `email`, `password`, `id_group`)
VALUES
	(1,1,'admin@mygle.com','21232f297a57a5a743894a0e4a801fc3',1);





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
