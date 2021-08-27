<?php

use SecTheater\Support\Str;
use PHPUnit\Framework\TestCase;

class StrTest extends TestCase
{
    protected $irregulars = [
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

    protected $uncountable = [
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
        foreach ($this->uncountable as $word) {
            $this->assertEquals($word, Str::plural($word));
        }
    }

    public function test_it_finds_the_plural_of_irregular_singulars()
    {
        foreach ($this->irregulars as $singular => $plural) {
            $this->assertEquals($plural, Str::plural($singular));
        }
    }

    public function test_it_finds_the_singular_of_a_regular_word()
    {
        $regularPlurals = [
            'users' => 'user',
            'carts' => 'cart',
            'cups' => 'cup',
            'websites' => 'website',
            'passwords' => 'password',
            'usernames' => 'username',
            'emails' => 'email'
        ];

        foreach ($regularPlurals as $plural => $singular) {
            $this->assertEquals($singular, Str::singular($plural));
        }
    }

    public function test_it_returns_the_same_word_if_its_uncountable()
    {
        foreach ($this->uncountable as $word) {
            $this->assertEquals($word, Str::singular($word));
        }
    }

    public function test_it_finds_the_singular_for_irregular_plurals()
    {
        foreach (array_flip($this->irregulars) as $singular => $plural) {
            $this->assertEquals($plural, Str::singular($singular));
        }
    }
}
