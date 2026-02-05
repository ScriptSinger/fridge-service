@props(['model'])
<div x-cloak x-show="open" style="display: none;" class="fixed inset-0 bg-black/90 flex items-center justify-center z-50"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <div @click.away="closeModal()" class="bg-white rounded-lg p-4 sm:p-6 w-full max-w-md relative mx-4 sm:mx-0">
        <button @click="closeModal()"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-900 cursor-pointer">✕</button>

        <x-forms.leads class="w-full" :model="$model" idPrefix="modal" />
    </div>
</div>
