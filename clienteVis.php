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
					<form>
						<div class="input-group col-md-6 vert-offset-bottom-1">
							<input id="nomeCliente" class="form-control"
								placeholder="Pesquisar"> <span class="input-group-btn">
								<button class="btn btn-default" type="submit">
									<span class="glyphicon glyphicon-search"></span>
								</button>
								<button type="reset" class="btn btn-danger" value="Reset">
									<span class="glyphicon glyphicon-remove"></span>
								</button>
							</span>
						</div>
					</form>
					<div>

						<div class="row">
							<div class="col-md-12">
								<div class="table-responsive table-bordered">
									<table class="table vert-offset-bottom-0">
										<thead>
											<tr>
												<th class="col-md-1 text-center">Cod.:</th>
												<th>Nome</th>
												<th class="text-center">RG</th>
												<th class="text-center">Telefone</th>
												<th class="text-center">Última consulta</th>
												<th class="col-md-1 text-center">Selecionar</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td class="text-center">001</td>
												<td>Daniel Caldeira</td>
												<td class="text-center">MG-0000000</td>
												<td class="text-center">(31) 6666-6666</td>
												<td class="text-center">01/01/01</td>
												<td>
													<div class="col-md-1 text-center">
                                    				<button id="#" type="button" class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i> Editar</button>		
                                    				</div>
												</td>
											</tr>
											<tr>
												<td class="text-center">002</td>
												<td>João Carlos</td>
												<td class="text-center">MG-0000000</td>
												<td class="text-center">(31) 2424-2424</td>
												<td class="text-center">01/01/01</td>
												<td>
													<div class="col-md-1 text-center">
                                    				<button id="#" type="button" class="btn btn-warning btn-sm"><i class="fa fa-wrench"></i> Editar</button>		
                                    				</div>
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
	</div>
</body>
</html>