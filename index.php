<!doctype html>
<?php
session_start();
?>
<html lang="pt">
<head>
  <meta charset="utf-8">

  <title>birita</title>
  <meta name="descricao" content="Site de receitas de drinks e bebidas">
  <meta name="autor" content="birita">
  <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <meta name="HandheldFriendly" content="true">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


  <link rel="stylesheet" href="css\style.css">
  <script src="js/script-main-page.js"></script>
  
  <script src="https://kit.fontawesome.com/c4254e24a8.js" crossorigin="anonymous"></script>
</head>

<body>
  <!--#################### MENU #################### -->

  <div class="container">
    <div class="navbar">
      <a href="index.php"><img src="img/logo.png" class="logo"></a>
      <nav>
        <ul id="menuList">
          <li><a href="index.php">Home</a></li>
          <li><a href="biblioteca.php">Drincoteca</a></li>

          <?php  
            //error_reporting(E_ERROR | E_PARSE);
            $id = $_SESSION['loggedIn'];
            if(isset($id["nome"])){ ?>
            <li><a> Olá <?php echo $id["nome"][0]?></a>  
            <li><a><button onclick="logout()">Sair</button></a> </li>

            </li>
            <?php
            } else {?>
          <li><a href="indexLogin.html">Login</a></li>
          <li><a href="indexCadastro.html">Cadastro</a></li>
          <?php } ?>
        </ul>
      </nav>
      <img src="img/menu.png" class="menu-icon" onclick="togglemenu()">
    </div>
  

<!--#################### CONTEUDO LANDING PAGE #################### -->

    <div class="conteudo">
        <div class="col-1">
          <h2>Descubra sabores<br>
            com os ingredientes da sua casa!</h2>
            <h3>Encontre os drinks perfeitos com o que você tem em casa.</h3>
            <a href="biblioteca.php"><button type="button">Acessar <br> Drincoteca<img src="img/arrow.png"></button></a>
        </div>
        <div class="col-2">
          <img src="img/drinkindex.png" class="drinkindex">
          <div class="color-box"></div>
        </div>
      </div>
  </div>

  <div class="social-links">
    <img src="img/fb.png">
    <img src="img/tw.png">
    <img src="img/ig.png">
  </div>
</div>
<script src="js/scriptLogin&Cadastro.js"></script>


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
</body>
</html>