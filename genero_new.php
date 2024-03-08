<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilo.css">
    <title>Novo Gênero</title>
</head>
<body>
    <?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php";
    ?>
   <div id="corpo">
    <?php
    if(!is_admin()){
        echo msg_erro('Área restrita! Você não é administrador!');  
    }else{
        if(!isset($_POST['nome_gen'])){
            require "genero_new_form.php";
        }else{
            $nome = $_POST['nome_gen'];
            if(empty($nome)){
                echo msg_erro('Todos os dados são obrigatórios.');   
            }else{
                $busca = "SELECT * FROM generos WHERE genero = '$nome'";
                $result = $banco->query($busca);
                $duplicate = mysqli_num_rows($result);
                if($duplicate >= 1){
                    echo msg_erro('Este Gênero já existe.');
                }else{
                $q = "INSERT INTO generos (genero) VALUES('$nome')";
                if($banco->query($q)){
                    echo msg_sucesso("Gênero <strong> $nome </strong> adicionado com sucesso.");
                }else{
                    echo msg_erro("Não foi possível adicionar o gênero.");
                }
            }
        }
    }
}
    echo voltar();
    ?>
</body>
</html>