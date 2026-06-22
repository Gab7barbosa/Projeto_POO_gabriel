<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class FuncionarioController extends Controller
{
    
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('cpf', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role_filter')) {
            $query->where('role', $request->input('role_filter'));
        }

        $funcionarios = $query->orderBy('name', 'asc')->paginate(10)->withQueryString();

        return view('funcionarios.index', compact('funcionarios'));
    }

     
    public function create()
    {
        return view('funcionarios.create');
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|in:admin,funcionario',
            'cpf' => 'required|string|max:255|unique:users,cpf',
            'phone' => 'nullable|string|max:255',
            'active' => 'boolean',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        $validated['active'] = $request->has('active') ? true : false;

        User::create($validated);

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário cadastrado com sucesso!');
    }

    
    public function edit(User $funcionario)
    {
        return view('funcionarios.edit', compact('funcionario'));
    }

    
    public function update(Request $request, User $funcionario)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $funcionario->id,
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
            'role' => 'required|string|in:admin,funcionario',
            'cpf' => 'required|string|max:255|unique:users,cpf,' . $funcionario->id,
            'phone' => 'nullable|string|max:255',
            'active' => 'boolean',
        ]);

        // Security check: prevent self-deactivation or self-demotion
        if ($funcionario->id === auth()->id()) {
            if ($validated['role'] !== 'admin') {
                return redirect()->back()->withErrors(['role' => 'Você não pode revogar seus próprios privilégios de administrador.']);
            }
            if (!$request->has('active')) {
                return redirect()->back()->withErrors(['active' => 'Você não pode desativar sua própria conta.']);
            }
        }

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $validated['active'] = $request->has('active') ? true : false;

        $funcionario->update($validated);

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário atualizado com sucesso!');
    }

    
    public function destroy(User $funcionario)
    {
        // Security check: prevent self-deletion
        if ($funcionario->id === auth()->id()) {
            return redirect()->route('funcionarios.index')->with('error', 'Você não pode excluir sua própria conta.');
        }

        $funcionario->delete();

        return redirect()->route('funcionarios.index')->with('success', 'Funcionário removido com sucesso!');
    }
}
