<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = ['title', 'authors', 'type', 'theme'];

    const TYPES = [
        'journal'    => 'Статия в списание',
        'conference' => 'Доклад на конференция',
        'book'       => 'Книга',
        'report'     => 'Доклад/Отчет',
        'poster'     => 'Плакат/Презентация'
    ];

    const THEMES = [
        'ai'       => 'Изкуствен интелект',
        'physics'  => 'Физика',
        'biology'  => 'Биология',
        'chemistry'=> 'Химия',
        'math'     => 'Математика',
        'cs'       => 'Компютърни науки',
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
