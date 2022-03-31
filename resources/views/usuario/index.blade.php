<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>App Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>
<body>
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

        <div class="row mt-3 mb-5">
            <div class="col-md-3">
                <a href="{{ route('usuario.create')  }}" class="btn btn-primary">Cadastrar Usuário</a>
            </div>

        </div>

        <div class="row mt-3" style="margin-left: 5px; margin-right: 5px;">
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">CPF</th>
                    <th scope="col">Nascimento</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Opções</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->nome }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->cpf }}</td>
                            <td>{{ $usuario->dt_nascimento }}</td>
                            <td>{{ $usuario->cidade }}</td>
                            <td>{{ $usuario->estado }}</td>
                            <td>
                                <a href="{{ route('usuario.edit', [$usuario->id]) }}" class="btn btn-warning btn-sm">Editar</a>
                                <a href="{{ route('usuario.deletar', [$usuario->id]) }}" class="btn btn-danger btn-sm" href="">Deletar</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



    </div>
</body>
</html>