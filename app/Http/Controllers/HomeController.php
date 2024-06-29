<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Cotizaciones;

class HomeController extends Controller
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
    public function index()
    {

        $patientsCount = Patient::count();

        // Obtener la cantidad de cotizaciones
        $quotationsCount = Cotizaciones::count();

        return view('home', [
            'patientsCount' => $patientsCount,
            'quotationsCount' => $quotationsCount,
        ]);
    }
}
