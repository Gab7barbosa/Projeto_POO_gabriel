<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Painel Geral') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- Welcome Alert / Banner -->
            <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 rounded-2xl shadow-xl overflow-hidden text-white relative">
                <div class="absolute inset-0 bg-grid-white/[0.1] bg-[size:20px_20px]" aria-hidden="true"></div>
                <div class="p-8 md:p-10 relative z-10">
                    <h3 class="text-2xl md:text-3xl font-extrabold tracking-tight">Bem-vindo ao Manga Store, {{ Auth::user()->name }}!</h3>
                    <p class="mt-2 text-blue-100 max-w-2xl text-sm md:text-base">Você está logado como <span class="bg-white/20 px-2 py-0.5 rounded font-semibold capitalize">{{ Auth::user()->role }}</span>. Aqui estão os dados mais recentes do inventário da sua loja.</p>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Total Mangas -->
                <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 flex items-center justify-between group">
                    <div class="space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Total de Mangás</p>
                        <h4 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">{{ $totalMangas }}</h4>
                        <a href="{{ route('mangas.index') }}" class="inline-flex items-center text-xs font-semibold text-blue-600 hover:text-blue-500 transition-colors">
                            Ver catálogo &rarr;
                        </a>
                    </div>
                    <div class="p-4 bg-blue-50 dark:bg-blue-950/50 rounded-xl text-blue-600 dark:text-blue-400 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 2: Valor de Inventário -->
                <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 flex items-center justify-between group">
                    <div class="space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Valor do Estoque</p>
                        <h4 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">R$ {{ number_format($totalStockValue, 2, ',', '.') }}</h4>
                        <span class="inline-flex items-center text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                            Inventário total
                        </span>
                    </div>
                    <div class="p-4 bg-emerald-50 dark:bg-emerald-950/50 rounded-xl text-emerald-600 dark:text-emerald-400 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 3: Clientes -->
                <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 flex items-center justify-between group">
                    <div class="space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Clientes Cadastrados</p>
                        <h4 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">{{ $totalClientes }}</h4>
                        <a href="{{ route('clientes.index') }}" class="inline-flex items-center text-xs font-semibold text-indigo-600 hover:text-indigo-500 transition-colors">
                            Gerenciar clientes &rarr;
                        </a>
                    </div>
                    <div class="p-4 bg-indigo-50 dark:bg-indigo-950/50 rounded-xl text-indigo-600 dark:text-indigo-400 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Card 4: Funcionários -->
                <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm hover:shadow-md transition-all duration-300 p-6 flex items-center justify-between group">
                    <div class="space-y-2">
                        <p class="text-xs font-semibold uppercase tracking-wider text-gray-400 dark:text-gray-500">Equipe / Funcionários</p>
                        <h4 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">{{ $totalFuncionarios }}</h4>
                        @if(Auth::user()->isAdmin())
                        <a href="{{ route('funcionarios.index') }}" class="inline-flex items-center text-xs font-semibold text-purple-600 hover:text-purple-500 transition-colors">
                            Gerenciar equipe &rarr;
                        </a>
                        @else
                        <span class="inline-flex items-center text-xs font-semibold text-purple-600/70">
                            Colaboradores ativos
                        </span>
                        @endif
                    </div>
                    <div class="p-4 bg-purple-50 dark:bg-purple-950/50 rounded-xl text-purple-600 dark:text-purple-400 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Alerts / Action list -->
            <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm overflow-hidden">
                <div class="border-b border-gray-100 dark:border-gray-800 p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200">Alertas de Estoque Baixo</h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Mangás com quantidade de estoque crítica (&le; 5 unidades).</p>
                </div>
                <div class="p-6">
                    @if($lowStockMangas->isEmpty())
                        <div class="flex flex-col items-center justify-center py-8 text-center">
                            <div class="p-3 bg-emerald-50 dark:bg-emerald-950/50 rounded-full text-emerald-600 dark:text-emerald-400 mb-3">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-sm font-semibold text-gray-800 dark:text-gray-200">Tudo em ordem!</h4>
                            <p class="text-xs text-gray-400 mt-1 max-w-xs">Nenhum mangá está com estoque crítico no momento.</p>
                        </div>
                    @else
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="text-xs font-semibold text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-800 uppercase">
                                        <th class="pb-3 font-semibold">Mangá</th>
                                        <th class="pb-3 font-semibold">Editora</th>
                                        <th class="pb-3 font-semibold">Preço</th>
                                        <th class="pb-3 font-semibold text-center">Estoque</th>
                                        <th class="pb-3 font-semibold text-right">Ação</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                                    @foreach($lowStockMangas as $manga)
                                        <tr class="text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/20 transition-colors">
                                            <td class="py-4 pr-3 font-semibold flex items-center gap-3">
                                                @if($manga->capa)
                                                    <img src="{{ asset($manga->capa) }}" alt="{{ $manga->titulo }}" class="w-8 h-12 object-cover rounded shadow-sm">
                                                @else
                                                    <div class="w-8 h-12 bg-gray-100 dark:bg-gray-800 rounded flex items-center justify-center text-xs text-gray-400">
                                                        Capa
                                                    </div>
                                                @endif
                                                <div>
                                                    <div class="text-sm font-bold text-gray-800 dark:text-gray-200">{{ $manga->titulo }}</div>
                                                    <div class="text-xs text-gray-400">{{ $manga->autor }}</div>
                                                </div>
                                            </td>
                                            <td class="py-4 px-3 text-gray-500 dark:text-gray-400">{{ $manga->editora }}</td>
                                            <td class="py-4 px-3 font-medium text-gray-800 dark:text-gray-200">R$ {{ number_format($manga->preco, 2, ',', '.') }}</td>
                                            <td class="py-4 px-3 text-center">
                                                @if($manga->estoque == 0)
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-800 dark:bg-red-950/50 dark:text-red-400">
                                                        Sem estoque
                                                    </span>
                                                @else
                                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-800 dark:bg-amber-950/50 dark:text-amber-400">
                                                        {{ $manga->estoque }} unidades
                                                    </span>
                                                @endif
                                            </td>
                                            <td class="py-4 pl-3 text-right">
                                                <a href="{{ route('mangas.edit', $manga) }}" class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-lg text-indigo-700 bg-indigo-50 hover:bg-indigo-100 dark:text-indigo-300 dark:bg-indigo-950/30 dark:hover:bg-indigo-950/60 transition-colors">
                                                    Abastecer
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
