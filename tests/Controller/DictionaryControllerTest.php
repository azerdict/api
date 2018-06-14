<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Tests\Controller;

class DictionaryControllerTest extends ApiTestCase
{
    public function testEnglishNotFound()
    {
        $this->client->request('GET', '/dictionary/english', [
            'term' => 'something-does-not-exist',
        ]);

        $this->assertStatusCode(404);
        $this->assertEmpty($this->getContentAsArray());
    }

    public function testEnglish()
    {
        $this->client->request('GET', '/dictionary/english', [
            'term' => 'abandon',
        ]);

        $this->assertStatusCode(200);
        $content = $this->getContentAsArray();
        $this->assertNotEmpty($content);
        $this->assertSame('abandon', $content[0]['english']);
        $this->assertSame('əl çəkmək', $content[0]['azerbaijani']);
        $this->assertSame(1, $content[0]['terminology']);
        $this->assertSame(3, $content[0]['partOfSpeech']);
        $this->assertNull($content[0]['transcription']);
        $this->assertNull($content[0]['explanation']);
        $this->assertSame('1', $content[0]['source']);
    }

    /**
     * @dataProvider englishFulltextData
     *
     * @param string $term
     * @param array $result
     */
    public function testEnglishFulltext(string $term, array $result)
    {
        $this->client->request('GET', '/dictionary/english', [
            'term' => $term,
        ]);

        $this->assertStatusCode(200);
        $content = $this->getContentAsArray();
        $this->assertNotEmpty($content);
        $this->assertSame($result['english'], $content[0]['english']);
        $this->assertSame($result['azerbaijani'], $content[0]['azerbaijani']);
        $this->assertSame($result['terminology'], $content[0]['terminology']);
        $this->assertSame($result['partOfSpeech'], $content[0]['partOfSpeech']);
        $this->assertSame($result['transcription'], $content[0]['transcription']);
        $this->assertSame($result['explanation'], $content[0]['explanation']);
        $this->assertSame($result['source'], $content[0]['source']);
    }

    public function englishFulltextData()
    {
        return [
            [
                'term' => 'sit',
                'result' => [
                    'english' => 'lorem ipsum',
                    'azerbaijani' => 'dolor sit amet',
                    'terminology' => 1,
                    'partOfSpeech' => 1,
                    'transcription' => null,
                    'meaning' => 1,
                    'explanation' => null,
                    'source' => '1',
                ],
            ],
            [
                'term' => 'sit amet',
                'result' => [
                    'english' => 'lorem ipsum',
                    'azerbaijani' => 'dolor sit amet',
                    'terminology' => 1,
                    'partOfSpeech' => 1,
                    'transcription' => null,
                    'meaning' => 1,
                    'explanation' => null,
                    'source' => '1',
                ],
            ],
            [
                'term' => 'ipsum',
                'result' => [
                    'english' => 'lorem ipsum',
                    'azerbaijani' => 'dolor sit amet',
                    'terminology' => 1,
                    'partOfSpeech' => 1,
                    'transcription' => null,
                    'meaning' => 1,
                    'explanation' => null,
                    'source' => '1',
                ],
            ],
        ];
    }
}
