
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Novo Jogo</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos/estilo.css">
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
                if(!is_admin()){
                    echo msg_erro('Área restrita! Você não é administrador!');
                }else{
                    if(!isset($_POST['nome'])){
                        require "jogo_new_form.php";
                    }else{
                        $nome = $_POST['nome'] ?? null;
                        $genero = $_POST['genero'] ?? null;
                        $produtora = $_POST['produtora'] ?? null;
                        $descricao = $_POST['descricao'] ?? null;
                        $nota = $_POST['nota'] ?? null;
                        $capa = $_POST['capa'] ?? null;                        
                            if(empty($nome)||empty($genero)||empty($produtora)||empty($descricao)||empty($nota)){
                                echo msg_erro('Todos os dados são obrigatórios');
                            }else{
                                $q = "INSERT INTO jogos(nome,genero,produtora,descricao,nota,capa)VALUES('$nome','$genero','$produtora','$descricao','$nota','$capa')";
                                if($banco->query($q)){
                                    echo msg_sucesso("Jogo $nome cadastrado com sucesso");
                                }else{
                                    echo msg_erro("Não foi possivel criar o jogo $nome");
                                }
                            }                        
                        }                 
                    }
                echo voltar();
            ?>
        </div> 
    </body>
</html>