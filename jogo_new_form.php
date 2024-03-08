<h1>Novo Jogo</h1>
<?php
    $q="select cod,genero from generos";
    $busca = $banco->query($q);
    
    $q2 = "select cod,produtora from produtoras";
    $busca2 = $banco->query($q2);
?>

<form action="jogo_new.php" method="POST">
    <table class="form">
        <tr><td>Nome <td> <input type="text" name="nome" id="nome" size="40" maxlength="40">
        <tr><td>Genero <td><select name="genero" id="genero">
                            <?php
                                while($reg=$busca->fetch_object()){
                                    echo "<option value='$reg->cod'>$reg->genero</option>";
                                }
                            ?>
                            </select>
        <tr><td>Produtora <td><select name="produtora" id="produtora">
                            <?php
                                while($reg=$busca2->fetch_object()){
                                    echo "<option value='$reg->cod'>$reg->produtora</option>";
                                }
                            ?>
                            </select>          
        <tr><td>Nota <td><select name="nota" id="nota">
                            <option value="1" selected>1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                        <tr><td>Descrição <td> <textarea name="descricao" id="descricao" rows="10" cols="42" maxlength="1000"></textarea>                
        <tr><td>Capa <td><input type="file" id="capa" name="capa">                
        <tr><td><td><input class="botao" type="submit" value="Gravar Jogo">
    </table>
</form>
