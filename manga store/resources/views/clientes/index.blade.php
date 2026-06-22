<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Clientes') }}
            </h2>
            <a href="{{ route('clientes.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 shadow-lg shadow-indigo-600/30">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"></path>
                </svg>
                Novo Cliente
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

            <!-- Search Panel -->
            <div class="bg-white dark:bg-gray-900 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-800">
                <form action="{{ route('clientes.index') }}" method="GET" class="flex flex-col sm:flex-row gap-4">
                    <div class="flex-1 space-y-1">
                        <label for="search" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Buscar Cliente</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Nome, email, CPF ou telefone..." class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                    </div>
                    <div class="flex items-end gap-2">
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-gray-850 hover:bg-gray-800 dark:bg-indigo-650 dark:hover:bg-indigo-600 border border-gray-200 dark:border-transparent text-sm font-semibold rounded-xl text-white shadow-sm transition-colors cursor-pointer">
                            Pesquisar
                        </button>
                        @if(request()->filled('search'))
                            <a href="{{ route('clientes.index') }}" class="inline-flex items-center justify-center p-2.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-850 dark:hover:bg-gray-800 rounded-xl text-gray-500 transition-colors" title="Limpar pesquisa">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </a>
                        @endif
                    </div>
                </form>
            </div>

            <!-- Customers Table -->
            <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-sm overflow-hidden">
                @if($clientes->isEmpty())
                    <div class="p-12 text-center">
                        <div class="w-16 h-16 bg-gray-50 dark:bg-gray-800 rounded-full flex items-center justify-center text-gray-400 mx-auto mb-4">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-850 dark:text-gray-200">Nenhum cliente cadastrado</h3>
                        <p class="text-sm text-gray-400 mt-1 max-w-sm mx-auto">Nenhum resultado corresponde à sua pesquisa.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-xs font-semibold text-gray-400 dark:text-gray-500 border-b border-gray-100 dark:border-gray-800 uppercase bg-gray-50/50 dark:bg-gray-900/50">
                                    <th class="py-4 px-6 font-semibold">Nome</th>
                                    <th class="py-4 px-6 font-semibold">CPF</th>
                                    <th class="py-4 px-6 font-semibold">Contato</th>
                                    <th class="py-4 px-6 font-semibold">Endereço</th>
                                    <th class="py-4 px-6 font-semibold text-right">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800 text-sm">
                                @foreach($clientes as $cliente)
                                    <tr class="text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800/10 transition-colors">
                                        <td class="py-4 px-6 font-bold text-gray-800 dark:text-gray-200">
                                            {{ $cliente->nome }}
                                        </td>
                                        <td class="py-4 px-6 font-mono text-xs text-gray-550 dark:text-gray-400">
                                            {{ $cliente->cpf }}
                                        </td>
                                        <td class="py-4 px-6 space-y-0.5">
                                            <div class="flex items-center gap-1.5 text-gray-600 dark:text-gray-400">
                                                <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 01-2.25 2.25h-15a2.25 2.25 0 01-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25m19.5 0v.243a2.25 2.25 0 01-1.07 1.916l-7.5 4.615a2.25 2.25 0 01-2.36 0l-7.5-4.615a2.25 2.25 0 01-1.07-1.916V6.75"></path>
                                                </svg>
                                                <span class="text-xs">{{ $cliente->email }}</span>
                                            </div>
                                            @if($cliente->telefone)
                                                <div class="flex items-center gap-1.5 text-gray-550 dark:text-gray-400">
                                                    <svg class="w-4 h-4 opacity-70" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 6.75c0 8.284 6.716 15 15 15h2.25a2.25 2.25 0 002.25-2.25v-1.372c0-.516-.351-.966-.852-1.091l-4.423-1.106c-.44-.11-.902.055-1.173.417l-.97 1.293c-2.824-1.802-5.18-4.156-6.98-6.98l1.293-.97c.363-.271.527-.734.417-1.173L6.963 3.102a1.125 1.125 0 00-1.091-.852H4.5A2.25 2.25 0 002.25 4.5v2.25z"></path>
                                                    </svg>
                                                    <span class="text-xs">{{ $cliente->telefone }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td class="py-4 px-6 text-xs text-gray-500 dark:text-gray-400 max-w-xs truncate" title="{{ $cliente->endereco ?? 'Não informado' }}">
                                            {{ $cliente->endereco ?? 'Não informado' }}
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="{{ route('clientes.edit', $cliente) }}" class="p-2 text-gray-450 hover:text-indigo-650 hover:bg-indigo-50 dark:hover:bg-indigo-950/30 rounded-lg transition-all" title="Editar cliente">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.83 20.013a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"></path>
                                                    </svg>
                                                </a>
                                                
                                                <form action="{{ route('clientes.destroy', $cliente) }}" method="POST" onsubmit="return confirm('Deseja realmente excluir este cliente do sistema?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2 text-gray-450 hover:text-red-650 hover:bg-red-50 dark:hover:bg-red-950/30 rounded-lg transition-all cursor-pointer" title="Remover cliente">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"></path>
                                                        </svg>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="p-6 border-t border-gray-100 dark:border-gray-800">
                        {{ $clientes->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
