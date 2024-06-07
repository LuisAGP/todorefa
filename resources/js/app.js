import 'flowbite';
import { Modal } from 'flowbite';

window.modal = new Modal(document.getElementById('modal-alerta'), {
    closable: true,
    onHide: () => {},
    onShow: () => {},
    onToggle: () => {}
});

window.openMenu = () => {
    let sideBar = document.getElementById("default-sidebar");
    sideBar.classList.remove('hide-menu');
    sideBar.classList.add('show-menu');
}

window.closeMenu = () => {
    let sideBar = document.getElementById("default-sidebar");
    sideBar.classList.remove('show-menu');
    sideBar.classList.add('hide-menu');
}

window.ajax = (json) => {

    try {

        fetch(json.url, {
            headers: { 
                'X-CSRF-TOKEN': document.getElementsByName('_token')[0].value
            },
            method: json.method ? json.method : 'POST',
            body: json.body ? json.body : null
        })
        .then(response => response.json())
        .then(data => {
            if(data.code == 200){
                json.success(data)
            }else if(data.code == 500){
                json.error(data)
            }else{
                json.complete(data);
            }
        })
        .catch(err => {
            if(json.catch){
                json.catch(err);
            }
        });

        
    } catch (error) {
        console.error(error);
    }

    return false;

}


window.showAlert = (mensaje) =>{

    document.getElementById('modal-alerta-mensaje').innerHTML = mensaje;
    modal.toggle();

}

window.errorAlert = (mensaje) => {

    try {

        document.getElementById('modal-alerta-contenedor').style = "background-color: #fd9090;";

        document.getElementById('modal-alerta-mensaje').innerHTML = `<div style="display: flex; justify-content: center; align-items: center; flex-direction: column; color: #a41a1a;">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
                <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd" />
            </svg>
            <h2>${mensaje}</h2>
        </div>`;
        modal.toggle();  

    } catch (error) {
        console.error(error);
    }

}

window.putInfoModal = (button) => {
    try {
        
        let modal = button.dataset['modalTarget'] ? button.dataset['modalTarget'] : button.dataset.modal;

        for(let i in button.dataset){

            if(i == "previewer"){
                document.getElementById('previewer').innerHTML = `<div class="w-full">
                    <img src="${button.dataset[i]}" class="w-full"/>
                </div>`;
            }else if(i == "action"){
                let form = modal.split('-')[1];
                document.getElementById(`form-${form}`).action = button.dataset[i];
            }else if(i !== 'modalToggle' && i !== 'modalTarget' && i != 'modal'){
                let component = document.getElementById(modal+"-"+i);
                if(component.tagName.toLowerCase() === 'input' || component.tagName.toLowerCase() === 'select'){
                    document.getElementById(modal+"-"+i).value = button.dataset[i];
                }else{
                    document.getElementById(modal+"-"+i).innerHTML = button.dataset[i];
                }
            }
        }

    } catch (error) {
        console.error(error);
    }
}
