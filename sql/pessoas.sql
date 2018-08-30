CREATE TABLE `tab_pessoass` (
  `id_pessoa` int(11) NOT NULL AUTO_INCREMENT,
  `nome_pessoa` varchar(200) NOT NULL,
  `cpf_cnpj_pessoa` varchar(20) NOT NULL,
  `data_nasc_pessoa` date NOT NULL,
  `peso_pessoa` decimal(10,2) DEFAULT NULL,
  `uf_pessoa` varchar(45) DEFAULT NULL,
  `DATE_CADASTRO` datetime NOT NULL,
  PRIMARY KEY (`id_pessoa`),
  UNIQUE KEY `id_pessoa_UNIQUE` (`id_pessoa`),
  UNIQUE KEY `cpf_cnpj_pessoa_UNIQUE` (`cpf_cnpj_pessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1
