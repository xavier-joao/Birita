async function login(){
    var email = document.getElementById("emailLogin").value
    var senha = document.getElementById("senhaLogin").value

    var hashLogin = CryptoJS.SHA1(senha);
    document.getElementById("senhaHashLogin").value = hashLogin;
                    
    var dados = $("#loginForm").serialize();

        $.ajax({
            type: "POST",
            data: dados,
            url: "php/enviaCodigoLogin.php",
            success:function(retorno) {
                window.location.href='indexCodigo.html'
            }
        });

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
                    var hash = CryptoJS.SHA1(senha);
                    document.getElementById("senhaHash").value = hash;
                    

                    var dados = $("#formularioCadastro").serialize();

                    $.ajax({
                        type: "POST",
                        data: dados,
                        dataType: "JSON",
                        url: "php/signUp.php",
                        success:function(retorno){
                            if(retorno.status == 'emailCadastrado') {
                                alertaModal('Email já cadastrado!')
                            } else if (retorno.status == 'sucesso') {
                                alertaModal('Cadastro realizado com sucesso!')
                            }
                        }
                    });  
                }
            } else {
                alertaModal("Deve conter um email válido, por exemplo: exemplo@exemplo.com")
            }
        } else {
            alertaModal("A senha deve conter no mínimo 8 caracteres, sendo obrigatório, no mínimo, um número, uma letra maiúscula e minúscula e um caracter especial.")
        }        
    } else {
        alertaModal("Email e senha não podem ser nulos")
    }
}

function recuperaSenha(){
    
    var senha = document.getElementById("novaSenha").value
    var senhaConfirm = document.getElementById("confirmaNovaSenha").value

    if (codigo != '') {
        if (senha != '') {
            if (validaSenha(senha)){
                if (senha != senhaConfirm){
                    alertaModal("As senhas não coicidem!")
                    var senha = document.getElementById("novaSenha").value = ""
                    var senhaConfirm = document.getElementById("confirmaNovaSenha").value = ""
                } else {
                    var novaSenhaHash = CryptoJS.SHA1(senha);
                    document.getElementById("novaSenhaHash").value = novaSenhaHash;

                    $.ajax({
                        type: "POST",
                        data: novaSenhaHash,
                        url: "php/alteraSenha.php",
                        success:function(retorno) {
                            alertaModal("Senha alterada com sucesso!"),
                            window.location.href='indexLogin.html'
                        }
                    });
                }
                //window.location.href = "indexLogin.html"
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

function modalEmail() {
    var myModal = new bootstrap.Modal(document.getElementById('senhaRecuperacao'))
    myModal.show()
}

function enviaCodigoRecuperacao() {
    var email = document.getElementById("emailRecuperacao").value

    $.ajax({
        type: "POST",
        data: email,
        url: "php/enviaCodigoRecuperacao.php",
        success:function(retorno) {
            window.location.href='indexCodigo.html'
        }
    });

}

function alertaModal (texto) {
    var myModal = new bootstrap.Modal(document.getElementById('promptModal'))
        document.getElementById("modalBody").innerHTML = '<h7>' + texto;
        myModal.show()
}

function validaCodigo(){
    var codigo = document.getElementById("codigo").value;

    $.ajax({
        type: "POST",
        data: codigo,
        url: "php/validaCodigo.php",
        success:function(retorno) {
            if(retorno.status == 'autenticacaoLogin') {
                window.location.href='index.html'
            } else if (retorno.status == 'autenticacaoSenha') {
                window.location.href='indexNovaSenha.html'
            }
            
        }
    });

}

function validaSenha (senha){
    var senhaForte = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/;
    
    return senhaForte.test(senha)  
}

function validaEmail (email){
    var testaEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

    return testaEmail.test(email)
}