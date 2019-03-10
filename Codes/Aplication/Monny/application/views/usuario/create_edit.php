<html>
	<div class='col-lg-12'>
		<div class='row'>
			<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>
    				<?php
    					echo ((isset($obj['Id'])) ? 'Editar Usuário' : 'Novo Usuário');
    				?>
    			</h1>
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
			<div class='col-lg-12 rounded fundo-divs'>
				<?php echo form_open('usuario/formCreateEdit'); ?>
					<input type='hidden' id='id' name='id' value='<?php if(!empty($obj['Id'])) echo $obj['Id']; ?>'/>
				 	<div class='form-group col-lg-4' style='margin-top: 15px'>
					    <label for='nome'>Nome do usuário:</label>
					    <input type='text' class='form-control' id='nome' name='nome' value='<?php if(!empty($obj['Nome'])) echo $obj['Nome']; ?>'>
				  	</div>
				  	<div class='form-group col-lg-4'>
						<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
							<?php
								$checked = "";
								if($obj['Ativo'] == 1 or !(isset($obj['Id'])))
									$checked = "checked";
								
								echo"<label for='ativo' >";
									echo "<input type='checkbox' $checked id='ativo' name='ativo' value='1' /><span></span> Usuário ativo";
								echo"</label>";
							?>
						</div>
					</div>
				  	<?php
						if(!isset($obj['Id']))
							echo"<input  type='submit' id='btn_cadastro_obj' class='btn btn-digo btn-block col-lg-2 offset-lg-1' value='Cadastrar'>";
						else
							echo"<input type='submit' id='btn_cadastro_obj' class='btn btn-digo btn-block col-lg-2 offset-lg-1' value='Atualizar'>";
					?>
				</form>
			</div>
		</div>
	</div>
</html>