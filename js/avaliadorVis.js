$(document).ready(function() {
	
	$("#gridAvaliador").xGrid({
	    gridAttributes: [{ "class": "table vert-offset-bottom-0" }],
	    
	    dataSource: {
	        url: "ajax/avaliador.ajax.php?lista"
	    },
	    
	    columns: [
	        { field: "codigo", title: "Código", sortColumn: "Cod_Avaliador", attributes: [{ "class": "col-md-1 text-center" }] },
	        { field: "nome", title: "Nome", sortColumn: "Nom_Avaliador", attributes: [{ "class": "" }] },
	        { field: "especialidade", title: "Especialidade", sortColumn: "Nom_Especialidade", attributes: [{ "class": "text-center" }] },
	        { field: "login", title: "Login", sortColumn: "Des_Login", attributes: [{ "class": "text-center" }] }, 
	        { 
	            title: "Selecionar", 
	            attributes: [{ "class": "col-md-1 text-center" }],//fa fa-wrench fa fa-check-circle
	            template: "<button data-id='{#codigo}' type='button' class='btn btn-warning btn-sm'><i class='fa fa-bluetooth'></i>Editar</button>" 
	        }
	    ],
	
	    sorting: {
	        enabled: true
	        //defaultSortColumn: "Nome"
	        //defaultSortOrder: "DESC"
	    }
	});  
	
	$("#gridAvaliador").on("click", "button[data-id]", function() {
	    window.location= "avaliadorEdit.php?idAvaliador=" + $(this).attr("data-id");
	});   
	
	$("#btnNovo").click(function(){
		window.location= "avaliadorEdit.php";
	});	

	$("#btnFiltro").click(function () {
		console.log("filtrou");
		var filtro = $("#txtFiltro").val();            
		$("#gridAvaliador").xGrid("filter", "filtro=" + filtro);
	});

	$("#btnLimpar").click(function(){
		$("#txtFiltro").val("");
		$("#gridAvaliador").xGrid("filter", "filtro=");
	});	
});