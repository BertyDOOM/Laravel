<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = ['title', 'authors', 'type', 'theme', 'image'];

        const TYPES = [
        'journal'    => 'Статия',
        'conference' => 'Доклад',
        'book'       => 'Книга',
        'report'     => 'Отчет',
        'poster'     => 'Плакат/Презентация',
        'encyclopedia' => 'Енциклопедия',
        'monograph'    => 'Монография',
        'other' => 'Друго'
    ];

    const THEMES = [

        'physics'  => 'Физика',
        'biology'  => 'Биология',
        'chemistry'=> 'Химия',
        'math'     => 'Математика',
        'cs'       => 'Компютърни науки',
        'ai'       => 'Изкуствен интелект',
        'literature' => 'Литература',
        'history'    => 'История',
        'art'        => 'Изкуство',
        'philosophy' => 'Философия',
        'sociology'  => 'Социология',
        'languages'   => 'Езици',
        'other'    => 'Друго'
    ];

    public static function getTypes(): array
    {
        return self::TYPES;
    }

    public static function getThemes(): array
    {
        return self::THEMES;
    }
}
