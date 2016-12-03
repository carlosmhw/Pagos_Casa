<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!--<script src="https://code.jquery.com/jquery-1.12.4.js"></script>-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
table {
    border-collapse: collapse;
    border-spacing: 0;
    width: 100%;
    border: 1px solid #ddd;
}

th, td {
    border: none;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}
</style>
<br>
<?php echo '<div class="container-index">'; ?>
<ul class="ul-btn-administrar">
	<li class="li-btn-administrar">
		<button onClick="mostrarNuevoRecibo();">+ Nuevo recibo</button>
	</li>
	<li class="li-box-nuevo-recibo" id="li_box_nuevo_recibo">
		<div class="div-box-administrar">
			<?php 
				$db = new Conexion(); 
				$sql = $db->query("SELECT * FROM user"); 
				$sql2 = $db->query("SELECT COUNT(id_user) as TOTAL_USUARIOS FROM user");
				$total_usuarios = $db->recorrer($sql2)[0]; 
				if($db->rows($sql)>0){
					echo '<div style="overflow-x:auto;">';
					echo "<table>
    					<tr>
    						<th>Recivo</th>
      						<th>Id usuario</th>
      						<th>Usuario</th>
      						<th>Email</th>
      						<th>Nombre</th>
      						<th>Apellido Paterno</th>
      						<th>Apellido Materno</th>
    					</tr>";
    				$i=1; 
					while($datos_usuario = $db->recorrer($sql)){
						echo "<tr>
							<th><input type='checkbox' value=".$datos_usuario[0]." onClick='updateTotalAdeudo(); 'id='input_user_".$i++."'></th>
							<td>".$datos_usuario[0]."</td>
							<td>".$datos_usuario[1]."</td>
							<td>".$datos_usuario[2]."</td>
							<td>".$datos_usuario[3]."</td>
							<td>".$datos_usuario[4]."</td>
							<td>".$datos_usuario[5]."</td>
						</tr>";
					}
					echo "</table>";
					echo "</div>";
					echo '<input type="hidden" value="'.$total_usuarios.'" id="total_usuarios">';
				}else{
					echo "<h2>No existen usuarios registrados.</h2>";
				}
				$db->liberar($sql); 
				$db->liberar($sql2); 
				$db->close(); 
			?>	

			<label for="input_total_recibo">Total del recibo: </label>
			<input id="input_total_recibo" type="number" onkeyup="calcularAdudo();" placeholder="$ Total del recibo">	
			<label for="input_total_dividir">Dividir entre: </label>
			<input id="input_total_dividir" value = "0" type="number" placeholder="Total dividir" disabled>	
			<label for="input_adeudo_persona">Adeudo por persona: </label>
			<input id="input_adeudo_persona" type="number" placeholder="Adeudo por persona" disabled>
			<label for="input_concepto_recibo">Concepto:</label>
			<input type="text" id="input_concepto_recibo" placeholder="CFE">
			<label for="input_descripcion_recibo">Descripción:</label>
			<input type="text" id="input_descripcion_recibo" placeholder="Descripción">
			<label for="input_fecha_recibo">Fecha vencimiento:</label>
			<input type="text" id="input_fecha_recibo" onClick="dateRecibo();" placeholder="02/16/2016">
			<label for="input_fecha_registro">Fecha de registro:</label>
			<input type="text" id="input_fecha_registro" onClick="dateRegistro();" placeholder="02/28/2016">
			<div id="_AJAX_RECIBO_NUEVO_"></div>
			<button onClick="guardar();">Guardar recibo</button>
			<button onclick="ocultarNuevoRecibo();">Cancelar</button>	
		</div>
	</li>
	<li class="li-btn-administrar">
		<button>- Eliminar recibo</button>
	</li>
	<li class="li-box-eliminar-recibo">
		<div class="div-box-administrar">
			
		</div>
	</li>
	<li class="li-btn-administrar">
		<button>Nuevo usuario</button>
	</li>
	<li class="li-box-nuevo-usuario">
		<div class="div-box-administrar">
			
		</div>
	</li>
</ul>
<?php echo "</div>"; ?>

<script>
	var total_usuarios, dividir, total_dividir, total_recibo, adeudo_persona; 
	function updateTotalAdeudo(){
		total_usuarios = __('total_usuarios').value; 
		dividir = 0; 
		for(i = 1; i <= total_usuarios; i++){
			if(__("input_user_"+i).checked){
				dividir = dividir + 1; 
			}
		}
		__("input_total_dividir").value = dividir; 
		calcularAdudo(); 		 
	}

	function calcularAdudo(){
		total_dividir = __("input_total_dividir").value; 
		if(total_dividir != 0){
			total_recibo = __("input_total_recibo").value;
			adeudo_persona = total_recibo / total_dividir; 
			__("input_adeudo_persona").value = adeudo_persona; 
		}else if(total_dividir == 0){
			__("input_adeudo_persona").value = ""; 
		}
	}

	function guardar(){
		var id_user;
		total_recibo = __("input_total_recibo").value; 
		total_dividir = __("input_total_dividir").value; 
		adeudo_persona = __("input_adeudo_persona").value;
		fecha_recibo = __("input_fecha_recibo").value; 
		fecha_registro = __("input_fecha_registro").value;
		concepto = __("input_concepto_recibo").value;
		descripcion = __("input_descripcion_recibo").value;

		if(total_recibo != "" && total_dividir > 0 && adeudo_persona != "" && fecha_recibo != "" && fecha_registro != "" && adeudo_persona > 0 && concepto != "" && descripcion != ""){ 
			for(i = 1; i <= total_usuarios; i++){
				if(__("input_user_"+i).checked){
					  id_user = __("input_user_"+ i).value;			  
					   goBuscar(id_user, total_recibo, adeudo_persona); 				   
				}
			}
		}else{
			result = 	'<div class="warning-fail">';
			result += 		'<span class="exclamation-circle"></span>';
			result += 		'<p class="p_warning">Verifica los campos.</p>';
			result += 	'</div>';
			__('_AJAX_RECIBO_NUEVO_').innerHTML = result; 
		}
	}

	function mostrarNuevoRecibo(){
		$("#li_box_nuevo_recibo").toggle(500);		
	}

	function ocultarNuevoRecibo(){
		$("#li_box_nuevo_recibo").fadeOut(400);
		
	}

	function goBuscar(id_usuario, total_recibo_id, adeudo_persona_id){
		var connect, form, responseText, result, concepto, descripcion, fecha;
		concepto = __("input_concepto_recibo").value;
		descripcion = __("input_descripcion_recibo").value;
		fecha = __("input_fecha_recibo").value;
		form = "id_user="+id_usuario+"&total_recibo="+total_recibo_id+"&adeudo_persona="+adeudo_persona_id + "&concepto=" + concepto + "&descripcion=" +descripcion + "&fecha=" + fecha; 
		connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		connect.onreadystatechange = function(){
			if(connect.readyState == 4 && connect.status ==200){
				if(connect.responseText == 1){
					result = 	'<div class="warning-success">';
					result += 		'<span class="exclamation-circle"></span>';
					result += 		'<p class="p_warning">Guardado correctamente.</p>';
					result += 	'</div>';
					__('_AJAX_RECIBO_NUEVO_').innerHTML = result;
					location.reload();				
				}else if(connect.responseText == 2){
					result = 	'<div class="warning-fail">';
					result += 		'<span class="exclamation-circle"></span>';
					result += 		'<p class="p_warning">Problemas al guardar la información.</p>';
					result += 	'</div>';
					__('_AJAX_RECIBO_NUEVO_').innerHTML = result;
				}else{
					__('_AJAX_RECIBO_NUEVO_').innerHTML = connect.responseText; 				
				}

			}else if(connect.readyState != 4){
					result = 	'<div class="warning-info">';
					result += 		'<span class="exclamation-circle"></span>';
					result += 		'<p class="p_warning">Procesando información...</p>';
					result += 	'</div>';
					__('_AJAX_RECIBO_NUEVO_').innerHTML = result;
			}
		}
		connect.open('POST', 'ajax.php?mode=nuevoRecibo', true);
		connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		connect.send(form);
	}

	$( function() {
    	$( "#input_fecha_registro" ).datepicker();
  	} );

  	$( function() {
    	$( "#input_fecha_recibo" ).datepicker();
  	} );




</script>
