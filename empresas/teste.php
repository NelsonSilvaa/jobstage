<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <h2>Filtros</h2>
        <form method="post">
            <input type="checkbox" name="filtro[]" value="item1">Item 1<br>
            <input type="checkbox" name="filtro[]" value="item2">Item 2<br>
            <input type="checkbox" name="filtro[]" value="item3">Item 3<br>
            <input type="checkbox" name="filtro[]" value="item4">Item 4<br>
            <input type="checkbox" name="filtro[]" value="item5">Item 5<br>
            <input type="submit" name="submit" value="Filtrar">
        </form>
    </div>

    <div>
        <h2>Itens filtrados</h2>
        <?php
            if(isset($_POST['submit'])) {
                $itens_filtrados = $_POST['filtro'];

                if(count($itens_filtrados) > 0) {
                    echo "<ul>";

                    foreach($itens_filtrados as $item) {
                        echo "<li>$item</li>";
                    }

                    echo "</ul>";
                } else {
                    echo "Nenhum item selecionado";
                }
            }
        ?>
    </div>
</body>
</html>