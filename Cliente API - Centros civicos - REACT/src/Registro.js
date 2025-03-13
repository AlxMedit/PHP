import { useEffect, useState } from "react";
import { useNavigate } from "react-router-dom";
import "./Registro.css"; // Importamos los estilos

function Registro() {
  const [nombre, setNombre] = useState("");
  const [email, setEmail] = useState("");
  const [password, setPassword] = useState("");
  const [error, setError] = useState(null);
  const navigate = useNavigate();

  useEffect(() => {
    const jwt = localStorage.getItem("jwt");
    if (jwt) {
      navigate("/");
    }
  }, [navigate]);

  const handleRegister = (e) => {
    e.preventDefault();

    const userData = { nombre, email, password };

    fetch("http://gestion.local/api/register", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(userData),
    })
      .then((response) => {
        if (response.ok && response.status === 201) {
          return response.text();
        } else {
          return response.text().then((text) => {
            throw new Error(
              `Error en la respuesta: ${text || "Error desconocido"} (Status: ${
                response.status
              })`
            );
          });
        }
      })
      .then((data) => {
        if (data === '"Usuario creado"') {
          navigate("/login");
        } else {
          setError("Error desconocido");
        }
      })
      .catch((error) => {
        console.error("Error en la petición de registro:", error);
        setError(error.message || "Error al registrarse. Intenta de nuevo.");
      });
  };

  return (
    <div className="registro-container">
      <h1 className="registro-title">Registro</h1>

      <form className="registro-form" onSubmit={handleRegister}>
        <div className="input-group">
          <label>Nombre</label>
          <input
            type="text"
            value={nombre}
            onChange={(e) => setNombre(e.target.value)}
            required
          />
        </div>
        <div className="input-group">
          <label>Email</label>
          <input
            type="email"
            value={email}
            onChange={(e) => setEmail(e.target.value)}
            required
          />
        </div>
        <div className="input-group">
          <label>Contraseña</label>
          <input
            type="password"
            value={password}
            onChange={(e) => setPassword(e.target.value)}
            required
          />
        </div>
        <div>
          <button className="registro-button" type="submit">
            Registrar
          </button>
        </div>
      </form>

      {error && <p className="error-message">{error}</p>}
    </div>
  );
}

export default Registro;
