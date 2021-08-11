<?php

declare(strict_types=1);

namespace TDD;

class WordCounter
{
    public function split(string $text, string $delimiter): array
    {
        return explode($delimiter, $text);
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

    public function process(string $text, string $delimiter): array
    {
        if(!$text) {
            throw new EmptyStringException();
        }
        
        $split = $this->split($text, $delimiter);
        $count = $this->countWords($split);
        $sort = $this->sort($count);

        return $sort;
    }
}
