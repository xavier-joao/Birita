var productsList = [[0, 'Tanqueray London Dry Gin','R$ 119,90', 'tanqueray.png', false],
                    [1, 'Ballantine’s Finest Whisky Escocês','R$ 99,98', 'ballantines.png', false],
                    [2, 'Vodka Absolut', 'R$ 64,99', 'absolut.png', false],
                    [3, 'Diablo Dark Red', 'R$ 79,80', 'diablo.png', false],
                    [4, 'Heineken Long Neck', 'R$ 5,99', 'heineken.png', false],
                    [5, 'Vodka Smirnoff', 'R$ 36,79', 'smirnoff.png', false],
                    [6, 'Whisky Johnnie Walker Blue Label', 'R$ 890,95', 'bluelabel.png', false],
                    [7, "Gin Gordon's", 'R$ 73,51', 'gordons.png', false],
                    [8, 'Brahma Duplo Malte 600ml', 'R$ 6,49', 'duplomalte.png', false],
                    [9, 'Licor Amarula', 'R$ 78,98', 'amarula.png', false],
                    [10, 'Skol Beats Senses 269ml', 'R$ 4,50', 'skolbeats.png', false],
                    [11, 'Anciano Gran Reserva 10 Years', 'R$ 81,96', 'anciano.png', false],
                    [12, 'Stella Artois Long Neck', 'R$ 5,69', 'stella.png', false],
                    [13, 'Yellow Tail Shiraz', 'R$ 67,49', 'yellow.png', false],
                    [14, 'Whisky Johnnie Walker Red Label', 'R$ 78,89', 'redlabel.png', false],
                    [15, 'Tequila Jose Cuervo Gold', 'R$ 104,00', 'zecuervo.png', false],
                    [16, 'Vodka Stolichnaya', 'R$ 101,90', 'stolichnaya.png', false],
                    [17, 'Colorado Appia 600ml', 'R$ 9,98', 'colorado.png', false],
                    [18, 'Espumante Chandon Pinot Noir', 'R$ 74,25', 'chandon.png', false],
                    [19, 'Corote Pêssego 500ml', 'R$ 1,79', 'corote.png', false],
                    [20, 'Velho Barreiro', 'R$ 8,48', 'velhobarreiro.png', false],
                ];


var cart = [];

window.onload = function(){
    buildCards();
}

function buildCards(){

    document.getElementById("divProducts").innerHTML = "";


    for(var i = 0; i < productsList.length; i++){

        var conteudo = "";
        conteudo += '<div class="card-product" >';
        conteudo += '<div class="img-product">';
        conteudo += '<img src="img/' + productsList[i][3] + '" />';
        conteudo += '<div class="text-product">' + productsList[i][1] + '</div>';
        conteudo += '<div class="text-product-price">' + productsList[i][2] + '</div>';
        conteudo += '</div>';
        

        if(productsList[i][4] == false)
        {
            conteudo += '<div class="botton-product-add"  onclick="buy(' + productsList[i][0] + ')"  >';
            conteudo += 'Comprar';
            conteudo += '</div>';
        }
        else
        {
            conteudo += '<div class="botton-product-add botton-product-added"   >';
            conteudo += 'Adicionado ao seu carrinho!';
            conteudo += '</div>';
        }
        


        conteudo += '</div>';
        
        document.getElementById("divProducts").innerHTML += conteudo;
    }
}

function buy(id){
    productsList[id][4] = true;
    
    cart.push(productsList[id]);

    window.localStorage.setItem("cart", JSON.stringify(cart));

    buildCards();

}