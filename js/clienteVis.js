$(document).ready(function() {
	$("#btnBuscaCliente").click(function() {
		var cliente = $("#nomeCliente").val();	
		alert(cliente);
		$.ajax({
			url: "ajax/cliente.ajax.php?term=" + cliente,
			success: function (data) {
				
				var cliente = jQuery.parseJSON(data);
				alert(cliente);
			}
		});
	});
});