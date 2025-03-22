<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Главная') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div id="divi">
                <a  id="redi_btn" href="/redi" >Перейти в Веб-конференцию</a>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
