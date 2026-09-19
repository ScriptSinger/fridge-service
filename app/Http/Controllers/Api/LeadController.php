<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Jobs\SendEmailLeadNotification;
use App\Jobs\SendTelegramLeadNotification;
use App\Models\Lead;
use App\Support\ResolvesLeadable;
use Illuminate\Support\Arr;

class LeadController extends Controller
{
    use ResolvesLeadable;

    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create([
            ...Arr::except($request->validated(), ['privacy_policy']),
            'channel' => Lead::CHANNEL_FORM,
        ]);

        if ($leadable = $this->resolveLeadable($request->leadable_type, $request->leadable_id, $request->allowedLeadableTypes())) {
            $lead->leadable()->associate($leadable);
            $lead->save();
        }

        SendTelegramLeadNotification::dispatch($lead->id);
        SendEmailLeadNotification::dispatch($lead->id);

        return $request->wantsJson()
            ? response()->json(['success' => true, 'id' => $lead->id])
            : back()->with('success', 'Заявка отправлена!');
    }
}
