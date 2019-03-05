<html>
	<div class='col-lg-12'>
		<div class='row'>
			<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>
    				<?php
    					echo ((isset($obj['Id'])) ? 'Editar Subcategoria' : 'Nova Subcategoria');
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
				<?php echo form_open('subcategoria/formCreateEdit'); ?>
					<input type='hidden' id='id' name='id' value='<?php if(!empty($obj['Id'])) echo $obj['Id']; ?>'/>
				 	<div class='form-group col-lg-4' style='margin-top: 15px'>
					    <label for='nome'>Nome da subcategoria:</label>
					    <input type='text' class='form-control' id='nome' name='nome' value='<?php if(!empty($obj['Nome'])) echo $obj['Nome']; ?>'>
				  	</div>
				  	<div class='form-group col-lg-4'>
				  		<label for='nome'>Escolha a qual categoria pertence:</label>
						<select name='categoria_select_id' id='categoria_select_id' class='form-control' style='padding-left: 0px;'>
							<?php
								echo " <option value='0' style='background-color: #A5A4A0;'>Selecione uma categoria</option> ";
								for ($i = 0; $i < count($list_categorias); $i++)
								{
									$selected = "";
									if ($list_categorias[$i]['Id'] == $obj['Id_categoria'])
										$selected = "selected";
									echo "<option class='background_dark' $selected value='" . $list_categorias[$i]['Id'] . "'>" . $list_categorias[$i]['Nome'] . "</option>";
									echo "";
								}
							?>
						</select>
						</div>
				  	<div class='form-group col-lg-4'>
						<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
							<?php
								$checked = "";
								if($obj['Ativo'] == 1)
									$checked = "checked";
								
								echo"<label for='ativo' >";
									echo "<input type='checkbox' $checked id='ativo' name='ativo' value='1' /><span></span> Subcategoria ativa";
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