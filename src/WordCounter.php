<?php

declare(strict_types=1);

namespace TDD;

class WordCounter
{
    public function split(string $value, string $delimiter): array
    {
        if(!$value) {
            throw new EmptyStringException();
        }

        return explode($delimiter, $value);
    }

    public function countWords(array $words): array
    {
        return array_count_values($words);
    }

    public function sort(array $words): array
    {
        arsort($words);
        return $words;
    }
}
