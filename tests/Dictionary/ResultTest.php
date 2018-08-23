<?php

namespace App\Tests\Dictionary;

use App\Dictionary\Result;
use PHPUnit\Framework\TestCase;

class ResultTest extends TestCase
{
    /**
     * @var Result
     */
    private $dictionaryResult;

    public function setUp()
    {
        $this->dictionaryResult = new Result();
    }

    public function tearDown()
    {
        unset($this->dictionaryResult);
    }

    public function testEmpty()
    {
        $this->assertFalse($this->dictionaryResult->hasResult());
        $this->assertSame([
            'meta' => [
                'all' => [
                    'count' => 0,
                ],
            ],
            'data' => [],
        ], $this->dictionaryResult->getResult());
    }

    public function testOneDictionary()
    {
        $this->dictionaryResult->addData('english_azerbaijani', ['lorem ipsum']);
        $this->dictionaryResult->addData('english_azerbaijani', ['dolor sit amet']);

        $this->assertTrue($this->dictionaryResult->hasResult());
        $this->assertSame([
            'meta' => [
                'all' => [
                    'count' => 2,
                ],
                'english_azerbaijani' => [
                    'count' => 2,
                ],
            ],
            'data' => [
                'english_azerbaijani' => [
                    ['lorem ipsum'],
                    ['dolor sit amet'],
                ],
            ],
        ], $this->dictionaryResult->getResult());
    }

    public function testTwoDictionaries()
    {
        $this->dictionaryResult->addData('english_azerbaijani', ['lorem ipsum']);
        $this->dictionaryResult->addData('azerbaijani_english', ['dolor sit amet']);

        $this->assertTrue($this->dictionaryResult->hasResult());
        $this->assertSame([
            'meta' => [
                'all' => [
                    'count' => 2,
                ],
                'english_azerbaijani' => [
                    'count' => 1,
                ],
                'azerbaijani_english' => [
                    'count' => 1,
                ],
            ],
            'data' => [
                'english_azerbaijani' => [['lorem ipsum']],
                'azerbaijani_english' => [['dolor sit amet']],
            ],
        ], $this->dictionaryResult->getResult());
    }
}
