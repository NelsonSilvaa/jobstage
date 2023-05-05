<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/index.css"/>
    <link rel="stylesheet" type="text/css" href="./css/layout.css"/>
</head>
<body>
<header>

</header>
<section id="first-section" class="first-section">
    <div class="container-first-section ">
        <div class="div-flex-f-section">
            <div>
                <h1>Chegou a hora de colocar seus estudos em prática!!!</h1>
            </div>
            <div>
                <h3>Encontre sua vaga de estágio perfeita aqui!</h3>
            </div>
        </div>
    
    </div>
</section>

<section id="secont-section" class="second-section">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h4>Tela de Login</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="./src/login.php">
                            <div class="form-group">
                                <label for="usuario">Login</label>
                                <input type="text" class="form-control" id="login" name="usuario" placeholder="Digite seu login">
                            </div>
                            <div class="form-group">
                                <label for="senha">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Entrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"
            integrity="sha384-kSpN/7CfdBjN9+RY5DhN5Hz5zr+ZnysK8W1ufX0ZN0SPR20BpZiDgmWwfdKvSGtl"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


















    <!-- <div class="container-second-section">
        <div class="login">
            <h1>LOGIN</h1>
            <div class="login-flex">
                <div class="btn-login-estudante">
                    <button>Estudante</button>
                </div>
                <div class="btn-login-empresa">
                    <button>Empresa</button>
                </div>
            </div>
        </div>
        <div class="login-estudante">
            <h1>CADASTRE-SE</h1>
            <div class="cadastro-flex">
                <div class="btn-cadastro-estudante">
                    <button>Estudante</button>
                </div>
                <div class="btn-cadastro-empresa">
                    <button>Empresa</button>
                </div>
            </div>
        </div>
    </div> -->
</section>

</body>
</html>