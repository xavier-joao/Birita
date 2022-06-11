<!DOCTYPE html>
<?php
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
    <div class="navbar">
      <a href="index.html"><img src="img/logo.png" class="logo"></a>
      <nav>
        <ul id="menuList">
          <li><a href="biblioteca.php">Drincoteca</a></li>
          <li><a href="indexLogin.html">Login</a></li>
          <li><a href="indexCadastro.html">Cadastro</a></li>
        </ul>
      </nav>
      <img src="img/menu.png" class="menu-icon" onclick="togglemenu()">
    </div>
  
        <div class="row d-flex justify-content-center">
            <div class="col-sm-3">
                <span class="filter-heading d-flex justify-content-center">Drincoteca</span>
                <div class="box-shadow shadow p-3 mb-5 bg-white rounded">
                    <form class="form-inline my-2 my-lg-0"> 
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" id="search" placeholder="Digite aqui seus ingredientes" aria-label="Digite aqui" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary" id="searchButton" type="button">Buscar!</button>
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