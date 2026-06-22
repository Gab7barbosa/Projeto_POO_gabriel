<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('mangas.index') }}" class="inline-flex items-center justify-center p-2 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-xl text-gray-500 hover:text-gray-700 dark:hover:text-gray-300 transition-colors shadow-sm" title="Voltar">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18"></path>
                </svg>
            </a>
            <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Editar Mangá') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 dark:bg-gray-950 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-900 border border-gray-100 dark:border-gray-800 rounded-2xl shadow-xl overflow-hidden">
                
                <div class="p-8 border-b border-gray-100 dark:border-gray-800 bg-gray-50/50 dark:bg-gray-900/50">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-gray-200">Editar Informações: {{ $manga->titulo }}</h3>
                    <p class="text-xs text-gray-400 mt-1">Atualize as informações do mangá conforme necessário.</p>
                </div>

                <form action="{{ route('mangas.update', $manga) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Título -->
                        <div class="md:col-span-2 space-y-1">
                            <label for="titulo" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Título <span class="text-red-500">*</span></label>
                            <input type="text" id="titulo" name="titulo" value="{{ old('titulo', $manga->titulo) }}" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('titulo')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Autor -->
                        <div class="space-y-1">
                            <label for="autor" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Autor <span class="text-red-500">*</span></label>
                            <input type="text" id="autor" name="autor" value="{{ old('autor', $manga->autor) }}" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('autor')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Editora -->
                        <div class="space-y-1">
                            <label for="editora" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Editora <span class="text-red-500">*</span></label>
                            <input type="text" id="editora" name="editora" value="{{ old('editora', $manga->editora) }}" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('editora')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Preço -->
                        <div class="space-y-1">
                            <label for="preco" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Preço (R$) <span class="text-red-500">*</span></label>
                            <input type="number" id="preco" name="preco" value="{{ old('preco', $manga->preco) }}" step="0.01" min="0" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('preco')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estoque -->
                        <div class="space-y-1">
                            <label for="estoque" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Estoque <span class="text-red-500">*</span></label>
                            <input type="number" id="estoque" name="estoque" value="{{ old('estoque', $manga->estoque) }}" min="0" required class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300">
                            @error('estoque')
                                <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Sinopse -->
                    <div class="space-y-1">
                        <label for="sinopse" class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Sinopse</label>
                        <textarea id="sinopse" name="sinopse" rows="4" class="w-full bg-gray-50 dark:bg-gray-800 border-gray-200 dark:border-gray-700 rounded-xl shadow-sm text-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500/20 dark:text-gray-300" placeholder="Escreva uma breve sinopse do mangá...">{{ old('sinopse', $manga->sinopse) }}</textarea>
                        @error('sinopse')
                            <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Capa (Imagem) -->
                    <div class="space-y-3">
                        <label class="text-xs font-bold text-gray-500 dark:text-gray-400 uppercase">Capa do Mangá</label>
                        
                        @if($manga->capa)
                            <div class="flex items-center gap-4 p-4 bg-gray-50 dark:bg-gray-800/30 rounded-xl border border-gray-150 dark:border-gray-850">
                                <img src="{{ asset($manga->capa) }}" alt="{{ $manga->titulo }}" class="w-16 h-24 object-cover rounded-lg shadow-md border border-gray-200 dark:border-gray-800">
                                <div>
                                    <p class="text-sm font-semibold text-gray-700 dark:text-gray-300">Imagem de Capa Atual</p>
                                    <p class="text-xs text-gray-400">Se você carregar um novo arquivo, a imagem atual será substituída.</p>
                                </div>
                            </div>
                        @endif

                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 dark:border-gray-800 border-dashed rounded-xl">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                    <label for="capa" class="relative cursor-pointer bg-white dark:bg-gray-900 rounded-md font-semibold text-indigo-650 hover:text-indigo-550 focus-within:outline-none">
                                        <span>Carregar um novo arquivo</span>
                                        <input id="capa" name="capa" type="file" class="sr-only" accept="image/*">
                                    </label>
                                </div>
                                <p class="text-xs text-gray-400">PNG, JPG, JPEG ou WEBP até 2MB</p>
                            </div>
                        </div>
                        @error('capa')
                            <p class="text-xs text-red-550 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="pt-4 border-t border-gray-100 dark:border-gray-800 flex items-center justify-end gap-3">
                        <a href="{{ route('mangas.index') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 dark:border-gray-700 rounded-xl font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest hover:bg-gray-50 dark:hover:bg-gray-800 transition shadow-sm">
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
