<html lang="pt-br">
	<head> 
		
		<title><?php echo $title;?></title>
		<meta charset="utf-8">
		<?php echo"<link rel='shortcut icon' href='".base_url()."content/imagens/pageicon.jpg'>"; ?>
		<?= link_tag('content/css/bootstrap.min.css') ?>
		<?= link_tag('content/css/normalize.css') ?>
		<?= link_tag('content/css/font-awesome.css') ?>
		<?= link_tag('content/css/glyphicons.css') ?>
		<?= link_tag('content/css/site.css') ?>
		<?= link_tag('content/css/default.css') ?>
		<meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
		
		<style type='text/css'>
			
		</style>
	</head>
	<body>
	<div class='container-fluid div-mestre col-lg-12'>
		<header class='cabecalho col-lg-12'>
			<div class='row'>
				<nav class='navbar rounded col-lg-12'>
					<div class='row col-lg-12'>
						<div class='col-lg-3 offset-lg-8' id='conteiner_usuario_atual'>
						<select name='usuario_contexto_id' id='usuario_contexto_id' class='form-control' style='padding-left: 0px;'>
							<?php
							if($usuario_atual['Id'] == 0)
							{
								echo " <option value='0' style='background-color: #A5A4A0;'>Selecione um usuário</option> ";
							}
							else
							{
								echo " <option value='".$usuario_atual['Id']."' style='background-color: #A5A4A0;'>".$usuario_atual['Nome']."</option> ";
							}
							for ($i = 0; $i < count($list_usuarios_ativos); $i++)
							{
								$selected = "";
								if ($list_usuarios_ativos[$i]['Id'] == $usuario_atual['Id'])
									$selected = "selected";
								echo "<option class='background_dark' $selected value='" . $list_usuarios_ativos[$i]['Id'] . "'>" . $list_usuarios_ativos[$i]['Nome'] . "</option>";
								echo "";
							}
							?>
						</select>
						</div>
						<div class='col-lg-1'>
							<button class='btn btn-secondary col-lg-12' type='button' id='configuracoes' aria-haspopup='true' aria-expanded='false'>
						    	Config
							</button>
						</div>
					</div>
					<div class='col-lg-12'>
						<?php echo "<a class='navbar-brand col-lg-3' href='".base_url()."'>";?>
							<nav class='navbar-light bg-light rounded col-lg-12'>
								<div class='col-lg-12'>
									<?php echo "<img src='".base_url()."content/imagens/logo.jpg' width='100' height='100' alt='' class='logo rounded'>";?>
								</div>
								<div class='texto-logo col-lg-12'>
							  		<h3>Monny</h3>
							  	</div>
							</nav>
						</a>
					</div>
				</nav>
			</div>
			</br>
			<div class='row'>
				<nav class='navbar rounded col-lg-12'>
					<div class='dropdown col-lg-2'>
						<button class='btn btn-secondary dropdown-toggle col-lg-12' type='button' id='dropdownMenuFuncionalidades' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
					    	Funcionalidades
						</button>
						<div class='dropdown-menu col-lg-12' aria-labelledby='dropdownMenuFuncionalidades'>
					    	<a class='dropdown-item' href='#'>Registro Financeiro</a>
					    	<?php echo "<a class='dropdown-item' href='".base_url()."index.php/carteira/index'>Carteiras</a>";?>
					    	<a class='dropdown-item' href='#'>Objetivos</a>
					    	<a class='dropdown-item' href='#'>Dívidas</a>
					    	<a class='dropdown-item' href='#'>Agendamentos</a>
					    </div>
					</div>
					<div class='dropdown col-lg-2'>
						<button class='btn btn-secondary dropdown-toggle col-lg-12' type='button' id='dropdownMenuRelatorios' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
					    	Relatórios
						</button>
						<div class='dropdown-menu col-lg-12' aria-labelledby='dropdownMenuRelatorios'>
					    	<a class='dropdown-item' href='#'>Balanços</a>
					    	<a class='dropdown-item' href='#'>Categorias</a>
					    	<a class='dropdown-item' href='#'>Objetivos</a>
					    	<a class='dropdown-item' href='#'>Dívidas</a>
					    	<a class='dropdown-item' href='#'>Doações</a>
					    </div>
					</div>
					<div class='dropdown col-lg-2'>
						<button class='btn btn-secondary dropdown-toggle col-lg-12' type='button' id='dropdownMenuAdministracao' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
					    	Administração
						</button>
						<div class='dropdown-menu col-lg-12' aria-labelledby='dropdownMenuAdministracao'>
					    	<?php echo "<a class='dropdown-item' href='".base_url()."index.php/categoria/index'>Categorias</a>";?>
					    	<?php echo "<a class='dropdown-item' href='".base_url()."index.php/subcategoria/index'>Subcategorias</a>";?>
					    	<?php echo "<a class='dropdown-item' href='".base_url()."index.php/tipo_dinheiro/index'>Moeda</a>";?>
					    	<?php echo "<a class='dropdown-item' href='".base_url()."index.php/usuario/index'>Usuários</a>";?>
					    	<?php echo "<a class='dropdown-item' href='".base_url()."index.php/responsavel/index'>Responsáveis</a>";?>
					    </div>
					</div>
					<div class='col-lg-6'>
						
					</div>
				</nav>
			</div>
		</header>
		