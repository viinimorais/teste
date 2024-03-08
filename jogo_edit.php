<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Jogo</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body>
    <?php
    require_once "includes/banco.php";
    require_once "includes/funcoes.php";
    require_once "includes/login.php";
    ?>
    <div id="corpo">
        <?php
        if(!is_logado()){
           echo msg_erro('Efetue o login.'); 
        }else{
          
            if(!isset($POST['nome'])){
                if(is_admin()){
                    require "jogo_edit_form.php";
                }else{
                    require "jogo_edit_form_editor.php";
                }
            }else{
                $cod = $_SESSION['cod'];
                $nome = $_POST['nome'] ?? null;
                $genero = $_POST['genero'] ?? null;
                $produtora = $_POST['produtora'] ?? null;
                $descricao = $_POST['descricao'] ?? null;
                $nota = $_POST['nota'] ?? null;
                $capa = $_POST['capa'] ?? null;
                if(empty($nome) || empty($genero) || empty($produtora) || empty($descricao) || empty($nota) || empty($capa)){
                    echo msg_aviso('Todos os dados precisam ser preenchidos.');
                }else{
                $q ="UPDATE jogos SET nome='$nome', genero='$genero', produtora='$produtora', descricao='$descricao', nota='$nota' where cod='$cod' ";
                if($busca=$banco->query($q)){
                    echo msg_sucesso('Jogo alterado.');
                }else{
                    echo msg_erro('Jogo não alterado.');
                }
            }
        }
    }
    ?>
</body>
</html>