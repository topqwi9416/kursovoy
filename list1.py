# settings.py - Подключение к базе данных

DATABASES = {
    'default': {
        'ENGINE': 'django.db.backends.sqlite3',
        'NAME': BASE_DIR / 'db.sqlite3',
    }
}

# Настройки для загрузки шаблонов документов
MEDIA_URL = '/media/'
MEDIA_ROOT = BASE_DIR / 'media'

# Подключённые приложения
INSTALLED_APPS = [
    'django.contrib.admin',
    'django.contrib.auth',
    'django.contrib.contenttypes',
    'django.contrib.sessions',
    'django.contrib.messages',
    'django.contrib.staticfiles',
    'mainMMI',  # Наше приложение
]