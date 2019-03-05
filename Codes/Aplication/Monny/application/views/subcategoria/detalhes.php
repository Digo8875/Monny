<html>
	<div class='col-lg-12'>
		<div class='row'>
			<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>Detalhes da Subcategoria</h1>
    		</div>
    		<div class='col-lg-1 titulo-tabela'>
    			<?php
	    			echo "<a href='javascript:window.history.go(-1)' class='btn btn-secondary' title='Voltar'>";
						echo "<span class='glyphicon glyphicon-arrow-left' style='font-size: 25px;'></span>";
					echo "</a>";
		    	?>
    		</div>
		</div>

		<div class='row'>
			<table class='table table-striped rounded col-lg-12'>
				</tr>
				<tr>
					<td>Nome</td>
					<?php
					echo "<td>".$obj['Nome']."</td>";
					?>
				</tr>
				<tr>
					<td>Ativo</td>
					<?php
					echo "<td>".(($obj['Ativo'] == 1) ? 'Sim' : 'Não')."</td>";
					?>
				</tr>
				<tr>
					<td>Data de registro</td>
					<?php
					echo "<td>".$obj['Data_registro']."</td>";
					?>
				</tr>
				<tr>
					<td>Categoria</td>
					<?php
					echo "<td>".$obj['Nome_categoria']."</td>";
					?>
				</tr>
			</table>
		</div>
	</div>
</html>