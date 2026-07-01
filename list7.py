# views.py - Регистрация пользователей

from django.shortcuts import render, redirect
from django.contrib.auth import login
from django.contrib.auth.models import User
from .models import UserProfile

def register(request):
    if request.method == 'POST':
        username = request.POST.get('username')
        password1 = request.POST.get('password1')
        password2 = request.POST.get('password2')

        errors = []
        if not username:
            errors.append('Введите логин')
        if password1 != password2:
            errors.append('Пароли не совпадают')
        if len(password1) < 8:
            errors.append('Пароль должен быть не менее 8 символов')
        if User.objects.filter(username=username).exists():
            errors.append('Пользователь с таким логином уже существует')

        if errors:
            return render(request, 'register.html', {'errors': errors})

        # Создание пользователя с хэшированием пароля
        user = User.objects.create_user(username=username, password=password1)
        UserProfile.objects.get_or_create(user=user)
        
        login(request, user)
        return redirect('profile')

    return render(request, 'register.html')