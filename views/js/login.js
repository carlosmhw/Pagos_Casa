function goLogin(){
	var connect, form, responseText, result, user, pass; 
	user = __('user').value;
	pass = __('pass').value;
	form = 'user=' + user + '&pass=' + pass; //
	connect = window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
	connect.onreadystatechange = function(){
		if(connect.readyState == 4 && connect.status ==200){
			if(connect.responseText == 1){
				result = 	'<div class="warning-success">';
				result+= 		'<span class="exclamation-circle"></span>';
				result += 		'<p class="p_warning">Estamos redireccionando...</p>';
				result += 	'</div>';
				__('_AJAX_LOGIN_').innerHTML = result;
				location.reload();				
			}else if(connect.responseText == 2){
				result = 	'<div class="warning-fail">';
				result+= 		'<span class="exclamation-circle"></span>';
				result += 		'<p class="p_warning">Credenciales invalidas.</p>';
				result += 		'<div class="divClose-warning"><a href="#" class="close-warning" onClick="runClose();">X</a></div>';
				result += 	'</div>';
				__('_AJAX_LOGIN_').innerHTML = result;
			}else if(connect.responseText == 3){
				result = 	'<div class="warning-fail">';
				result+= 		'<span class="exclamation-circle"></span>';
				result += 		'<p class="p_warning">Todos los campos deben estar llenos.</p>';
				result += 		'<div class="divClose-warning"><a href="#" class="close-warning" onClick="runClose();">X</a></div>';
				result += 	'</div>';
				__('_AJAX_LOGIN_').innerHTML = result;

			}else{
				__('_AJAX_LOGIN_').innerHTML = connect.responseText; 				
			}
		}else if(connect.readyState != 4){
				result = 	'<div class="warning-success">';
				result+= 		'<span class="exclamation-circle"></span>';
				result += 		'<p class="p_warning">Estamos intentando iniciar la sesión...</p>';
				result += 	'</div>';
				__('_AJAX_LOGIN_').innerHTML = result;
		}
	}

	connect.open('POST', 'ajax.php?mode=login', true);
	connect.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
	connect.send(form); 
}


function runScriptLogin(e){
	if(e.keyCode == 13){
		goLogin(); 
	}
}

