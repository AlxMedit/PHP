// src/MiCuenta.js
import { useState, useEffect, useCallback } from "react";
import { useNavigate } from "react-router-dom";

const MiCuenta = ({ setIsAuthenticated }) => {
  const [usuario, setUsuario] = useState(null);
  const [nombre, setNombre] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [mensaje, setMensaje] = useState("");
  const navigate = useNavigate();

  // Hacemos que obtenerUsuario sea estable y no cambie entre renders
  const obtenerUsuario = useCallback(async () => {
    const jwt = localStorage.getItem("jwt");
    if (!jwt) {
      navigate("/login"); // Si no está autenticado, redirige a login
      return;
    }

    try {
      const response = await fetch("http://gestion.local/api/user", {
        method: "GET",
        headers: {
          "Authorization": `Bearer ${jwt}`,
        },
      });
      if (response.ok) {
        const data = await response.json();
        setUsuario(data);
        setNombre(data.nombre);
        setEmail(data.email);
      } else {
        setMensaje("No se pudo obtener el usuario.");
      }
    } catch (error) {
      setMensaje("Error al obtener el usuario.");
      console.error(error);
    }
  }, [navigate]);

  useEffect(() => {
    obtenerUsuario(); // Obtener los datos del usuario cuando se monta el componente
  }, [obtenerUsuario]);

  const actualizarUsuario = async () => {
    const jwt = localStorage.getItem("jwt");
    if (!jwt) {
      navigate("/login"); // Si no está autenticado, redirige a login
      return;
    }

    const datosActualizados = {
      nombre,
      email,
      password,
    };

    try {
      const response = await fetch("http://gestion.local/api/user", {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
          "Authorization": `Bearer ${jwt}`,
        },
        body: JSON.stringify(datosActualizados),
      });

      if (response.ok) {
        setMensaje("Datos actualizados correctamente.");
        obtenerUsuario(); // Actualizar los datos del usuario
      } else {
        setMensaje("Error al actualizar los datos.");
      }
    } catch (error) {
      setMensaje("Error al actualizar los datos.");
      console.error(error);
    }
  };

  const eliminarUsuario = async () => {
    const confirmacion = window.confirm("¿Estás seguro de que quieres borrar tu usuario?");
    if (confirmacion) {
      const jwt = localStorage.getItem("jwt");
      if (!jwt) {
        navigate("/login"); // Si no está autenticado, redirige a login
        return;
      }

      try {
        const response = await fetch("http://gestion.local/api/user", {
          method: "DELETE",
          headers: {
            "Authorization": `Bearer ${jwt}`,
          },
        });

        if (response.ok) {
          // Elimina los datos del localStorage
          localStorage.removeItem("jwt");
          localStorage.removeItem("expira");

          // Actualiza el estado de autenticación
          setIsAuthenticated(false); // Aquí actualizas el estado

          // Redirige a la página principal después de eliminar el usuario
          navigate("/");
        } else {
          setMensaje("Error al eliminar el usuario.");
        }
      } catch (error) {
        setMensaje("Error al eliminar el usuario.");
        console.error(error);
      }
    }
  };

  const refrescarToken = async () => {
    const jwt = localStorage.getItem("jwt");
    if (!jwt) {
      navigate("/login"); // Si no está autenticado, redirige a login
      return;
    }

    try {
      const response = await fetch("http://gestion.local/api/token/refresh", {
        method: "POST",
        headers: {
          "Authorization": `Bearer ${jwt}`,
        },
      });

      if (response.ok) {
        const data = await response.json();
        localStorage.setItem("jwt", data.jwt); // Actualizamos el JWT en el localStorage
        setMensaje("Token refrescado correctamente.");
      } else {
        setMensaje("Error al refrescar el token.");
      }
    } catch (error) {
      setMensaje("Error al refrescar el token.");
      console.error(error);
    }
  };

  return (
    <div style={{ padding: "20px" }}>
      <h1>Mi Cuenta</h1>
      {usuario ? (
        <div>
          <p><strong>Nombre:</strong> {usuario.nombre}</p>
          <p><strong>Email:</strong> {usuario.email}</p>

          <div>
            <h3>Actualizar Datos</h3>
            <div>
              <label>Nombre:</label>
              <input
                type="text"
                value={nombre}
                onChange={(e) => setNombre(e.target.value)}
              />
            </div>
            <div>
              <label>Email:</label>
              <input
                type="email"
                value={email}
                onChange={(e) => setEmail(e.target.value)}
              />
            </div>
            <div>
              <label>Contraseña:</label>
              <input
                type="password"
                value={password}
                onChange={(e) => setPassword(e.target.value)}
              />
            </div>
            <button onClick={actualizarUsuario}>Actualizar</button>
          </div>

          <div>
            <button onClick={eliminarUsuario} style={{ backgroundColor: "red", color: "white" }}>
              Eliminar Cuenta
            </button>
          </div>

          <div>
            <button onClick={refrescarToken}>Refrescar Token</button>
          </div>
        </div>
      ) : (
        <p>Cargando datos de usuario...</p>
      )}

      {mensaje && <p>{mensaje}</p>}
    </div>
  );
};

export default MiCuenta;
