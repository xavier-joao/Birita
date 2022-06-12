<?php
include("config.php");

$nomereceita = $_POST['inputTitulo'];
$descricaoreceita = $_POST['inputDescricao'];
$tagsreceita = $_POST['inputTags'];

$saveDir = "../img/";
$saveFile = $saveDir.basename($_FILES['imagemReceita']['name']);

if (move_uploaded_file($_FILES['imagemReceita']['tmp_name'], $saveFile)){
	echo "<h1>Imagem a enviar</h1><br>".$_FILES['imagemReceita']['name']." was saved<br>";
	echo "<img src='".$saveFile."'><br>";
    echo "Nome da receita: ".$nomereceita."<br>";
	echo "Descrição da receita: ".$descricaoreceita."<br>";
	echo "Ingredientes da receita: ".$tagsreceita."<br>";
} else {
	echo "Upload Did Not Work<a href='./biblioteca.php'> Voltar</a>";
}

$sql = "insert into receita(nomereceita, tagsreceita, descricaoreceita, imagemreceita)values('$nomereceita','$tagsreceita','$descricaoreceita', '$saveFile')";

if ($conexao->query($sql)=== TRUE){	
	echo "Database Worked";
} else {
	echo "error";
}

echo "<h3>Diagnostic Info:</h3>";
echo "<br>Tmp File Name: ".$_FILES['imagemReceita']['tmp_name']."<br>";
echo "saveFile Variable Valuable: ".$saveFile;
?>

<h1><a href="../biblioteca.php">Voltar para drincoteca</a></h1> 