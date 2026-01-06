<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
            📚 Система за научни публикации
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Add publication -->
            <div class="bg-white shadow rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">➕ Нова публикация</h3>

                <form method="POST" action="{{ route('publications.store') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @csrf

                    <input name="title" placeholder="Заглавие"
                           class="border rounded px-3 py-2 col-span-2" />

                    <input name="authors" placeholder="Автори"
                           class="border rounded px-3 py-2" />

                    <select name="type" class="border rounded px-3 py-2">
                        <option value="">Тип</option>
                        <option value="journal_article">Статия в списание</option>
                        <option value="conference_paper">Доклад на конференция</option>
                        <option value="book">Книга</option>
                    </select>

                    <button class="md:col-span-4 bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                        Запази
                    </button>
                </form>
            </div>

            <!-- Search -->
            <div class="bg-white shadow rounded-lg p-4">
                <form method="GET" class="flex gap-4">
                    <input name="search" placeholder="Търсене по заглавие или автор"
                           class="flex-grow border rounded px-3 py-2" />

                    <select name="type" class="border rounded px-3 py-2">
                        <option value="">Всички типове</option>
                        <option value="journal_article">Статия</option>
                        <option value="conference_paper">Доклад</option>
                        <option value="book">Книга</option>
                    </select>

                    <button class="bg-gray-700 text-white px-4 rounded">Търси</button>
                </form>
            </div>

            <!-- Publications list -->
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3">Заглавие</th>
                            <th class="p-3">Автори</th>
                            <th class="p-3">Тип</th>
                            <th class="p-3 text-right">Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publications as $publication)
                            <tr class="border-t">
                                <td class="p-3 font-medium">{{ $publication->title }}</td>
                                <td class="p-3">{{ $publication->authors }}</td>
                                <td class="p-3 text-sm text-gray-600">
                                    {{ ucfirst(str_replace('_', ' ', $publication->type)) }}
                                </td>
                                <td class="p-3 text-right">
                                    <form method="POST" action="{{ route('publications.destroy', $publication) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-500 hover:text-red-700">✖</button>
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
