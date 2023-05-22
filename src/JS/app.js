// pega a URL atual da página
var url = window.location.href;

// verificase a URL corresponde a algum link, em seguida adiciona "active" na classe
if (url.includes("dadosUser.php")) {
    document.getElementById("dados-link").classList.add("active");
}else if (url.includes("formacaoUser.php")) {
    document.getElementById("formacao-link").classList.add("active");
}else if (url.includes("expUser.php")) {
    document.getElementById("exp-link").classList.add("active");
}else if (url.includes("cursoUser.php")) {
     document.getElementById("curso-link").classList.add("active");
}




$('.editarExp').click(function() {
    var valor = $(this).val();
    console.log(valor);
    

    $(document).ready(function() {
        $('#cargo-atualEdit'+valor).click(function() {
            if ($('#cargo-atualEdit'+valor).prop('checked')){
                $('#fimEdit'+valor).prop('type', 'text');
                $('#fimEdit'+valor).prop('placeholder', 'Atual');
                $('#fimEdit'+valor).val('');
                $('#fimEdit'+valor).prop('disabled', true);
            } else {
                $('#fimEdit'+valor).prop('disabled', false);
                $('#fimEdit'+valor).prop('type', 'date');
                $('#fimEdit'+valor).prop('disabled', false);
            }
        });
    });
});