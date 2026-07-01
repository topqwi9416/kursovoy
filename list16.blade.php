{{-- resources/views/catalog.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Каталог букетов</h1>

    {{-- Строка поиска --}}
    <form action="{{ route('catalog.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}"
               placeholder="Поиск по названию...">

        {{-- Фильтр по категориям --}}
        <div class="categories">
            <a href="{{ route('catalog.index') }}"
               class="{{ !request('category_id') ? 'active' : '' }}">Все</a>
            @foreach($categories as $cat)
                <a href="{{ route('catalog.index', ['category_id' => $cat->id]) }}"
                   class="{{ request('category_id') == $cat->id ? 'active' : '' }}">
                    {{ $cat->name }}
                </a>
            @endforeach
        </div>
    </form>

    <p>Найдено букетов: {{ $bouquets->count() }}</p>

    {{-- Сетка товаров --}}
    <div class="catalog-grid">
        @foreach($bouquets as $bouquet)
            <div class="card">
                <img src="{{ asset('storage/' . $bouquet->image) }}" alt="">
                <h3>{{ $bouquet->name }}</h3>
                <p>{{ $bouquet->description }}</p>
                <b>{{ number_format($bouquet->price, 0, '.', ' ') }} ₽</b>
            </div>
        @endforeach
    </div>
@endsection


<?php
// CatalogController.php — логика поиска и фильтрации
public function index(Request $request)
{
    $query = Bouquet::where('is_available', true);

    // Поиск по названию и описанию (ilike — регистронезависимый)
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'ilike', "%{$search}%")
              ->orWhere('description', 'ilike', "%{$search}%");
        });
    }

    // Фильтр по категории
    if ($request->filled('category_id')) {
        $query->where('category_id', $request->category_id);
    }

    return view('catalog', [
        'bouquets'   => $query->get(),
        'categories' => Category::all(),
    ]);
}