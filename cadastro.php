<?php
	require_once 'init.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<?php include("includes/header.php"); ?>
	<style>
		.ui-autocomplete-loading {
			background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
		}
	</style>
</head>
<body>
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
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Consulta
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                    	<div class="form-group col-md-6">
                                            <input id="nomeCliente" class="form-control" placeholder="Pesquisar">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Dados Cadastrais
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <form role="form">
                                        <div class="form-group col-md-2">
                                            <label>Código</label>
                                            <input id="codCliente" class="form-control" disabled>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Nome</label>
                                            <input id="nomCliente" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Telefone</label>
                                            <input id="telCliente" class="form-control">
                                        </div>								
										 <div class="form-group col-md-4">
                                            <label>Cor</label>
                                            <input id="corCliente" class="form-control">
                                        </div>	
                                         <div class="form-group col-md-4">
                                            <label>Escolaridade</label>
                                            <input id="escolaridadeCliente" class="form-control">
                                        </div>	
                                         <div class="form-group col-md-4">
                                            <label>Ocupação</label>
                                            <input id="ocupacaoCliente" class="form-control">
                                        </div>	
                                        <div class="form-group col-md-4">
                                            <label>Estado Civil</label>
                                            <input id="estadoCivilCliente" class="form-control">
                                        </div>	
                                         <div class="form-group col-md-4">
                                            <label>Naturalidade</label>
                                            <input id="naturalidadeCliente" class="form-control">
                                        </div>	
                                        <div class="form-group col-md-4">
                                            <label>Sexo</label>
                                            <input id="sexoCliente" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Data de Nascimento</label>
                                            <input id="dataNascimentoCliente" class="form-control">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label>Número de Filhos</label>
                                            <input id="numeroFilhosCliente" class="form-control">
                                        </div>	
                                        <div class="form-group col-md-4">
                                            <label>Endereço</label>
                                            <input id="enderecoCliente" class="form-control">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->		
    </div>
    <!-- /#wrapper -->

	<!-- Alterando o arquivo Cadastro.php -->
	<!-- Outro aluno alterou o arquivo -->
	<!-- Exemplo de altera��o no mesmo arquivo por dois alunos diferentes -->
	<!-- Ao mesmo tempo outro aluno alterou o arquivo -->
	<!-- Posso fazer isso varias vezes antes de sincronizar com o repositorio remoto -->
	<!-- Mais uma alteração -->
	<!-- Mais um merge (local) -->
    
	<?php include("includes/footer.php"); ?>	
	<script>
		$(document).ready(function() {
			
			$("#nomeCliente").autocomplete({
				source: "ajax/cliente.ajax.php",
				minLength: 2,
				select: function(event, ui) {					
					
					console.log(ui);
				
					if(ui.item) {
						$.ajax({
							url: "ajax/cliente.ajax.php?codigo=" + ui.item.codigo,
							success: function (data) {
								var cliente = jQuery.parseJSON(data);
								
								$("#codCliente").val(cliente.codigo);
								$("#telCliente").val(cliente.telefone);	
								
								$("#nomCliente").val(cliente.nome);
								$("#corCliente").val(cliente.cor);
								$("#escolaridadeCliente").val(cliente.escolaridade);	
								$("#ocupacaoCliente").val(cliente.ocupacao);		
								$("#estadoCivilCliente").val(cliente.estadoCivil);	
								$("#naturalidadeCliente").val(cliente.naturalidade);	
								$("#sexoCliente").val(cliente.sexo);	
								$("#dataNascimentoCliente").val(cliente.dataNascimento);	
								$("#numeroFilhosCliente").val(cliente.numeroFilhos);
								$("#enderecoCliente").val(cliente.endereco);							
							}
						});
					}				
				}
			})
			.autocomplete("instance")._renderItem = function(ul, item) {
				return $("<li>")
					.append(item.nome + "<br>" + item.telefone)
					.appendTo(ul);
			};			
		});
	</script>
</body>
</html>
