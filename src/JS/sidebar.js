var url = window.location.href;

if (url.includes("index.php")) {
    $(".sidebar ul li.active").removeClass('active');
    $(".inicio").addClass('active');
}else if (url.includes("dadosUser.php") || url.includes("formacaoUser.php")  || url.includes("cursoUser.php") || url.includes("expUser.php")) {
    $(".sidebar ul li.active").removeClass('active');
    $(".dados").addClass('active');
}else if (url.includes("vagas.php")) {
    $(".sidebar ul li.active").removeClass('active');
    $(".vagas").addClass('active');
}else if (url.includes("candidaturas.php")) {
    $(".sidebar ul li.active").removeClass('active');
    $(".candidaturas").addClass('active');
}else if (url.includes("curriculo.php")) {
    $(".sidebar ul li.active").removeClass('active');
    $(".curriculo").addClass('active');
}

$('.open-btn').on('click', function () {
    $('.sidebar').addClass('active');

});


$('.close-btn').on('click', function () {
    $('.sidebar').removeClass('active');

})