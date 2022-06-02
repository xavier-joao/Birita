<!DOCTYPE html>
<?php
include("fetchBiblioteca.php"); 
?>
<html>
    <head>
    <!-- BOOTSTRAP CSS E JS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!--CSS CUSTOMIZADO-->
    <link rel="stylesheet" type="text/css" href="../css/styleBiblioteca.css">
    
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <span class="filter-heading">Drincoteca:</span>
                    <input type="text" class="form-control" id="live_search" autocomplete="off" placeholder="Busque seus ingredientes aqui!">
                </div>
                <script type="text/javascript">
                    $(document).ready(function(){
                        $("#live_search").keyup(function(){
                            var input = $(this).val();

                            if(input != ""){
                                $.ajax({
                                    url:"livesearch.php",
                                    method:"POST",
                                    data:{input:input},

                                    success:function(data){
                                        $("#searchResults").html(data);
                                    }
                                });
                            
                            }else{
                                $("#searchResults").css("display","none");
                            }
                        })
                    })
                </script>
            </div>
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
                                    <img src="../img/<?php echo $imagemreceita;?>" style="width: 100%">
                                        <h1><?php echo $nomereceita;?></h1>
                                        <p class="desc"><?php echo $descricaoreceita;?></p>
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
    </body>




</html>