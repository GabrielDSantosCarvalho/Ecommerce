<!DOCTYPE html>
<html>
<head>
    <title>Validação de Alistamento Militar</title>
</head>
<body>

<?php
    
// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os dados do formulário
    $nome = $_POST["nome"];
    $idade = $_POST["idade"];
    $sexo = $_POST["sexo"];

    // Verifica se é do sexo masculino e tem mais de 18 anos
    if ($sexo == "masculino" && $idade >= 18) {
        echo "<p><script>window.alert('Parabéns, $nome! Você foi alistado.');</script></p>";
    } else {
        echo "<p><script>window.alert('$nome, você não atende aos requisitos para o alistamento militar obrigatório.');</script></p>";
    }
}
?>




<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validação de Alistamento Militar</title>
    <link rel="stylesheet" href="./alistamento.css">
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">

    <label for="nome">Nome:</label>
    <input type="text" name="nome" required>
    <br>

    <label for="idade">Idade:</label>
    <input type="number" name="idade" required>
    <br>

    <label for="sexo">Sexo:</label>
    <select name="sexo" required>
        <option value="masculino">Masculino</option>
        <option value="feminino">Feminino</option>
    </select>
    <br>

    <input type="submit" value="Verificar Alistamento">
</form>

</body>
</html>
