<html>
    <div class='col-lg-12'>
    	<div class='row'>
    		<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Lista de Carteiras</h1>
    		</div>
    		<div class='col-lg-2 titulo-tabela'>
    			<?php
    			echo "<a class='btn btn-secondary' href='".base_url()."index.php/carteira/create'><span class='glyphicon glyphicon-plus'></span> Nova Carteira</a>";
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
			      <th>Descrição</th>
			      <th>Data Registro</th>
			      <th>Carteira Mestre</th>
			      <th>Ativo</th>
			      <th>Ações</th>
			    </tr>
			  </thead>
			  <tbody>
			  	<?php
			  	for($i = 0; $i < count($lista_carteiras); $i++)
				{
					echo '<tr>';
					echo '<td>'.($i + 1).'</td>';
					echo '<td>'.$lista_carteiras[$i]['Id'].'</td>';
					echo '<td>'.$lista_carteiras[$i]['Nome'].'</td>';
					echo '<td class="texto-grande-esconder">'.$lista_carteiras[$i]['Descricao'].'</td>';
					echo '<td>'.$lista_carteiras[$i]['Data_registro'].'</td>';
					if(is_null($lista_carteiras[$i]['Carteira_mestre_id']))
						echo '<td> RAIZ </td>';
					else
						echo '<td>'.$lista_carteiras[$i]['Carteira_mestre_id'].'</td>';
					echo '<td>'.(($lista_carteiras[$i]['Ativo'] == 1) ? 'Sim' : 'Não').'</td>';
					echo "<td>";
						echo "<a href='".base_url()."index.php/carteira/edit/".$lista_carteiras[$i]['Id']."' title='Editar' style='cursor: pointer;' class='glyphicon glyphicon-edit text-dark'></a>  |  ";
						echo "<a href='".base_url()."index.php/carteira/detalhes/".$lista_carteiras[$i]['Id']."' title='Detalhes' style='cursor: pointer;' class='glyphicon glyphicon-th text-dark'></a>  |  ";
						echo "<a href='".base_url()."index.php/carteira/deletar/".$lista_carteiras[$i]['Id']."' title='Apagar' style='cursor: pointer;' class='glyphicon glyphicon-trash text-dark'></a>";
					echo "</td>";
					echo '</tr>';
				}
				?>
			  </tbody>
			</table>
		</div>
	</div>
</html>