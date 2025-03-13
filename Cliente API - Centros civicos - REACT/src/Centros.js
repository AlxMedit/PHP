import { useEffect, useState } from "react";
import { Link } from "react-router-dom";
import "./Centros.css"; // Importamos los estilos

function Centros() {
  const [centros, setCentros] = useState([]);

  useEffect(() => {
    fetch("http://gestion.local/api/centros")
      .then((response) => response.json())
      .then((data) => setCentros(data))
      .catch((error) => console.error("Error al cargar los centros:", error));
  }, []);

  return (
    <div className="centros-container">
      <h1 className="centros-title">Centros Cívicos</h1>
      <div className="centros-grid">
        {centros.length > 0 ? (
          centros.map((centro) => (
            <Link key={centro.id} to={`/centro/${centro.id}`} className="centro-card">
              <img
                src={`/img/${centro.foto}`} // Ruta corregida para acceder a las imágenes en public/img
                alt={centro.nombre}
                className="centro-img"
              />
              <div className="centro-info">
                <h2>{centro.nombre}</h2>
                <p>{centro.direccion}</p>
                <p><strong>Tel:</strong> {centro.telefono}</p>
                <p><strong>Horario:</strong> {centro.horario}</p>
              </div>
            </Link>
          ))
        ) : (
          <p className="no-results">No se encontraron centros.</p>
        )}
      </div>
    </div>
  );
}

export default Centros;
