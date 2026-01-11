<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-bookish-red leading-tight">
            📚 Система за научни публикации
        </h2>
    </x-slot>

    <div class="py-8 bg-white min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Add publication -->
            <div class="bg-white shadow rounded-lg p-6 border border-bookish-red">
                <h3 class="text-lg font-semibold text-bookish-red mb-4">➕ Нова публикация</h3>
                <form method="POST" action="{{ route('publications.store') }}" class="space-y-3">
                    @csrf
                    <input type="text" name="title" placeholder="Заглавие" required
                           class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-bookish-red">
                    <input type="text" name="authors" placeholder="Автори" required
                           class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-bookish-red">

                    <select name="type" required
                            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-bookish-red">
                        @foreach(\App\Models\Publication::getTypes() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                    <select name="theme"
                            class="w-full border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-bookish-red">
                        <option value="">Без тема</option>
                        @foreach(\App\Models\Publication::getThemes() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                    <button type="submit" class="bg-bookish-red text-white px-4 py-2 rounded hover:bg-red-700">
                        Добави публикация
                    </button>
                </form>
            </div>

            <!-- Search -->
            <div class="bg-white shadow rounded-lg p-4 border border-bookish-red">
                <form method="GET" class="flex gap-4">
                    <input name="search" placeholder="Търсене по заглавие или автор"
                           class="flex-grow border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-bookish-red" />

                    <select name="type" class="border px-3 py-2 rounded focus:outline-none focus:ring-2 focus:ring-bookish-red">
                        <option value="">Всички типове</option>
                        <option value="journal_article">Статия</option>
                        <option value="conference_paper">Доклад</option>
                        <option value="book">Книга</option>
                        <option value="poster">Плакат</option>
                    </select>

                    <button class="bg-bookish-red text-white px-4 py-2 rounded hover:bg-red-700">Търси</button>
                </form>
            </div>

            <!-- Publications list -->
            <div class="bg-white shadow rounded-lg overflow-hidden border border-bookish-red">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-bookish-red font-semibold">Заглавие</th>
                            <th class="p-3 text-bookish-red font-semibold">Автори</th>
                            <th class="p-3 text-bookish-red font-semibold">Тип</th>
                            <th class="p-3 text-right text-bookish-red font-semibold">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publications as $publication)
                            <tr class="border-t">
                                <td class="p-3 font-medium">{{ $publication->title }}</td>
                                <td class="p-3">{{ $publication->authors }}</td>
                                <td class="p-3 text-sm text-gray-600">
                                    {{ \App\Models\Publication::TYPES[$publication->type] ?? $publication->type }}
                                </td>
                                <td class="p-3 text-right">
                                    <form method="POST" action="{{ route('publications.destroy', $publication) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-bookish-red hover:text-red-700">✖</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
