async function login(){
    var usersList = JSON.parse(localStorage.getItem("usuarios"))
    console.log(usersList)
    var email = document.getElementById("emailLogin").value
    var senha = document.getElementById("senhaLogin").value

        if(email == "batata@batatinha.com" && senha == "123456") {
            alertaModal("Login realizado com sucesso")
            var form = new FormData(document.getElementById('loginForm'));

            const response = await fetch('php/Session.php', {
                method: 'POST',
                body: form
            })
            
            window.location.href = "index.html"; 
            console.log(response)
        }else{
            alertaModal("Login incorreto tente novamente")
        }

    var email = document.getElementById("email").value = ""
    var senha = document.getElementById("senha").value = ""
}

function cadastro(){
    var email = document.getElementById("email").value
    var nome = document.getElementById("nome").value
    var senha = document.getElementById("senha").value
    var senhaConfirm = document.getElementById("confirmSenha").value

   

    
    if(nome != '' && senha != '' && email != '') {
        if (validaSenha(senha)) {
            if (validaEmail(email)){
                if(senha != senhaConfirm) {
                    alertaModal("As senhas não coincidem")
                    var senha = document.getElementById("senha").value = ""
                    var senhaConfirm = document.getElementById("confirmSenha").value = ""
                } else {
                    var hash = CryptoJS.SHA1($("#senha").val());
                    $("#senhaHash").val(hash);

                    var dados = $("#formularioCadastro").serialize();

                    $.ajax({
                        type: "POST",
                        data: dados,
                        url: "php/SignUp.php",
                
                    });

                    

                    alertaModal("Cadastro realizado com sucesso!")
                    
                    //window.location.href = "index.html";    
                }
            } else {
                alertaModal("Deve conter um email válido, por exemplo: exemplo@exemplo.com")
            }
        } else {
            alertaModal("A senha deve conter no mínimo 8 caracteres, sendo obrigatório, no mínimo, um número, uma letra maiúscula e minúscula e um caracter especial!")
        }        
    } else {
        alertaModal("Email e senha não podem ser nulos")
    }
}

function recuperaSenha(){
    var codigo = document.getElementById("codigo").value;
    var senha = document.getElementById("senha").value
    var senhaConfirm = document.getElementById("confirmSenha").value

    if (codigo != '') {
        if (senha != '') {
            if (validaSenha(senha)){
                if (senha != senhaConfirm){
                    alertaModal("As senhas não coicidem!")
                    var senha = document.getElementById("senha").value = ""
                    var senhaConfirm = document.getElementById("confirmSenha").value = ""
                } else {
                    alertaModal("Senha alterada com sucesso!")
                }
                window.location.href = "indexLogin.html"
            } else {
                alertaModal("A senha deve conter no mínimo 8 caracteres, sendo obrigatório, no mínimo, um número, uma letra maiúscula e minúscula e um caracter especial!") 
            }
        } else {
            alertaModal("A senha não pode ser nula!")
        }
    } else {
        alertaModal("Por favor, digite o código enviado para o email cadastrado!")
    }

}

function enviarEmail() {
    var myModal = new bootstrap.Modal(document.getElementById('senhaRecuperacao'))
    myModal.show()
}

function alertaModal (texto) {
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'))
        document.getElementById("modalBody").innerHTML = '<h7>' + texto;
        myModal.show()
}

function validaSenha (senha){
    var senhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
    
    return senhaForte.test(senha)  
}

function validaEmail (email){
    var testaEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    return testaEmail.test(email)
}

