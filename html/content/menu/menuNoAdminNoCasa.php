<nav>
	<div class="header-movil">
			<h2>JUNIO 21</h2>
			<input type="checkbox" id="btn-menu">
			<label for="btn-menu" class="icon-menu"></label>
	</div>
	<ul class="nav-ul-menu">
		<?php 
			$nombre = $users[$_SESSION['app_id']]['nombre'];
			$page = $_GET['view'];
			switch ($page) {
				case 'home':
					echo '
						<li class="item-li-menu">
							<a href="?view=home"  class="flag-page" >Inicio</a>
						</li>
						<li class="item-li-menu">
							<a href="?view=historial">Historial de pagos</a>
						</li>
						<li class="item-li-menu">
							<a href="#">'.$nombre.'</a>
						</li>
						<li class="item-li-menu">
							<a href="?view=logout">Salir</a>
						</li>
					';
					break;	
				case 'historial':
					echo '
						<li class="item-li-menu">
							<a href="?view=home">Inicio</a>
						</li>
						<li class="item-li-menu">
							<a href="?view=historial" class="flag-page" >Historial de pagos</a>
						</li>
						<li class="item-li-menu">
							<a href="#">'.$nombre.'</a>
						</li>
						<li class="item-li-menu">
							<a href="?view=logout">Salir</a>
						</li>
					';
					break;			
				default:
					echo '
						<li class="item-li-menu">
							<a href="?view=home">Inicio</a>
						</li>
						<li class="item-li-menu">
							<a href="?view=historial">Historial de pagos</a>
						</li>
						<li class="item-li-menu">
							<a href="#">'.$nombre.'</a>
						</li>
						<li class="item-li-menu">
							<a href="?view=logout">Salir</a>
						</li>
					';
					break;
			}
		?>
		
	</ul>
</nav>