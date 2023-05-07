// const { Swal } = require("./swetalert2");

// document.querySelector('form').addEventListener('submit', function(event) {
//     var LoginINput = document.querySelector('#login');
//     var nomeError = document.querySelector('#nome-error');
//     var senhaInput = document.querySelector('#senha');
//     var senhaError = document.querySelector('#senha-error');
//     if (LoginINput.value.trim() === '' && senhaInput.value.trim() === '') {
//         event.preventDefault();
//         LoginINput.classList.add('error');
//         nomeError.style.display = 'block';
//         senhaInput.classList.add('error');
//         senhaError.style.display = 'block';
//     } else {
//         LoginINput.classList.remove('error');
//         nomeError.style.display = 'none';
//     }
// });


function alert(){
    Swal.fire(
        'Good job',
        'you clicked the buton',
        'success'
    )
    

}