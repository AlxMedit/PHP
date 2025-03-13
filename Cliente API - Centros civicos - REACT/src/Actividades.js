import React, { useState, useEffect } from "react";
import "./Actividades.css"; // Importamos los estilos

const Actividades = () => {
  const [actividades, setActividades] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [filteredActividades, setFilteredActividades] = useState([]);

  useEffect(() => {
    // Obtener las actividades de la API
    const fetchActividades = async () => {
      try {
        const response = await fetch("http://gestion.local/api/actividades");
        const data = await response.json();
        setActividades(data);
        setFilteredActividades(data); // Mostrar todas al inicio
      } catch (error) {
        console.error("Error al cargar las actividades:", error);
      }
    };

    fetchActividades();
  }, []);

  // Filtra las actividades en función del término de búsqueda
  const handleSearch = (event) => {
    const search = event.target.value;
    setSearchTerm(search);

    const filtered = actividades.filter((actividad) =>
      actividad.nombre.toLowerCase().includes(search.toLowerCase())
    );
    setFilteredActividades(filtered);
  };

  return (
    <div className="actividades-container">
      <h1 className="actividades-title">Actividades</h1>

      <input
        type="text"
        placeholder="Buscar por nombre..."
        value={searchTerm}
        onChange={handleSearch}
        className="search-input"
      />

      <div className="actividades-grid">
        {filteredActividades.length > 0 ? (
          filteredActividades.map((actividad) => (
            <div key={actividad.id} className="actividad-card">
              <h3 className="actividad-title">{actividad.nombre}</h3>
              <p>{actividad.descripcion}</p>
              <p><strong>Plazas máximas:</strong> {actividad.plazas}</p>
            </div>
          ))
        ) : (
          <p className="no-results">No se encontraron actividades.</p>
        )}
      </div>
    </div>
  );
};

export default Actividades;
