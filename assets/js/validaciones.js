$(document).ready(function () {
    // Crear constantes para los inputs comunes
    const inputs = {
        productos: {
            id_producto: $("#id_producto"),
            nombre_producto: $("#nombre_producto"),
            descripcion_producto: $("#descripcion_producto"),
            precio_producto: $("#precio_producto")
        },
        categorias: {
            id_categoria: $("#id_categoria"),
            nombre_categoria: $("#nombre_categoria")
        }
    };

    // Función para eliminar espacios en blanco y verificar campos vacíos
    function trimAndValidate(elements) {
        let emptyElements = [];

        elements.forEach((element) => {
            element.val(element.val().trim());
            if (element.val() === "") {
                emptyElements.push(element);
            }
        });

        if (emptyElements.length) {
            showAlertMsg(emptyElements);
            return false;
        }

        return true;
    }

    // Función para mostrar mensaje de alerta
    function showAlertMsg(elements) {
        const missingFields = elements.map(element => element.attr('placeholder') || element.attr('name')).join(', ');
        alert(`Falta completar los siguientes campos: ${missingFields}.\nSergio San Martín`);
    }

    // Función para mostrar mensaje de confirmación
    function showSuccessMsg() {
        alert("La información está completa.\nSergio San Martín");
    }

    // Función para eliminar los elementos li del ul
    function destroyLi() {
        $('#alert-msg ul').empty();
    }

    // Crear evento click al presionar el contenedor #bg-disable
    $('#bg-disable').click(() => {
        destroyLi();
        $('#bg-disable').addClass('inactive');
    });

    // Función para agregar evento de validación a formularios
    function addFormValidation(formId, inputElements) {
        $(`#${formId} button[type='submit']`).click((event) => {
            if (!trimAndValidate(inputElements)) {
                event.preventDefault();
            } else {
                event.preventDefault(); // Prevent the form submission to show success message
                showSuccessMsg();
            }
        });
    }

    // Agregar validación para los formularios existentes
    if ($("#productos").length) {
        addFormValidation("productos", Object.values(inputs.productos));
    }

    if ($("#categorias").length) {
        addFormValidation("categorias", Object.values(inputs.categorias));
    }
});

