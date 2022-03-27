window.onload = function(){
    buildCards();
}
var cart = JSON.parse(localStorage.getItem("cart"))

function buildCards(){

    document.getElementById("divProducts").innerHTML = "";


    for(var i = 0; i < cart.length; i++){

        var conteudo = "";
        conteudo += '<div class="card-product" >';
        conteudo += '<div class="img-product">';
        conteudo += '<img src="img/' + cart[i][3] + '" />';
        conteudo += '<div class="text-product">' + cart[i][1] + '</div>';
        conteudo += '<div class="text-product-price">' + cart[i][2] + '</div>';
        conteudo += '</div>';
        
        conteudo += '<div class="botton-product-add"  onclick="removeFromCart(' + i + ')"  >';
        conteudo += 'Retirar do carrinho';
        conteudo += '</div>';

        conteudo += '</div>';
        
        document.getElementById("divProducts").innerHTML += conteudo;
    }
}


function removeFromCart(id){

    let cartRemoved = cart.splice(id, 1);  

    console.log(cart)

    window.localStorage.setItem("cart", JSON.stringify(cart));
    buildCards();

}