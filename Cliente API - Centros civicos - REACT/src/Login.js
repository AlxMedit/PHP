import { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom";
import "./Login.css"; // Importamos los estilos

function Login({ setIsAuthenticated }) {
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

  const handleLogin = (e) => {
    e.preventDefault();

    const userData = { email, password };

    fetch("http://gestion.local/api/login", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(userData),
    })
      .then((response) => response.json())
      .then((data) => {
        if (data.jwt) {
          localStorage.setItem("jwt", data.jwt);
          localStorage.setItem("expira", data.expira);
          setIsAuthenticated(true);
          navigate("/");
        } else {
          setError(data.message || "Error desconocido");
        }
      })
      .catch(() => {
        setError("Error al iniciar sesión. Intenta de nuevo.");
      });
  };

  return (
    <div className="login-container">
      <form className="login-form" onSubmit={handleLogin}>
      <h1 className="login-title">Iniciar sesión</h1>
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
          <button className="login-button" type="submit">
            Iniciar sesión
          </button>
        </div>
      </form>

      {error && <p className="error-message">{error}</p>}
    </div>
  );
}

export default Login;
