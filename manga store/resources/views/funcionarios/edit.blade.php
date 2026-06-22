<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('funcionarios.index') }}" class="inline-flex items-center justify-center p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors shadow-sm" title="Voltar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Funcionário') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-xl overflow-hidden">
                
                <div class="p-8 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-gray-200">Editar Cadastro: {{ $funcionario->name }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Modifique as informações de perfil e permissões conforme necessário.</p>
                </div>

                <!-- Self-Editing Warning Alert -->
                @if($funcionario->id === auth()->id())
                    <div class="mx-8 mt-6 bg-amber-50 dark:bg-amber-950/20 border border-amber-250 dark:border-amber-900 text-amber-850 dark:text-amber-300 p-4 rounded-xl text-sm flex gap-3">
                        <svg class="w-5 h-5 text-amber-550 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                        </svg>
                        <div>
                            <span class="font-bold">Observação de Segurança:</span> Você está editando seu próprio usuário. Por questões de segurança, você não poderá alterar seu nível de permissão (Administrador) nem desativar sua conta.
                        </div>
                    </div>
                @endif

                <form action="{{ route('funcionarios.update', $funcionario) }}" method="POST" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nome -->
                        <div class="space-y-1">
                            <label for="name" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Nome Completo <span class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name', $funcionario->name) }}" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('name')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-1">
                            <label for="email" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Email de Acesso <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email', $funcionario->email) }}" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('email')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- CPF -->
                        <div class="space-y-1">
                            <label for="cpf" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">CPF <span class="text-red-500">*</span></label>
                            <input type="text" id="cpf" name="cpf" value="{{ old('cpf', $funcionario->cpf) }}" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('cpf')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Telefone -->
                        <div class="space-y-1">
                            <label for="phone" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Telefone</label>
                            <input type="text" id="phone" name="phone" value="{{ old('phone', $funcionario->phone) }}" class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('phone')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Cargo / Função -->
                        <div class="space-y-1">
                            <label for="role" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Nível de Permissão <span class="text-red-500">*</span></label>
                            @if($funcionario->id === auth()->id())
                                <input type="hidden" name="role" value="admin">
                                <select id="role" name="role_disabled" disabled class="w-full bg-gray-100 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm cursor-not-allowed dark:text-gray-500">
                                    <option value="admin" selected>Administrador (Acesso total - Bloqueado)</option>
                                </select>
                            @else
                                <select id="role" name="role" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                                    <option value="funcionario" {{ old('role', $funcionario->role) === 'funcionario' ? 'selected' : '' }}>Funcionário (Acesso ao estoque e clientes)</option>
                                    <option value="admin" {{ old('role', $funcionario->role) === 'admin' ? 'selected' : '' }}>Administrador (Acesso total)</option>
                                </select>
                            @endif
                            @error('role')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ativo -->
                        <div class="flex items-center pt-6 pl-2">
                            <label class="inline-flex items-center cursor-pointer">
                                @if($funcionario->id === auth()->id())
                                    <input type="hidden" name="active" value="1">
                                    <input type="checkbox" id="active" name="active_disabled" checked disabled class="rounded border-gray-300 text-indigo-650 opacity-50 cursor-not-allowed">
                                @else
                                    <input type="checkbox" id="active" name="active" value="1" {{ old('active', $funcionario->active) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-650 shadow-sm focus:ring-indigo-500">
                                @endif
                                <span class="ms-2 text-sm font-semibold text-gray-700 dark:text-gray-300">Conta Ativa e Liberada</span>
                            </label>
                            @error('active')
                                <p class="text-xs text-red-550 mt-1 ml-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Password Section Alert -->
                    <div class="pt-6 border-t border-gray-100 dark:border-gray-800">
                        <h4 class="font-bold text-sm text-gray-700 dark:text-gray-300">Alterar Senha de Acesso</h4>
                        <p class="text-xs text-gray-400 mt-1">Deixe estes campos em branco caso não queira alterar a senha atual do colaborador.</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Senha -->
                        <div class="space-y-1">
                            <label for="password" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Nova Senha</label>
                            <input type="password" id="password" name="password" class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('password')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirmar Senha -->
                        <div class="space-y-1">
                            <label for="password_confirmation" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Confirmar Nova Senha</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                        </div>
                    </div>

                    <!-- Buttons -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-end gap-3">
                        <a href="{{ route('funcionarios.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-xl font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-800 transition shadow-sm">
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
