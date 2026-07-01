<?php
// AuthController.php — метод login()
public function login(Request $request)
{
    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt([
        'email'    => $request->email,
        'password' => $request->password,
    ])) {
        // Защита от фиксации сессии
        $request->session()->regenerate();
        return redirect('/');
    }

    return back()->withErrors(['email' => 'Неверный email или пароль']);
}