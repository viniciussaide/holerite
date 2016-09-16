<?php
	require_once("config/db.php");
	$conn_root = mysqli_connect(DB_HOST, DB_USER_ROOT, DB_PASS_ROOT) or die ("Erro ao conectar");
	$bd = mysqli_select_db($conn_root, "holerite") or die("Não foi possível selecionar o banco de dados.");
	mysqli_set_charset($conn_root, "utf8");
	$query = "ALTER TABLE `desconto` DROP FOREIGN KEY `fk_matricula_desconto`;
		ALTER TABLE `holerite` DROP FOREIGN KEY `fk_matricula_holerite`;
		ALTER TABLE `imposto_arquivo` DROP FOREIGN KEY `imposto_arquivo_fk`;
		ALTER TABLE `plr` DROP FOREIGN KEY `fk_matricula_plr`;
		ALTER TABLE `provento` DROP FOREIGN KEY `fk_matricula_provento`;
		ALTER TABLE `users` CHANGE `matricula` `matricula` INT(20) NOT NULL;
		ALTER TABLE `users` DROP `user_type`;
		ALTER TABLE `users` DROP INDEX `user_name`;
		ALTER TABLE `users` ADD `cargo` VARCHAR(255) NOT NULL , ADD `email` VARCHAR(255) NOT NULL , ADD `fk_id_setor` INT(20) NOT NULL ;
		ALTER TABLE `users` CHANGE `fk_id_setor` `fk_id_setor` INT(20) NULL DEFAULT '1';
		ALTER TABLE `users` ADD INDEX(`fk_id_setor`);
		ALTER TABLE `provento` CHANGE `id` `id_provento` INT(20) NOT NULL AUTO_INCREMENT;
		ALTER TABLE `provento` CHANGE `matricula` `fk_matricula` INT(20) NOT NULL;
		ALTER TABLE `provento` ADD `fk_holerite` INT(20) NOT NULL ;
		ALTER TABLE `plr` DROP PRIMARY KEY;
		ALTER TABLE `plr` ADD `id_plr` INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY FIRST;
		ALTER TABLE `plr` CHANGE `matricula` `fk_matricula` VARCHAR(60) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL;
		ALTER TABLE `plr` CHANGE `fk_matricula` `fk_matricula` INT(20) NOT NULL;
		ALTER TABLE `imposto_arquivo` CHANGE `id_arquivo` `id_arquivo` INT(20) NOT NULL AUTO_INCREMENT;
		ALTER TABLE `imposto_arquivo` CHANGE `matricula` `fk_matricula` INT(20) NOT NULL;
		ALTER TABLE `holerite` CHANGE `id` `id_holerite` INT(20) NOT NULL AUTO_INCREMENT;
		ALTER TABLE `holerite` CHANGE `matricula` `fk_matricula` INT(20) NOT NULL;
		ALTER TABLE `desconto` CHANGE `id` `id_desconto` INT(20) NOT NULL AUTO_INCREMENT;
		ALTER TABLE `desconto` CHANGE `matricula` `fk_matricula` INT(20) NOT NULL;
		ALTER TABLE `desconto` ADD `fk_holerite` INT(20) NOT NULL AFTER `id_desconto`;
		ALTER TABLE `provento` ADD INDEX(`fk_holerite`);
		ALTER TABLE `plr` ADD INDEX(`fk_matricula`);
		ALTER TABLE `imposto_arquivo` DROP INDEX `matricula`;
		ALTER TABLE `imposto_arquivo` ADD INDEX(`fk_matricula`);
		ALTER TABLE `holerite` DROP INDEX `user_name`;
		ALTER TABLE `holerite` ADD INDEX(`fk_matricula`);
		ALTER TABLE `desconto` DROP INDEX `user_name`;
		ALTER TABLE `desconto` ADD INDEX(`fk_holerite`);
		CREATE TABLE total_final LIKE holerite; 
		INSERT total_final SELECT * FROM holerite;
		ALTER TABLE `total_final` CHANGE `id_holerite` `fk_id_holerite` INT(20) NOT NULL;
		ALTER TABLE total_final DROP INDEX fk_matricula;
		ALTER TABLE `total_final`
		  DROP `fk_matricula`,
		  DROP `nome`,
		  DROP `cpf`,
		  DROP `mes`,
		  DROP `ano`,
		  DROP `data_credito`,
		  DROP `dataCadastro`;
		";
	$result = mysqli_multi_query($conn_root, $query);
	while (mysqli_more_results($conn_root)){
		mysqli_next_result($conn_root);
		if (!$result = mysqli_store_result($conn_root)) {
			echo mysqli_error ($conn_root);
		}
	}
	echo "Remoção de Foreign Keys concluído!</br>";
	$query = "SELECT * FROM holerite";
	$result = mysqli_query($conn_root, $query);
	echo mysqli_error ($conn_root);
	if ($result){
		$query = "UPDATE provento JOIN holerite 
			ON holerite.fk_matricula=provento.fk_matricula 
			AND holerite.data_credito=provento.data_credito 
			SET provento.fk_holerite=holerite.id_holerite;";
		mysqli_query($conn_root, $query);
		$query = "UPDATE desconto JOIN holerite 
			ON holerite.fk_matricula=desconto.fk_matricula 
			AND holerite.data_credito=desconto.data_credito 
			SET desconto.fk_holerite=holerite.id_holerite;";
		mysqli_query($conn_root, $query);
		echo "Atualização das chaves tabela provento e desconto concluído!</br>";
		$query = "DROP TABLE IF EXISTS `funcao`;
			CREATE TABLE IF NOT EXISTS `funcao` (
			  `id_funcao` int(20) NOT NULL AUTO_INCREMENT,
			  `funcao` varchar(50) NOT NULL,
			  `pagina_php` varchar(255) NOT NULL,
			  `prioridade` double NOT NULL,
			  `nome_menu` varchar(255) NOT NULL,
			  `tipo_menu` varchar(255) NOT NULL,
			  PRIMARY KEY (`id_funcao`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

			-- --------------------------------------------------------

			--
			-- Estrutura da tabela `mensagem`
			--

			DROP TABLE IF EXISTS `mensagem`;
			CREATE TABLE IF NOT EXISTS `mensagem` (
			  `id_mensagem` int(20) NOT NULL AUTO_INCREMENT,
			  `descricao` varchar(255) NOT NULL,
			  `titulo` varchar(255) NOT NULL,
			  `mensagem` text NOT NULL,
			  `data_inicio` date DEFAULT NULL,
			  `data_fim` date DEFAULT NULL,
			  `tela_inicial` tinyint(1) DEFAULT '0',
			  PRIMARY KEY (`id_mensagem`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

			-- --------------------------------------------------------

			--
			-- Estrutura da tabela `relacao_mensagem_user`
			--

			DROP TABLE IF EXISTS `relacao_mensagem_user`;
			CREATE TABLE IF NOT EXISTS `relacao_mensagem_user` (
			  `fk_id_mensagem` int(20) NOT NULL,
			  `fk_matricula` int(20) NOT NULL,
			  `data_visualizacao` date DEFAULT NULL,
			  KEY `fk_id_mensagem` (`fk_id_mensagem`),
			  KEY `fk_matricula` (`fk_matricula`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			-- --------------------------------------------------------

			--
			-- Estrutura da tabela `relacao_type_funcao`
			--

			DROP TABLE IF EXISTS `relacao_type_funcao`;
			CREATE TABLE IF NOT EXISTS `relacao_type_funcao` (
			  `fk_id_funcao` int(20) NOT NULL,
			  `fk_id_user_type` int(20) NOT NULL,
			  KEY `fk_id_funcao` (`fk_id_funcao`),
			  KEY `fk_id_type` (`fk_id_user_type`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			-- --------------------------------------------------------

			--
			-- Estrutura da tabela `relacao_type_mensagem`
			--

			DROP TABLE IF EXISTS `relacao_type_mensagem`;
			CREATE TABLE IF NOT EXISTS `relacao_type_mensagem` (
			  `fk_id_user_type` int(20) NOT NULL,
			  `fk_id_mensagem` int(20) NOT NULL,
			  KEY `fk_user_type` (`fk_id_user_type`),
			  KEY `fk_id_mensagem` (`fk_id_mensagem`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			-- --------------------------------------------------------

			--
			-- Estrutura da tabela `relacao_type_user`
			--

			DROP TABLE IF EXISTS `relacao_type_user`;
			CREATE TABLE IF NOT EXISTS `relacao_type_user` (
			  `fk_id_user_type` int(20) NOT NULL,
			  `fk_matricula` int(20) NOT NULL,
			  KEY `fk_matricula` (`fk_matricula`),
			  KEY `fk_id_type` (`fk_id_user_type`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1;

			-- --------------------------------------------------------

			--
			-- Estrutura da tabela `setor`
			--

			DROP TABLE IF EXISTS `setor`;
			CREATE TABLE IF NOT EXISTS `setor` (
			  `id_setor` int(20) NOT NULL AUTO_INCREMENT,
			  `setor` varchar(50) NOT NULL,
			  PRIMARY KEY (`id_setor`),
			  UNIQUE KEY `setor` (`setor`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

			-- --------------------------------------------------------

			--
			-- Estrutura da tabela `user_type`
			--

			DROP TABLE IF EXISTS `user_type`;
			CREATE TABLE IF NOT EXISTS `user_type` (
			  `id_user_type` int(20) NOT NULL AUTO_INCREMENT,
			  `type` varchar(50) NOT NULL,
			  PRIMARY KEY (`id_user_type`)
			) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

			--
			-- Constraints for dumped tables
			--

			--
			-- Limitadores para a tabela `relacao_mensagem_user`
			--
			ALTER TABLE `relacao_mensagem_user`
			  ADD CONSTRAINT `relacao_mensagem_user_fk_id_mensagem` FOREIGN KEY (`fk_id_mensagem`) REFERENCES `mensagem` (`id_mensagem`) ON DELETE CASCADE,
			  ADD CONSTRAINT `relacao_mensagem_user_fk_matricula` FOREIGN KEY (`fk_matricula`) REFERENCES `users` (`matricula`) ON DELETE CASCADE;

			--
			-- Limitadores para a tabela `relacao_type_funcao`
			--
			ALTER TABLE `relacao_type_funcao`
			  ADD CONSTRAINT `relacao_type_funcao_fk_id_funcao` FOREIGN KEY (`fk_id_funcao`) REFERENCES `funcao` (`id_funcao`) ON DELETE CASCADE,
			  ADD CONSTRAINT `relacao_type_funcao_fk_id_user_type` FOREIGN KEY (`fk_id_user_type`) REFERENCES `user_type` (`id_user_type`) ON DELETE CASCADE;

			--
			-- Limitadores para a tabela `relacao_type_mensagem`
			--
			ALTER TABLE `relacao_type_mensagem`
			  ADD CONSTRAINT `relacao_type_mensagem_fk_id_mensagem` FOREIGN KEY (`fk_id_mensagem`) REFERENCES `mensagem` (`id_mensagem`) ON DELETE CASCADE,
			  ADD CONSTRAINT `relacao_type_mensagem_fk_id_user_type` FOREIGN KEY (`fk_id_user_type`) REFERENCES `user_type` (`id_user_type`) ON DELETE CASCADE;

			--
			-- Limitadores para a tabela `relacao_type_user`
			--
			ALTER TABLE `relacao_type_user`
			  ADD CONSTRAINT `relacao_type_user_fk_id_user_type` FOREIGN KEY (`fk_id_user_type`) REFERENCES `user_type` (`id_user_type`) ON DELETE CASCADE,
			  ADD CONSTRAINT `relacao_type_user_fk_matricula` FOREIGN KEY (`fk_matricula`) REFERENCES `users` (`matricula`) ON DELETE CASCADE;

			--
			-- Limitadores para a tabela `total_final`
			--
			ALTER TABLE `total_final`
			  ADD CONSTRAINT `total_final_fk_id_holerite` FOREIGN KEY (`fk_id_holerite`) REFERENCES `holerite` (`id_holerite`) ON DELETE CASCADE;

			--
			-- Retornar com Foreign Keys apís atualização
			--
			
			  INSERT INTO `setor`(`id_setor`, `setor`) VALUES ('1','Não atribuído');
			  UPDATE users SET fk_id_setor='1' WHERE matricula<>'';
			  ALTER TABLE `users` ADD CONSTRAINT `users_fk_id_setor` FOREIGN KEY (`fk_id_setor`) REFERENCES `holerite`.`setor`(`id_setor`) ON DELETE RESTRICT ON UPDATE RESTRICT;
			  ALTER TABLE `provento` ADD CONSTRAINT `provento_fk_holerite` FOREIGN KEY (`fk_holerite`) REFERENCES `holerite`.`holerite`(`id_holerite`) ON DELETE CASCADE ON UPDATE RESTRICT;
			  ALTER TABLE `plr` ADD CONSTRAINT `plr_fk_matricula` FOREIGN KEY (`fk_matricula`) REFERENCES `holerite`.`users`(`matricula`) ON DELETE CASCADE ON UPDATE RESTRICT;
			  ALTER TABLE `imposto_arquivo` ADD CONSTRAINT `imposto_arquivo_fk_matricula` FOREIGN KEY (`fk_matricula`) REFERENCES `holerite`.`users`(`matricula`) ON DELETE CASCADE ON UPDATE RESTRICT;
			  ALTER TABLE `desconto` ADD CONSTRAINT `desconto_fk_holerite` FOREIGN KEY (`fk_holerite`) REFERENCES `holerite`.`holerite`(`id_holerite`) ON DELETE CASCADE ON UPDATE RESTRICT;
			  ALTER TABLE `holerite` ADD CONSTRAINT `holerite_fk_matricula` FOREIGN KEY (`fk_matricula`) REFERENCES `holerite`.`users`(`matricula`) ON DELETE CASCADE ON UPDATE RESTRICT;
			  INSERT INTO `holerite`.`user_type` (`id_user_type`, `type`) VALUES ('1', 'super_admin'), ('2', 'default');
			  INSERT INTO `funcao` (`id_funcao`, `funcao`, `pagina_php`, `prioridade`, `nome_menu`, `tipo_menu`) VALUES
				(1, 'Página Inicial', 'home.php', 1, 'Home', 'Superior Simples'),
				(2, 'Verificar Holerites', 'holerite.php', 2, 'Holerite', 'Superior Simples'),
				(3, 'Links Úteis', 'links.php', 3, 'Links Úteis', 'Superior Simples'),
				(4, 'Fale Conosco', 'contato.php', 5, 'Fale Conosco', 'Superior Simples'),
				(15, 'Mostra Imposto de Renda', 'impostoRenda.php', 3, 'Imposto de Renda', '18'),
				(16, 'Relatório de chaves', 'relatorio.php', 1, 'Relatório de Chaves', '18'),
				(17, 'Extrato PLR', 'extrato_plr.php', 2, 'Extrato PLR', '18'),
				(18, 'Dropdown Serviços', '#', 4, 'Serviços', 'Superior Dropdown'),
				(19, 'Gerenciar Mensagens', 'gerenciar_mensagens.php', 1, '<span class=\"glyphicon glyphicon-envelope\"></span> Mensagens', '23'),
				(20, 'Gerenciar Usuários', 'gerenciar_usuarios.php', 3, '<span class=\"glyphicon glyphicon-user\"></span> Usuários', '23'),
				(21, 'Gerenciar Grupos', 'gerenciar_grupos.php', 4, '<span class=\"glyphicon glyphicon-briefcase\"></span> Grupos', '23'),
				(22, 'Gerenciar Funções', 'gerenciar_funcoes.php', 5, '<span class=\"glyphicon glyphicon-cog\"></span> Funções', '23'),
				(23, 'Dropdown Gerenciar', '#', 1, 'Gerenciar', 'Lateral Dropdown'),
				(24, 'Importar Holerite', 'importar_holerite.php', 2, 'Importar Holerite', 'Lateral Simples'),
				(25, 'Perfil', 'troca_senha.php', 1, '<span class=\"glyphicon glyphicon-user\"></span> Alterar Perfil', 'Perfil'),
				(26, 'Gerenciar Usuários Super Admin', 'gerenciar_usuarios_super_admin.php', 2, '<span class=\"glyphicon glyphicon-user\"></span> Usuários (Super_Admin)', '23'),
				(27, 'Importar Efetivo', 'importar_efetivo.php', 3, 'Importar Efetivo', 'Lateral Simples');
			  INSERT INTO `relacao_type_funcao` (`fk_id_funcao`, `fk_id_user_type`) VALUES
				(1, 2),
				(2, 2),
				(3, 2),
				(15, 2),
				(17, 2),
				(18, 2),
				(1, 1),
				(2, 1),
				(3, 1),
				(15, 1),
				(17, 1),
				(18, 1),
				(19, 1),
				(21, 1),
				(22, 1),
				(23, 1),
				(24, 1),
				(26, 1),
				(27, 1),
				(4, 1),
				(4, 2),
				(25, 1),
				(25, 2);
			  INSERT INTO `mensagem` (`id_mensagem`, `descricao`, `titulo`, `mensagem`, `data_inicio`, `data_fim`, `tela_inicial`) VALUES
				(1, 'Mensagem de Tela inicial', 'Título de Teste', '', '2016-06-01', '2016-06-30', 1);
			  INSERT INTO `holerite`.`relacao_type_mensagem` (`fk_id_user_type`, `fk_id_mensagem`) VALUES ('1', '1');
			  ";
		$result = mysqli_multi_query($conn_root, $query);
		while (mysqli_more_results($conn_root)){
			mysqli_next_result($conn_root);
			if (!$result = mysqli_store_result($conn_root)) {
				echo mysqli_error ($conn_root);
			}
		}
		echo "Criação das tabelas e chaves novas concluído!</br>";
		echo "Renovação das chaves estrangeiras concluído!</br>";
		$query = "ALTER TABLE `provento`
					  DROP `fk_matricula`,
					  DROP `data_credito`,
					  DROP `mes`,
					  DROP `ano`,
					  DROP `dataCadastro`;
					  
				  ALTER TABLE `holerite`
					  DROP `nome`,
					  DROP `cpf`,
					  DROP `salario_base`,
					  DROP `base_inss`,
					  DROP `base_irrf`,
					  DROP `base_fgts`,
					  DROP `fgts_mes`,
					  DROP `total_credito`,
					  DROP `total_debito`,
					  DROP `valor_liquido`;
					  
				  ALTER TABLE `desconto`
					  DROP `fk_matricula`,
					  DROP `data_credito`,
					  DROP `mes`,
					  DROP `ano`,
					  DROP `dataCadastro`";
		$result = mysqli_multi_query($conn_root, $query);
		while (mysqli_more_results($conn_root)){
			mysqli_next_result($conn_root);
			if (!$result = mysqli_store_result($conn_root)) {
				echo mysqli_error ($conn_root);
			}
		}
		echo "Remoção de colunas desnecessárias concluído!</br>";
	}
	else {
		echo mysqli_error ($conn_root);
	}
	mysqli_close($conn_root);
?>