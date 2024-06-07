window.agregarCarrito = (button) => {

    ajax({
        url: button.dataset.url,
        body: new FormData(document.getElementById('form-producto')),
        success: (data) => {
            window.location.href = data.url;
        },
        error: (error) => {
            showAlert(error.message);
        },
        catch: (error) => {
            console.log("Error de consulta", error);
        }
    });

    return false;

}