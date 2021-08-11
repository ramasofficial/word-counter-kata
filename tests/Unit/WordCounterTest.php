<?php

declare(strict_types=1);

namespace Test\Unit;

use TDD\WordCounter;
use TDD\EmptyStringException;
use PHPUnit\Framework\TestCase;

class WordCounterTest extends TestCase
{
    protected WordCounter $wordCounter;

    private const STRING_WITH_COMMA = 'labas,mama,labas';

    private const STRING_WITH_DOT = 'labas.mama.labas';

    private const STRING_WITH_SPACE = 'labas mama labas';

    private const STRING_EMPTY = '';

    private const DELIMITER_COMMA = ',';

    private const DELIMITER_DOT = '.';

    private const DELIMITER_SPACE = ' ';

    private const LABAS = 'labas';

    private const MAMA = 'mama';

    private const CORRECT_ARRAY = ['labas' => 2, 'mama' => 1];

    protected function setUp(): void
    {
        $this->wordCounter = new WordCounter();
    }

    public function test_should_initialize_word_counter_class(): void
    {
        $this->assertInstanceOf(WordCounter::class, $this->wordCounter);
    }

    public function test_should_throw_exception_if_string_is_empty(): void
    {
        $this->expectException(EmptyStringException::class);

        $this->wordCounter->process(self::STRING_EMPTY, self::DELIMITER_COMMA);
    }

    public function test_should_split_words_through_comma(): void
    {
        $split = $this->split(self::STRING_WITH_COMMA, self::DELIMITER_COMMA);
        $this->assertContains(self::LABAS, $split);
        $this->assertContains(self::MAMA, $split);
    }

    public function test_should_split_words_through_dot(): void
    {
        $split = $this->split(self::STRING_WITH_DOT, self::DELIMITER_DOT);
        $this->assertContains(self::LABAS, $split);
        $this->assertContains(self::MAMA, $split);
    }

    public function test_should_split_words_through_space(): void
    {
        $split = $this->split(self::STRING_WITH_SPACE, self::DELIMITER_SPACE);
        $this->assertContains(self::LABAS, $split);
        $this->assertContains(self::MAMA, $split);
    }

    public function test_should_count_words_in_array(): void
    {
        $split = $this->split(self::STRING_WITH_COMMA, self::DELIMITER_COMMA);
        $words = $this->countWords($split);

        $this->assertIsArray($words);
        $this->assertContains(1, $words);
        $this->assertContains(2, $words);
    }

    public function test_should_return_correct_array(): void
    {
        $correct = $this->wordCounter->process(self::STRING_WITH_COMMA, self::DELIMITER_COMMA);

        $this->assertIsArray($correct);
        $this->assertEquals(self::CORRECT_ARRAY, $correct);
    }

    private function split(string $string, string $delimiter): array
    {
        return $this->wordCounter->split($string, $delimiter);
    }

    private function countWords(array $split): array
    {
        return $this->wordCounter->countWords($split);
    }
}
