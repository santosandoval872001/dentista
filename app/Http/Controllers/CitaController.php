<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use Illuminate\Http\Request;

class CitaController extends Controller
{

    public function index()
    {

        $citas = Cita::orderBy('fecha')
            ->orderBy('hora')
            ->get();

        return view('citas.index', compact('citas'));
    }

    public function crear()
    {

        return view('citas.crear');
    }

    public function guardar(Request $request)
    {

        $datos = $request->validate([
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|max:50',
            'email' => 'nullable|email|max:255',
            'fecha' => 'required|date',
            'hora' => 'required',
            'servicio' => 'required|string|max:255',
            'comentarios' => 'nullable|string|max:1000',
        ]);

        Cita::create($datos);

        return redirect()
            ->route('cita.crear')
            ->with('success', 'Tu cita fue solicitada correctamente');
    }

    public function confirmar(Cita $cita)
    {

        $cita->update([
            'estado' => 'confirmado',
        ]);

        return redirect()
            ->route('admin.citas')
            ->with('success', 'La cita fue confirmada correctamente.');
    }

    public function whatsapp(Cita $cita)
    {

        if ($cita->estado !== 'confirmado')
            return redirect()
                ->route('admin.citas')
                ->with('error', 'Primero debes confirmar la cita antes de enviar un mensaje por WhatsApp.');

        $telefono = preg_replace('/\D/', '', $cita->telefono);

        if (strlen($telefono) === 10) {
            $telefono = '52' . $telefono;
        }

        $fecha = \Carbon\Carbon::parse($cita->fecha)
            ->format('d/m/Y');

        $hora = \Carbon\Carbon::parse($cita->hora)
            ->format('h:i A');

        $mensaje = "Hola {$cita->nombre} 👋\n\n\ "
            . "Te confirmamos tu cita dental.\n\n"
            . "🦷 Servicio: {$cita->servicio}\n "
            . "📅 Fecha: {$fecha}\n "
            . "🕐 Hora: {$hora}\n\n "
            . "¡Te esperamos!";

        $url = 'https://wa.me/' . $telefono . '?text=' . urlencode($mensaje);

        return redirect()->away($url);
    }

    public function cancelar(Cita $cita)
    {

        $cita->update([
            'estado' => 'cancelado',
        ]);

        return redirect()
            ->route('admin.citas')
            ->with('success', 'La cita fue cancelada correctamente.');
    }

    public function atender(Cita $cita)
    {

        $cita->update([
            'estado' => 'atendida',
        ]);

        return redirect()
            ->route('admin.citas')
            ->with('success', 'La cita fue marcada como atendida');
    }

    public function eventos()
    {

        $citas = \App\Models\Cita::all();

        $eventos = $citas->map(function ($cita) {
            $colores = [
                'pendiente' => '#ffc107',
                'confirmado' => '#198754',
                'cancelado' => '#dc3545',
                'atendida' => '#0d6efd',
            ];

            return [
                'id' => $cita->id,
                'title' => $cita->nombre . ' - ' . $cita->servicio,
                'start' => $cita->fecha . 'T' . $cita->hora,
                'color' => $colores[$cita->estado] ?? '#6c757d',
                'nombre' => $cita->nombre,
                'servicio' => $cita->servicio,
                'estado' => $cita->estado,
            ];
        });

        return response()->json($eventos);
    }
}
