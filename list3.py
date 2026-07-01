# admin.py - Админ-панель Django

from django.contrib import admin
from django.utils.html import format_html
from .models import UserProfile, PracticeDocument, DocTemplate

@admin.register(PracticeDocument)
class PracticeDocumentAdmin(admin.ModelAdmin):
    list_display = ('fio', 'get_practice_type', 'group', 'user', 'created_at')
    list_filter = ('practice_type', 'created_at')
    search_fields = ('fio', 'speciality', 'group')

    @admin.display(description='Вид практики')
    def get_practice_type(self, obj):
        colors = {'educational': '#2f81f7', 'production': '#d29922'}
        color = colors.get(obj.practice_type, '#8b949e')
        return format_html(
            '<span style="color:{};font-weight:600">{}</span>',
            color, obj.get_practice_type_display()
        )

@admin.register(DocTemplate)
class DocTemplateAdmin(admin.ModelAdmin):
    list_display = ('template_type', 'uploaded_by', 'uploaded_at')
    
    def save_model(self, request, obj, form, change):
        obj.uploaded_by = request.user
        super().save_model(request, obj, form, change)