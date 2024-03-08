<?php
  $c = $_GET['cod'] ?? 0; 
  $q = "SELECT j.cod,j.nome,g.genero,p.produtora,j.descricao,j.nota,j.capa,g.cod AS CodGenero,p.cod AS CodProdutora from jogos j join generos g on g.cod=j.genero join produtoras p on p.cod=j.produtora where j.cod='$c'";
  $busca=$banco->query($q);
  $reg=$busca->fetch_object();

  $qg = "SELECT cod,genero from generos";
  $buscag = $banco->query($qg);

  $qp = "SELECT cod,produtora from produtoras";
  $buscap = $banco->query($qp);
?>


    <!--//$q="select cod,genero from generos";
    //$busca = $banco->query($q);
    
    //$q2 = "select cod,produtora from produtoras";
    //$busca2 = $banco->query($q2);-->
   


<h1>Alteração de Dados</h1>
<form action="jogo_edit.php" method="GET">
    <table>
        <tr><td>Nome <td> <input type="text" name="nome" id="nome" size="10" maxlength="15" value="<?php echo $reg->nome?>">
        <tr><td>Gênero <td> <select name="genero" id="genero">
            <?php 
            while($regg=$buscag->fetch_object()){
                echo "<option value='$regg->cod'>$regg->genero</option>";
            }
            ?>
            </select>
        <tr><td>Produtora<td><select name="produtora" id="produtora">
            <?php
            while($regp=$buscap->fetch_object()){
                echo "<option value='$regp->cod'>$regp->produtora</option>";
            }
            ?>
        <tr><td>Descrição <td> <textarea name="descricao" id="descricao" rows="10"  cols="42" maxlength="1000" value="<?php echo $reg->descricao?>"></textarea>
        <tr><td>Nota <td><select name="nota" id="nota" value="<?php echo $reg->nota?>"></select>
        <tr><td><input type="submit" value="Salvar">
    </table>
</form>
<?php
$_SESSION['cod'] = $c;
?>


