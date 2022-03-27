
function login(){
    var usersList = JSON.parse(localStorage.getItem("usuarios"))
    console.log(usersList)
    var email = document.getElementById("email").value
    var senha = document.getElementById("senha").value

    if (usersList != null){
        var usuarioEncontrado = false

        for(var i = 0; i < usersList.length; i++){
            if(usersList[i][0] == email && usersList[i][1] == senha){
                usuarioEncontrado = true
                window.location.href = "index.html"
            }
        }
        if(usuarioEncontrado){
            alert("Login realizado com sucesso")
        }else{
            alert("Login incorreto tente novamente")
        }
    }else{
        alert("Login incorreto tente novamente")
    }

    var email = document.getElementById("email").value = ""
    var senha = document.getElementById("senha").value = ""
}

function cadastro(){
    var email = document.getElementById("email").value
    var nome = document.getElementById("nome").value
    var senha = document.getElementById("senha").value

    var senhaConfirm = document.getElementById("confirmSenha").value

    
    if(nome != '' && senha != '') {
        if (validaSenha(senha)) {
            if (validaEmail(email)){
                if(senha != senhaConfirm) {
                    alert("As senhas não coincidem")
                    var senha = document.getElementById("senha").value = ""
                    var senhaConfirm = document.getElementById("confirmSenha").value = ""
                } else {
                    alert("Cadastro realizado com sucesso!")
                    var usersList = JSON.parse(localStorage.getItem("usuarios"))
                    var usuario = [ email, senha, nome ]
                    if (usersList != null) {
                        usersList.push(usuario)
                        window.localStorage.setItem("usuarios", JSON.stringify(usersList));
                    }else {
                        var list = [usuario]
                        window.localStorage.setItem("usuarios", JSON.stringify(list));
                    }    
                }
            } else {
                alert("Deve conter um email válido, por exemplo: exemplo@exemplo.com")
            }
        } else {
            alert("A senha deve conter no mínimo 8 caracteres, sendo obrigatório, no mínimo, um número, uma letra maiúscula e minúscula e um caracter especial!")
        }        
    } else {
        alert("Usuário e senha não podem ficar em branco")
    }
}

function validaSenha (senha){
    var senhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
    
    return senhaForte.test(senha)  
}

function validaEmail (email){
    var testaEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    return testaEmail.test(email)
}