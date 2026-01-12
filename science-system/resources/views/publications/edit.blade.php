
<x-app-layout>
    <x-slot name="header">
        <div class="header-container">
            <h2 class="header-text">
                ✏️ Редакция на публикация
            </h2>
        </div>
    </x-slot>

    <div class="py-8 min-h-screen">
        <div class="max-w-3xl mx-auto">

            <div class="card">
                <h3>Промяна на данни</h3>

                <form method="POST"
                      action="{{ route('publications.update', $publication) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input
                        type="text"
                        name="title"
                        value="{{ old('title', $publication->title) }}"
                        class="input"
                        placeholder="Заглавие"
                        required>

                    <input
                        type="text"
                        name="authors"
                        value="{{ old('authors', $publication->authors) }}"
                        class="input"
                        placeholder="Автори"
                        required>

                    <select name="type" class="input" required>
                        @foreach(\App\Models\Publication::getTypes() as $value => $label)
                            <option value="{{ $value }}"
                                @selected($publication->type === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    <select name="theme" class="input">
                        <option value="">Без сфера</option>
                        @foreach(\App\Models\Publication::getThemes() as $value => $label)
                            <option value="{{ $value }}"
                                @selected($publication->theme === $value)>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    @if($publication->image)
                        <div style="margin-bottom: 1rem;">
                            <strong>Текуща снимка:</strong><br>
                            <img src="{{ asset('storage/' . $publication->image) }}"
                                 style="width:120px;height:120px;object-fit:cover;border:1px solid #ccc;border-radius:6px;">
                        </div>
                    @endif

                    <input type="file" name="image" class="input">

                    <div style="display:flex; gap:1rem;">
                        <button type="submit" class="button">
                            💾 Запази
                        </button>

                        <a href="{{ route('publications.index') }}"
                           class="button"
                           style="background:#999;text-align:center;">
                            ⬅ Назад
                        </a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>

<style>
    body { background-color: #ffffff; font-family: Arial, sans-serif; }

    .header-container {
        background-color: #fff8dc;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 2rem;
        text-align: center;
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .header-text {
        color: #7B3F00;
        font-size: 2rem;
        font-weight: bold;
        margin: 0;
    }

    .card {
        background-color: #ffffff;
        border: 2px solid #7b3030;
        border-radius: 8px;
        padding: 1rem;
        margin-bottom: 1.5rem;
        box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    .card h3 {
        color: #7b3030;
        margin-bottom: 1rem;
    }

    .input, select, button {
        display: block;
        width: 100%;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border-radius: 6px;
        border: 1px solid #ccc;
        font-size: 1rem;
    }

    .input:focus, select:focus {
        outline: none;
        border-color: #7b3030;
        box-shadow: 0 0 0 2px rgba(179, 71, 71, 0.3);
    }

    .button {
        background-color: #7b3030;
        color: #ffffff;
        border: none;
        cursor: pointer;
        font-weight: bold;
        padding: 0.5rem 1rem;
        text-decoration: none;
    }

    .button:hover {
        background-color: #912e2e;
    }
</style>