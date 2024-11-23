function handleSubmit(event) {
    event.preventDefault(); // Previene el reinicio
    const formData = new FormData(event.target);
    const data = Object.fromEntries(formData.entries());
    //console.log(data); Datos del formulario
}