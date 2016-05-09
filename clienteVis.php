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
						<input id="nomeCliente" class="form-control"
							placeholder="Pesquisar"> <span class="input-group-btn">
							<button type="button" id="btnBuscaCliente" class="btn btn-default">
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
								<!--
								<div class="table-responsive table-bordered">
									<table id="tablePaciente" class="table vert-offset-bottom-0">
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
								 -->
								
								<br />
								<div id="grid2" class="table-responsive table-bordered">
									
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
	<script src="js/clienteVis.js"></script>
	
	<script src="js/xGrid.js"></script>	
    <script type="text/javascript">
        $("#grid2").xGrid({
           gridAttributes: [{ "class": "table vert-offset-bottom-0" }],
           //headerAttributes: [{ "class": "grid-view-header" }],
           //rowAttributes: [{ "class": "grid-view-row" }],
           //rowAltAttributes: [{ "class": "grid-view-row-alt" }],
           dataSource: {
               url: "ajax/cliente.ajax.php?lista"
           },
           columns: [
               { field: "codigo", title: "Código", sortColumn: "Cod_Cliente", attributes: [{ "class": "col-md-1 text-center" }] },
               { field: "nome", title: "Nome", sortColumn: "Nom_Cliente", attributes: [{ "class": "" }] },
               { field: "NumRg", title: "RG", attributes: [{ "class": "text-center" }] },
               { field: "NumTelefone", title: "Telefone", attributes: [{ "class": "text-center" }] },
               { field: "DtaUltimoAtendimento", title: "Última consulta", attributes: [{ "class": "text-center" }] },
               { 
                   title: "Selecionar", 
                   attributes: [{ "class": "col-md-1 text-center" }],
                   template: "<button data-id='{#codigo}' type='button' class='btn btn-warning btn-sm'><i class='fa fa-wrench'></i> Editar</button>" 
               },
               
               //{ field: "DataCadastro", title: "Data Cadastro", type: "date", format: "dd/MM/yyyy", attributes: [{ "class": "text-center" }] },
//                {
//                    title: "Ações",
//                    attributes: [{ "class": "halign-center" }],
//                    //template: "<div>Ola {#Nome}</div>"
//                    template: $("#actionsTemplate").html()
//                },
//                {
//                    title: "Excluir",
//                    command: {
//                        keyField: "IdUsuario",
//                        onCall: Remove,
//                        toolTip: "Excluir Registro",
//                        //controller: "Usuario",
//                        //action: "Remove",
//                        //confirm: "Tem certeza que deseja excluir o registro?",
//                        attributes: [{ "class": "ico-delete" }]
//                    }
//                }
           ],
           //lineClick: {
               //controller: "Usuario",
               //action: "Manage",
               //keyField: "IdUsuario",
               //url: "cadastro.php?idCliente={#codigo}",
               //cellsWithoutClick: [5],
               //onClick: LineClick
           //},
//            pager: {
//                allowPageSize: false,
//                allowRefresh: true,
//                attributes: [{ "class": "grid-view-pager" }]
//            },

           sorting: {
               enabled: true
               //defaultSortColumn: "Nome"
               //defaultSortOrder: "DESC"
           },

           onRowDataBound: RowDataBound

        });

        function RowDataBound(data, row) {
            console.log(data);
        }

        function LineClick(e) {
            console.log(e.data);
        }

        function Remove(e) {
            if (confirm("Tem certeza que deseja excluir o registro?")) {
                $.ajax({
                    url: "/Usuario/Remove/" + e.data.key,
                    success: function (data) {
                        if (data.Sucesso) {
                            $(e.data.row).remove();
                            $("#grid2").xGrid("reload");
                        }

                        alert(data.Mensagem);
                    }
                });
            }
        }

        $("#btnBuscaCliente").click(function () {
        	var filtro = $("#nomeCliente").val();            
            $("#grid2").xGrid("filter", "filtro=" + filtro);
        });

        $("#btnReload").click(function () {
            $("#grid2").xGrid("reload");
        });

        $(document.body).on("click", "button[data-id]", function() {
            window.location= "clienteEdit.php?idCliente=" + $(this).attr("data-id");
        });

        $("#btnLimpar").click(function(){
        	$("#nomeCliente").val("");
        	$("#grid2").xGrid("filter", "filtro=");
        });
    </script>	
	
	</div>
</body>
</html>