 <!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Listagem de Jogos</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="estilos/estilo.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    </head>
    <body>
        <?php
           require_once "includes/banco.php";
           require_once "includes/funcoes.php";
           require_once "includes/login.php";
           $ordem = $_GET['o'] ?? "n";    /*recebe 'o' se nao receber fica "n"*/
           $chave = $_GET['c'] ?? "";     /*recebe 'c' se nao receber fica ""*/
        ?>
        <div id="corpo">
            <?php include_once "topo.php"; ?>
            <h1>Escolha seu jogo</h1>            
            
            <form method="get" id="busca" action="index.php">
                Ordenar: 
                <a href="index.php?o=n&c=<?php echo $chave;?>">Nome</a> | 
                <a href="index.php?o=p&c=<?php echo $chave;?>">Produtora</a> | 
                <a href="index.php?o=n1&c=<?php echo $chave;?>">Nota Alta</a> | 
                <a href="index.php?o=n2&c=<?php echo $chave;?>">Nota Baixa</a> |
                <a href="index.php">Mostrar Todos</a> |
                Buscar: <input type="text" name="c" size="10" maxlength="40"/>
                <input type="submit" value="OK"/>
            </form>

            <table class="listagem">
                <?php
                    $q="select j.cod, j.nome, j.capa, g.genero,p.produtora from jogos j join generos g on j.genero=g.cod join produtoras p on j.produtora=p.cod ";
                    
                    /*crie o if com concatenação de q no final*/
                    if(!empty($chave)){
                        $q .="where j.nome like '%$chave%' or p.produtora like '%$chave%' or g.genero like '%$chave%' ";
                    }
                
                
                    switch ($ordem){
                        case "p":
                            $q .="order by p.produtora";
                            break;
                        case "n1":
                            $q .="order by j.nota desc";
                            break;
                        case "n2":
                            $q .="order by j.nota asc";
                            break;    
                        default:    
                            $q .="order by j.nome";
                    }
                
                    $busca = $banco->query($q);
                    if(!$busca){
                        echo "<tr><td>Infelizmente a busca deu errado";
                    }else{
                        if($busca->num_rows==0){
                            echo"<tr><td>Nenhum registro encontrado";
                        }else{
                            while($reg=$busca->fetch_object()){
                                $t = thumb($reg->capa); 
                                echo "<tr><td><img src='$t' class='mini'/>";
                                echo "<td><a href='detalhes.php?cod=$reg->cod'>$reg->nome</a>"; 
                                //inserir genero e produtora
                                echo " [$reg->genero]";
                                echo "<br>$reg->produtora";
                                if(is_admin()){
                                    //echo "<td>Novo | Alterar | Excluir";
                                    echo "<td><i class='material-icons'>add_circle</i>";
                                    echo "<i class='material-icons'><a href='jogo_edit.php?cod=$reg->cod'>edit</a></i>";
                                    echo "<i class='material-icons'>delete</i>";
                                }elseif(is_editor()){
                                    //echo "<td>Alterar";
                                    echo "<td><i class='material-icons'>edit</i>";
                                }
                            }
                        }
                    }
                ?>
            </table>
        </div>
    <?php include_once "rodape.php"; /*incluir*/ ?>
    </body>
</html>