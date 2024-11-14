//document.cookie = "usuario=Juan; expires=Fri, 31 Dec 2024 23:59:59 GMT; path=/";
//const DiaAMilisegundos = 86400000;
//const CarritoHabitacionesKey = "carritoHabitaciones"

export const cookiesCarrito = {
    DiaAMilisegundos: 86400000,
    CarritoHabitacionesKey: "carritoHabitaciones",
    fechaExpiracionDefault(){
        const fecha = new Date();
        fecha.setTime(fecha.getTime() + this.DiaAMilisegundos);
        const fechaExpiracion = fecha.toUTCString();
        return fechaExpiracion;
    },
    obtenerCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) return parts.pop().split(';').shift();
    },
    agregarHabitacionAlCarrito(idHabitacion) {
        const carrito = this.obtenerCookie(`${this.CarritoHabitacionesKey}`) || "";
        const habitaciones = carrito ? carrito.split(",") : [];
        
        if (!habitaciones.includes(idHabitacion)) {
            habitaciones.push(idHabitacion);
        }
        
        document.cookie = `${this.CarritoHabitacionesKey}=${habitaciones.join(",")}; expires=${this.fechaExpiracionDefault()}; path=/`;
    },
    eliminarHabitacionDelCarrito(idHabitacion) {
        const carrito = this.obtenerCookie(`${this.CarritoHabitacionesKey}`) || "";
        let habitaciones = carrito ? carrito.split(",") : [];
    
        if (habitaciones.includes(idHabitacion)) {
            habitaciones = habitaciones.filter(habitacion => habitacion !== idHabitacion);
            
            const nuevaCookie = habitaciones.length > 0
                ? `${this.CarritoHabitacionesKey}=${habitaciones.join(",")}; ${this.fechaExpiracionDefault()}; path=/`
                : `${this.CarritoHabitacionesKey}=; expires=${this.fechaExpiracionDefault()}; path=/`;
            document.cookie = nuevaCookie;
            document.cookie = `habitacion${idHabitacion}=; expires=${this.fechaExpiracionDefault()}; path=/` //borra la cantidad de habitaciones
        } else {
            console.log("Producto no encontrado en el carrito.");
        }
    },
    obtenerHabitacionesDelCarrito() {
        const carrito = this.obtenerCookie(`${this.CarritoHabitacionesKey}`);
        return carrito ? carrito.split(",") : [];
    },
    eliminarTodasabitacionesDelCarrito(){
        const cookie = `${this.CarritoHabitacionesKey}=; expires=${this.fechaExpiracionDefault()}; path=/`;
        document.cookie = cookie;
    },
    
    
    establecerNumeroHabitacionesTipo(idHabitacion){
        const cookie = `habitacion${idHabitacion}=; expires=${this.fechaExpiracionDefault()}; path=/`;
        document.cookie = cookie;
    },
    obtenerNumeroHabitacionesTipo(idHabitacion){
        return obtenerCookie(`habitacion${idHabitacion}`);
    }
    
}



/*
function fechaExpiracionDefault(){
    const fecha = new Date();
    fecha.setTime(fecha.getTime() + DiaAMilisegundos);
    const fechaExpiracion = fecha.toUTCString;
    return fechaExpiracion;
}
function obtenerCookie(name) {
    const value = `; ${document.cookie}`;
    const parts = value.split(`; ${name}=`);
    if (parts.length === 2) return parts.pop().split(';').shift();
}


function agregarHabitacionAlCarrito(idHabitacion) {
    const carrito = obtenerCookie(`${CarritoHabitacionesKey}`) || "";
    const habitaciones = carrito ? carrito.split(",") : [];
    
    if (!habitaciones.includes(idHabitacion)) {
        habitaciones.push(idHabitacion);
    }
    
    document.cookie = `${CarritoHabitacionesKey}=${productos.join(",")}; expires=${fechaExpiracionDefault()}; path=/`;
}
function eliminarHabitacionDelCarrito(idHabitacion) {
    const carrito = obtenerCookie(`${CarritoHabitacionesKey}`) || "";
    let habitaciones = carrito ? carrito.split(",") : [];

    if (habitaciones.includes(idHabitacion)) {
        habitaciones = habitaciones.filter(habitacion => habitacion !== idHabitacion);
        
        const nuevaCookie = habitaciones.length > 0
            ? `${CarritoHabitacionesKey}=${habitaciones.join(",")}; ${fechaExpiracionDefault()}; path=/`
            : `${CarritoHabitacionesKey}=; expires=${fechaExpiracionDefault()}; path=/`;
        document.cookie = nuevaCookie;
        document.cookie = `habitacion${idHabitacion}=; expires=${fechaExpiracionDefault()}; path=/` //borra la cantidad de habitaciones
    } else {
        console.log("Producto no encontrado en el carrito.");
    }
}
function obtenerHabitacionesDelCarrito() {
    const carrito = obtenerCookie(`${CarritoHabitacionesKey}`);
    return carrito ? carrito.split(",") : [];
}
function eliminarTodasabitacionesDelCarrito(){
    const cookie = `${CarritoHabitacionesKey}=; expires=${fechaExpiracionDefault()}; path=/`;
    document.cookie = cookie;
}


function establecerNumeroHabitacionesTipo(idHabitacion){
    const cookie = `habitacion${idHabitacion}=; expires=${fechaExpiracionDefault()}; path=/`;
    document.cookie = cookie;
}
function obtenerNumeroHabitacionesTipo(idHabitacion){
    return obtenerCookie(`habitacion${idHabitacion}`);
}*/