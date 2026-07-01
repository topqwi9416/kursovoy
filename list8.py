# views.py - Авторизация пользователей

from django.shortcuts import render, redirect
from django.contrib.auth import authenticate, login

def login_view(request):
    if request.method == 'POST':
        username = request.POST.get('username')
        password = request.POST.get('password')

        user = authenticate(request, username=username, password=password)
        
        if user is not None:
            login(request, user)
            # Создание профиля при необходимости
            if not hasattr(user, 'profile'):
                from .models import UserProfile
                UserProfile.objects.create(user=user)
            return redirect('profile')
        else:
            return render(request, 'login.html', {
                'error': 'Неверный логин или пароль'
            })

    return render(request, 'login.html')