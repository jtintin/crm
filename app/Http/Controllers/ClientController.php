<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients=Client::where('active', 1)->get();
        return view('clients.index',compact('clients'));
    }
    public function deleted()
    {
        $clients=Client::where('active', 0)->get();
        return view('clients.deleted',compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $datos = $request->validate([
        'name'    => 'required|min:5|max:255',
        'email'   => 'nullable|email|unique:clients,email',
        'phone'   => 'nullable|string|max:20',
        'company' => 'nullable|string|max:255',
        'notes'   => 'nullable|string|max:500',
    ], [
        'name.required' => 'El nombre es requerido',
        'name.min'      => 'El nombre debe tener al menos 5 caracteres',
        'name.max'      => 'El nombre debe tener menos de 255 caracteres',
        'email.email'   => 'El formato de correo no es válido',
        'email.unique'  => 'El correo ya existe',
    ]);

    // Auditoría: este campo no se valida porque no viene del request
    $datos['user_id'] = auth()->id();

    Client::create($datos);

    return redirect()->route('clients.index')->with('success','Cliente registrado');
}

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit',compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
public function update(Request $request, Client $client)
{
    $datos = $request->validate([
        'name'    => 'required|min:5|max:255',
        'email'   => 'nullable|email|unique:clients,email,' . $client->id,
        'phone'   => 'nullable|string|max:20',
        'company' => 'nullable|string|max:255',
        'notes'   => 'nullable|string|max:500',
    ], [
        'name.required' => 'El nombre es requerido',
        'name.min'      => 'El nombre debe tener al menos 5 caracteres',
        'name.max'      => 'El nombre debe tener menos de 255 caracteres',
        'email.email'   => 'El formato de correo no es válido',
        'email.unique'  => 'El correo ya existe',
    ]);

    // Auditoría: registrar quién actualizó
    $datos['user_id'] = auth()->id();

    $client->update($datos);

    return redirect()->route('clients.index')->with('success', 'Cliente actualizado');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->update(['active' => 0]);
        return redirect()->route('clients.index')->with('success','Cliente eliminado');
    }
    public function activate(Client $client)
    {
        $client->update(['active' => 1]);
        return redirect()->route('clients.index')->with('success','Cliente reingresado');
    }
}
