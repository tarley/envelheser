<?php
    require_once 'init.php';

    $mysql = new MySQL();
    $Especialidade = new Especialidade($mysql->link);
    if($_SESSION['Cod_Acesso'] != 1)
    	header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("includes/header.php"); ?>
</head>
<body>
    <div id="wrapper">
		<?php include("includes/menu.php") ?>
		
        <div id="page-wrapper">
          	<div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><i class="fa fa-user-md"></i> Cadastro de Avaliadores</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            
            <!--  -->
            	
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-pencil-square-o"></i>
                            Dados Cadastrais
                        </div>
                        
                        <div class="panel-body">
                        	
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                        <div class="form-group col-md-2">
                                            <label>Código</label>
                                            <input id="codAvaliador" disabled="disabled" class="form-control" >
                                        </div>
                                        <div class="form-group col-md-7">
                                            <label>Nome</label>
                                            <input id="nomAvaliador" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                        	<label>Especialidade</label>
                                             <?php 
                                            $listaOpcoes = $Especialidade->getLista();
                                            
                                            echo '<select id="nomEspecialidade" class="form-control">';
                                            echo '<option value="">Selecione</option>';
												for ($j = 0; $j < sizeof($listaOpcoes); $j++) {
													echo '<option value="'.$listaOpcoes[$j]['Cod_Especialidade'].'">'.$listaOpcoes[$j]['Nom_Especialidade'].'</option>';
												}
											echo '</select>';
											?>
                                        </div>						
                                        <div class="form-group col-md-5">
                                            <label>E-mail</label>
                                            <input id="emailAvaliador" type="email" class="form-control">
                                        </div>
										<div class="form-group col-md-4">
                                            <label>Login</label>
                                            <input id="loginAvaliador" class="form-control">
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label>Senha</label>
                                            <input id="senhaAvaliador" type="password" class="form-control">
                                        </div>	
                                        <div class="form-group col-md-3">
                                            <label>Confirma Senha</label>
                                            <input id="confirmaSenhaAvaliador" type="password" class="form-control">
                                        </div>	
                                         <div class="form-group col-md-3 col-md-offset-9 vert-offset-top-1">
                                    		<div class="pull-right">
                                    		<button id="saveAvaliador" type="button" class="btn btn-success"><i class="fa fa-save"></i> Salvar</button>		
                                    		<button id="btnCancelar" type="button" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</button>
                               			</div>
                               			</div>
                               			
                                        	
                                    </form>
                                   
                            	</div>
                                    
                                </div>
								<div id="alert" class="alert alert-dismissable" style="display: none">
									<span class="text"></span>
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								</div>	
                                
                            </div>
                            <!-- /.row (nested) -->
                            
                        </div>
                        
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    
					
                                    
             
        </div>
        <!-- /#page-wrapper -->		
    </div>
    	
    <!-- /#wrapper -->
	<?php include("includes/footer.php"); ?>
	<script src="js/avaliadorEdit.js"></script>	
</body>
</html>