<?php

error_reporting(0);

$criptografia = $_POST['mensagem'];

$chave = '1234567887654321';
$iv = '1234567890';

$mensagem_decrypt = openssl_decrypt($criptografia, 'aes-128-cbc', $chave, OPENSSL_ZERO_PADDING, $iv);

echo $mensagem_decrypt;

?>