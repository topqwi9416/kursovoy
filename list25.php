<?php
// AuthController.php — хэширование пароля при регистрации

use Illuminate\Support\Facades\Hash;

// Пароль НЕ сохраняется в открытом виде
$user = User::create([
    'name'     => $request->name,
    'email'    => $request->email,
    'password' => Hash::make($request->password), // bcrypt
]);

// Hash::make() использует алгоритм bcrypt (по умолчанию в Laravel)
// с автоматической генерацией соли и 12 раундами хэширования.
// В БД хранится только хэш вида: $2y$12$ABC...XYZ