// src/Logout.js
import { useEffect } from "react";
import { useNavigate } from "react-router-dom";

function Logout({ setIsAuthenticated }) {
    const navigate = useNavigate();

    useEffect(() => {
        const jwt = localStorage.getItem("jwt");
        if (!jwt) {
            navigate("/"); // Redirige al home si ya está autenticado
        }
    }, [navigate]);

    const handleLogout = () => {
        localStorage.removeItem("jwt");
        localStorage.removeItem("expira");
        setIsAuthenticated(false); // Actualizamos el estado de autenticación
        navigate("/"); // Redirige al usuario a la página de inicio
    };

    return (
        <div style={{ padding: "20px", maxWidth: "400px", margin: "auto" }}>
            <h1>Cerrar sesión</h1>
            <p>¿Estás seguro de que quieres cerrar sesión?</p>
            <button onClick={handleLogout}>Cerrar sesión</button>
        </div>
    );
}

export default Logout;
