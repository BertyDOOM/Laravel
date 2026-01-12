<x-app-layout>
    {{-- Header слот с жълт фон --}}
    <x-slot name="header">
        <div class="header-container">
            <h2 class="header-text">
                📚 Система за научни публикации
            </h2>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen">
        <div class="max-w-5xl mx-auto">

            <!-- Add publication -->
            <div class="card">
                <h3>➕ Нова публикация</h3>
                <form method="POST" action="{{ route('publications.store') }}" enctype="multipart/form-data" class="space-y-3">
                    @csrf
                    <input type="text" name="title" placeholder="Заглавие" class="input" required>
                    <input type="text" name="authors" placeholder="Автор" class="input" required>

                    <select name="type" required class="input">
                        @foreach(\App\Models\Publication::getTypes() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                    <select name="theme" class="input">
                        <option value="">Без Сфера</option>
                        @foreach(\App\Models\Publication::getThemes() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>

                    <!-- Upload image -->
                    <input type="file" name="image" class="input">

                    <button type="submit" class="button">Добави публикация</button>
                </form>
            </div>

            <div class="card">
                <form method="GET" class="flex gap-4">
                    <input name="search" placeholder="Търсене по заглавие или автор" class="input">
                    <select name="type" class="input">
                        <option value="">Всички типове</option>
                        @foreach(\App\Models\Publication::getTypes() as $value => $label)
                            <option value="{{ $value }}">{{ $label }}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="button">Търси</button>
                </form>
            </div>

            <div class="card">
                <table>
                    <thead>
                        <tr>
                            <th>Снимка</th>
                            <th>Заглавие</th>
                            <th>Автори</th>
                            <th>Тип публикация</th>
                            <th>Тема</th>
                            <th>Действия</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($publications as $publication)
                            <tr>
                                <td>
                                    @if($publication->image)
                                        <img src="{{ asset('storage/' . $publication->image) }}" 
                                             alt="Снимка" 
                                             class="w-16 h-16 object-cover rounded border">
                                    @endif
                                </td>
                                <td>{{ $publication->title }}</td>
                                <td>{{ $publication->authors }}</td>
                                <td>{{ \App\Models\Publication::TYPES[$publication->type] ?? $publication->type }}</td>
                                <td>{{ \App\Models\Publication::THEMES[$publication->theme] ?? '' }}</td>
                                <td class="text-right">
                                    <form method="POST" action="{{ route('publications.destroy', $publication) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button">✖</button>
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

<style>
    body { background-color: #ffffff; font-family: Arial, sans-serif; }
    .header-container { background-color: #fff8dc; padding: 1.5rem; border-radius: 8px; margin-bottom: 2rem; text-align: center; box-shadow: 0 2px 6px rgba(0,0,0,0.05); }
    .header-text { color: #7B3F00; font-size: 2rem; font-weight: bold; margin: 0; }
    .card { background-color: #ffffff; border: 2px solid #7b3030; border-radius: 8px; padding: 1rem; margin-bottom: 1.5rem; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    .card h3 { color: #7b3030; margin-bottom: 1rem; }
    .input, select, button { display: block; width: 100%; padding: 0.5rem; margin-bottom: 1rem; border-radius: 6px; border: 1px solid #ccc; font-size: 1rem; }
    .input:focus, select:focus { outline: none; border-color: #7b3030; box-shadow: 0 0 0 2px rgba(179, 71, 71, 0.3); }
    .button { background-color: #7b3030; color: #ffffff; border: none; cursor: pointer; font-weight: bold; padding: 0.5rem 1rem; }
    .button:hover { background-color: #912e2e; }
    table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
    th, td { padding: 0.75rem; text-align: left; border-bottom: 1px solid #ddd; }
    th { color: #7b3030; font-weight: bold; }
    td .delete-button { color: #7b3030; background: none; border: none; cursor: pointer; }
    td .delete-button:hover { color: #ff0000; }
</style>
