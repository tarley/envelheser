$(document).ready(function() {
	$("#btnBuscaCliente").click(function() {
		var cliente = $("#nomeCliente").val();	
		$.ajax({
			url: "ajax/cliente.ajax.php?term=" + cliente,
			success: function (data) {
				var cliente = jQuery.parseJSON(data);
			}
		});
	});
});