<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Controle de Funcionários / Equipe') }}
            </h2>
            <a href="{{ route('funcionarios.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-lg shadow-indigo-600/30">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z"></path>
                </svg>
                Novo Funcionário
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-emerald-50 border border-emerald-200 dark:bg-emerald-950/20 dark:border-emerald-900 text-emerald-800 dark:text-emerald-300 p-4 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="text-sm font-semibold">{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border border-red-200 dark:bg-red-950/20 dark:border-red-900 text-red-800 dark:text-red-300 p-4 rounded-xl flex items-center gap-3 shadow-sm">
                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                    </svg>
                    <span class="text-sm font-semibold">{{ session('error') }}</span>
                </div>
            @endif

            <!-- Search and Filter Panel -->
            <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800">
                <form action="{{ route('funcionarios.index') }}" method="GET" class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label for="search" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Buscar Colaborador</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Nome, email ou CPF..." class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                    </div>
                    
                    <div class="space-y-1">
                        <label for="role_filter" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Cargo / Função</label>
                        <select id="role_filter" name="role_filter" class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            <option value="">Todos</option>
                            <option value="admin" {{ request('role_filter') === 'admin' ? 'selected' : '' }}>Administrador</option>
                            <option value="funcionario" {{ request('role_filter') === 'funcionario' ? 'selected' : '' }}>Funcionário</option>
                        </select>
                    </div>

                    <div class="flex items-end gap-2">
                        <button type="submit" class="flex-1 inline-flex items-center justify-center px-6 py-2.5 bg-gray-850 hover:bg-gray-800 dark:bg-indigo-650 dark:hover:bg-indigo-600 border border-gray-200 dark:border-transparent text-sm font-semibold rounded-xl text-white shadow-sm transition-colors cursor-pointer">
                            Filtrar
                        </button>
                        @if(request()->anyFilled(['search', 'role_filter']))
                            <a href="{{ route('funcionarios.index') }}" class="inline-flex items-center justify-center p-2.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-850 dark:hover:bg-gray-800 rounded-xl text-gray-500 transition-colors" title="Limpar filtros">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Table of Employees -->
            <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm overflow-hidden">
                @if($funcionarios->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-850 dark:text-gray-200">Nenhum funcionário encontrado</h3>
                        <p class="text-sm text-gray-400 mt-1 max-w-sm mx-auto">Tente ajustar seus termos de pesquisa.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-xs font-semibold text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-800 uppercase bg-gray-50/50 dark:bg-gray-900/50">
                                    <th class="py-4 px-6 font-semibold">Funcionário</th>
                                    <th class="py-4 px-6 font-semibold">CPF</th>
                                    <th class="py-4 px-6 font-semibold">Função</th>
                                    <th class="py-4 px-6 font-semibold">Status de Acesso</th>
                                    <th class="py-4 px-6 font-semibold text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                                @foreach($funcionarios as $funcionario)
                                    <tr class="text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/10 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-xl bg-indigo-50 dark:bg-indigo-950 flex items-center justify-center font-bold text-indigo-650 dark:text-indigo-400">
                                                    {{ strtoupper(substr($funcionario->name, 0, 2)) }}
                                                </div>
                                                <div>
                                                    <div class="font-bold text-gray-850 dark:text-gray-200 flex items-center gap-1.5">
                                                        {{ $funcionario->name }}
                                                        @if($funcionario->id === auth()->id())
                                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-800 dark:bg-gray-800 dark:text-gray-300">
                                                                Você
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="text-xs text-gray-400">{{ $funcionario->email }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6 font-mono text-xs text-gray-550 dark:text-gray-400">
                                            {{ $funcionario->cpf ?? 'Não cadastrado' }}
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($funcionario->role === 'admin')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-100 text-purple-800 dark:bg-purple-950/50 dark:text-purple-400">
                                                    Administrador
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-blue-100 text-blue-800 dark:bg-blue-950/50 dark:text-blue-400">
                                                    Funcionário
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6">
                                            @if($funcionario->active)
                                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-emerald-600 dark:text-emerald-400">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-emerald-600 dark:bg-emerald-400"></span>
                                                    Ativo / Liberado
                                                </span>
                                            @else
                                                <span class="inline-flex items-center gap-1 text-xs font-semibold text-red-550 dark:text-red-400">
                                                    <span class="w-1.5 h-1.5 rounded-full bg-red-550 dark:bg-red-400"></span>
                                                    Inativo / Bloqueado
                                                </span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('funcionarios.edit', $funcionario) }}" class="p-2 text-gray-450 hover:text-indigo-650 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 rounded-lg transition-all" title="Editar funcionário">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.83 20.013a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                                    </svg>
                                                </a>
                                                
                                                @if($funcionario->id !== auth()->id())
                                                    <form action="{{ route('funcionarios.destroy', $funcionario) }}" method="POST" onsubmit="return confirm('Deseja realmente remover este funcionário?')" class="inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="p-2 text-gray-450 hover:text-red-650 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-lg transition-all cursor-pointer" title="Remover colaborador">
                                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                                <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @else
                                                    <span class="p-2 text-gray-300 dark:text-gray-700 cursor-not-allowed" title="Você não pode excluir sua própria conta">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 10-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 002.25-2.25v-6.75a2.25 2.25 0 00-2.25-2.25H6.75a2.25 2.25 0 00-2.25 2.25v6.75a2.25 2.25 0 002.25 2.25z"></path>
                                                        </svg>
                                                    </span>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-6 border-t border-gray-100 dark:border-gray-800">
                        {{ $funcionarios->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
