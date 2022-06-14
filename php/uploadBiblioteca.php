<?php
include("config.php");

session_start();

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
	$_SESSION['status'] = "ERRO: Algum dos valores inseridos não é válido :(";
	header("Location: https://localhost/Birita/biblioteca.php");
}

$sql = "insert into receita(nomereceita, tagsreceita, descricaoreceita, imagemreceita)values('$nomereceita','$tagsreceita','$descricaoreceita', '$saveFile')";
$query_run = mysqli_query($conexao, $sql);

if ($query_run){	
	$_SESSION['status'] = "<strong>Hey!</strong> Receita enviada com sucesso ;)";
	header("Location: https://localhost/Birita/biblioteca.php");
} else {
	$_SESSION['status'] = "ERRO: Algum dos valores inseridos não é válido :(";
	header("Location: https://localhost/Birita/biblioteca.php");
}

echo "<h3>Diagnostic Info:</h3>";
echo "<br>Tmp File Name: ".$_FILES['imagemReceita']['tmp_name']."<br>";
echo "saveFile Variable Valuable: ".$saveFile;
exit();
?>

<h1><a href="../biblioteca.php">Voltar para drincoteca</a></h1> 