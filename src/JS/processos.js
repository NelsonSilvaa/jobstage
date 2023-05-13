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
                    $('input').val("");
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


function crudVaga(idVaga){
    
        var tiporequest  = $('#tipoVaga').val();

        switch (tiporequest){
            case 'editVaga':
                event.preventDefault();
                var nomeInput = document.querySelector('#nomeVaga'+idVaga);
                var nomeError = document.querySelector('#nome-error');
            
                var turnoInput = document.querySelector('#turno'+idVaga);
                var turnoError = document.querySelector('#turno-error');
            
                var turnoDas = document.querySelector('#turnoDas'+idVaga);
                var turnoDasError = document.querySelector('#turno-das-error');
            
                var turnoAte = document.querySelector('#turnoAte'+idVaga);
                var turnoAteError = document.querySelector('#turno-ate-error');
            
                var cidadeInput = document.querySelector('#cidade'+idVaga);
                var cidadeError = document.querySelector('#cidade-error');
            
                var estadoInput = document.querySelector('#estado'+idVaga);
                var estadoError = document.querySelector('#estado-error');
            
                var tipoContrato = document.querySelector('#contrato'+idVaga);
                var tipoContratoError = document.querySelector('#contrato-error');
            
                var tipoRequisitos = document.querySelector('#requisitos'+idVaga);
                var tipoRequisitosError = document.querySelector('#requisitos-error');
            
                var tipoAtv = document.querySelector('#atividades'+idVaga);
                var tipoAtvError = document.querySelector('#atv-error');
            
                nomeInput.classList.add('error');
                nomeError.style.display = 'block';
            
                turnoInput.classList.add('error');
                turnoError.style.display = 'block';
            
                turnoDas.classList.add('error');
                turnoDasError.style.display = 'block';
            
                turnoAte.classList.add('error');
                turnoAteError.style.display = 'block';
            
                cidadeInput.classList.add('error');
                cidadeError.style.display = 'block';
            
                estadoInput.classList.add('error');
                estadoError.style.display = 'block';
            
                tipoContrato.classList.add('error');
                tipoContratoError.style.display = 'block';
            
                tipoRequisitos.classList.add('error');
                tipoRequisitosError.style.display = 'block';
            
                tipoAtv.classList.add('error');
                tipoAtvError.style.display = 'block';
            
                if(nomeInput.value.trim() !== ''){
                    nomeInput.classList.remove('error');
                    nomeError.style.display = 'none';
                }
            
                if(turnoInput.value.trim() !== ''){
                    turnoInput.classList.remove('error');
                    turnoError.style.display = 'none';
                }
            
                if(turnoAte.value.trim() !== ''){
                    turnoAte.classList.remove('error');
                    turnoAteError.style.display = 'none';
                }
            
                if(turnoDas.value.trim() !== ''){
                    turnoDas.classList.remove('error');
                    turnoDasError.style.display = 'none';
                }
            
                if(cidadeInput.value.trim() !== ''){
                    cidadeInput.classList.remove('error');
                    cidadeError.style.display = 'none';
                }
            
                if(estadoInput.value.trim() !== ''){
                    estadoInput.classList.remove('error');
                    estadoError.style.display = 'none';
                }
            
                if(tipoContrato.value.trim() !== ''){
                    tipoContrato.classList.remove('error');
                    tipoContratoError.style.display = 'none';
                }
            
                if(tipoRequisitos.value.trim() !== ''){
                    tipoRequisitos.classList.remove('error');
                    tipoRequisitosError.style.display = 'none';
                }
            
                if(tipoAtv.value.trim() !== ''){
                    tipoAtv.classList.remove('error');
                    tipoAtvError.style.display = 'none';
                }
            
                if(nomeInput.value.trim() === '' || turnoInput.value.trim() === '' || turnoAte.value.trim() === '' || turnoDas.value.trim() === '' || cidadeInput.value.trim() === '' || estadoInput.value.trim() === '' || tipoContrato.value.trim() === '' || tipoRequisitos.value.trim() === '' || tipoAtv.value.trim() === ''){
                    return
                }
            
                var nomeInput      = $('#nomeVaga'+idVaga).val();
                var turnoInput     = $('#turno'+idVaga).val();
                var turnoDas       = $('#turnoDas'+idVaga).val();
                var turnoAte       = $('#turnoAte'+idVaga).val();
                var cidadeInput    = $('#cidade'+idVaga).val();
                var estadoInput    = $('#estado'+idVaga).val();
                var tipoContrato   = $('#contrato'+idVaga).val();
                var tipoRequisitos = $('#requisitos'+idVaga).val();
                var tipoAtv        = $('#atividades'+idVaga).val();
                var salario        = $('#salario'+idVaga).val();

                // requisição para criar vaga
                $.ajax({
                    url: 'http://localhost/jobstage/src/update/updateVagas.php',
                    type: 'POST',
                    data: { 
                        nome:nomeInput,
                        turno:turnoInput,
                        turnoDas:turnoDas,
                        turnoAte:turnoAte,
                        cidade:cidadeInput,
                        estado:estadoInput,
                        tipoContrato:tipoContrato,
                        requisitos:tipoRequisitos,
                        atv:tipoAtv,
                        salario:salario,     
                        idVaga:idVaga
                        },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('input').val("");
                            Swal.fire(
                                'Sucesso!',
                                response.message,
                                'success'
                            ).then(()=>{
                                window.location.replace(response.redirect);
                            });
                          }
                    },
                });
            break;


            case 'criaVaga':
                event.preventDefault();
                var nomeInput = document.querySelector('#nomeVaga');
                var nomeError = document.querySelector('#nome-error');
            
                var turnoInput = document.querySelector('#turno');
                var turnoError = document.querySelector('#turno-error');
            
                var turnoDas = document.querySelector('#turnoDas');
                var turnoDasError = document.querySelector('#turno-das-error');
            
                var turnoAte = document.querySelector('#turnoAte');
                var turnoAteError = document.querySelector('#turno-ate-error');
            
                var cidadeInput = document.querySelector('#cidade');
                var cidadeError = document.querySelector('#cidade-error');
            
                var estadoInput = document.querySelector('#estado');
                var estadoError = document.querySelector('#estado-error');
            
                var tipoContrato = document.querySelector('#contrato');
                var tipoContratoError = document.querySelector('#contrato-error');
            
                var tipoRequisitos = document.querySelector('#requisitos');
                var tipoRequisitosError = document.querySelector('#requisitos-error');
            
                var tipoAtv = document.querySelector('#atividades');
                var tipoAtvError = document.querySelector('#atv-error');
            
                nomeInput.classList.add('error');
                nomeError.style.display = 'block';
            
                turnoInput.classList.add('error');
                turnoError.style.display = 'block';
            
                turnoDas.classList.add('error');
                turnoDasError.style.display = 'block';
            
                turnoAte.classList.add('error');
                turnoAteError.style.display = 'block';
            
                cidadeInput.classList.add('error');
                cidadeError.style.display = 'block';
            
                estadoInput.classList.add('error');
                estadoError.style.display = 'block';
            
                tipoContrato.classList.add('error');
                tipoContratoError.style.display = 'block';
            
                tipoRequisitos.classList.add('error');
                tipoRequisitosError.style.display = 'block';
            
                tipoAtv.classList.add('error');
                tipoAtvError.style.display = 'block';
            
                if(nomeInput.value.trim() !== ''){
                    nomeInput.classList.remove('error');
                    nomeError.style.display = 'none';
                }
            
                if(turnoInput.value.trim() !== ''){
                    turnoInput.classList.remove('error');
                    turnoError.style.display = 'none';
                }
            
                if(turnoAte.value.trim() !== ''){
                    turnoAte.classList.remove('error');
                    turnoAteError.style.display = 'none';
                }
            
                if(turnoDas.value.trim() !== ''){
                    turnoDas.classList.remove('error');
                    turnoDasError.style.display = 'none';
                }
            
                if(cidadeInput.value.trim() !== ''){
                    cidadeInput.classList.remove('error');
                    cidadeError.style.display = 'none';
                }
            
                if(estadoInput.value.trim() !== ''){
                    estadoInput.classList.remove('error');
                    estadoError.style.display = 'none';
                }
            
                if(tipoContrato.value.trim() !== ''){
                    tipoContrato.classList.remove('error');
                    tipoContratoError.style.display = 'none';
                }
            
                if(tipoRequisitos.value.trim() !== ''){
                    tipoRequisitos.classList.remove('error');
                    tipoRequisitosError.style.display = 'none';
                }
            
                if(tipoAtv.value.trim() !== ''){
                    tipoAtv.classList.remove('error');
                    tipoAtvError.style.display = 'none';
                }
            
                if(nomeInput.value.trim() === '' || turnoInput.value.trim() === '' || turnoAte.value.trim() === '' || turnoDas.value.trim() === '' || cidadeInput.value.trim() === '' || estadoInput.value.trim() === '' || tipoContrato.value.trim() === '' || tipoRequisitos.value.trim() === '' || tipoAtv.value.trim() === ''){
                    return
                }
           
                var nomeInput      = $('#nomeVaga').val();
                var turnoInput     = $('#turno').val();
                var turnoDas       = $('#turnoDas').val();
                var turnoAte       = $('#turnoAte').val();
                var cidadeInput    = $('#cidade').val();
                var estadoInput    = $('#estado').val();
                var tipoContrato   = $('#contrato').val();
                var tipoRequisitos = $('#requisitos').val();
                var tipoAtv        = $('#atividades').val();
                var salario        = $('#salario').val();



                // requisição para criar vaga
                $.ajax({
                    url: 'http://localhost/jobstage/src/read-inputs/criarVagas.php',
                    type: 'POST',
                    data: { 
                        nome:nomeInput,
                        turno:turnoInput,
                        turnoDas:turnoDas,
                        turnoAte:turnoAte,
                        cidade:cidadeInput,
                        estado:estadoInput,
                        tipoContrato:tipoContrato,
                        requisitos:tipoRequisitos,
                        atv:tipoAtv,
                        salario:salario,     
                        },
                    dataType: "json",
                    success: function(response) {
                        if (response.success) {
                            $('input').val("");
                            Swal.fire(
                                'Sucesso!',
                                response.message,
                                'success'
                            ).then(()=>{
                                window.location.replace(response.redirect);
                            });
                          }
                    },
                });
            break;
        }
}

function deleteVaga(idVaga){
    event.preventDefault();
    console.log(idVaga);
    Swal.fire({
        title: 'Quer mesmo remover?',
        text: "Esta ação não poderá ser revertida!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'NÃO!',
        confirmButtonText: 'SIM!'
      }).then((result) => {
        $.ajax({
            url: 'http://localhost/jobstage/src/delete/deleteVaga.php',
            type: 'POST',
            data: { 
                    idVaga: idVaga,
                },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    Swal.fire(
                        'Removido!',
                        'Sua vaga foi removida com sucesso!',
                        'success'
                      ).then(()=>{
                        window.location.replace(response.redirect);
                    });
                }else{
                    Swal.fire(
                        'Ops...!',
                        'Algum erro impediu que a vaga fosse removida!',
                        'error'
                      ).then(()=>{
                        window.location.replace(response.redirect);
                    });
                }
            },
        });
      })
}


function candidatoVaga(idVaga){
    event.preventDefault();
    $.ajax({
        url: 'http://localhost/jobstage/usuario/vagas-usuario/candidatoVagas.php',
        type: 'POST',
        data: { 
                idVaga: idVaga,
            },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                Swal.fire(
                    'Sucesso!',
                    response.message,
                    'success'
                ).then(()=>{
                    window.location.replace(response.redirect);
                });
            }
        },
    });
}


function criarDados(){
    event.preventDefault();
    var nome = document.querySelector('#nome');
    var nomeEerror = document.querySelector('#nome-error');

    var email = document.querySelector('#email');
    var emailEerror = document.querySelector('#email-error');

    var dataNsc = document.querySelector('#dataNsc');
    var dataNscEerror = document.querySelector('#dataNsc-error');

    var estadoCivil = document.querySelector('#estadoCivil');
    var estadoCivilEerror = document.querySelector('#estadoCivil-error');

    var telefone = document.querySelector('#telefone');
    var telefoneEerror = document.querySelector('#telefone-error');

    
    nome.classList.add('error');
    nomeEerror.style.display = 'block';

    email.classList.add('error');
    emailEerror.style.display = 'block';

    dataNsc.classList.add('error');
    dataNscEerror.style.display = 'block';

    estadoCivil.classList.add('error'); 
    estadoCivilEerror.style.display = 'block';

    telefone.classList.add('error'); 
    telefoneEerror.style.display = 'block';

    if(nome.value.trim() !== ''){
        nome.classList.remove('error');
        nomeEerror.style.display = 'none';
    }

    if(email.value.trim() !== ''){
        email.classList.remove('error');
        emailEerror.style.display = 'none';
    }

    if(dataNsc.value.trim() !== ''){
        dataNsc.classList.remove('error');
        dataNscEerror.style.display = 'none';
    }

    if(estadoCivil.value.trim() !== ''){
        estadoCivil.classList.remove('error');
        estadoCivilEerror.style.display = 'none';
    }

    if(telefone.value.trim() !== ''){
        telefone.classList.remove('error');
        telefoneEerror.style.display = 'none';
    }

    if(nome.value.trim() === '' || email.value.trim() === '' || dataNsc.value.trim() === '' || estadoCivil.value.trim() === '' || telefone.value.trim() === ''){
        return
    }


    var nome        = $('#nome').val(); 
    var email       = $('#email').val(); 
    var dataNsc     = $('#dataNsc').val(); 
    var estadoCivil = $('#estadoCivil').val(); 
    var telefone    = $('#telefone').val(); 
    var linkedin    = $('#linkedin').val(); 
    var sobre       = $('#objetivo').val(); 
    
    $.ajax({
        url: 'http://localhost/jobstage/src/read-inputs/dados.php',
        type: 'POST',
        data: { 
            nome: nome,
            email: email,
            dataNsc: dataNsc,
            estdoCivil: estadoCivil,
            telefone: telefone,
            linkedin: linkedin,
            sobre: sobre
            },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                Swal.fire(
                    'Sucesso!',
                    response.message,
                    'success'
                ).then(()=>{
                    window.location.replace(response.redirect);
                });
              }
        },
    });

}


function novaFormacao(){
    event.preventDefault();
    var curso = document.querySelector('#cursoInsert');
    var cursoError = document.querySelector('#curso-error-insert');

    var instituicao = document.querySelector('#instituicaoInsert');
    var instituicaoError = document.querySelector('#instituicao-error-insert');

    var nivel = document.querySelector('#nivelInsert');
    var nivelError = document.querySelector('#nivel-error-insert');

    var duracao = document.querySelector('#duracaoInsert');
    var duracaoError = document.querySelector('#duracao-error-insert');

    var status = document.querySelector('#statusInsert');
    var statusError = document.querySelector('#status-error-insert');

    curso.classList.add('error');
    cursoError.style.display = 'block';

    instituicao.classList.add('error');
    instituicaoError.style.display = 'block';

    nivel.classList.add('error');
    nivelError.style.display = 'block';

    duracao.classList.add('error'); 
    duracaoError.style.display = 'block';

    status.classList.add('error'); 
    statusError.style.display = 'block';


    if(curso.value.trim() !== ''){
        curso.classList.remove('error');
        cursoError.style.display = 'none';
    }

    if(instituicao.value.trim() !== ''){
        instituicao.classList.remove('error');
        instituicaoError.style.display = 'none';
    }

    if(nivel.value.trim() !== ''){
        nivel.classList.remove('error');
        nivelError.style.display = 'none';
    }

    if(duracao.value.trim() !== ''){
        duracao.classList.remove('error');
        duracaoError.style.display = 'none';
    }

    if(status.value.trim() !== ''){
        status.classList.remove('error');
        statusError.style.display = 'none';
    }

    if(curso.value.trim() === '' || instituicao.value.trim() === '' || nivel.value.trim() === '' || duracao.value.trim() === '' || status.value.trim() === ''){
        return
    }


    var curso = $('#cursoInsert').val();
   
    var instituicao = $('#instituicaoInsert').val();
    
    var nivel = $('#nivelInsert').val();

    var duracao = $('#duracaoInsert').val();

    var status = $('#statusInsert').val();

    $.ajax({
        url: 'http://localhost/jobstage/src/read-inputs/formacao.php',
        type: 'POST',
        data: { 
            curso: curso,
            instituicao: instituicao,
            nivel: nivel,
            duracao: duracao,
            status: status
            },
        dataType: "json",
        success: function(response) {
            if (response.success) {
                Swal.fire(
                    'Sucesso!',
                    response.message,
                    'success'
                ).then(()=>{
                    window.location.replace(response.redirect);
                });
              }
        },
    });
}


function deletarFormacao(row_id) {
    event.preventDefault();
    var idlinha = row_id
    console.log(row_id);
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
            console.log("hsehfrlf")
            $.ajax({
                url: 'http://localhost/jobstage/src/delete/deleteFormacao.php',
                type: 'POST',
                data: { 
                    id_linha: idlinha,
                    },
                dataType: "json",
                success: function(response) {
                    Swal.fire(
                        'Deletado!',
                        'Sua formação foi deletada com sucesso!',
                        'success'
                    ).then(()=>{
                        window.location.replace(response.redirect);
                    });
                }
            })
        }
      })
  };