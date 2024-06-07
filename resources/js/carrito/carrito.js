window.updateStock = (select) => {
    
    try {

        select.classList.add('hide');
        select.parentNode.classList.add('loading');

        const url = select.dataset.url;
        const parent = select.parentNode;
        const stock = select.value;


        ajax({
            url: url,
            method: 'PUT',
            body: new URLSearchParams({
                'stock': stock
            }),
            success: (data) => {
                parent.classList.remove('loading');
                select.value = data.stock;
                select.classList.remove('hide');
                document.getElementById('total-producto-'+data.id).innerHTML = data.totalProducto;
                document.getElementById('subtotal-carrito').innerHTML = data.subtotal;
                document.getElementById('iva-carrito').innerHTML = data.iva;
                document.getElementById('total-carrito').innerHTML = data.total;
            },
            error: (err) => {
                showAlert(`<div style="text-center">
                    <h2>${err.message}</h2>
                </div>`);
            }
        });

    } catch (error) {
        console.error(error)
    }

    return false
}