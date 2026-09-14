<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
</head>
<body style="font-family: sans-serif; font-size: 14px; color: #1f2937;">
    <h2 style="margin-bottom: 4px;">Новый лид</h2>
    <p style="margin: 4px 0;"><strong>Имя:</strong> {{ $lead->name ?? '—' }}</p>
    <p style="margin: 4px 0;"><strong>Телефон:</strong> {{ $lead->phone ?? '—' }}</p>
    <p style="margin: 4px 0;"><strong>Комментарий:</strong> {{ $lead->comment ?? '—' }}</p>
    <p style="margin: 4px 0;"><strong>Источник:</strong> {{ $lead->leadable_type ?? '—' }}</p>
</body>
</html>
