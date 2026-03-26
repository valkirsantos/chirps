<?php

namespace App\Http\Controllers;
use App\Models\Chirp;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ChirpController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $chirps = Chirp::with('user') //Chirp::all();
        ->latest()//ordem de lançamento
        ->take(50)//queremos pegar 50 deles
        ->get();//E então vamos ouvir aqueles chilreios.
            
            return view('home', ['chirps' => $chirps]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Valide a solicitação
        $validated = $request->validate([
            'message' => 'required|string|max:255',
        ], [
            'message.required' => 'Por favor, escreva algo para gorjear!',
            'message.max' => 'Os chilreios devem ter 255 caracteres ou menos.',
        ]);
        
        /*
        // Crie o chirp (nenhum usuário por enquanto - adicionaremos autenticação mais tarde)
        \App\Models\Chirp::create([
            'message' => $validated['message'],
            'user_id' => null, // Adicionaremos autenticação na lição 11
        ]);
        */

        // Use the authenticated user
        auth()->user()->chirps()->create($validated);

        
        // Redirecionar de volta para o feed
        return redirect('/')->with('success', 'Chirp criado!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chirp $chirp) { 
        
        $this->authorize('update', $chirp);

        return view('chirps.edit', compact('chirp'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Chirp $chirp) { 
        $this->authorize('update', $chirp);
        
        $validated = $request->validate([
            'message' => 'required|string|max:255',
       ]);
       
       $chirp->update($validated);
    
       return redirect('/')->with('success', 'Chirp updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp) { 

        $this->authorize('delete', $chirp);

        $chirp->delete();

        return redirect('/')->with('success', 'Chirp deleted!');
    }
}


