
<head>
<?php include("includes/header.php"); ?>
	<style>
		.ui-autocomplete-loading {
			background: white url("images/ui-anim_basic_16x16.gif") right center no-repeat;
		}
	</style>
</head>
<body>
	<form role="form" id="form1">
		<div class="form-group col-md-2" id="perg1" data-type="text" data-typePerg="aberta">
        	<label name="codigo">Código</label>
        	<input type="text" name="codCliente" class="form-control" >
   		</div>
   		<div class="form-group col-md-2" id="perg2" data-type="drop" data-typePerg="selecao">
        	<select name="sexo">
        		<option>Fem</option>
        		<option>Masc</option>
        	</select>
   		</div>
   		<div class="form-group col-md-2" id="perg3" data-type="radio" data-typePerg="simNao">
        	<label name="a"></label>
        	<input type="radio" name="testeA[]" value="a" id="aA" class="form-control" >
    		<label name="b"></label>
        	<input type="radio" name="testeA[]" value="b" id="bB" class="form-control" >
   		</div>
   		<div class="form-group col-md-2" id="perg4" data-type="check" data-typePerg="opcoes">
        	<label name="a"></label>
        	<input type="checkbox" name="testeB[]" value="a" id="aA" class="form-control" >
    		<label name="b"></label>
        	<input type="checkbox" name="testeB[]" value="b" id="bB" class="form-control" >
   		</div>
   	</form>
   	<button id="enviar">Enviar</button>
   	<?php include("includes/footer.php"); ?>	
   	<script>
	   	$(document).ready(function() {
	   		$("#enviar").click(function(){
	   			var frm = $("#form1");
	 			var data = JSON.stringify(frm.serializeArray());
	 			
	 			MontaJSON();
	 			
	   		});
	   	});

	   	function MontaJSON(){
		   	var arrayObjJson = [];
		   	
		   	$("div[id*='perg']").each(function(){
			   	
			   	var arrayId = $(this).attr("id").split('g');
			   	var id = arrayId[1];
			   	var tipoCampo = $(this).attr("data-type");
			   	var tipoPerg = $(this).attr("data-typePerg");
			   	var obj = {};
			   	obj['Id'] = id;
			   	obj['TipoPergunta'] = tipoPerg;
			   	
			   	if(tipoCampo == "text"){
			   		obj['Valor'] = $("input", $(this)).val();
			   	}
			   	else if(tipoCampo == "drop"){
			   		obj['Valor'] = $("option:selected", $(this)).val();
			   	}
			   	else if(tipoCampo == "radio"){
			   		obj['Valor'] = $("input:checked", $(this)).val();
			   	}
			   	else if(tipoCampo == "check"){
				   	var valores=[];
				   	
			   		$("input :checked", $(this)).each(function(){
			   			valores.push($(this).val());
			   		});

			   		obj['Valor'] = valores;
			   	}
			   	arrayObjJson.push(obj);
		   	});
		   	alert(JSON.stringify(arrayObjJson));
	   	}
   	</script>
</body>
