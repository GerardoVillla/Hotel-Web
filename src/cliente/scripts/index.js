

//El usuario envia las credenciales para iniciar sesiom
const formularioInicioSesion = document.getElementById('formulario-inicio-sesion')
formularioInicioSesion.addEventListener('submit', function(event){
	const usuario = document.getElementById('txt_nombre').value;
	const contrasena = document.getElementById('pass_contraseña').value;
	//Si no se rellenan los campos, se muestra un mensaje de error y se cancela el envio de la peticion
	if(usuario == '' || contrasena == ''){
		event.preventDefault();
		alert('Por favor, rellene todos los campos');
		return;
	}
});

document.getElementById('btn_RegistrarsePag').onclick = function(){
	window.location.href = 'registro.php';
}
