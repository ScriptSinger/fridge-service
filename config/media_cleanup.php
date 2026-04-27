<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Media cleanup defaults
    |--------------------------------------------------------------------------
    |
    | These settings are used by cleanup commands that prune "orphaned" media
    | files which are no longer referenced from HTML content.
    */
    'gallery_tinymce' => [
        // Defaults to MEDIA_DISK via config('filesystems.media').
        'disk' => env('MEDIA_CLEANUP_DISK'),

        // Folder where TinyMCE uploads are stored.
        'prefix' => 'galleries/content',

        // Do not delete files newer than N days (safety window).
        'older_than_days' => env('MEDIA_CLEANUP_OLDER_THAN_DAYS', 30),
    ],
];

