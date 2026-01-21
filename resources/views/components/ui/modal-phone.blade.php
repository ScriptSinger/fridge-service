@props(['payload' => [], 'model' => null])

<div x-cloak x-show="open" style="display: none;" class="fixed inset-0 bg-black/90 flex items-center justify-center z-50"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div @click.away="closeModal()" class="bg-white rounded-lg p-6 w-full max-w-md relative">
        <button @click="closeModal()"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-900 cursor-pointer">✕</button>
        <x-ui.lead-form class="w-full" id="my-form" :payload="[
            'leadable_type' => get_class($model),
            'leadable_id' => $model->id,
            'utm_source' => session('utm_source'),
            'utm_medium' => session('utm_medium'),
            'utm_campaign' => session('utm_campaign'),
        ]" />
    </div>
</div>
