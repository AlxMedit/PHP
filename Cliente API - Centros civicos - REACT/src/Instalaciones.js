import React, { useState, useEffect } from "react";
import { useNavigate } from "react-router-dom"; // Importa el hook de navegación
import "./Instalaciones.css"; // Importamos los estilos

const Instalaciones = () => {
  const navigate = useNavigate(); // Inicializa el hook para navegar
  const [instalaciones, setInstalaciones] = useState([]);
  const [searchTerm, setSearchTerm] = useState("");
  const [filteredInstalaciones, setFilteredInstalaciones] = useState([]);
  const [reservaData, setReservaData] = useState({
    nombre_solicitante: "",
    telefono: "",
    correo: "",
    instalacion_id: "",
    fecha_hora_inicio: "",
    fecha_hora_final: ""
  });

  const jwt = localStorage.getItem("jwt"); // Obtener JWT antes de renderizar

  useEffect(() => {
    // Obtener las instalaciones de la API
    const fetchInstalaciones = async () => {
      try {
        const response = await fetch("http://gestion.local/api/instalaciones");
        const data = await response.json();
        setInstalaciones(data);
        setFilteredInstalaciones(data); // Mostrar todas al inicio
      } catch (error) {
        console.error("Error al cargar las instalaciones:", error);
      }
    };

    // Obtener los datos del usuario solo si el token existe
    const obtenerUsuario = async () => {
      if (!jwt) return;

      try {
        const response = await fetch("http://gestion.local/api/user", {
          method: "GET",
          headers: {
            "Authorization": `Bearer ${jwt}`,
            "Content-Type": "application/json",
          },
        });

        if (!response.ok) throw new Error(`Error: ${response.status} ${response.statusText}`);

        const data = await response.json();
        console.log("Datos del usuario:", data);
        setReservaData((prevData) => ({
          ...prevData,
          nombre_solicitante: data.nombre,
          correo: data.email,
        }));
      } catch (error) {
        console.error("Error al obtener el usuario:", error);
        alert("Error al obtener los datos del usuario");
      }
    };

    fetchInstalaciones();
    obtenerUsuario();
  }, [jwt]); // Se ejecuta solo cuando jwt cambia

  // Filtra las instalaciones en función del término de búsqueda
  const handleSearch = (event) => {
    const search = event.target.value;
    setSearchTerm(search);

    const filtered = instalaciones.filter((instalacion) =>
      instalacion.nombre.toLowerCase().includes(search.toLowerCase())
    );
    setFilteredInstalaciones(filtered);
  };

  // Maneja el cambio en los campos del formulario de reserva
  const handleReservaChange = (event) => {
    const { name, value } = event.target;
    setReservaData({
      ...reservaData,
      [name]: value
    });
  };

  // Envía la solicitud POST para crear una reserva
  const handleReservaSubmit = async (event) => {
    event.preventDefault();
    try {
      if (!jwt) throw new Error("No se ha encontrado el token de autenticación.");

      const response = await fetch("http://gestion.local/api/reservas", {
        method: "POST",
        headers: {
          "Authorization": `Bearer ${jwt}`,
          "Content-Type": "application/json",
        },
        body: JSON.stringify(reservaData),
      });

      if (!response.ok) throw new Error(`Error: ${response.status} ${response.statusText}`);

      const data = await response.json();
      alert(data.mensaje);

      navigate("/mis-reservas"); // Redirige tras la reserva
    } catch (error) {
      console.error("Error al crear la reserva:", error);
      alert("Necesitas tener la sesión iniciada para gestionar tu reserva");
    }
  };

  return (
    <div className="instalaciones-container">
      <h1 className="instalaciones-title">Instalaciones</h1>

      <input
        type="text"
        placeholder="Buscar por nombre..."
        value={searchTerm}
        onChange={handleSearch}
        className="search-input"
      />

      <div className="instalaciones-grid">
        {filteredInstalaciones.length > 0 ? (
          filteredInstalaciones.map((instalacion) => (
            <div key={instalacion.id} className="instalacion-card">
              <h3 className="instalacion-title">{instalacion.nombre}</h3>
              <p>{instalacion.descripcion}</p>
              <p><strong>Capacidad máxima:</strong> {instalacion.capacidad_maxima}</p>

              {/* Mostrar botón solo si el usuario está autenticado */}
              {jwt && (
                <button
                  className="gestion-reserva-button"
                  onClick={() => setReservaData({ ...reservaData, instalacion_id: instalacion.id })}
                >
                  Gestionar reserva
                </button>
              )}
            </div>
          ))
        ) : (
          <p className="no-results">No se encontraron instalaciones.</p>
        )}
      </div>

      {reservaData.instalacion_id && (
        <div className="reserva-form">
          <h2>Formulario de reserva</h2>
          <form onSubmit={handleReservaSubmit}>
            <input
              type="hidden"
              name="nombre_solicitante"
              value={reservaData.nombre_solicitante}
            />
            <input
              type="hidden"
              name="correo"
              value={reservaData.correo}
            />
            <input
              type="text"
              name="telefono"
              value={reservaData.telefono}
              onChange={handleReservaChange}
              placeholder="Teléfono"
              required
            />
            <input
              type="datetime-local"
              name="fecha_hora_inicio"
              value={reservaData.fecha_hora_inicio}
              onChange={handleReservaChange}
              required
            />
            <input
              type="datetime-local"
              name="fecha_hora_final"
              value={reservaData.fecha_hora_final}
              onChange={handleReservaChange}
              required
            />
            <button type="submit">Enviar Reserva</button>
          </form>
        </div>
      )}
    </div>
  );
};

export default Instalaciones;
