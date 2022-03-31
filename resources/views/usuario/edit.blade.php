<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <style>
        .add-tel {
            width: 35px;
            height: 30px;
            margin-top: 35px;
        }
    </style>
</head>
<body>
<form method="POST" action="{{ route('usuario.update', [$usuario->id]) }}">
    {{csrf_field()}}
    {{method_field('PUT')}}
    <div class="container-fluid">
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-light " style="background-color: #23E3FF;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#"><strong>AppUsuario</strong></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                </div>
            </nav>
        </div>


        <div class="row mt-5" style="margin-left: 5px; margin-right: 5px;">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" id="nome" placeholder="Nome completo" autocomplete="off" required value="{{ $usuario->nome }}">
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" placeholder="email@example.com" autocomplete="off" required value="{{ $usuario->email }}">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" name="cpf" class="form-control" id="cpf" autocomplete="off" required value="{{ $usuario->cpf }}">
                </div>

                <div class="mb-3 col-md-4">
                    <label for="dt_nascimento" class="form-label">Data nascimento</label>
                    <input type="date" name="dt_nascimento" class="form-control" id="dt_nascimento" autocomplete="off" required value="{{ $usuario->dt_nascimento }}">
                </div>

                <div class="mb-3 col-md-4">
                    <label for="perfil" class="form-label">Perfil</label>
                    <select class="form-control" name="perfil" id="perfil" required>
                        <option value="">Selecione o Perfil</option>
                        <option {{ $usuario->perfil == 'A' ? 'selected' : ''  }} value="A">Admin</option>
                        <option {{ $usuario->perfil == 'S' ? 'selected' : ''  }} value="S">Supervisor</option>
                        <option {{ $usuario->perfil == 'O' ? 'selected' : ''  }} value="O">Operário</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-3">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" name="cep" class="form-control" id="cep" autocomplete="off" required value="{{ $usuario->cep }}">
                </div>

                <div class="mb-3 col-md-6">
                    <label for="logradouro" class="form-label">Logradouro</label>
                    <input type="text" name="logradouro" class="form-control" id="logradouro" autocomplete="off" required value="{{ $usuario->logradouro }}">
                </div>

                <div class="mb-3 col-md-3">
                    <label for="numero" class="form-label">Número</label>
                    <input type="text" name="numero" class="form-control" id="numero" autocomplete="off" required value="{{ $usuario->numero }}">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="cidade" class="form-label">Cidade</label>
                    <input type="text" name="cidade" class="form-control" id="cidade" autocomplete="off" required value="{{ $usuario->cidade }}">
                </div>

                <div class="mb-3 col-md-4">
                    <label for="estado" class="form-label">Estado</label>
                    <input type="text" name="estado" class="form-control" id="estado" autocomplete="off" required value="{{ $usuario->estado }}">
                </div>

                <div class="mb-3 col-md-4">
                    <label for="pais" class="form-label">País</label>
                    <input type="text" name="pais" class="form-control" id="pais" autocomplete="off" required value="{{ $usuario->pais }}">
                </div>
            </div>

            <div class="row">
                <div class="mb-3 col-md-8">
                    <label for="complemento" class="form-label">Complemento</label>
                    <input type="text" name="complemento" class="form-control" id="complemento" autocomplete="off" required value="{{ $usuario->complemento }}">
                </div>

                <div class="mb-3 col-md-4">
                    <label for="senha" class="form-label">Senha</label>
                    <input type="password" name="senha" class="form-control" id="senha" autocomplete="off" required value="{{ $usuario->senha }}">
                </div>
            </div>

            <div class="row">

                @foreach($usuario->telefones as $telefone)
                    <div class="mb-3 col-md-3">
                        <label for="txt_telefone" class="form-label">Telefone</label>
                        <input type="text" name="txt_telefone[]" class="form-control" id="txt_telefone" autocomplete="off" value="{{ $telefone->txt_telefone }}">
                    </div>
                @endforeach
                <button class="add-tel addtel1" data-numtel="1" type="button">+</button>
            </div>

            <div class="row mt-4 mb-4">
                <div class="col-md-4">
                    <a href="{{ route('usuario.index')  }}" class="btn btn-secondary">Voltar</a>
                    <button type="submit" class="btn btn-success">Atualizar</button>
                </div>
            </div>

        </div>
    </div>
</form>

<script>

    var cep = document.getElementById('cep');
    cep.onblur = function () {
        let num_cep = cep.value;

        var url = `https://viacep.com.br/ws/${num_cep}/json/`;

        fetch(url, {
            method: 'GET',
            headers: {'Content-Type':'application/x-www-form-urlencoded'}
        })
            .then(function (data) {
                data.json().then(function (resp) {

                    console.log("Debug no resp - ", resp);
                    document.getElementById('estado').value = resp.uf;
                    document.getElementById('cidade').value = resp.localidade;
                    document.getElementById('logradouro').value = resp.logradouro;

                });
            })
            .catch(function (error) {
                console.log("Debug error - ", error);
            });

    }

    var addTel = document.querySelector(".add-tel");
    addTel.onclick = function () {
        alert("Clicou aqui !");
    }


</script>
</body>
</html>
