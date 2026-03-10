<?php 
 
 // As letras em maiusculo ou minusculo faz diferença

date_default_timezone_set('America/Sao_Paulo');
$data = date("d/m/Y H:i:s");
echo "<p>$data<p/>";

$valor = 1505.888888;
$valor_arredondado = round($valor);
echo "<p>$valor_arredondado<p/>";

// valor , 2 casas,"," usar , em vez de . na casa decimal 
// e por fim o troca a virgula por ponto no milhar;

$valor_formatado = number_format($valor, 2, ",",".");
echo "<p>$valor<p/>";
echo "<p>$valor_formatado<p/>";

//Exponenciação
$exp = pow(3,4);
//Raiz Quadrada
$raiz = sqrt(16);
//Número aleatório
$aleatorio = rand(1, 100);

// Saber se exite e tem algo na variavel
if(isset($nome)){
    echo "<p>Nome Informado!</p>";

}else {
    echo("<p>Nome não Informado</p>");
    // die(); mata tudo após, muito usado por exemplo se 
    // a aplicação não conectou ao banco de dados
}


if(is_float($valor)){
    echo"<p>É um número flutuante</p>";
}












?>