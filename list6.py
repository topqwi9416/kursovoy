# docx_generator.py - Обработка текста (форматирование дат)

def _month_name(month_num):
    """Переводит номер месяца в название на русском языке."""
    months = [
        '', 'января', 'февраля', 'марта', 'апреля', 'мая', 'июня',
        'июля', 'августа', 'сентября', 'октября', 'ноября', 'декабря'
    ]
    try:
        return months[int(month_num)]
    except (ValueError, IndexError):
        return str(month_num)

def _practice_type_ru(practice_type):
    """Преобразует код типа практики в русское название."""
    mapping = {
        'educational': 'учебную',
        'production': 'производственную',
        'prediploma': 'преддипломную'
    }
    return mapping.get(practice_type, practice_type)