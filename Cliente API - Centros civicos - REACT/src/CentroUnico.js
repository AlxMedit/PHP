import { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import "./CentroUnico.css"; // Asegúrate de que la ruta sea correcta

function CentroUnico({ setTitulo }) {
  const { id } = useParams();
  const [centro, setCentro] = useState(null);
  const [instalaciones, setInstalaciones] = useState([]);
  const [actividades, setActividades] = useState([]);

  useEffect(() => {
    // Obtener datos del centro
    fetch(`http://gestion.local/api/centros`)
      .then((response) => response.json())
      .then((data) => {
        const centroEncontrado = data.find((centro) => centro.id === parseInt(id));
        setCentro(centroEncontrado);
        if (centroEncontrado) {
          setTitulo(centroEncontrado.nombre);
        }
      })
      .catch((error) => console.error("Error al cargar el centro:", error));

    // Obtener instalaciones del centro
    fetch(`http://gestion.local/api/centros/${id}/instalaciones`)
      .then((response) => response.json())
      .then((data) => setInstalaciones(data))
      .catch((error) => console.error("Error al cargar las instalaciones:", error));

    // Obtener actividades del centro
    fetch(`http://gestion.local/api/centros/${id}/actividades`)
      .then((response) => response.json())
      .then((data) => setActividades(data))
      .catch((error) => console.error("Error al cargar las actividades:", error));
  }, [id, setTitulo]);

  if (!centro) {
    return <p>Cargando...</p>;
  }

  return (
    <div className="container">
      <img src={`/img/${centro.foto}`} alt={centro.nombre} className="centro-img" />
      <h1>{centro.nombre}</h1>
      <div className="info-container">
        <p><strong>Dirección:</strong> {centro.direccion}</p>
        <p><strong>Teléfono:</strong> {centro.telefono}</p>
        <p><strong>Horario:</strong> {centro.horario}</p>
      </div>

      <h3>Instalaciones</h3>
      <div className="section">
        {instalaciones.length > 0 ? (
          instalaciones.map((instalacion) => (
            <div key={instalacion.id} className="card">
              <h4>{instalacion.nombre}</h4>
              <p><strong>Descripción:</strong> {instalacion.descripcion}</p>
              <p><strong>Capacidad máxima:</strong> {instalacion.capacidad_maxima}</p>
            </div>
          ))
        ) : (
          <p className="no-data">No hay instalaciones disponibles.</p>
        )}
      </div>

      <h3>Actividades</h3>
      <div className="section">
        {actividades.length > 0 ? (
          actividades.map((actividad) => (
            <div key={actividad.id} className="card">
              <h4>{actividad.nombre}</h4>
              <p><strong>Descripción:</strong> {actividad.descripcion}</p>
              <p><strong>Horario:</strong> {actividad.horario}</p>
            </div>
          ))
        ) : (
          <p className="no-data">No hay actividades disponibles.</p>
        )}
      </div>
    </div>
  );
}

export default CentroUnico;
