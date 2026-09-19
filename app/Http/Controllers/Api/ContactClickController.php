<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactClickRequest;
use App\Models\Lead;
use App\Support\ResolvesLeadable;

/**
 * Records intent-only contact clicks (phone/WhatsApp/Telegram links) that
 * bypass the lead form entirely — without this, the Leads admin only ever
 * saw form submissions, undercounting real inbound contact volume by
 * channel and UTM source.
 */
class ContactClickController extends Controller
{
    use ResolvesLeadable;

    public function store(StoreContactClickRequest $request)
    {
        $lead = Lead::create($request->validated());

        if ($leadable = $this->resolveLeadable($request->leadable_type, $request->leadable_id, $request->allowedLeadableTypes())) {
            $lead->leadable()->associate($leadable);
            $lead->save();
        }

        return response()->json(['success' => true]);
    }
}
