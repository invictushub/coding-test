<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Users') }}
        </h2>
    </x-slot>

    <div class="max-h-3.5/4 flex-1 flex flex-col py-6" id="kanban-content">
        <users></users>
    </div>
</x-app-layout>
