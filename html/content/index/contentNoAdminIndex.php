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
		$sql = $db->query("SELECT * FROM pago where id_user = $id_user AND estatus = 0;"); 
		if($db->rows($sql)>0){
			echo '<div class="container-index">';
			echo "<h2>Mis pagos pendientes:</h2>";
			echo '<div style="overflow-x:auto;">';
			echo "<table>
    				<tr>
      					<th>Id</th>
      					<th>Concepto</th>
      					<th>Descripción</th>
      					<th>Fecha de vencimiento</th>
      					<th>Total de recibo</th>
      					<th>Adeudo por persona</th>
    				</tr>";
			while($datos_pago = $db->recorrer($sql)){
				$adeudo_total = $adeudo_total + $datos_pago[5];
				echo "<tr>
						<td>".$datos_pago[0]."</td>
						<td>".$datos_pago[1]."</td>
						<td>".$datos_pago[2]."</td>
						<td>".$datos_pago[3]."</td>
						<td>".$datos_pago[4]."</td>
						<td>".$datos_pago[5]."</td>
				</tr>";
			}
			echo "</table>";
			echo "</div>";
			echo "<br>";
			echo "<h3>Adeudo total: ".$adeudo_total."</h3>";
			echo "</div>";
		}else{
			echo '<div class="container-index">';
			echo "<h2>¡Hurra! <br>No presenta ningun pago pendiente $nombre.</h2>";
			echo "</div>";
			
		}
		$db->liberar($sql); 
		$db->close(); 
	?>
  		