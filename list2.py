# views.py - Работа с данными профиля

from django.shortcuts import render, redirect
from django.contrib.auth.decorators import login_required
from .models import UserProfile, PracticeDocument

@login_required
def profile_view(request):
    user = request.user
    profile, created = UserProfile.objects.get_or_create(user=user)

    if request.method == 'POST':
        # Обновление данных профиля
        profile.last_name = request.POST.get('last_name', '')
        profile.first_name = request.POST.get('first_name', '')
        profile.middle_name = request.POST.get('middle_name', '')
        profile.phone = request.POST.get('phone', '')
        profile.telegram = request.POST.get('telegram', '')
        profile.birth_date = request.POST.get('birth_date')
        profile.gender = request.POST.get('gender', '')
        profile.inn = request.POST.get('inn', '')
        
        # Обновление данных практики
        PracticeDocument.objects.update_or_create(
            user=user,
            defaults={
                'fio': f"{profile.last_name} {profile.first_name} {profile.middle_name}",
                'speciality': request.POST.get('speciality', ''),
                'group': request.POST.get('group', ''),
                'course': request.POST.get('course', ''),
                'organization': request.POST.get('organization', ''),
                'start_date': request.POST.get('start_date'),
                'end_date': request.POST.get('end_date'),
            }
        )
        
        profile.save()
        return redirect('profile')

    return render(request, 'profile.html', {'profile': profile})