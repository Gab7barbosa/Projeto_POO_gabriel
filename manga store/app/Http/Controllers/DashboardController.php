<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use App\Models\Cliente;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    
    public function index()
    {
        $totalMangas = Manga::count();
        
        
        $totalStockValue = Manga::all()->sum(function ($manga) {
            return $manga->preco * $manga->estoque;
        });

        $totalClientes = Cliente::count();
        $totalFuncionarios = User::where('role', 'funcionario')->count();

        
        $lowStockMangas = Manga::where('estoque', '<=', 5)
            ->orderBy('estoque', 'asc')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'totalMangas',
            'totalStockValue',
            'totalClientes',
            'totalFuncionarios',
            'lowStockMangas'
        ));
    }
}
