<html>
    <div class='col-lg-12'>
    	<div class='row'>
    		<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Lista de Tipos Monetários</h1>
    		</div>
    		<div class='col-lg-2 titulo-tabela'>
    			<?php
    			echo "<a class='btn btn-secondary' href='".base_url()."index.php/tipo_dinheiro/create'><span class='glyphicon glyphicon-plus'></span> Novo Tipo Monetário</a>";
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
			      <th>Sigla</th>
			      <th>Ações</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
			  	for($i = 0; $i < count($lista_tipo_dinheiros); $i++)
				{
					echo '<tr>';
						echo '<td>'.($i + 1).'</td>';
						echo '<td>'.$lista_tipo_dinheiros[$i]['Id'].'</td>';
						echo '<td>'.$lista_tipo_dinheiros[$i]['Nome'].'</td>';
						echo '<td>'.$lista_tipo_dinheiros[$i]['Data_registro'].'</td>';
						echo '<td>'.(($lista_tipo_dinheiros[$i]['Ativo'] == 1) ? 'Sim' : 'Não').'</td>';
						echo '<td>'.$lista_tipo_dinheiros[$i]['Sigla'].'</td>';
						echo "<td>";
							echo "<a href='".base_url()."index.php/tipo_dinheiro/edit/".$lista_tipo_dinheiros[$i]['Id']."' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  ";
							echo "<a href='".base_url()."index.php/tipo_dinheiro/detalhes/".$lista_tipo_dinheiros[$i]['Id']."' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  ";
							echo "<a href='".base_url()."index.php/tipo_dinheiro/deletar/".$lista_tipo_dinheiros[$i]['Id']."' title='Apagar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>";
						echo "</td>";
					echo '</tr>';
				}
				?>
			  </tbody>
			</table>
		</div>
	</div>
</html>