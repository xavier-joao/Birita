var listaProdutos = [[0, 'R$ 85,90', 'VODKA STOLICHNAYA', 'stolichnaya.png', false], [1, 'R$ 99,90','TEQUILA JOSÉ CUERVO', 'josecuervo.png', false], [2, 'R$ 90,50','GIN TANQUERAY', 'tanqueray.png', false]];

var carrinho = [];

window.onload = function(){
    montarCardProdutos();
}

function montarCardProdutos(){

    document.getElementById("lista-produtos").innerHTML = "";


    for(var i = 0; i < listaProdutos.length; i++)
    {
        var conteudo = "";
        conteudo += '<div class="div-card" >';
        conteudo += '<div class="div-card-img">';
        conteudo += '<img src="img/' + listaProdutos[i][3] + '" />';
        conteudo += '</div>';
        conteudo += '<div class="div-card-descricao">';
        conteudo += listaProdutos[i][2];
        conteudo += '<br>' + '<div class="div-preco-main">' + listaProdutos[i][1] + '</div>';
        conteudo += '</div>';

        if(listaProdutos[i][4] == false)
        {
            conteudo += '<div class="div-card-comprar"  onclick="comprar(' + listaProdutos[i][0] + ')"  >';
            conteudo += 'Comprar';
            conteudo += '</div>';
        }
        else
        {
            conteudo += '<div class="div-card-comprar div-card-comprado"   >';
            conteudo += 'Comprado';
            conteudo += '</div>';
        }
        


        conteudo += '</div>';
        
        document.getElementById("lista-produtos").innerHTML += conteudo;
    }
}

function comprar(id){

    listaProdutos[id][4] = true;
    
    carrinho.push(listaProdutos[id]);

    window.localStorage.setItem("carrinho", JSON.stringify(carrinho));

    montarCardProdutos();

}