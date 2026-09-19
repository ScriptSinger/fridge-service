<?php

namespace App\Support;

use Illuminate\Database\Eloquent\Model;

/**
 * Shared by every controller that associates a Lead with a polymorphic
 * "leadable" — the caller must pass the same whitelist the request validated
 * against ($request->allowedLeadableTypes() from ValidatesLeadable), so a
 * loosened validation rule can't turn this into arbitrary class
 * instantiation via $type::find().
 */
trait ResolvesLeadable
{
    protected function resolveLeadable(?string $type, ?int $id, array $allowedTypes): ?Model
    {
        if (! $type || ! in_array($type, $allowedTypes, true)) {
            return null;
        }

        return $type::find($id);
    }
}
