import 'flowbite';
import { Modal } from 'flowbite';

window.modalDomicilio = new Modal(document.getElementById('modal-guardarDomicilio'), {
    closable: true,
    onHide: (m) => {
        let form = m._targetEl.querySelector('form');
        if(form){
            form.reset();
        }
    },
    onShow: () => {},
    onToggle: () => {}
});

window.showModalDomicilio = (button) => {
    
    let input = document.getElementById('modal-guardarDomicilio-code');
    
    putInfoModal(button);
    obtenerZipCode(
        input,
        button.dataset.state_id,
        button.dataset.city_id,
        button.dataset.zip_code_id
    );
    modalDomicilio.show();

}

window.obtenerZipCode = (input, estado=false, ciudad=false, colonia=false) => {

    if(input.value.length >= 5){

        ajax({
            url: input.dataset.url,
            body: new URLSearchParams({
                'code': input.value
            }),
            success: (data) => {

                let selectEstados  = document.getElementById('modal-guardarDomicilio-state_id');
                let selectCiudades = document.getElementById('modal-guardarDomicilio-city_id');
                let selectColonias = document.getElementById('modal-guardarDomicilio-zip_code_id');

                selectEstados.innerHTML = "";
                selectCiudades.innerHTML = "";
                selectColonias.innerHTML = "";
                
                for(let i of data.states){
                    if(estado && estado == i.id){
                        selectEstados.innerHTML += `<option value="${i.id}" selected>${i.name}</option>`;
                    }else{
                        selectEstados.innerHTML += `<option value="${i.id}">${i.name}</option>`;
                    }
                }

                for(let i of data.cities){
                    if(ciudad && ciudad == i.id){
                        selectCiudades.innerHTML += `<option value="${i.id}" selected>${i.name}</option>`;
                    }else{
                        selectCiudades.innerHTML += `<option value="${i.id}">${i.name}</option>`;
                    }
                }

                for(let i of data.locations){
                    if(colonia && colonia == i.id){
                        selectColonias.innerHTML += `<option value="${i.id}" selected>${i.location}</option>`;
                    }else{
                        selectColonias.innerHTML += `<option value="${i.id}">${i.location}</option>`;
                    }
                }

            },
            error: (err) => {
                console.err(err);
            }
        });

    }

    return false;

}


window.guardarDomicilioUsuario = (form) => {

    try {

        ajax({
            url: form.dataset.url,
            body: new FormData(form),
            success: (data) => {
                modalDomicilio.hide();
                showAlert(`
                    <h2 style="margin: 3rem 0; font-size: 1.8rem;">${data.message}</h2>
                `);

                let listaDomicilios = document.getElementById('lista-domicilios');
                listaDomicilios.innerHTML = '';

                for(let i of data.domicilios){

                    listaDomicilios.innerHTML += `<div class="border-b py-3 flex gap-1">
                        <div class="w-1/5">
                            <button
                                class="rounded p-1 bg-red-600 hover:bg-red-500 text-white"
                                onclick="putInfo(this)"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path fill-rule="evenodd" d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z" clip-rule="evenodd" />
                                </svg>                               
                            </button>

                            <button
                                data-modal="modal-guardarDomicilio" 
                                data-id="${ i.id }"
                                data-adress="${ i.adress }"
                                data-state_id="${ i.state_id }"
                                data-city_id="${ i.city_id }"
                                data-zip_code_id="${ i.zip_code_id }"
                                data-phone_number="${ i.phone_number }"
                                data-selected="${ i.selected }"
                                data-code="${ i.code }"
                                class="rounded p-1 bg-green-500 hover:bg-green-400 text-white"
                                onclick="showModalDomicilio(this)"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-4 h-4">
                                    <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32l8.4-8.4z" />
                                    <path d="M5.25 5.25a3 3 0 00-3 3v10.5a3 3 0 003 3h10.5a3 3 0 003-3V13.5a.75.75 0 00-1.5 0v5.25a1.5 1.5 0 01-1.5 1.5H5.25a1.5 1.5 0 01-1.5-1.5V8.25a1.5 1.5 0 011.5-1.5h5.25a.75.75 0 000-1.5H5.25z" />
                                </svg>
                            </button>
                        </div>
                        <div class="w-4/5">
                            ${i.domicilio }
                        </div>
                    </div>`;

                }

            },
            error: (error) => {
                errorAlert(error.message);
            }
        });

    } catch (error) {
        console.log(error);
    }

    return false;

}