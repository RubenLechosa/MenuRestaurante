<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Restaurante Nombre</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Estilos personalizados -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container py-4">
        <h2 class="text-center fw-bold mb-4">Menú del Restaurante</h2>
        @foreach($categories as $category)
        @if ($category->dishes->isEmpty())
            @continue
        @endif
            <div class="menu-category mb-5">
                <h3 class="menu-category-title">{{ $category->name }}</h3>
                <ul class="list-group">
                    @foreach($category->dishes as $dish)
                        <li class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex align-items-center">
                                    <img src="{{ Storage::url($dish->image) }}" alt="{{ $dish->name }}" class="menu-item-image rounded-circle me-2">
                                    <div>
                                        <div class="menu-item-name">{{ $dish->name }}</div>
                                        <div class="menu-item-ingredients">{{ $dish->ingredients }}</div>
                                    </div>
                                </div>
                                <div class="menu-item-price d-flex align-items-center">
                                    <span class="menu-item-dots flex-fill"></span>
                                    {{ number_format($dish->price, 2) }}€
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endforeach
    </div>
    <!-- Bootstrap Bundle con Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
