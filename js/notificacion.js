
  function showNotification(message) {
    const notification = document.getElementById('notification');
    notification.textContent = message;
    notification.style.display = 'block';
    setTimeout(() => {
      notification.style.display = 'none';
    }, 3000);
  }

  // Ejemplo de cómo se llamaría a esta función cuando se agrega un producto al carrito
  // Supongamos que ya tienes una función `addToCart(product)` que agrega el producto al carrito.
  function addToCart(product) {
    // Lógica existente para agregar el producto al carrito
    // ...
    showNotification(`${product} agregado al carrito!`);
  }

  // Ejemplo de botón de agregar al carrito (esto ya debería estar en tu HTML)
  // <button onclick="addToCart('Producto 1')">Agregar Producto 1 al Carrito</button>

