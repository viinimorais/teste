<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Edição de dados do usuário</title>
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
            if(!is_logado()){
                echo msg_erro("Efetue o login para editar seus dados");
            }else{
                if(!isset($_POST['usuario'])){
                    include "user_edit_form.php";
                }else{
                    //echo msg_sucesso("Dados foram recebidos");
                    $usuario=$_POST['usuario']??null;
                    $nome=$_POST['nome']??null;
                    $tipo=$_POST['tipo']??null;
                    $senha1=$_POST['senha1']??null;
                    $senha2=$_POST['senha2']??null;

                    $q="update usuarios set usuario='$usuario', nome='$nome'";

                    if(empty($senha1)|| is_null($senha1)){
                        echo msg_aviso("Senha antiga foi mantida");
                    }else{
                        if($senha1===$senha2){
                            $senha=gerarHash($senha1);
                            $q .=", senha='$senha'";
                        }else{
                            echo msg_erro("Senhas não conferem. A senha anterior será mantida");
                        }
                    }
                    $q .=" where usuario = '" .$_SESSION['user'] . "'";

                    //echo msg_aviso($q);
                    if($banco->query($q)){
                        echo msg_sucesso("Usuário alterado com sucesso");
                        logout();
                        echo msg_aviso("Por segurança, efetue o <a href='user_login.php'>Login</a> novamente.");
                    }else{
                        echo msg_erro("Não foi possivel alterar os dados");
                    }
                }
            }
            ?>
            <?php echo voltar();?>
        </div>
        <?php require_once "rodape.php";?> 
    </body>
</html>