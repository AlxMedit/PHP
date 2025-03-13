import { Link } from "react-router-dom";
import "./Navbar.css"; // Importamos el archivo CSS

function Navbar({ isAuthenticated }) {
  return (
    <nav className="navbar">
      <ul className="nav-list">
        <li><Link to="/" className="nav-link">Centros Cívicos</Link></li>
        <li><Link to="/instalaciones" className="nav-link">Instalaciones</Link></li>
        <li><Link to="/actividades" className="nav-link">Actividades</Link></li>

        {!isAuthenticated ? (
          <>
            <li><Link to="/login" className="nav-link">Login</Link></li>
            <li><Link to="/registro" className="nav-link">Registro</Link></li>
          </>
        ) : (
          <>
            <li><Link to="/mis-reservas" className="nav-link">Mis reservas</Link></li>
            <li><Link to="/mi-cuenta" className="nav-link">Mi cuenta</Link></li>
            <li><Link to="/logout" className="nav-link logout">Cerrar sesión</Link></li>
          </>
        )}
      </ul>
    </nav>
  );
}

export default Navbar;
