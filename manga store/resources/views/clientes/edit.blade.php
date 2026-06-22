<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('clientes.index') }}" class="inline-flex items-center justify-center p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors shadow-sm" title="Voltar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Cliente') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-xl overflow-hidden">
                
                <div class="p-8 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-gray-200">Editar Cadastro: {{ $cliente->nome }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Atualize as informações de cadastro do cliente.</p>
                </div>

                <form action="{{ route('clientes.update', $cliente) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nome -->
                        <div class="md:col-span-2 space-y-1">
                            <label for="nome" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Nome Completo <span class="text-red-500">*</span></label>
                            <input type="text" id="nome" name="nome" value="{{ old('nome', $cliente->nome) }}" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('nome')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label for="email" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Email <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', $cliente->email) }}" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('email')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CPF -->
                        <div class="space-y-1">
                            <label for="cpf" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">CPF <span class="text-red-500">*</span></label>
                            <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $cliente->cpf) }}" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('cpf')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telefone -->
                        <div class="md:col-span-2 space-y-1">
                            <label for="telefone" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Telefone</label>
                            <input type="text" id="telefone" name="telefone" value="{{ old('telefone', $cliente->telefone) }}" class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('telefone')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Endereço -->
                    <div class="space-y-1">
                        <label for="endereco" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Endereço Residencial</label>
                        <textarea id="endereco" name="endereco" rows="3" class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">{{ old('endereco', $cliente->endereco) }}</textarea>
                        @error('endereco')
                            <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-end gap-3">
                        <a href="{{ route('clientes.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-xl font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-800 transition shadow-sm">
                            Cancelar
                        </a>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500 active:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition shadow-lg shadow-indigo-600/30 cursor-pointer">
                            Salvar Alterações
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
