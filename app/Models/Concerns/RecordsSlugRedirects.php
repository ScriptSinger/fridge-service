<?php

namespace App\Models\Concerns;

use App\Models\Redirect;

/**
 * Records a 301 redirect whenever a Sluggable model's slug changes on an
 * already-existing record, so renaming a published Title/H1 doesn't turn
 * an already-indexed URL into a silent 404.
 */
trait RecordsSlugRedirects
{
    public function recordSlugRedirect(): void
    {
        if ($this->wasRecentlyCreated || ! $this->wasChanged('slug')) {
            return;
        }

        $oldSlug = $this->getOriginal('slug');

        if (! $oldSlug) {
            return;
        }

        // Uses the model's current relations for both paths, so if a
        // device/brand-scoping field changes in the very same save as the
        // slug, the recorded old path won't exactly match the real previous
        // URL and the redirect silently won't fire for that one edit.
        $oldPath = $this->slugRedirectPath($oldSlug);
        $newPath = $this->slugRedirectPath($this->slug);

        if (! $oldPath || ! $newPath || $oldPath === $newPath) {
            return;
        }

        Redirect::query()->updateOrCreate(
            ['from_path' => $oldPath],
            ['to_path' => $newPath]
        );

        // Keep chained renames resolving in a single hop: any earlier
        // redirect pointing at the now-stale path should point to the new one.
        Redirect::query()->where('to_path', $oldPath)->update(['to_path' => $newPath]);
    }

    abstract protected function slugRedirectPath(string $slug): ?string;
}
