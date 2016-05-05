
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
                    <h1 class="page-header"><i class="fa fa-users"></i> Avaliadores</h1>
                </div>				
                	<div class="col-sm-3 vert-offset-bottom-1" >
                        <button id="#" type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Novo</button>		
                    </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            		
                    <div class="panel panel-default">
                        <div class="panel-heading"><i class="fa fa-user"></i>
                            Avaliadores
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive table-bordered">
                                    	<table class="table vert-offset-bottom-0">
                                    		<thead>
                                    			<tr>
                                    				<th class="text-center">Cod.:</th>
                                    				<th>Nome Avaliador</th>
                                    				<th class="text-center">Especialidade</th>
                                    				<th>Login</th>
                                    				<th class="col-md-1 text-center">Editar</th>
                                    				<th class="col-md-1 text-center">Excluir</th>
                                    			</tr>
                                    		</thead>
                                    		<tbody>
                                    			<tr>
                                    				<td class="text-center">001</td>
                                    				<td>Daniel Caldeira</td>
                                    				<td class="text-center">Odontologia</td>
                                    				<td>danielcaldeira</td>
                                    				<td class="text-center">
                                    					<button id="edit" type="button" class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i> Editar</button>
                                    				</td><td class="text-center">
                                    					<button id="#" type="button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Excluir</button>
                                    				</td>
                                    			</tr><tr>
                                    				<td class="text-center">002</td>
                                    				<td>João Carlos</td>
                                    				<td class="text-center">Fisioterapia</td>
                                    				<td>joaocarlos</td>
                                    				<td class="text-center">
                                    					<button id="#" type="button" class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i> Editar</button>		
                                    				</td><td class="text-center">
                                    					<button id="#" type="button" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i> Excluir</button>
                                    				</td>
                                    				</tr>	
                                    		</tbody>  
                                    	</table>
                                    </div>
                                    
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
</body>
</html>