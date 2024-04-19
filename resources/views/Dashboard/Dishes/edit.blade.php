<!-- resources/views/add-work-entry.blade.php -->

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Editar Plato
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('dashboard.dishes.update', $dish->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Nombre -->
                        <div>
                            <x-input-label for="name" :value="__('Nombre del Plato')" />
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$dish->name" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Categoría -->
                        <div class="mt-4">
                            <x-input-label for="category_id" :value="__('Categoría')" />
                            <x-select id="category_id" name="category_id" class="block mt-1 w-full">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if($category->id === $dish->category_id) selected @endif>{{ $category->name }}</option>
                                @endforeach
                            </x-select>
                            <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                        </div>

                        <!-- Descripción -->
                        <div class="mt-4">
                            <x-input-label for="description" :value="__('Descripción')" />
                            <x-text-input id="description" class="block mt-1 w-full" name="description" :value="$dish->description" />
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Ingredients -->
                        <div class="mt-4">
                            <x-input-label for="ingredients" :value="__('Ingredientes')" />
                            <x-text-input id="ingredients" class="block mt-1 w-full" name="ingredients" :value="$dish->ingredients" />
                            <x-input-error :messages="$errors->get('ingredients')" class="mt-2" />
                        </div>

                        <!-- Imagen -->
                        <div class="mt-4">
                            <x-input-label for="image" :value="__('Imagen')" />
                            <x-text-input id="image" class="block mt-1 w-full" type="file" name="image" :value="$dish->image" />
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        <!-- Precio -->
                        <div class="mt-4">
                            <x-input-label for="price" :value="__('Precio')" />
                            <x-text-input id="price" class="block mt-1 w-full" type="number" name="price" :value="$dish->price" step="0.01" required />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        <!-- Disponible -->
                        <div class="mt-4">
                            <x-input-label for="visible" :value="__('Disponible')" />
                            <x-select id="visible" name="visible" class="block mt-1 w-full">
                                <option value="1" {{ old('visible', $dish->visible) == 1 ? 'selected' : '' }}>Sí</option>
                                <option value="0" {{ old('visible', $dish->visible) == 0 ? 'selected' : '' }}>No</option>
                            </x-select>
                            <x-input-error :messages="$errors->get('visible')" class="mt-2" />
                        </div>

                        <!-- Botones -->
                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-3">
                                {{ __('Actualizar') }}
                            </x-primary-button>
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-900 focus:outline-none focus:border-red-900 focus:ring focus:ring-red-300 disabled:opacity-25 transition ml-3">
                                {{ __('Cancelar') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
