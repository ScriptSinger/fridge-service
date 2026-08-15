<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Jobs\SendTelegramLeadNotification;
use App\Models\Lead;
use Illuminate\Support\Arr;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request)
    {
        $lead = Lead::create(
            Arr::except($request->validated(), ['privacy_policy'])
        );

        if ($request->leadable_type && in_array($request->leadable_type, $request->allowedLeadableTypes(), true)) {
            $leadable = $request->leadable_type::find($request->leadable_id);

            if ($leadable) {
                $lead->leadable()->associate($leadable);
                $lead->save();
            }
        }

        SendTelegramLeadNotification::dispatch($lead->id);

        return $request->wantsJson()
            ? response()->json(['success' => true, 'id' => $lead->id])
            : back()->with('success', 'Заявка отправлена!');
    }
}
