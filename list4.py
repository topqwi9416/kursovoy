# settings.py - Настройки сессий для многопользовательского режима

SESSION_ENGINE = 'django.contrib.sessions.backends.db'
SESSION_COOKIE_AGE = 1209600  # 2 недели

# Middleware обеспечивает изоляцию сессий пользователей
MIDDLEWARE = [
    'django.middleware.security.SecurityMiddleware',
    'django.contrib.sessions.middleware.SessionMiddleware',  # Изоляция сессий
    'django.middleware.common.CommonMiddleware',
    'django.middleware.csrf.CsrfViewMiddleware',
    'django.contrib.auth.middleware.AuthenticationMiddleware',  # Привязка к пользователю
    'django.contrib.messages.middleware.MessageMiddleware',
]

# Каждый пользователь видит только свои данные благодаря фильтрации
# в views.py через request.user