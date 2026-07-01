<?php
// routes/web.php — административные маршруты защищены автоматически

// Filament регистрирует все маршруты /admin/* внутри себя
// и применяет к ним собственный middleware Authenticate.

// Попытка открыть /admin/bouquets без входа в Filament
// → перенаправление на /admin/login

// Обычный покупатель, авторизованный через AuthController,
// НЕ имеет доступа к /admin — требуется отдельная
// аутентификация через make:filament-user