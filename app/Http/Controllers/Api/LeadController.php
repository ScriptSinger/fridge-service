<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function store(StoreLeadRequest $request)
    {
        sleep(5);
        $lead = Lead::create($request->validated());

        if ($request->leadable_type) {
            $lead->leadable()->associate(
                $request->leadable_type::find($request->leadable_id)
            );

            $lead->save();
        }

        return $request->wantsJson()
            ? response()->json(['success' => true, 'id' => $lead->id])
            : back()->with('success', 'Заявка отправлена!');
    }
}
