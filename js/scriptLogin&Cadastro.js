window.onload = function() {
    var nomeLogado = "";
    $.ajax({
        type: "GET",
        url: "php/enviaCodigoLogin.php",
        success:function(retorno){
            nomeLogado = retorno.nome;
        },
        error:function(e) {
            console.log(e)
        }
    });
    document.getElementById("usuarioLogado") = "Olá, " + nomeLogado;
}

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
                if(retorno.statusLogin == 'usuarioInvalido'){
                    alertaModal("Usuário ou senha inválidos")
                } else if (retorno.statusLogin == 'verificacaoLogin') {
                    window.location.href='indexCodigo.html'
                } else if (retorno.statusLogin == 'sucesso') {
                    window.location.href='indexCodigo.html'
                }
                
            }
        });

    //var email = document.getElementById("email").value = ""
    //var senha = document.getElementById("senha").value = ""
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
                                modalConfirmacao()
                            }
                        },
                        error:function(e){
                            console.log(e)
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
                        data:'novaSenhaHash='+novaSenhaHash,
                        url: "php/alteraSenha.php",
                        success:function(retorno) {
                            alertaModal("Senha alterada com sucesso!"),
                            window.location.href='indexLogin.html'
                        }
                    });
                }
            } else {
                alertaModal("A senha deve conter no mínimo 8 caracteres, sendo obrigatório, no mínimo, um número, uma letra maiúscula e minúscula e um caracter especial!") 
            }
        } else {
            alertaModal("A senha não pode ser nula!")
        }
    }


function modalEmail() {
    var myModal = new bootstrap.Modal(document.getElementById('senhaRecuperacao'))
    myModal.show()
}

function enviaCodigoRecuperacao() {
    var emailRecuperacao = document.getElementById('emailRecuperacao').value;

    $.ajax({
        type: "POST",
        data: 'emailRecuperacao='+emailRecuperacao,
        url: "php/enviaCodigoRecuperacao.php",
        success:function(retorno) {
            console.log(retorno)
            window.location.href='indexCodigo.html'
        },
        error:function(e){
            console.log(e)
        }

     });

}

function modalConfirmacao () {
    var myModal = new bootstrap.Modal(document.getElementById('promptModal'))
        document.getElementById("modalBody").innerHTML = '<h7>' + "Cadastro realizado com sucesso, agora precisamos validar ele com o código que enviamos para o seu email!! Ahh, não esquece de olhar o spam :)";
        myModal.show()
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
        data: 'codigo='+codigo,
        url: "php/validaCodigo.php",
        dataType: "JSON",
        success:function(retorno) {
            console.log(retorno)
            if(retorno.autenticacao == 'autenticacaoLogin') {
                window.location.href='index.html'
            } else if (retorno.autenticacao == 'autenticacaoSenha') {
                window.location.href='indexNovaSenha.html'
            } else if(retorno.autenticacao == 'validacaoUsuario') {
                window.location.href='index.html'
            }
        },
        error:function(e){
            console.log(e)
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