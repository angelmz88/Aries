document.addEventListener("DOMContentLoaded", function () {
  const telClientesInput = document.querySelector(".tel-clientes");
  const fechaEntregaInput = document.querySelector(".fecha-entrega");
  const prendasContainer = document.getElementById("prendas-container");

  function mostrarError(input, message) {
    const errorMessage = input.parentElement.querySelector(".error-message");
    if (message) {
      errorMessage.textContent = message;
      input.classList.add("error");
    } else {
      errorMessage.textContent = "";
      input.classList.remove("error");
    }
  }

  function mostrarErrorPrenda(input, message) {
    const errorMessagePrenda = input.parentElement.querySelector(
      ".error-message-prenda"
    );
    if (message) {
      errorMessagePrenda.textContent = message;
      input.classList.add("error");
    } else {
      errorMessagePrenda.textContent = "";
      input.classList.remove("error");
    }
  }

  function validarTelefono(input) {
    input.value = input.value.replace(/\D/g, "");
    if (input.value.length > 10) {
      input.value = input.value.slice(0, 10);
    }
    mostrarError(
      input,
      input.value.length !== 10
        ? "El teléfono debe tener exactamente 10 dígitos."
        : ""
    );
  }

  telClientesInput.addEventListener("input", function () {
    validarTelefono(telClientesInput);
  });

  telClientesInput.addEventListener("keypress", function (event) {
    if (!/^\d$/.test(event.key) || telClientesInput.value.length >= 10) {
      event.preventDefault();
    }
  });

  document.querySelector(".form").addEventListener("submit", function (event) {
    if (telClientesInput.value.length !== 10) {
      event.preventDefault();
      mostrarError(
        telClientesInput,
        "El teléfono debe tener exactamente 10 dígitos."
      );
    }
  });

  const today = new Date().toISOString().split("T")[0];
  fechaEntregaInput.setAttribute("min", today);

  function validarNumeroPrendas(input) {
    input.value = input.value.replace(/\D/g, "");
    if (input.value.length > 3) {
      input.value = input.value.slice(0, 3);
    }
    mostrarErrorPrenda(
      input,
      input.value.length > 3
        ? "El número debe tener como máximo 3 dígitos."
        : ""
    );
  }

  prendasContainer.addEventListener("input", function (event) {
    if (event.target.classList.contains("numero-prenda")) {
      validarNumeroPrendas(event.target);
    }
  });

  prendasContainer.addEventListener("keypress", function (event) {
    if (event.target.classList.contains("numero-prenda")) {
      if (!/^\d$/.test(event.key) || event.target.value.length >= 3) {
        event.preventDefault();
      }
    }
  });

  document.getElementById("add-prenda").addEventListener("click", function () {
    const container = document.getElementById("prendas-container");
    const newPrenda = container.children[0].cloneNode(true);
    newPrenda.querySelector('input[name="numero-prenda[]"]').value = "";
    newPrenda.querySelector('input[name="color-prenda[]"]').value = "";
    newPrenda.querySelector('input[name="notas-adicionales[]"]').value = "";
    container.appendChild(newPrenda);
  });

  document.addEventListener("click", function (e) {
    if (e.target && e.target.classList.contains("remove-prenda")) {
      const prenda = e.target.closest(".prenda");
      if (document.querySelectorAll(".prenda").length > 1) {
        prenda.remove();
      } else {
        alert("Debe haber al menos una prenda.");
      }
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const horaEntregaInput = document.querySelector(".hora-entrega");

  // Función para validar y establecer el rango de horas permitido
  function establecerRangoHoras() {
    const horaActual = new Date().getHours(); // Hora actual en formato 24 horas
    if (horaActual < 7 || horaActual >= 20) {
      // Si la hora actual está fuera del rango permitido, establecer el rango completo
      horaEntregaInput.setAttribute("min", "07:00");
      horaEntregaInput.setAttribute("max", "20:00");
    } else {
      // Si la hora actual está dentro del rango permitido, establecer el rango hasta las 8 pm
      horaEntregaInput.setAttribute("min", "07:00");
      horaEntregaInput.setAttribute("max", "20:00");
    }
  }

  // Llamar a la función al cargar la página
  establecerRangoHoras();

  // Llamar a la función cada vez que se cambie la fecha de entrega
  document
    .querySelector(".fecha-entrega")
    .addEventListener("change", establecerRangoHoras);
});

document.addEventListener("DOMContentLoaded", function () {
  const numeroInputs = document.querySelectorAll(".numero-exterior");

  // Función para limitar la cantidad de caracteres en los campos de número exterior
  function limitarCaracteres() {
    const maxLength = 6; // Máximo de 6 caracteres
    if (this.value.length > maxLength) {
      this.value = this.value.slice(0, maxLength); // Limitar a 6 caracteres
    }
  }

  // Iterar sobre todos los campos de número exterior y agregar el evento de entrada a cada uno
  numeroInputs.forEach(function (numeroInput) {
    numeroInput.addEventListener("input", limitarCaracteres);
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const nombreInputs = document.querySelectorAll(".nombre");

  // Función para validar la entrada y permitir solo letras en el campo del primer nombre
  function validarNombre(event) {
    const regex = /^[a-zA-Z]+$/; // Expresión regular que acepta solo letras (mayúsculas y minúsculas)
    const inputChar = String.fromCharCode(event.charCode);
    if (!regex.test(inputChar)) {
      event.preventDefault();
    }
  }

  // Agregar evento de teclado a cada campo de primer nombre
  nombreInputs.forEach(function (nombreInput) {
    nombreInput.addEventListener("keypress", validarNombre);
  });
});

document.addEventListener("DOMContentLoaded", (event) => {
  // Obtener el campo de entrada
  const input = document.querySelector(".numero4");

  // Agregar un listener de eventos para el evento 'input'
  input.addEventListener("input", (event) => {
    let valor = event.target.value;

    // Verificar si el valor es negativo
    if (parseFloat(valor) < 0 || isNaN(parseFloat(valor))) {
      // Si es negativo, establecer el valor como 0
      event.target.value = "1";
      valor = "1"; // Actualizamos la variable valor
    }

    // Limitar a 4 dígitos
    if (valor.length > 4) {
      event.target.value = valor.slice(0, 4);
    }
  });
});

document.addEventListener("DOMContentLoaded", (event) => {
  // Obtener el campo de entrada
  const inputStock = document.getElementById("stock");

  // Agregar un listener de eventos para el evento 'input'
  inputStock.addEventListener("input", (event) => {
    let valor = event.target.value;

    // Verificar si el valor es negativo
    if (parseFloat(valor) < 0 || isNaN(parseFloat(valor))) {
      // Si es negativo, establecer el valor como 0
      event.target.value = "1";
      valor = "1"; // Actualizamos la variable valor
    }

    // Limitar a 4 dígitos
    if (valor.length > 4) {
      event.target.value = valor.slice(0, 4);
    }
  });
});

document.addEventListener("DOMContentLoaded", (event) => {
  // Obtener el campo de entrada
  const input = document.querySelector(".seguro");

  // Agregar un listener de eventos para el evento 'input'
  input.addEventListener("input", (event) => {
    let valor = event.target.value;

    // Verificar si el valor es negativo
    if (parseFloat(valor) < 0 || isNaN(parseFloat(valor))) {
      // Si es negativo, establecer el valor como 0
      event.target.value = "1";
      valor = "1"; // Actualizamos la variable valor
    }

    // Limitar a 4 dígitos
    if (valor.length > 11) {
      event.target.value = valor.slice(0, 11);
    }
  });
});

document.addEventListener("DOMContentLoaded", (event) => {
  // Obtener el campo de entrada
  const inputTelSecundario = document.getElementById("telSecundario");

  // Agregar un listener de eventos para el evento 'input'
  inputTelSecundario.addEventListener("input", (event) => {
    let valor = event.target.value;

    // Limitar a 10 dígitos
    if (valor.length > 10) {
      event.target.value = valor.slice(0, 10);
    }
  });
});
