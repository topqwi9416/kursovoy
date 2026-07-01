# views.py - Выход из системы

from django.shortcuts import redirect
from django.contrib.auth import logout
from django.contrib.auth.decorators import login_required

@login_required
def logout_view(request):
    """Завершает текущую сессию пользователя."""
    logout(request)
    return redirect('login')