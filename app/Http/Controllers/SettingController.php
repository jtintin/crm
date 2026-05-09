<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
public function index()
{
    // Obtiene todos los registros de la tabla settings
    // y los convierte en un arreglo asociativo ['key' => 'value']
    $settings = Setting::all()->pluck('value','key')->toArray();

    // Envía el arreglo a la vista settings.index
    return view('settings.index', compact('settings'));
}
public function store(Request $request)
{
    // Valida los campos del formulario
    $request->validate([
        'name'=>'nullable|string|max:255',
        'phone'=>'nullable|string|max:255',
        'logo'=>'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        'mail_host'=>'nullable|string|max:255',
        'mail_port'=>'nullable|string|max:255',
        'mail_username'=>'nullable|string|max:255',
        'mail_password'=>'nullable|string|max:255',
        'mail_encryption'=>'nullable|string|max:255'
    ]);

    // Excluye el token y el logo del arreglo
    $data = $request->except(['_token','logo']);

    // Recorre cada campo y lo guarda con tu modelo Setting
    foreach ($data as $key => $value) {
        if($key=== 'mail_password' && !empty($value)){
            $value=encrypt($value);
        }elseif($key=== 'mail_password' && empty($value)){
            continue;
        }
        Setting::setValue($key, $value);
    }

    // Si se sube un logo, lo guarda en storage/app/public/images
    if ($request->hasFile('logo')) {
        $path = $request->file('logo')->store('images', 'public');
        Setting::setValue('logo', $path);
    }

    // Redirige con mensaje de éxito
    return redirect()->back()->with('success', 'Configuración guardada correctamente');
}
}
