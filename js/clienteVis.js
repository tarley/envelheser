$(document).ready(function() {

	$("#gridCliente").xGrid({
	    gridAttributes: [{ "class": "table vert-offset-bottom-0" }],
	    
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
	        }
	    ],
	
	    sorting: {
	        enabled: true
	        //defaultSortColumn: "Nome"
	        //defaultSortOrder: "DESC"
	    }
	});    

	$("#gridCliente").on("click", "button[data-id]", function() {
	    window.location= "clienteEdit.php?idCliente=" + $(this).attr("data-id");
	});    

	$("#btnFiltro").click(function () {
		var filtro = $("#txtFiltro").val();            
		$("#gridCliente").xGrid("filter", "filtro=" + filtro);
	});
	
	
	$("#txtFiltro").keyup(function(e){
	    if(e.keyCode == 13)
	    	$("#btnFiltro").trigger("click");
	});
	
	$("#btnLimpar").click(function(){
		$("#txtFiltro").val("");
		$("#gridCliente").xGrid("filter", "filtro=");
	});	
	
	$("#btnNovo").click(function(){
		window.location= "clienteEdit.php";
	});	
	
});