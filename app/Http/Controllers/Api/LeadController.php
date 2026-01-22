<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class LeadController extends Controller
{
    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create($request->validated());

        if ($request->leadable_type) {
            $lead->leadable()->associate(
                $request->leadable_type::find($request->leadable_id)
            );

            $lead->save();
        }

        $token = env('TELEGRAM_BOT_TOKEN');
        $chatId = env('TELEGRAM_MASTER_CHAT');

        $message = "Новый лид!\n";
        $message .= "Имя: " . ($lead->name ?? '—') . "\n";
        $message .= "Телефон: " . ($lead->phone ?? '—') . "\n";
        $message .= "Бренд: " . ($lead->leadable_type ?? '—') . "\n";
        // $message .= "Комментарий: " . ($lead->comment ?? '—');

        Http::post("https://api.telegram.org/bot{$token}/sendMessage", [
            'chat_id' => $chatId,
            'text' => $message,
        ]);



        return $request->wantsJson()
            ? response()->json(['success' => true, 'id' => $lead->id])
            : back()->with('success', 'Заявка отправлена!');
    }
}
