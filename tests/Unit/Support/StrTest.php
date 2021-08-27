<?php

use SecTheater\Support\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    public function test_it_pluralizes_a_word_for_regular_singulars()
    {
        $words = ['quiz', 'category', 'bus', 'user', 'cart'];
        $plurals = ['quizzes', 'categories', 'buses', 'users', 'carts'];

        foreach ($words as $index => $word) {
            $this->assertEquals($plurals[$index], Str::plural($word));
        }
    }

    public function test_it_returns_the_same_words_if_words_are_uncountable()
    {
        $uncountable = [
            'sheep',
            'fish',
            'deer',
            'series',
            'species',
            'money',
            'rice',
            'information',
            'equipment'
        ];

        foreach ($uncountable as $word) {
            $this->assertEquals($word, Str::plural($word));
        }
    }

    public function test_it_finds_the_plural_of_irregular_singulars()
    {
        $irregulars = [
            'move' => 'moves',
            'foot' => 'feet',
            'sex' => 'sexes',
            'child' => 'children',
            'man' => 'men',
            'woman' => 'women',
            'tooth' => 'teeth',
            'person' => 'people',
            'leaf' => 'leaves',
            'knife' => 'knives',
            'life' => 'lives'
        ];

        foreach ($irregulars as $singular => $plural) {
            $this->assertEquals($plural, Str::plural($singular));
        }
    }
}
