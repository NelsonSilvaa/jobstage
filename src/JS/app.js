function excluirLinha(row_id) {
  console.log(row_id);
  // Faz uma requisição AJAX para o servidor PHP
  $.ajax({
    url: 'http://localhost/jobstage/src/delete/deleteFormacao.php',
    type: 'POST',
    data: { 
            id_linha: row_id
          },
    success: function(data) {
        location.reload();
    },
    error: function() {
      alert('Erro ao se comunicar com o servidor!');
    }
  });
};