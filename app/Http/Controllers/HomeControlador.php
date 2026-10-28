<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Gestao;
use App\Models\Tarefa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeControlador extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $afazer = Tarefa::select("tarefas.id", "tarefas.name as name", "users.name as responsavel", "tarefas.entidade_id")->where("tarefas.entidade_id", Auth::user()->entidade_id)->where('coluna', '=', 1)->join("users", "tarefas.user_id", "=", "users.id")->get();
        $emprogresso = Tarefa::select("tarefas.id", "tarefas.name as name", "users.name as responsavel", "tarefas.entidade_id")->where("tarefas.entidade_id", Auth::user()->entidade_id)->where('coluna', '=', 2)->join("users", "tarefas.user_id", "=", "users.id")->get();
        $concluido = Tarefa::select(
            "tarefas.id",
            "tarefas.name as name",
            "users.name as responsavel",
            "tarefas.entidade_id"
        )->where("tarefas.entidade_id", Auth::user()->entidade_id)->where('coluna', '=', 3)->join("users", "tarefas.user_id", "=", "users.id")->get();
        $gestao = User::where("gestao_id", Auth::user()->gestao_id)->get();
        return view('home', compact("afazer", "emprogresso", "concluido", "gestao"))->with('fireAlert', false);
    }

    //Método para salvar tarefa
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string|max:255',
            'responsavel' => 'required',


        ], [
            'required' => "Este campo é obrigatório.",

        ]);
        $input['entidade_id'] = Auth::user()->entidade_id;
        $input['user_id'] = Auth::user()->id;
        $input['coluna'] = 1;
        Tarefa::create($input);
        return redirect(route("index"));
    }

    public function update(Request $request, $id)
    {
        $tarefa = Tarefa::Find($id);
        $tarefa->coluna = $request->coluna;
        $tarefa->save();

        return redirect(route("index"));
    }
    public function destroy($id)
    {
        //
        $t = Tarefa::find($id);
        $t->delete();
        return redirect(route('home'));
    }




    //Eventos

    public function showEventos()
    {
        $e = Evento::select("id", "title", "color", "start", "end")->where("entidade_id", "=", Auth::user()->entidade_id)->get();

        $e = json_encode($e);
        return $e;
    }
    public function storeEventos(Request $request)
    {
        $input = $request->validate([
            'title' => 'required|string|max:255',
            'color' => 'required|string|max:255',
            'start' => 'required',
            'end' => 'required',


        ], [
            'required' => "Este campo é obrigatório.",

        ]);
        //  Transforma o formato de data para o compatível com o do banco de dados
        $input['start'] = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $input['start'])));
        $input['end'] = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $input['end'])));
        $input['entidade_id'] = Auth::user()->entidade_id;
        Evento::create($input);
        return redirect(route("index"));
    }


    public function updateEventos(Request $request)
    {
        $evento = Evento::Find($request->id);
        if($evento->entidade_id == Auth::user()->entidade_id){
        $evento->title = $request->title;

        $evento->start = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->start)));
        $evento->end = date("Y-m-d H:i:s", strtotime(str_replace('/', '-', $request->end)));

        $evento->color = $request->color;
         $evento->save();
        }
        return redirect(route("index"));
    }
    public function deleteEventos(Request $request)
    {
        $ev = Evento::Find($request->id);
        $ev->destroy();
        return (redirect(route('index')));
    }
}
