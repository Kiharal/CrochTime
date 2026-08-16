      //Replace cartRecord object on client side with server side session
//Implement safe fetch function
const csrfToken = document.querySelector('meta[name="csrf-token"]').content
async function UpdateCart(url, item){
const response = await fetch(url, {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json',
    'X-CSRF-TOKEN': csrfToken},
    body: JSON.stringify({'item_id': item})
})
return response
}

const checkoutBtn = document.getElementById('checkout');
//IF go to cart(Checkout) button is visible
checkoutBtn.classList.toggle('hidden', true);
//determine if delete button is visible

//add and remove items to cart
document.addEventListener('click', function (event){
{

    //To add an item
    /*
      To improve customer view speed work on the optimistic loading for the cart number
    */
   
    const addBtn = event.target.closest('#added');
    if(addBtn){
    const item_data = addBtn.dataset.item
    const url = addBtn.dataset.url
    UpdateCart(`${url}`, item_data)
    .then( response => {
        if(!response.ok){
        throw new Error('Imagine kuna error' + response.status)
        }
        return response.json()
    })
    .then(data => {

        addBtn.closest('article').querySelector('#item_count').classList.toggle('bg-yellow-600', data['qty'] >= 1)
        addBtn.closest('article').querySelector('#item_count').innerHTML = data['qty']
        checkoutBtn.classList.toggle('hidden', data['count']);
    })
    //.then(addBtn.closest('article').querySelector('#item_count').classList.toggle('bg-yellow-600', count > 0))
    
    
    return;
    }
    //To remove an item
    const rmvBtn = event.target.closest('#removed');
    if (rmvBtn){
    let item = rmvBtn.dataset.item;
    let url = rmvBtn.dataset.url;
    
    //Update the server side session
    //determine if remove button is visible

    UpdateCart(`${url}`, item)
    .then(response => {
        if(!response.ok){
        throw new Error('Yaani a negative error: ' + response.status)
        }
        return response.json()
    })
    .then( data => {
        rmvBtn.closest('article').querySelector('#item_count').innerHTML = data['qty'];
        checkoutBtn.classList.toggle('hidden', data['count']);
    } )

    
    }
}

})

      