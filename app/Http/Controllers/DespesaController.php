<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDespesaRequest;
use App\Http\Requests\UpdateDespesaRequest;
use App\Http\Resources\DespesaResource;
use App\Models\Despesa;
use Illuminate\Support\Facades\Notification;
use App\Notifications\DespesaCadastrada;
use Illuminate\Http\Request;

class DespesaController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $despesas = Despesa::where('user_id', $user->id)->get();

        return DespesaResource::collection($despesas);
    }

    public function store(StoreDespesaRequest $request)
    {
        $user = auth()->user();

        $despesa = new Despesa($request->validated());
        $despesa->user_id = $user->id;
        $despesa->save();

        // Notification::send($user, new DespesaCadastrada($despesa));

        return new DespesaResource($despesa);
    }

    public function show($id)
    {
        $despesa = Despesa::findOrFail($id);
        $this->authorize('view', $despesa);

        return new DespesaResource($despesa);
    }

    public function update(UpdateDespesaRequest $request, $id)
    {
        $despesa = Despesa::findOrFail($id);
        $this->authorize('update', $despesa);

        $despesa->update($request->validated());

        return new DespesaResource($despesa);
    }

    public function destroy($id)
    {
        $despesa = Despesa::findOrFail($id);
        $this->authorize('delete', $despesa);

        $despesa->delete();

        return response()->json(['message' => 'Despesa deletada com sucesso']);
    }
}
