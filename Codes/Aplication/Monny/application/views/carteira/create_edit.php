<html>
	<div class='col-lg-12'>
		<div class='row'>
			<div class='col-lg-6 table rounded titulo-tabela'>
    			<h1>
    				<?php
    					echo ((isset($obj['Id'])) ? 'Editar Carteira' : 'Nova Carteira');
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
				<?php echo form_open('carteira/formCreateEdit'); ?>
					<input type='hidden' id='id' name='id' value='<?php if(!empty($obj['Id'])) echo $obj['Id']; ?>'/>
					<input type='hidden' id='usuario_id' name='usuario_id' value='<?php if(!empty($obj['Usuario_id'])) echo $obj['Usuario_id']; else echo $usuario_atual['Id']; ?>'/>
				 	<div class='form-group col-lg-4' style='margin-top: 15px'>
					    <label for='nome'>Nome da carteira:</label>
					    <input type='text' class='form-control' id='nome' name='nome' value='<?php if(!empty($obj['Nome'])) echo $obj['Nome']; ?>'>
				  	</div>
				  	<div class='form-group col-lg-4' style='margin-top: 15px'>
					    <label for='sigla'>Descrição:</label>
					    <input type='text' class='form-control' id='descricao' name='descricao' value='<?php if(!empty($obj['Descricao'])) echo $obj['Descricao']; ?>'>
				  	</div>
				  	<div class='form-group col-lg-4'>
				  		<label for='nome'>Carteira Mestre:</label>
						<select name='carteira_mestre_select_id' id='carteira_mestre_select_id' class='form-control' style='padding-left: 0px;'>
							<?php
								echo " <option value='0' style='background-color: #A5A4A0;'>É uma carteira RAIZ</option> ";
								for ($i = 0; $i < count($list_carteiras); $i++)
								{
									$selected = "";
									if($list_carteiras[$i]['Id'] != $obj['Id'] AND $list_carteiras[$i]['Ativo'] == 1)
									{
										if($list_carteiras[$i]['Id'] == $obj['Carteira_mestre_id'])
											$selected = "selected";
										echo "<option class='background_dark' $selected value='" . $list_carteiras[$i]['Id'] . "'>" . $list_carteiras[$i]['Nome'] . "</option>";
										echo "";
									}
								}
							?>
						</select>
					</div>
				  	<div class='form-group col-lg-4'>
						<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
							<?php
								$checked = "";
								if($obj['Ativo'] == 1 or !(isset($obj['Id'])))
									$checked = "checked";
								
								echo"<label for='ativo' >";
									echo "<input type='checkbox' $checked id='ativo' name='ativo' value='1' /><span></span> Carteira ativa";
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