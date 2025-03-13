import React, { useState, useEffect } from "react";
import "./Reservas.css"; // Asegúrate de que el CSS esté actualizado

const Reservas = () => {
  const [reservas, setReservas] = useState([]);
  const [instalaciones, setInstalaciones] = useState([]);
  const [error, setError] = useState("");

  useEffect(() => {
    // Obtener las reservas
    const fetchReservas = async () => {
      try {
        const token = localStorage.getItem("jwt");
        if (!token) {
          throw new Error("No se ha encontrado el token de autenticación.");
        }

        const response = await fetch("http://gestion.local/api/reservas", {
          method: "GET",
          headers: {
            "Authorization": `Bearer ${token}`,
            "Content-Type": "application/json",
          },
        });

        if (!response.ok) {
          throw new Error(`Error: ${response.status} ${response.statusText}`);
        }

        const data = await response.json();
        setReservas(data.reservas);
      } catch (error) {
        setError("No tienes reservas");
        console.error("Error al obtener las reservas:", error);
      }
    };

    // Obtener las instalaciones para poder asociarlas a las reservas
    const fetchInstalaciones = async () => {
      try {
        const response = await fetch("http://gestion.local/api/instalaciones");
        const data = await response.json();
        setInstalaciones(data);
      } catch (error) {
        console.error("Error al cargar las instalaciones:", error);
      }
    };

    fetchReservas();
    fetchInstalaciones();
  }, []);

  // Función para cancelar la reserva
  const handleCancelarReserva = async (reservaId, instalacionNombre) => {
    const confirmarCancelacion = window.confirm(
      `¿Seguro que quiere cancelar su reserva en '${instalacionNombre}'?`
    );

    if (confirmarCancelacion) {
      try {
        const token = localStorage.getItem("jwt");

        const response = await fetch(
          `http://gestion.local/api/reservas/${reservaId}`,
          {
            method: "DELETE",
            headers: {
              "Authorization": `Bearer ${token}`,
              "Content-Type": "application/json",
            },
          }
        );

        if (!response.ok) {
          throw new Error(`Error: ${response.status} ${response.statusText}`);
        }

        const data = await response.json();
        alert(data.mensaje); // Muestra el mensaje de éxito
        setReservas(reservas.filter((reserva) => reserva.id !== reservaId)); // Actualiza la lista de reservas
      } catch (error) {
        console.error("Error al cancelar la reserva:", error);
        alert("Error al cancelar la reserva");
      }
    }
  };

  return (
    <div className="reservas-container">
      <h1 className="reservas-title">Mis Reservas</h1>

      {error && <p className="error-message">{error}</p>}

      <div className="reservas-list">
        {reservas.length > 0 ? (
          reservas.map((reserva) => {
            // Buscar la instalación asociada a esta reserva
            const instalacion = instalaciones.find(
              (inst) => inst.id === reserva.instalacion_id
            );

            return (
              <div key={reserva.id} className="reserva-card">
                <h3 className="reserva-titulo">
                  {instalacion ? instalacion.nombre : "Instalación no encontrada"}
                </h3>
                <p><strong>Nombre solicitante:</strong> {reserva.nombre_solicitante}</p>
                <p><strong>Teléfono:</strong> {reserva.telefono}</p>
                <p><strong>Correo:</strong> {reserva.correo}</p>
                <p><strong>Fecha de inicio:</strong> {reserva.fecha_hora_inicio}</p>
                <p><strong>Fecha de finalización:</strong> {reserva.fecha_hora_final}</p>
                <p><strong>Estado:</strong> {reserva.estado}</p>

                {/* Botón para cancelar la reserva */}
                <button
                  className="cancelar-reserva-button"
                  onClick={() => handleCancelarReserva(reserva.id, instalacion ? instalacion.nombre : '')}
                >
                  Cancelar reserva
                </button>
              </div>
            );
          })
        ) : (
          <p>¡Reserva ya una de nuestras instalaciones! <a href="/Instalaciones">PINCHA AQUÍ</a></p>
        )}
      </div>
    </div>
  );
};

export default Reservas;
