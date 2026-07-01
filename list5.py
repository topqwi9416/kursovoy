# views.py - Генерация и скачивание документов

from django.http import HttpResponse
from django.contrib.auth.decorators import login_required
from .models import PracticeDocument, CharacteristicDocument
from .docx_generator import generate_attestat, generate_harakteristika

@login_required
def download_document(request, doc_id, doc_type):
    """Генерирует DOCX файл на основе шаблона и данных пользователя."""
    if doc_type == 'attestat':
        doc_obj = PracticeDocument.objects.get(id=doc_id, user=request.user)
        file_obj = generate_attestat(doc_obj)
        filename = f"Attestat_{doc_obj.fio}.docx"
    elif doc_type == 'harakteristika':
        doc_obj = CharacteristicDocument.objects.get(id=doc_id, user=request.user)
        file_obj = generate_harakteristika(doc_obj)
        filename = f"Harakteristika_{doc_obj.fio}.docx"

    response = HttpResponse(
        file_obj.read(),
        content_type='application/vnd.openxmlformats-officedocument.wordprocessingml.document'
    )
    response['Content-Disposition'] = f'attachment; filename="{filename}"'
    return response