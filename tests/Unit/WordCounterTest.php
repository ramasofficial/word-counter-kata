<?php

declare(strict_types=1);

namespace Test\Unit;

use TDD\WordCounter;
use PHPUnit\Framework\TestCase;

class WordCounterTest extends TestCase
{
    protected WordCounter $wordCounter;

    private const TEST_STRING = 'labas,mama,labas';

    protected function setUp(): void
    {
        $this->wordCounter = new WordCounter();
    }

    public function test_should_initialize_word_counter_class(): void
    {
        $this->assertInstanceOf(WordCounter::class, $this->wordCounter);
    }

    public function test_should_split_words_through_comma(): void
    {
        $split = $this->split(self::TEST_STRING);
        $this->assertContains('labas', $split);
        $this->assertContains('mama', $split);
    }

    public function test_should_count_words_in_array(): void
    {
        $split = $this->split(self::TEST_STRING);
        $words = $this->countWords($split);

        $this->assertIsArray($words);
        $this->assertContains(1, $words);
        $this->assertContains(2, $words);
    }

    public function test_should_return_sorted_array(): void
    {
        $split = $this->split(self::TEST_STRING);
        $words = $this->countWords($split);
        $sortedWords = $this->sort($words);

        $this->assertIsArray($sortedWords);
        $this->assertEquals(['labas' => 2, 'mama' => 1], $sortedWords);
    }

    private function split(): array
    {
        return $this->wordCounter->split(self::TEST_STRING);
    }

    private function countWords(array $split): array
    {
        return $this->wordCounter->countWords($split);
    }

    private function sort(array $words): array
    {
        return $this->wordCounter->sort($words);
    }
}
