@php
    $siteHost = 'service.ufamasters.ru';
@endphp

<div style="width:230px;font-family:inherit;background:#fff;border-radius:12px;box-shadow:0 4px 20px rgba(0,0,0,.15);padding:14px;box-sizing:border-box;">
    <button type="button" @click="open = false"
        style="position:absolute;top:8px;right:8px;width:20px;height:20px;border:0;background:transparent;cursor:pointer;color:#9ca3af;font-size:18px;line-height:1;padding:0;">&times;</button>

    <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
        <img src="{{ asset('assets/images/logo.webp') }}" alt="РемБытТехника" width="44" height="44"
            style="width:44px;height:44px;object-fit:contain;background:#f9fafb;border:1px solid #f3f4f6;border-radius:8px;padding:2px;">
        <div style="flex:1;min-width:0;padding-right:16px;box-sizing:border-box;">
            <div style="font-weight:600;color:#111827;font-size:14px;line-height:1.2;">РемБытТехника</div>
            <div style="font-size:12px;color:#6b7280;">Ремонт бытовой техники</div>
        </div>
    </div>

    <div style="display:flex;align-items:center;gap:8px;font-size:14px;color:#374151;margin-bottom:6px;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
        <span>{{ config('contacts.address_full') }}</span>
    </div>

    <div style="display:flex;align-items:center;gap:8px;font-size:14px;color:#374151;margin-bottom:6px;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
        <span>{{ config('contacts.opening_hours_display') }}</span>
    </div>

    <div style="display:flex;align-items:center;gap:8px;font-size:14px;color:#374151;margin-bottom:6px;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.127.96.361 1.903.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
        <a href="tel:{{ config('contacts.phone_tel') }}" style="color:#374151;text-decoration:none;">{{ config('contacts.phone_display') }}</a>
    </div>

    <div style="display:flex;align-items:center;gap:8px;font-size:14px;color:#374151;margin-bottom:12px;">
        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#9ca3af" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="flex-shrink:0;"><circle cx="12" cy="12" r="10"/><line x1="2" y1="12" x2="22" y2="12"/><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/></svg>
        <a href="https://{{ $siteHost }}" target="_blank" rel="noopener" style="color:#374151;text-decoration:none;">{{ $siteHost }}</a>
    </div>

    <a href="https://yandex.ru/profile/14301877469/" target="_blank" rel="noopener"
        style="display:block;text-align:center;background:#eab308;color:#fff;font-size:14px;font-weight:500;padding:8px 0;border-radius:6px;text-decoration:none;">
        Об организации
    </a>
</div>
