

document.getElementById('btn_RegistrarsePag').onclick = function(){
	window.location.href = 'registro.php';
}

document.getElementById('btn_iniciarSPag').onclick = function(){
	window.location.href = 'index.php';
}

// Verificar si hay un mensaje de registro exitoso en la URL
console.log("Registro exitoso");
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.has('registro_exitoso')) {
    const message = document.createElement('h3');
    message.style.color = 'black';
    message.textContent = 'Usuario registrado exitosamente. Por favor, inicie sesión.';
	message.style.textAlign = 'center';
	message.style.marginBottom = '5rem';
    document.getElementById('formulario-contenedor').prepend(message);
}

document.getElementById('btn_Registro').addEventListener('click', function(){
	let contrasena = document.getElementById('pass_contraseña').value;
	let connfirmacion = document.getElementById('pass_contraseña_2').value;

	if(contrasena != connfirmacion){
		alert('Las contraseñas no coinciden, revise su información');
	}
});


