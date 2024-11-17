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