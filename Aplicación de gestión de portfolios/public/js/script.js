document.addEventListener("DOMContentLoaded", () => {
    const skillBadges = document.querySelectorAll(".skill-badge");
    const modal = new bootstrap.Modal(document.getElementById("skillModal"));
    const modalMessage = document.getElementById("skillModalMessage");
    const editButton = document.getElementById("editSkillButton");
    const deleteButton = document.getElementById("deleteSkillButton");

    skillBadges.forEach((badge) => {
        badge.addEventListener("click", () => {
            const id = badge.dataset.id;
            const categoria = badge.dataset.categoria;
            const habilidad = badge.dataset.habilidad;

            // Actualiza el mensaje del modal
            modalMessage.textContent = `¿Qué deseas hacer con la habilidad "${habilidad}"?`;

            // Manejadores para los botones
            editButton.onclick = () => {
                if (confirm(`¿Estás seguro que deseas editar la habilidad "${habilidad}"?`)) {
                    const form = document.createElement("form");
                    form.method = "POST";
                    form.action = "/editarSkill";
                    form.innerHTML = `
                        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['usuarioActivo']['id']; ?>">
                        <input type="hidden" name="id_skill" value="${id}">
                        <input type="hidden" name="categoria" value="${categoria}">
                        <input type="hidden" name="habilidad" value="${habilidad}">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            };

            deleteButton.onclick = () => {
                if (confirm(`¿Estás seguro que deseas eliminar la habilidad "${habilidad}"?`)) {
                    const form = document.createElement("form");
                    form.method = "POST";
                    form.action = "/eliminarSkill";
                    form.innerHTML = `
                        <input type="hidden" name="id_usuario" value="<?php echo $_SESSION['usuarioActivo']['id']; ?>">
                        <input type="hidden" name="id_skill" value="${id}">
                    `;
                    document.body.appendChild(form);
                    form.submit();
                }
            };

            // Muestra el modal
            modal.show();
        });
    });
});