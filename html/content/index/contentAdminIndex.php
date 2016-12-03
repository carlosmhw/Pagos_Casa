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
	<?php 
		//Estatus = 0 es no pagado 
		$db = new Conexion();
		$id_user =  $users[$_SESSION['app_id']]['id_user'];
		$adeudo_total = 0;
		$mi_adeudo_total = 0;
		$sql = $db->query("SELECT * FROM pago where estatus = 0;"); 
		if($db->rows($sql)>0){
			echo '<div class="container-index">';
			echo "<div id='_AJAX_PAGO_'></div>";
			echo "<h2>Pagos pendientes:</h2>";
			echo '<div style="overflow-x:auto;">';
			echo "<table>
    				<tr>
      					<th>Id</th>
      					<th>Concepto</th>
      					<th>Descripción</th>
      					<th>Fecha de vencimiento</th>
      					<th>Total de recibo</th>
      					<th>Adeudo por persona</th>
      					<th>Usuario</th>
      					<th>Realizar pago</th>
    				</tr>";
			while($datos_pago = $db->recorrer($sql)){
				$adeudo_total = $adeudo_total + $datos_pago[5];
				if($datos_pago[6] == $id_user){
					$mi_adeudo_total = $mi_adeudo_total + $datos_pago[5];
				}
				$id_user_mostrar = $datos_pago[6];
				$sql2 = $db->query("SELECT user from user WHERE id_user = $id_user_mostrar LIMIT 1;");
				$usuario_mostrar = $db->recorrer($sql2)[0]; 
				echo "<tr>
						<td>".$datos_pago[0]."</td>
						<td>".$datos_pago[1]."</td>
						<td>".$datos_pago[2]."</td>
						<td>".$datos_pago[3]."</td>
						<td>".$datos_pago[4]."</td>
						<td>".$datos_pago[5]."</td>
						<td>".$usuario_mostrar."</td>
						<td><button id='btn_pagar' onClick='goPagar(".$datos_pago[6].",".$datos_pago[0].");' class='btn-table'>Pagar</button></td>
				</tr>";
			}
			echo "</table>";
			echo "</div>";
			echo "<br>";
			echo "<h3>Adeudo total: ".$adeudo_total."</h3>";
			echo "<h3>Adeudo total de ".$nombre.": ".$mi_adeudo_total."</h3>";
			echo "</div>";
		}else{
			echo '<div class="container-index">';
			echo "<h2>¡Hurra! <br>No se presenta ningun pago pendiente.</h2>";
			echo "</div>";
		}
		$db->liberar($sql); 
		$db->close(); 
	?>

<script>
	function goPagar(id_user, id_pago){
		var connect, form, responseText, result, id_pago;
		form = 'id_user=' + id_user + '&id_pago=' + id_pago; 
		connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
		connect.onreadystatechange = function(){
			if(connect.readyState == 4 && connect.status ==200){
				if(connect.responseText == 1){
					result = 	'<div class="warning-success">';
					result+= 		'<span class="exclamation-circle"></span>';
					result += 		'<p class="p_warning">Pago realizado con exito!</p>';
					result += 	'</div>';
					__('_AJAX_PAGO_').innerHTML = result;
					location.reload();				
				}else if(connect.responseText == 2){
					result = 	'<div class="warning-fail">';
					result+= 		'<span class="exclamation-circle"></span>';
					result += 		'<p class="p_warning">Problemas al realizar el pago.</p>';
					result += 	'</div>';
					__('_AJAX_PAGO_').innerHTML = result;
				}else{
					__('_AJAX_PAGO_').innerHTML = connect.responseText; 				
				}
			}else if(connect.readyState != 4){
					result = 	'<div class="warning-success">';
					result+= 		'<span class="exclamation-circle"></span>';
					result += 		'<p class="p_warning">Procesando pago...</p>';
					result += 	'</div>';
					__('_AJAX_PAGO_').innerHTML = result;
			}
		}

	connect.open('POST', 'ajax.php?mode=pago', true);
	connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	connect.send(form); 
	}
</script>