<!DOCTYPE html>
<?php
session_start();
include("php/fetchBiblioteca.php"); 
?>
<html>
    <head>
    <!-- BOOTSTRAP CSS E JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--CSS CUSTOMIZADO-->
    <link rel="stylesheet" type="text/css" href="css/styleBiblioteca.css">
    
    </head>
    <body>
    <div class="container">
    <div class="navbarBiblioteca">
    <div class="navbar nav-fill">
      <a href="index.html"><img src="img/logo.png" class="logo"></a>
      <nav>
        <ul id="menuList">
          <li><a href="index.html">Home</a></li>
          <?php  
            $id = $_SESSION['loggedIn'];
            if(isset($id["nome"])){ ?>
            <li> Olá <?php echo $id["nome"]?> </li>

            <?php
            } else {?>
          <li><a href="indexLogin.html">Login</a></li>
          <li><a href="indexCadastro.html">Cadastro</a></li>
          <?php } ?>
        </ul>
      </nav>
      <img src="img/menu.png" class="menu-icon" onclick="togglemenu()">
      <script>

    var menuList = document.getElementById("menuList");

    menuList.style.maxHeight = "0px";

    function togglemenu(){
      if(menuList.style.maxHeight == "0px"){
        menuList.style.maxHeight = "130px"
      }else{
        menuList.style.maxHeight = "0px";
      }
    }
  </script>
  </div>
  <div class="alertaEnvio d-flex justify-content-center">
  <?php
    if(isset($_SESSION['status'])){
        ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert"> 
            <?php
                echo $_SESSION['status'];
            ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        
        <?php
       
        unset($_SESSION['status']);
    }
    ?>
  </div>
    </div>
        <div class="row d-flex justify-content-center">
            <div class="col-10">
                <span class="d-flex tituloDrincoteca justify-content-center p-4 h1">Drincoteca</span>
                <div class="box-shadow shadow p-2 bg-white rounded-bottom caixaBusca">
                    <form class="form-inline justify-content-center"> 
                        <div class="input-group m-2 w-100">
                            <input type="text" class="form-control" id="search" placeholder="Digite aqui seus ingredientes" aria-label="Digite aqui" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <?php 
                                $id = $_SESSION['loggedIn'];
                                if($id["id"] == "6"){?>
                                <a href="upload.html"><button class="btn btn-outline-info"  type="button" >Adicionar Receita</button></a>  
                                <?php }?>
                                <button class="btn btn-outline-info" id="searchButton" type="button">Buscar</button>
                            </div>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-9">
                    <div id="searchResults" class="search-results-block">
                        <div class="row">
                            <?php
                            while($row = mysqli_fetch_assoc($r)){
                                $nomereceita =  $row['nomereceita']; 
                                $tagsreceita =  $row['tagsreceita']; 
                                $descricaoreceita =  $row['descricaoreceita']; 
                                $imagemreceita =  $row['imagemreceita']; 
                            ?>
                            <div class="col-sm-4">
                                <div class="product-card">
                                    <div class="card">
                                        <img src="img/<?php echo $imagemreceita;?>" style="width: 100%">
                                            <h1><?php echo $nomereceita;?></h1>
                                            <button class="botaoReceita">Saiba como fazer</button>

                                            <div class="row">
                                            <p class="desc"><?php echo $descricaoreceita;?></p>
                                            </div>
                                        <div class="row">
                                            <p class="tags"><?php echo $tagsreceita;?></p>
                                        </div>
                                        <p><button>Favoritar</button></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </body>



    <script src="js/scriptBiblioteca.js"></script>
    
  <script>
        var botaoReceita = document.getElementsByClassName("botaoReceita");
var desc = document.getElementsByClassName("desc");

for(let i = 0; i < botaoReceita.length; i = i + 1 ) {
    botaoReceita[i].addEventListener("click", (e) => {
        desc[i].classList.toggle("show-more");
    })
}
    </script>

</html>