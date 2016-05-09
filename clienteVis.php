<!DOCTYPE html>
<html lang="en">
<head>
<?php include("includes/header.php"); ?>
</head>
<body id="clienteVis">
	<div id="wrapper">
		<?php include("includes/menu.php")?>
		
        <div id="page-wrapper">
			<div class="row">

				<div class="col-lg-12">
					<h1 class="page-header"><i class="fa fa-child"></i> Pacientes</h1>
				</div>

				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->

			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-user"></i> Pacientes
				</div>
				<div class="panel-body">					
					<div class="input-group col-md-6 vert-offset-bottom-1">
						<input id="txtFiltro" class="form-control"
							placeholder="Pesquisar"> <span class="input-group-btn">
							<button id="btnFiltro" type="button" class="btn btn-default">
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<button id="btnLimpar" type="reset" class="btn btn-danger" value="Reset">
								<span class="glyphicon glyphicon-remove"></span>
							</button>
						</span>
					</div>					
					<div>
						<div class="row">
							<div class="col-md-12">						
								<div id="gridCliente" class="table-responsive table-bordered">			
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
	</div>
	<?php include("includes/footer.php"); ?>
	<script src="js/xGrid.js"></script>
	<script src="js/clienteVis.js"></script>	
</body>
</html>