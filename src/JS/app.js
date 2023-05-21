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