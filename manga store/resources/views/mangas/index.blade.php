<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Catálogo de Mangás') }}
            </h2>
            <a href="{{ route('mangas.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-lg shadow-indigo-600/30">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
                Novo Mangá
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Message -->
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 dark:bg-emerald-950/20 dark:border-emerald-900 text-emerald-800 dark:text-emerald-300 p-4 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Search and Filter Panel -->
            <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800">
                <form action="{{ route('mangas.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                    <!-- Search input -->
                    <div class="lg:col-span-2 space-y-1">
                        <label for="search" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Buscar</label>
                        <div class="relative">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Título, autor, editora..." class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                        </div>
                    </div>

                    <!-- Stock Status filter -->
                    <div class="space-y-1">
                        <label for="stock_status" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Estoque</label>
                        <select id="stock_status" name="stock_status" class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            <option value="">Todos</option>
                            <option value="ok" {{ request('stock_status') === 'ok' ? 'selected' : '' }}>Disponível (&gt;5)</option>
                            <option value="low" {{ request('stock_status') === 'low' ? 'selected' : '' }}>Estoque Baixo (&le;5)</option>
                            <option value="out" {{ request('stock_status') === 'out' ? 'selected' : '' }}>Sem estoque (0)</option>
                        </select>
                    </div>

                    <!-- Sort options -->
                    <div class="space-y-1">
                        <label for="sort_by" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Ordenar por</label>
                        <select id="sort_by" name="sort_by" class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            <option value="created_at" {{ request('sort_by') === 'created_at' ? 'selected' : '' }}>Recém adicionados</option>
                            <option value="titulo" {{ request('sort_by') === 'titulo' ? 'selected' : '' }}>Título</option>
                            <option value="preco" {{ request('sort_by') === 'preco' ? 'selected' : '' }}>Preço</option>
                            <option value="estoque" {{ request('sort_by') === 'estoque' ? 'selected' : '' }}>Estoque</option>
                        </select>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex items-end gap-2">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center px-4 py-2.5 bg-gray-850 hover:bg-gray-800 dark:bg-indigo-650 dark:hover:bg-indigo-600 border border-gray-200 dark:border-transparent text-sm font-semibold rounded-xl text-white shadow-sm transition-colors cursor-pointer">
                            Filtrar
                        </button>
                        @if(request()->anyFilled(['search', 'stock_status', 'sort_by']))
                            <a href="{{ route('mangas.index') }}" class="inline-flex items-center justify-center p-2.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-850 dark:hover:bg-gray-800 rounded-xl text-gray-500 transition-colors" title="Limpar filtros">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Manga Grid -->
            @if($mangas->isEmpty())
                <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl p-12 text-center shadow-sm">
                    <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-850 dark:text-gray-200">Nenhum mangá encontrado</h3>
                    <p class="text-sm text-gray-400 mt-1 max-w-sm mx-auto">Tente ajustar seus termos de busca ou filtros de estoque.</p>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach($mangas as $manga)
                        <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl overflow-hidden shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 flex flex-col justify-between group">
                            
                            <!-- Header Info & Cover Image -->
                            <div>
                                <div class="relative bg-gray-100 dark:bg-gray-950 aspect-[3/4] overflow-hidden">
                                    @if($manga->capa)
                                        <img src="{{ asset($manga->capa) }}" alt="{{ $manga->titulo }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex flex-col items-center justify-center p-6 text-center text-gray-400 bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-950">
                                            <svg class="w-10 h-10 mb-2 opacity-50" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                                            </svg>
                                            <span class="text-xs font-semibold uppercase tracking-wider">Sem Capa</span>
                                        </div>
                                    @endif

                                    <!-- Stock Badge Over Cover -->
                                    <div class="absolute top-3 left-3">
                                        @if($manga->estoque == 0)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-red-650 text-white shadow-md">
                                                Sem estoque
                                            </span>
                                        @elseif($manga->estoque <= 5)
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-amber-550 text-white shadow-md">
                                                Baixo estoque ({{ $manga->estoque }})
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-emerald-600 text-white shadow-md">
                                                Estoque: {{ $manga->estoque }}
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="p-5 space-y-2">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-gray-400 bg-gray-100 dark:bg-gray-800 px-2 py-0.5 rounded">
                                        {{ $manga->editora }}
                                    </span>
                                    <h3 class="font-bold text-gray-850 dark:text-gray-150 line-clamp-1 group-hover:text-indigo-600 transition-colors" title="{{ $manga->titulo }}">
                                        {{ $manga->titulo }}
                                    </h3>
                                    <p class="text-xs text-gray-450 dark:text-gray-400 line-clamp-1">
                                        {{ $manga->autor }}
                                    </p>
                                    @if($manga->sinopse)
                                        <p class="text-xs text-gray-400 dark:text-gray-500 line-clamp-2 mt-2 leading-relaxed italic">
                                            "{{ $manga->sinopse }}"
                                        </p>
                                    @endif
                                </div>
                            </div>

                            <!-- Footer actions -->
                            <div class="p-5 pt-0 border-t border-gray-50 dark:border-gray-800/50 mt-4 flex items-center justify-between">
                                <span class="text-lg font-extrabold text-gray-800 dark:text-gray-150">
                                    R$ {{ number_format($manga->preco, 2, ',', '.') }}
                                </span>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('mangas.edit', $manga) }}" class="p-2 text-gray-450 hover:text-indigo-650 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 rounded-lg transition-all" title="Editar mangá">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.83 20.013a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                        </svg>
                                    </a>
                                    
                                    <form action="{{ route('mangas.destroy', $manga) }}" method="POST" onsubmit="return confirm('Deseja realmente remover este mangá do catálogo?')" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-450 hover:text-red-650 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-lg transition-all cursor-pointer" title="Remover mangá">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $mangas->links() }}
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
