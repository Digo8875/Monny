<html>
    <div class='col-lg-12'>
    	<div class='row'>
    		<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Lista de Responsáveis</h1>
    		</div>
    		<div class='col-lg-2 titulo-tabela'>
    			<?php
    			echo "<a class='btn btn-secondary' href='".base_url()."index.php/responsavel/create'><span class='glyphicon glyphicon-plus'></span> Novo Responsável</a>";
				?>
    		</div>
    	</div>

    	<div class='row'>
	    	<table class='table table-striped rounded col-lg-12'>
			  <thead class='rounded'>
			    <tr>
			      <th>#</th>
			      <th>Id</th>
			      <th>Nome</th>
			      <th>Data Registro</th>
			      <th>Ativo</th>
			      <th>Descrição</th>
			      <th>Ações</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
			  	for($i = 0; $i < count($lista_responsaveis); $i++)
				{
					echo '<tr>';
						echo '<td>'.($i + 1).'</td>';
						echo '<td>'.$lista_responsaveis[$i]['Id'].'</td>';
						echo '<td>'.$lista_responsaveis[$i]['Nome'].'</td>';
						echo '<td>'.$lista_responsaveis[$i]['Data_registro'].'</td>';
						echo '<td>'.(($lista_responsaveis[$i]['Ativo'] == 1) ? 'Sim' : 'Não').'</td>';
						echo '<td>'.$lista_responsaveis[$i]['Descricao'].'</td>';
						echo '<td>ACT</td>';
					echo '</tr>';
				}
				?>
			  </tbody>
			</table>
		</div>
	</div>
</html>