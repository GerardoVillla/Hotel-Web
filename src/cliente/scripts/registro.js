
document.getElementById('btn_RegistrarsePag').onclick = function(){
	window.location.href = 'registro.php';
}

document.getElementById('btn_iniciarSPag').onclick = function(){
	window.location.href = 'index.php';
}


const formularioRegistro = document.getElementById('formulario-registro');
formularioRegistro.addEventListener('submit',function(event){
	const usuario = document.getElementById('txt_nombre').value;
	const contrasena = document.getElementById('pass_contraseña').value;
	const confirmacion = document.getElementById('pass_contraseña_2').value;
	if(usuario == "" || contrasena == "" || confirmacion == ""){
		alert("Existen campos sin llenar, por favor verifique");
		event.preventDefault();
		return;
	}

	if(contrasena != confirmacion){
		alert("Las contraseñas no coinciden, por favor verifique");
		event.preventDefault();
	}
});