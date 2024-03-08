<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Nova Produtora</title>
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
                echo msg_erro('Area restrita! Você não é administrador!');
            }else{
                if(!isset($_POST['produtora'])){
                    require "produtora_new_form.php";
                }else{
                    $produtora = $_POST['produtora'];
                    $pais = $_POST['pais'];
 
                   
                    if(empty($produtora) || empty($pais)){
                        echo msg_erro('Digite uma nova produtora e o pais de origem');
                }else{
                    $busca = "SELECT * FROM produtoras where produtora = '$produtora'";
                    $result = $banco->query($busca);
                    $duplicate2 = mysqli_num_rows($result);
                    if($duplicate2 >=1){
                        echo msg_erro('Este gênero já existel.');
                    }else{
                    $q = "INSERT INTO produtoras (produtora, pais) VALUES ('$produtora', '$pais')";                    
                        if($banco->query($q)){
                            echo msg_sucesso("a produtora $produtora foi adicionado com sucesso!");
                        }else{
                            echo msg_erro("Não foi possível adicionar a nova produtora $produtora");
                        }
                    }
                }
            }
        }
            echo voltar();
        ?>
    </div>
</body>
</html>