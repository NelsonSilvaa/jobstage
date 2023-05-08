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


function cadEmpresa(){
    event.preventDefault();
    var nomeEmpresa =  document.querySelector('#nomeEmpresa');
    var nomeError =  document.querySelector('#nome-error');

    var cnpjEmpresa =  document.querySelector('#cnpj');
    var cnpjError =  document.querySelector('#cnpj-error');

    var emailEmpresa =  document.querySelector('#email');
    var emailError =  document.querySelector('#email-error');

    var senha01 =  document.querySelector('#senha01');
    var senha01Error =  document.querySelector('#senha01-error');
    var senha01ErrorIgual =  document.querySelector('#senha01-error-igual');
    var s1 = $('#senha01').val();

    var senha02 =  document.querySelector('#senha02');
    var senha02Error =  document.querySelector('#senha02-error');
    var senha02ErrorIgual =  document.querySelector('#senha02-error-igual');
    var s2 = $('#senha02').val();


   // adiciona erro em todos os inputs
    nomeEmpresa.classList.add('error');
    nomeError.style.display = 'block';

    cnpjEmpresa.classList.add('error');
    cnpjError.style.display = 'block';

    emailEmpresa.classList.add('error');
    emailError.style.display = 'block';

    senha01.classList.add('error');
    senha01Error.style.display = 'block';

    senha02.classList.add('error');
    senha02Error.style.display = 'block';


    if(nomeEmpresa.value.trim() !== ''){
        event.preventDefault();
        nomeEmpresa.classList.remove('error');
        nomeError.style.display = 'none';
    }

    if(cnpjEmpresa.value.trim() !== ''){
        event.preventDefault();
        cnpjEmpresa.classList.remove('error');
        cnpjError.style.display = 'none';
    }

    if(emailEmpresa.value.trim() !== ''){
        event.preventDefault();
        emailEmpresa.classList.remove('error');
        emailError.style.display = 'none';
    }

    if(senha01.value.trim() !== '' || senha02.value.trim() !== ''){
        event.preventDefault();
        senha01.classList.remove('error');
        senha01Error.style.display = 'none';
        senha02.classList.remove('error');
        senha02Error.style.display = 'none';

        if(s1 !== s2){
            event.preventDefault();
            senha02.classList.add('error');
            senha01ErrorIgual.style.display = 'block';

            senha02.classList.add('error');
            senha02ErrorIgual.style.display = 'block';
            return;
        }else{
            senha02.classList.remove('error');
            senha01ErrorIgual.style.display = 'none';

            senha02.classList.remove('error');
            senha02ErrorIgual.style.display = 'none';
        }


    }
    
        var nome = $('#nomeEmpresa').val();
        var cnpj = $('#cnpj').val();
        var email = $('#email').val();
        var tipoCad = $('#tipoCad').val();
        
        $.ajax({
            url: 'http://localhost/jobstage/src/configs/novoCadastro.php',
            type: 'POST',
            data: { 
                    nome: nome,
                    cnpj: cnpj,
                    email: email,
                    senha: s1,
                    tipo:tipoCad,
                },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    $('input').val("");
                    Swal.fire(
                        'Cadastro criado com sucesso!',
                        response.message,
                        'succes'
                    ).then(()=>{
                        window.location.replace(response.redirect);
                    });
                  } else {
                    $('#formEmpresa')[0].reset();
                    Swal.fire({
                        icon: 'info',
                        title: 'CNPJ já existe!',
                        text: response.message,
                        footer: '<a href="../../empresas/acesso/loginempresa.html">Clique aqui para entrar!</a>'
                      })
                  }
            },
        });
}


function cadUser(){
    event.preventDefault();
    var emailInput = document.querySelector('#email');
    var emailEror = document.querySelector('#email-error');

    var senha01input = document.querySelector('#senha01');
    var senha01error = document.querySelector('#senha01-error');
    var senha01ErrorIgual = document.querySelector('#senha01-error-igual');

    var senha02input = document.querySelector('#senha02');
    var senha02Error = document.querySelector('#senha02-error');
    var senha02ErrorIgual = document.querySelector('#senha02-error-igual');


    emailInput.classList.add('error');
    emailEror.style.display = 'block';

    senha01input.classList.add('error');
    senha01error.style.display = 'block';

    senha02input.classList.add('error');
    senha02Error.style.display = 'block';

    if(emailInput.value.trim() !== ''){
        emailInput.classList.remove('error');
        emailEror.style.display = 'none';
    }

    if(senha01.value.trim() !== '' || senha02.value.trim() !== ''){
        event.preventDefault();
        senha01.classList.remove('error');
        senha01error.style.display = 'none';
        senha02.classList.remove('error');
        senha02Error.style.display = 'none';
        
        var s1 = $('#senha01').val();
        var s2 = $('#senha02').val();
        
        if(s1 !== s2){
            
            senha01.classList.add('error');
            senha01ErrorIgual.style.display = 'block';

            senha02.classList.add('error');
            senha02ErrorIgual.style.display = 'block';
            return;
        }else{
            senha01.classList.remove('error');
            senha01ErrorIgual.style.display = 'none';

            senha02.classList.remove('error');
            senha02ErrorIgual.style.display = 'none';
        }


    }

    var email = $('#email').val();
    var tipoCad = $('#tipoCad').val();
    
    $.ajax({
        url: 'http://localhost/jobstage/src/configs/novoCadastro.php',
        type: 'POST',
        data: { 
                email: email,
                senha: s1,
                tipo:tipoCad,
            },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                $('input').val("");
                Swal.fire(
                    'E-mail já existe!',
                    response.message,
                    'success'
                ).then(()=>{
                    window.location.replace(response.redirect);
                });
              } else {
                $('input').val("");
                Swal.fire({
                    icon: 'info',
                    title: 'Conta já cadastrada!',
                    text: response.message,
                    footer: '<a href="../../usuario/acesso/login-usuario.html">Clique aqui para entrar!</a>'
                  })
              }
        },
    });

}