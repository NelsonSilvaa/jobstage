<form method="post">
  <input type="checkbox" name="item[]" value="item1"> Item 1<br>
  <input type="checkbox" name="item[]" value="item2"> Item 2<br>
  <input type="checkbox" name="item[]" value="item3"> Item 3<br>
  <input type="checkbox" name="item[]" value="item4"> Item 4<br>
  <input type="checkbox" name="item[]" value="item5"> Item 5<br>
  <input type="submit" value="Mostrar Itens Selecionados">
</form>

-------------------------

if(isset($_POST['item'])) {
  // Recupera os valores dos checkboxes marcados
  $itensSelecionados = $_POST['item'];

  // Array com todos os itens
  $itens = array(
    'item1' => 'Item 1',
    'item2' => 'Item 2',
    'item3' => 'Item 3',
    'item4' => 'Item 4',
    'item5' => 'Item 5'
  );

  // Filtra os itens selecionados
  $itensFiltrados = array_intersect_key($itens, array_flip($itensSelecionados));
}


if(isset($itensFiltrados)) {
  echo '<div>';
  foreach($itensFiltrados as $item) {
    echo '<p>' . $item . '</p>';
  }
  echo '</div>';
}


