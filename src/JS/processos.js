/*

    INSERIR VERIFICAÇÕES DE INPUTS E ALERTS DE TODO O SISTEMA

*/

function loginUser(){
        var LoginINput = document.querySelector('#login');
        var nomeError = document.querySelector('#nome-error');
        var senhaInput = document.querySelector('#senha');
        var senhaError = document.querySelector('#senha-error');
        
        if (LoginINput.value.trim() === '' && senhaInput.value.trim() === '') {
            event.preventDefault();
            LoginINput.classList.add('error');
            nomeError.style.display = 'block';
            senhaInput.classList.add('error');
            senhaError.style.display = 'block';
        }
        else if(LoginINput.value.trim() === ''){
            event.preventDefault();
            senhaInput.classList.remove('error');
            senhaError.style.display = 'none';
            LoginINput.classList.add('error');
            nomeError.style.display = 'block';
        } 
        else if(senhaInput.value.trim() === ''){
            event.preventDefault();
            LoginINput.classList.remove('error');
            nomeError.style.display = 'none';
            senhaInput.classList.add('error');
            senhaError.style.display = 'block';
        } 
        else {
            event.preventDefault();
            LoginINput.classList.remove('error');
            senhaInput.classList.remove('error');
            nomeError.style.display = 'none';
            senhaError.style.display = 'none';
            
            var login = $('#login').val();
            var senha = $('#senha').val();
            var tipoLogin = $('#tipoLogin').val();
            tipoLogin === 'loginUser'? tipoLogin='LoginUser' : tipoLogin='loginempresa' 
            console.log(login);
            console.log(senha);
            console.log(tipoLogin);
            
            $.ajax({
                url: 'http://localhost/jobstage/src/configs/login.php',
                type: 'POST',
                data: { 
                        login: login,
                        senha: senha, 
                        tipo_login: tipoLogin,
                    },
                dataType: "json",
                success: function(response) {
                    if (response.success) {
                        console.log("adadad");
                        window.location.replace(response.redirect);
                      } else {
                        Swal.fire(
                            'ERRO!',
                            response.message,
                            'error'
                        )
                      }
                },
            });
    
        }
}


function loginEmpresa(){
    event.preventDefault();
    console.log("yeah")
    var LoginINput = document.querySelector('#cnpj');
    var nomeError = document.querySelector('#nome-error');
    var senhaInput = document.querySelector('#senha');
    var senhaError = document.querySelector('#senha-error');
    
    if (LoginINput.value.trim() === '' && senhaInput.value.trim() === '') {
        event.preventDefault();
        LoginINput.classList.add('error');
        nomeError.style.display = 'block';
        senhaInput.classList.add('error');
        senhaError.style.display = 'block';
    }
    else if(LoginINput.value.trim() === ''){
        event.preventDefault();
        senhaInput.classList.remove('error');
        senhaError.style.display = 'none';
        LoginINput.classList.add('error');
        nomeError.style.display = 'block';
    } 
    else if(senhaInput.value.trim() === ''){
        event.preventDefault();
        LoginINput.classList.remove('error');
        nomeError.style.display = 'none';
        senhaInput.classList.add('error');
        senhaError.style.display = 'block';
    } 
    else {
        event.preventDefault();
        LoginINput.classList.remove('error');
        senhaInput.classList.remove('error');
        nomeError.style.display = 'none';
        senhaError.style.display = 'none';
        
        var login = $('#cnpj').val();
        var senha = $('#senha').val();
        var tipoLogin = $('#tipoLogin').val();
        console.log(login);
        console.log(senha);
        
        $.ajax({
            url: 'http://localhost/jobstage/src/configs/login.php',
            type: 'POST',
            data: { 
                    cnpj: login,
                    senha: senha, 
                    tipo_login: tipoLogin,
                },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    console.log("adadad");
                    window.location.replace(response.redirect);
                  } else {
                    Swal.fire(
                        'ERRO!',
                        response.message,
                        'error'
                    )
                  }
            },
        });

    }
}

function aa(){
    event.preventDefault();
    Swal.fire(
        'Good job',
        'you clicked the buton',
        'success'
    )
    

}