<html>

	<div class='container- col-lg-12'>
		<div class='row' style='margin-top: 20px'>
			<?php
		    	echo"<div class='col-lg-5 fundo-divs rounded' style='margin-bottom:10px; font-size: 24px'>";
		    			echo ((isset($obj['Id'])) ? 'Editar Usuário' : 'Nov Usuário');
				echo "</div>";
		    ?>
			<div class='col-lg-12 rounded fundo-divs'>
				<?php echo form_open('usuario/formCreateEdit'); ?>
					<input type='hidden' id='id' name='id' value='<?php if(!empty($obj['Id'])) echo $obj['Id']; ?>'/>
				 	<div class='form-group col-lg-4' style='margin-top: 15px'>
					    <label for='nome'>Nome do usuário:</label>
					    <input type='text' class='form-control' id='nome' name='nome'>
				  	</div>
				  	<div class='form-group'>
						<div class='checkbox checbox-switch switch-success custom-controls-stacked'>
							<?php
								$checked = "";
								if($obj['Ativo'] == 1)
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