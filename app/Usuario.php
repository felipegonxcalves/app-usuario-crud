<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Usuario extends Model
{
    //
    protected $table = "usuario";
    protected $fillable = ['nome', 'email', 'senha', 'cpf', 'dt_nascimento', 'perfil', 'endereco_id'];

    public function insert($data)
    {
        \DB::beginTransaction();
        try {
            $endereco = new Endereco();

            $endereco = $endereco->create([
                'cep' => $data['cep'],
                'logradouro' => $data['logradouro'],
                'complemento' => $data['complemento'],
                'numero' => $data['numero'],
                'cidade' => $data['cidade'],
                'estado' => $data['estado'],
                'pais' => $data['pais']
            ]);

            $data['endereco_id'] = $endereco->id;

            $usuario = Usuario::query()->create($data);

            foreach ($data['txt_telefone'] as $telefone) {
                Telefone::query()->create(['txt_telefone' => $telefone, 'usuario_id' => $usuario->id]);
            }

            \DB::commit();

            return true;
        } catch (\Exception $ex) {
            \DB::rollback();
            return response()->json(['error' => $ex->getMessage()]);
        }

    }

    public function getAll()
    {
        $sql = "SELECT u.*,
                       e.cep,
                       e.logradouro,
                       e.complemento,
                       e.numero,
                       e.cidade,
                       e.estado,
                       e.pais
                FROM usuario u
                INNER JOIN endereco e ON e.id = u.endereco_id order by u.nome desc";

        $usuarios = \DB::select($sql);

        foreach ($usuarios as $key => $usuario) {
            $sql = "SELECT t.id, t.txt_telefone  FROM telefone t WHERE usuario_id = {$usuario->id}";
            $usuarios[$key]->telefones = \DB::select($sql);
        }

        return $usuarios;
    }

    public function getById($id)
    {
        $sql = "SELECT u.*,
                       e.cep,
                       e.logradouro,
                       e.complemento,
                       e.numero,
                       e.cidade,
                       e.estado,
                       e.pais
                FROM usuario u
                INNER JOIN endereco e ON e.id = u.endereco_id
                WHERE u.id = {$id}";

        $usuarios = \DB::select($sql);

        foreach ($usuarios as $key => $usuario) {
            $sql = "SELECT t.id, t.txt_telefone  FROM telefone t WHERE usuario_id = {$usuario->id}";
            $usuarios[$key]->telefones = \DB::select($sql);
        }

        return $usuarios;
    }

    public function updateUsuario($data, $usuario)
    {
        \DB::beginTransaction();

        try {
            Endereco::query()->where('id', $usuario->endereco_id)->update([
                'cep' => $data['cep'],
                'logradouro' => $data['logradouro'],
                'complemento' => $data['complemento'],
                'numero' => $data['numero'],
                'cidade' => $data['cidade'],
                'estado' => $data['estado'],
                'pais' => $data['pais']
            ]);

            Usuario::query()->where('id', $usuario->id)->update([
                'nome' => $data['nome'],
                'email' => $data['email'],
                'senha' => $data['senha'],
                'cpf' => $data['cpf'],
                'dt_nascimento' => $data['dt_nascimento'],
                'perfil' => $data['perfil']
            ]);

            \DB::table('telefone')->where('usuario_id', $usuario->id)->delete();
            foreach ($data['txt_telefone'] as $telefone) {
                Telefone::query()->create(['txt_telefone' => $telefone, 'usuario_id' => $usuario->id]);
            }

            \DB::commit();

            return true;
        } catch (\Exception $ex) {
            \DB::rollback();
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

    public function deletar($usuario)
    {
        \DB::beginTransaction();

        try {
            \DB::table('telefone')->where('usuario_id', $usuario->id)->delete();
            \DB::table('endereco')->where('id', $usuario->endereco_id)->delete();
            \DB::table('usuario')->where('id', $usuario->id)->delete();

            \DB::commit();
            return true;
        } catch (\Exception $ex) {
            \DB::rollback();
            return response()->json(['error' => $ex->getMessage()]);
        }
    }

}
