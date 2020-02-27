// Get the Modal Confirm Button Element
const deleteConfirmButton = document.getElementById('deleteConfirmButton');


//Listen for click on button and then send request to backend to delete the Product
deleteConfirmButton.addEventListener('click', ()=>{
    let productId = deleteConfirmButton.getAttribute('data-productId');
    fetch(`/products/${productId}/delete`, {
        method: "DELETE"
    }).then(()=>{
        //Redirect to products page after the product got deleted
        window.location.replace('/products')
    });
    console.log('clicked')
});


