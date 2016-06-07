<?php
	require_once 'init.php';
	
	$mysql = new MySQL();
	$Prontuario = new Prontuario($mysql->link);
	$Cor = new Cor($mysql->link);
	$Escolaridade = new Escolaridade($mysql->link);
	$Especialidade = new Especialidade($mysql->link);
	$EstadoCivil = new EstadoCivil($mysql->link);
	$Naturalidade = new Naturalidade($mysql->link);
	$Ocupacao = new Ocupacao($mysql->link);
	
	function MontaGrupos($codGrupoSuperior){
		global $Prontuario;
		
		$listaGrupos = $Prontuario->getGrupos($codGrupoSuperior);
		 
		for($i=0; $i < sizeof($listaGrupos); $i++)
		{
			echo '<div class="panel panel-default">';
			echo '<div class="panel-heading">';
			echo $listaGrupos[$i]['Nom_Grupo'];
			echo '</div>';
			echo '<div class="panel-body">';
			echo '<div class="row">';
			echo '<div class="col-lg-12">';
			
			MontaPerguntas($listaGrupos[$i]['Cod_Grupo']);			
			MontaGrupos($listaGrupos[$i]['Cod_Grupo']);
			
			echo '</div>';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}
		 
		return $listaGrupos;
	}
	
	$contPergunta = 0;
	function MontaPerguntas($codGrupo){
		global $Prontuario;
		global $contPergunta;
		$listaPerguntas = $Prontuario->getPerguntas($codGrupo);
			
		for($i=0; $i < sizeof($listaPerguntas); $i++)
		{			
			echo '<div id="perg-'. $listaPerguntas[$i]['Cod_Pergunta'] .'" class="form-group clearfix avoid-break">';
			echo '<div class="col-md-3 col-xs-3">';
			echo '<label style="margin-bottom: 10;">' . $listaPerguntas[$i]['Des_Pergunta'] . '</label>';
			echo '</div>';
			
			if($listaPerguntas[$i]['Ind_Pergunta_Aberta']){
				echo '<div data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Aberta" class="col-md-6 col-xs-7 nopadding">';
				echo '<input type="text" class="form-control">';
				echo '</div>';
				echo '</br>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_SimNao']){
				echo '<div data-tipo="resposta" data-tipopergunta="Ind_Pergunta_SimNao" class="col-md-1 col-xs-1 nopadding">';
                echo '<div class="btn-group btn-toggle text-right" data-toggle="buttons">';
                echo '<label class="btn btn-default btn-sm">';
                echo '<input name="options' . $contPergunta . '[]" value="1" type="radio">Sim';
                echo '</label>';
                echo '<label class="btn btn-primary btn-sm active">';
                echo '<input name="options' . $contPergunta . '[]" value="0" type="radio" checked="checked">Nao';
                echo '</label>';
                echo '</div>';
                echo '</div>';
				
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Qual']){
				echo '<div id="divQual" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Qual" class="form-horizontal">';
				echo '<label class="control-label col-md-1 text-right float-left nopadding">Qual?</label>';
				echo '<div class="col-md-3 col-xs-3">
						<input id="Ind_Pergunta_Qual" type="text" class="form-control">
						</div>';
				echo '</div>';
				
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Quando']){
				echo '<div id="divQuando" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Quando" class="form-horizontal">';
				echo '<label class="control-label col-md-1 float-left text-right nopadding">Quando?</label>';
				echo '<div class="col-md-3 col-xs-3">
						<input id="Ind_Pergunta_Quando" type="text" class="form-control">
						</div>';
				echo '</div>';
				
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_ComboBox']){
				echo '<div class="col-md-3 col-xs-3 nopadding" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_ComboBox">';				
				
				$listaOpcoes = $Prontuario->getOpcoesCombo($listaPerguntas[$i]['Cod_Pergunta']);
				
				echo '<select class="form-control">';
				echo '<option value="">Selecione</option>';
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<option value="'.$listaOpcoes[$j]['Cod_Item_Combo'].'">'.$listaOpcoes[$j]['Des_Item_Combo'].'</option>';
				}
				echo '</select>';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Multi_Combo']){
					
				echo '<div class="col-md-3 col-lg-3 nopadding" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Multi_Combo">';
					
				$listaOpcoes = $Prontuario->getCategoriaMultiCombo($listaPerguntas[$i]['Cod_Pergunta']);
					
				echo '<select data-placeholder="Selecione" class="chosen-select" style="width: 300px" multiple>';
				echo '<option value=""></option>';
					
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<optgroup label="' . $listaOpcoes[$j]['Des_Categoria'] . '">';
			
					$listaItens = $Prontuario->getOpcoesMultiComboByCategoria($listaOpcoes[$j]['Cod_Categoria_Combo']);
			
					for ($k = 0; $k < sizeof($listaItens); $k++) {
						echo '<option value="'.$listaItens[$k]['Cod_Item_Multi_Combo'].'">'.$listaItens[$k]['Des_Item_Multi_Combo'].'</option>';
					}
				}
					
				echo '</select>';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Outros']){
				echo '<div id="divOutros" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Outros" class="form-horizontal">';
				echo '<label class="control-label col-md-1 float-left text-right nopadding">Outros:</label>';
				echo '<div class="col-md-3 col-xs-3">
					  <input id="Ind_Pergunta_Outros" type="text" class="form-control">
					  </div>';
				echo '</div>';
			
			}
				
			if($listaPerguntas[$i]['Ind_Pergunta_Observacao']){
				echo '<div id="divObservacao" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Observacao">';
				echo '<label class="control-label col-md-1 float-left text-right nopadding">Obs.:</label>';
				echo '<div class="col-md-5 col-xs-5">
						<input id="Ind_Pergunta_Observacao" type="text" class="form-control">
						</div>';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Cite']){
				echo '<div id="divCite" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Cite" class="form-horizontal">';
				echo '<label class="control-label col-md-1 float-left text-right nopadding">Cite:</label>';
				echo '<div class="col-md-3 col-xs-3">
					  <input id="Ind_Pergunta_Cite" type="text" class="form-control">
					  </div>';
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_Radio']){
				echo '<div class="col-md-9 col-xs-9 nopadding" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_Radio">';
				
				$listaOpcoes = $Prontuario->getOpcoesRadio($listaPerguntas[$i]['Cod_Pergunta']);
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<div class="col-md-6 col-xs-6 nopadding">';
					echo '<label class="control-label">' . $listaOpcoes[$j]['Des_Item_Radio'] . '</label>';
					echo '<input style="float:left;margin-right:5px"; id="Ind_Pergunta_Radio[]" name="Ind_Pergunta_Radio'.$listaPerguntas[$i]['Cod_Pergunta'].'[]" type="radio" value="'.$listaOpcoes[$j]['Cod_Item_Radio'].'" class="form-horizontal" >';
					echo '</div>';
				}
				
				echo '</div>';
			}
			
			if($listaPerguntas[$i]['Ind_Pergunta_CheckBox']){
				
				echo '<div class="col-md-12 nopadding" data-tipo="resposta" data-tipopergunta="Ind_Pergunta_CheckBox">';
				
				$listaOpcoes = $Prontuario->getOpcoesCheck($listaPerguntas[$i]['Cod_Pergunta']);
				for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
					echo '<div class="col-md-12 col-xs-12 nopadding">';
					echo '<label class="control-label col-md-2 col-xs-3 float-left">' . $listaOpcoes[$j]['Des_Item_Check'] . '</label>';
					echo '<input id="Ind_Pergunta_CheckBox[]" type="checkbox" value="'.$listaOpcoes[$j]['Cod_Item_Check'].'"class="form-horizontal" >';
					echo '</div>';
				}
				echo '</div>';
			}
			echo '</div>';
			
			$contPergunta++;
		}
	}
	
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/header.php"); ?>
</head>
<body>
	<?php include("includes/loading.php") ?>
    <div id="wrapper">
		<?php include("includes/menu.php") ?>
		
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Paciente</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-pencil-square-o"></i>
                            Dados Cadastrais
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                    	<div class="form-group col-md-12">
                                    		<div style="padding-bottom: 10px">
	                                        	<button id="saveCliente" type="button" class="btn btn-primary no-print"><i class="fa fa-save"></i> Salvar</button>
	                                        	<button id="btnCancelar" type="button" class="btn btn-default no-print"><i class="fa fa-mail-reply"></i> Voltar</button>
                                    		</div>
                                    	</div>
                                        <div class="form-group col-md-1 col-xs-2">
                                            <label>Código</label>
                                            <input id="codCliente" disabled="disabled" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4 col-xs-7">
                                            <label>Nome</label>
                                            <input id="nomCliente" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4 col-xs-3">
                                            <label>RG</label>
                                            <input id="numRg" class="form-control">
                                        </div>
										<div class="form-group col-md-4">
                                            <label>Endereço</label>
                                            <input id="enderecoCliente" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3 col-xs-4">
                                            <label>Telefone</label>
                                            <input id="telCliente" class="form-control">
                                        </div>
										<div class="form-group col-md-2 col-xs-4">
                                            <label>Data de Nascimento</label>
                                            <input id="dataNascimentoCliente" class="form-control">
                                        </div>	
                                        <div class="form-group col-md-2 col-xs-4">
                                            <label>Estado Civil</label>
                                            <?php 
                                            $listaOpcoes = $EstadoCivil->getLista();
                                            
                                            echo '<select id="estadoCivilCliente" class="form-control">';
                                            echo '<option value="">Selecione</option>';
												for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
													echo '<option value="'.$listaOpcoes[$j]['Cod_Estado_Civil'].'">'.$listaOpcoes[$j]['Nom_Estado_Civil'].'</option>';
												}
											echo '</select>';
											?>
                                        </div>	
                                        <div class="form-group col-md-2 col-xs-4">
                                            <label>Naturalidade</label>
                                            <?php 
                                            $listaOpcoes = $Naturalidade->getLista();
                                            
                                            echo '<select id="naturalidadeCliente" class="form-control">';
                                            echo '<option value="">Selecione</option>';
												for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
													echo '<option value="'.$listaOpcoes[$j]['Cod_Naturalidade'].'">'.$listaOpcoes[$j]['Nom_Naturalidade'].'</option>';
												}
											echo '</select>';
											?>
                                        </div>		
                                        <div class="form-group col-md-2 col-xs-4">
                                            <label>Escolaridade</label>
                                            <?php 
                                            $listaOpcoes = $Escolaridade->getLista();
                                            
                                            echo '<select id="escolaridadeCliente" class="form-control">';
                                            echo '<option value="">Selecione</option>';
												for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
													echo '<option value="'.$listaOpcoes[$j]['Cod_Escolaridade'].'">'. $listaOpcoes[$j]['Nom_Escolaridade'].'</option>';
												}
											echo '</select>';
											?>
                                        </div>	
										<div class="form-group col-md-2">
                                            <label>Sexo</label>
                                            <div class="radio">
				                                <label>
				                                    <input type="radio" id="sexoCliente[]" name="sexoCliente[]" value="M" class="form-horizontal" checked="checked"/> Masculino
				                                </label>
				                            </div>
				                            <div class="radio">
				                                <label>
				                                    <input type="radio" id="sexoCliente[]" name="sexoCliente[]" value="F" class="form-horizontal"/> Feminino
				                                </label>
				                            </div>
                                        </div>					
										<div class="form-group col-md-2 col-xs-4">
                                            <label>Cor</label>
                                            <?php 
                                            $listaOpcoes = $Cor->getLista();
                                            
                                            echo '<select id="corCliente" class="form-control">';
                                            echo '<option value="">Selecione</option>';
												for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
													echo '<option value="'.$listaOpcoes[$j]['Cod_Cor'].'">'.$listaOpcoes[$j]['Nom_Cor'].'</option>';
												}
											echo '</select>';
											?>
                                        </div>		
                                        <div class="form-group col-md-2 col-xs-4">
                                            <label>Ocupação</label>
                                            <?php 
                                            $listaOpcoes = $Ocupacao->getLista();
                                            
                                            echo '<select id="ocupacaoCliente" class="form-control">';
                                            echo '<option value="">Selecione</option>';
												for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
													echo '<option value="'.$listaOpcoes[$j]['Cod_Ocupacao'].'">'.$listaOpcoes[$j]['Nom_Ocupacao'].'</option>';
												}
											echo '</select>';
											?>
                                        </div>	
                                        <div class="form-group col-md-1 col-xs-2">
                                            <label>Filhos</label>
                                            <input id="numeroFilhosCliente" class="form-control">
                                        </div>
									</form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
					<div id="alert" class="alert alert-dismissable" style="display: none">
						<span class="text"></span>
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
					</div>
						                    
                    <div id="divHistPront" class="panel panel-default" style="display: none;">
                        <div class="panel-heading"><i class="fa fa-list-alt"></i>
                            Histórico Prontuário
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div id="divQuestionario">										                                    	
                                    	<div style="padding-bottom: 10px">
                                    		<button id="novo" type="button" class="btn btn-success no-print"><i class="fa fa-plus-circle"></i> Novo</button>
                                    		<button id="save" type="button" class="btn btn-primary save no-print" disabled="disabled"><i class="fa fa-save"></i> Salvar</button>
                                    		<div id='divHistoricoProntuarios' class="btn-group">
                                    		</div>
	                                	</div>                                    		
						                <div id="divMontaProntruario" class="panel panel-default" style="display: none;">
											<div class="panel-body">
												<div class="row">
													<div class="col-lg-12">	
														<div>
															<?php 
																MontaGrupos(null);
															?>
														</div>
													</div>
												 </div>
											 </div> 
											 <div class="form-group col-md-12 nopadding">
                                    			<div style="padding-top: 20px">
											 		<button id="save" type="button" class="btn btn-primary save no-print" ><i class="fa fa-save"></i> Salvar</button>
											 		<button id="btnCancelarProntuario" type="button" class="btn btn-default no-print"><i class="fa fa-mail-reply"></i> Voltar</button>    
											 	</div>
											 </div>
											 <div id="alert2" class="alert alert-dismissable" style="display: none">
												<span class="text"></span>
												<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
											</div>                         
										</div>
	                             	</div>
	                         	</div>
	                     	</div>                                    
	                	</div>
                
                	<!-- /.col-lg-12 -->
            		</div>
        		</div>    		
        	</div>
            <!-- /.row -->    
    	</div>
		<!-- /#page-wrapper -->    		
    </div>
    <!-- /#wrapper -->    
	<?php include("includes/footer.php"); ?>	
	<script src="js/clienteEdit.js"></script>
</body>
</html>
