	<div class="div_formulario">
		<div class = "form_login" onkeypress="return runScriptLogin(event)"> 
			<h2 class="titulo_form">Iniciar Sesión</h2>
			<label for="auth_user" class="label_form">Usuario:</label>
   			<input name="auth_user" type="text" placeholder="Usuario" id="user" required   maxlength="35"/>
   			<label for="auth_pass">Contraseña:</label>
   			<input name="auth_pass" type="password" placeholder="********************" id="pass" required maxlength="25"/>	   			
   			<button name="accept" type="submit" value="?view=home" id="btn_accept" onclick="goLogin();">Entrar</button>
		</div>	
		<div id="_AJAX_LOGIN_"></div>
		<div class="mensaje">
			<span class="info-circle"></span><p class="p_info">Si tienes problemas para ingresar favor de comunicarse con: Carlos Carmona</p> 	
   		</div>
	</div>
	<script src="views/js/login.js"></script>














