/**
 * Functión para mostrar imagenes por subir
 * @author Luis GP
 * @param {DOM} inputFile 
 */
window.showPhotos = function(inputFile) {
    
    const files = inputFile.files;
    const viewer = document.getElementById('previewer');
    viewer.innerHTML = "";

    if (files) {
        for(let file of files){
            let src = URL.createObjectURL(file)
            viewer.innerHTML += `<div class="w-full">
                <img src="${src}" class="w-full"/>
            </div>`;
        }

    }

}



/**
 * Función para colocar información en el modal para eliminar imagenes
 * @author Luis GP
 * @param {DOM} button 
 */
window.putImageInfo = (button) => {
    document.getElementById('modal-eliminarProductoImagen-id').value = button.dataset.id_imagen;
}


window.resetForm = (button) => {
    let form = document.getElementById(button.dataset.form);
    let hidden = form.querySelectorAll('input[type="hidden"]');
    let previewer = form.querySelector('#previewer');

    form.reset();
    hidden.forEach(i => {
        if(i.getAttribute('name') != "_token"){
            i.value = "";
        }
    });

    if(previewer){
        previewer.innerHTML = "";
    }
    
}



/**
 * Función para mostrar botón al hacer hover a una foto
 * @author Luis GP
 * @param {DOM} div 
 * @returns {Boolean}
 */
window.showBack = (div) => {

    try {
        
        div.classList.add("shown-back");
        div.classList.remove("hidden-back");

    } catch (error) {
        console.error(error);
    }

    return false;

}



/**
 * Función para ocultar botón al hacer hover a una foto
 * @author Luis GP
 * @param {DOM} div 
 * @returns {Boolean}
 */
window.hideBack = (div) => {

    try {

        div.classList.add("hidden-back");
        div.classList.remove("shown-back");

    } catch (error) {
        console.error(error);
    }

    return false;

}



/**
 * Función para eliminar foto por ajax
 * @author Luis GP
 * @param {DOM} form 
 * @returns {Boolean}
 */
window.deletePhoto = (form) => {

    ajax({
        url: form.action,
        body: new FormData(form),
        success: (data) => {
            document.getElementById(`image-content-${data.id}`).remove();
        },
        error: (error) => {
            console.log("Ocurrio algo en el servidor", error);
        },
        catch: (error) => {
            console.log("Erorr de consulta", error);
        }
    });

    return false;

}


window.getModels = (select) => {

    let data = new FormData()
    data.append('brand_id', select.value);

    ajax({
        url: select.dataset.url,
        body: data,
        success: (data) => {
            let select = document.getElementById('brand_model_id');
            select.innerHTML = "";
            for(let i of data.modelos){
                select.innerHTML += `<option value="${i.id}">${i.name}</option>`;
            }
        },
        error: (error) => {
            console.log("Ocurrio algo en el servidor", error);
        },
        catch: (error) => {
            console.log("Erorr de consulta", error);
        }
    });

    return false;

} 