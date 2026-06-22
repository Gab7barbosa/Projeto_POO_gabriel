<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class MangaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Manga::query();

        // Search filter
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('titulo', 'like', "%{$search}%")
                  ->orWhere('autor', 'like', "%{$search}%")
                  ->orWhere('editora', 'like', "%{$search}%");
            });
        }

        // Stock status filter
        if ($request->filled('stock_status')) {
            $status = $request->input('stock_status');
            if ($status === 'out') {
                $query->where('estoque', 0);
            } elseif ($status === 'low') {
                $query->where('estoque', '>', 0)->where('estoque', '<=', 5);
            } elseif ($status === 'ok') {
                $query->where('estoque', '>', 5);
            }
        }

        // Ordering
        $sortBy = $request->input('sort_by', 'created_at');
        $sortOrder = $request->input('sort_order', 'desc');
        
        $allowedSorts = ['titulo', 'preco', 'estoque', 'created_at'];
        if (in_array($sortBy, $allowedSorts)) {
            $query->orderBy($sortBy, $sortOrder === 'asc' ? 'asc' : 'desc');
        } else {
            $query->orderBy('created_at', 'desc');
        }

        $mangas = $query->paginate(8)->withQueryString();

        return view('mangas.index', compact('mangas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('mangas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
            'sinopse' => 'nullable|string',
            'capa' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('capa')) {
            $image = $request->file('capa');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            // Create upload folder if not exists
            $destinationPath = public_path('uploads/mangas');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $fileName);
            $validated['capa'] = 'uploads/mangas/' . $fileName;
        }

        Manga::create($validated);

        return redirect()->route('mangas.index')->with('success', 'Mangá cadastrado com sucesso!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manga $manga)
    {
        return view('mangas.edit', compact('manga'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manga $manga)
    {
        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'editora' => 'required|string|max:255',
            'preco' => 'required|numeric|min:0',
            'estoque' => 'required|integer|min:0',
            'sinopse' => 'nullable|string',
            'capa' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('capa')) {
            // Delete old file if exists
            if ($manga->capa && File::exists(public_path($manga->capa))) {
                File::delete(public_path($manga->capa));
            }

            $image = $request->file('capa');
            $fileName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            
            $destinationPath = public_path('uploads/mangas');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }
            
            $image->move($destinationPath, $fileName);
            $validated['capa'] = 'uploads/mangas/' . $fileName;
        }

        $manga->update($validated);

        return redirect()->route('mangas.index')->with('success', 'Mangá atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manga $manga)
    {
        // Delete image file if exists
        if ($manga->capa && File::exists(public_path($manga->capa))) {
            File::delete(public_path($manga->capa));
        }

        $manga->delete();

        return redirect()->route('mangas.index')->with('success', 'Mangá removido com sucesso!');
    }
}
