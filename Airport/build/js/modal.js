document.addEventListener('DOMContentLoaded', function () {
    const openVenderModal = document.getElementById('openVenderModal');
  
    openVenderModal.addEventListener('click', function () {
      // Cargar el contenido de Vender.html en el modal
      fetch('PAG/Vender.html')
        .then(response => response.text())
        .then(data => {
          // Insertar el contenido en el modal
          document.body.insertAdjacentHTML('beforeend', data);
          const venderModal = new bootstrap.Modal(document.getElementById('venderModal'));
          venderModal.show();
        })
        .catch(error => console.error('Error al cargar el contenido del modal:', error));
    });
  });
  