<?php
	require_once 'init.php';

    if ($_SESSION['Cod_Acesso'] != 1)
        header("location:index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("includes/header.php"); ?>
</head>
<body>
	<div id="wrapper">
		<?php include("includes/menu.php")?>
		
        <div id="page-wrapper">
			<div class="row">

				<div class="col-lg-12">
					<h1 class="page-header">
						<i class="fa fa-users"></i> Avaliadores
					</h1>
				</div>
				<div class="col-sm-3 vert-offset-bottom-1">
					<button id="btnNovo" type="button" class="btn btn-success">
						<i class="fa fa-plus-circle"></i> Novo
					</button>
				</div>
				<!-- /.col-lg-12 -->
			</div>
			<!-- /.row -->

			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-user"></i> Avaliadores
				</div>
				<div class="panel-body">
					<div class="input-group col-md-6 vert-offset-bottom-1">
						<input id="txtFiltro" class="form-control" placeholder="Pesquisar">
						<span class="input-group-btn">
							<button id="btnFiltro" type="button" class="btn btn-default">
								<span class="glyphicon glyphicon-search"></span>
							</button>
							<button id="btnLimpar" type="reset" class="btn btn-danger"
								value="Reset">
								<span class="glyphicon glyphicon-remove"></span>
							</button>
						</span>
					</div>
					<div>
						<div class="row">
							<div class="col-md-12">
								<div id="gridAvaliador" class="table-responsive table-bordered"></div>
							</div>
						</div>
						<!-- /.row (nested) -->
					</div>
				</div>
				<!-- /.row (nested) -->
			</div>
			<!-- /.panel-body -->
		</div>
		<!-- /.panel -->
	</div>
	<!-- /#page-wrapper --

	<!-- /#wrapper -->
	<?php include("includes/footer.php"); ?>
	<script src="js/xGrid.js"></script>
	<script src="js/avaliadorVis.js"></script>	
</body>
</html>