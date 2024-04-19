<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg text-gray-800 leading-tight">
                        Categorías y platos
                    </h3>
                    <div class="flex justify-end mt-3">
                        <x-primary-button onclick="location.href='{{ url('/dashboard/categories/create') }}'">
                            {{ __('Agregar categoría') }}
                        </x-primary-button>
                        <x-primary-button onclick="location.href='{{ url('/dashboard/dishes/create') }}'">
                            {{ __('Agregar plato') }}
                        </x-primary-button>
                    </div>

                    @if ($categories->isNotEmpty())
                        <div class="accordion mt-4" id="accordionExample">
                            <!-- Div contenedor para hacer sortable las categorías -->
                            <div id="categories-list" data-reorder-url="{{ route('dashboard.categories.reorder') }}">
                                @foreach ($categories as $index => $category)
                                    <div class="accordion-item" data-id="{{ $category->id }}">
                                        <h2 class="accordion-header" id="heading{{ $index }}">
                                            <button class="accordion-button {{ $index == 0 ? '' : 'collapsed' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse{{ $index }}"
                                                    aria-expanded="{{ $index == 0 ? 'true' : 'false' }}"
                                                    aria-controls="collapse{{ $index }}">
                                                {{ $category->name }}
                                            </button>
                                        </h2>
                                        <div id="collapse{{ $index }}" class="accordion-collapse collapse {{ $index == 0 ? 'show' : '' }}" aria-labelledby="heading{{ $index }}" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <!-- Platos -->
                                                <ul class="list-disc list-inside">
                                                    @if ($category->dishes->isEmpty())
                                                        <li>No hay platos registrados</li>
                                                    @else
                                                    @foreach ($category->dishes as $dish)
                                                    <li class="flex justify-between items-center">
                                                        <span>{{ $dish->name }} - {{ number_format($dish->price, 2) }}€</span>
                                                        <div class="flex items-center">
                                                            <x-primary-button
                                                                onclick="location.href='{{ route('dashboard.dishes.edit', $dish->id) }}'">
                                                                <i class="fa-solid fa-pen-to-square"></i>
                                                            </x-primary-button>
                                                            <form
                                                                action="{{ route('dashboard.dishes.destroy', $dish->id) }}"
                                                                method="POST" onsubmit="return confirm('¿Estás seguro que quieres eliminar este plato?');">
                                                                @csrf
                                                                @method('DELETE')
                                                                <x-danger-button type="submit">
                                                                    <i class="fa-solid fa-trash"></i>
                                                                </x-danger-button>
                                                            </form>
                                                        </div>
                                                    </li>
                                                @endforeach
                                                    @endif
                                                </ul>
                                                <div class="flex justify-end mt-3">
                                                    <x-primary-button
                                                        onclick="location.href='{{ route('dashboard.categories.edit', $category->id) }}'">
                                                        Editar Categoria
                                                    </x-primary-button>
                                                    <form
                                                        action="{{ route('dashboard.categories.destroy', $category->id) }}"
                                                        method="POST" onsubmit="return confirm('¿Estás seguro que quieres eliminar esta categoría?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <x-danger-button type="submit">
                                                            Eliminar Categoria
                                                        </x-danger-button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <p class="mt-4">No hay categorías registradas</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script src="{{ asset('js/app.js') }}"></script>




