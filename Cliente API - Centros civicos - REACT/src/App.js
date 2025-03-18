import { BrowserRouter as Router, Route, Routes } from "react-router-dom";
import { useState, useEffect } from "react";
import './App.css';
import Centros from './Centros';
import CentroUnico from './CentroUnico';
import Login from './Login';
import Registro from "./Registro";
import Navbar from './Navbar';
import Logout from './Logout';
import MiCuenta from "./MiCuenta";
import Instalaciones from "./Instalaciones";
import Actividades from "./Actividades";
import Reservas from "./Reservas";

function App() {
  const [isAuthenticated, setIsAuthenticated] = useState(false);

  useEffect(() => {
    const jwt = localStorage.getItem("jwt");
    if (jwt) {
      setIsAuthenticated(true);
    }
  }, []);

  useEffect(() => {
    const handleStorageChange = () => {
      const jwt = localStorage.getItem("jwt");
      setIsAuthenticated(!!jwt); // Actualiza el estado en función de si el JWT está presente
    };

    // Escuchar cambios en el localStorage
    window.addEventListener("storage", handleStorageChange);

    // Limpiar el listener cuando el componente se desmonte
    return () => {
      window.removeEventListener("storage", handleStorageChange);
    };
  }, []);

  return (
    <Router>
      <div className="App">
        <Navbar isAuthenticated={isAuthenticated} />
        <Routes>
          <Route path="/" element={<Centros />} />
          <Route path="/centro/:id" element={<CentroUnico />} />
          <Route path="/login" element={<Login setIsAuthenticated={setIsAuthenticated} />} />
          <Route path="/registro" element={<Registro />} />
          <Route path="/logout" element={<Logout setIsAuthenticated={setIsAuthenticated} />} />
          <Route path="/mi-cuenta" element={<MiCuenta setIsAuthenticated={setIsAuthenticated} />} />
          <Route path="/instalaciones" element={<Instalaciones />} />
          <Route path="/actividades" element={<Actividades />} />
          <Route path="/mis-reservas" element={<Reservas setIsAuthenticated={setIsAuthenticated}/>} /> 
        </Routes>
      </div>
    </Router>
  );
}

export default App;
