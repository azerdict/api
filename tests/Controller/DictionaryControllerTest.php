<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Tests\Controller;

class DictionaryControllerTest extends ApiTestCase
{
    public function testEnglishValidation()
    {
        $this->client->request('GET', '/dictionary/english-azerbaijani');

        $this->assertStatusCode(422);
        $content = $this->getContentAsArray();
        $this->assertArrayHasKey('errors', $content);
        $this->assertArrayHasKey('term', $content['errors']);
    }

    public function testEnglishNotFound()
    {
        $this->client->request('GET', '/dictionary/english-azerbaijani', [
            'term' => 'something-does-not-exist',
        ]);

        $this->assertStatusCode(404);
        $content = $this->getContentAsArray();
        $this->assertEmpty($content['data']);
        $this->assertSame(0, $content['meta']['all']['count']);
    }

    public function testEnglish()
    {
        $this->client->request('GET', '/dictionary/english-azerbaijani', [
            'term' => 'abandon',
        ]);

        $this->assertStatusCode(200);
        $content = $this->getContentAsArray();
        $this->assertNotEmpty($content);

        $word = $content['data']['english_azerbaijani'][0];
        $this->assertSame('abandon', $word['english']);
        $this->assertSame('əl çəkmək', $word['azerbaijani']);
        $this->assertSame(1, $word['terminology']);
        $this->assertSame(3, $word['partOfSpeech']);
        $this->assertNull($word['transcription']);
        $this->assertNull($word['explanation']);
        $this->assertSame('9', $word['source']);
    }

    /**
     * @dataProvider englishFulltextData
     * @todo create english repository test and move this to there.
     *
     * @param string $term
     * @param array $result
     */
    public function testEnglishFulltext(string $term, array $result)
    {
        $this->client->request('GET', '/dictionary/english-azerbaijani', [
            'term' => $term,
        ]);

        $this->assertStatusCode(200);
        $content = $this->getContentAsArray();
        $this->assertNotEmpty($content);

        $this->assertArraySubset($result, $content['data']);
    }

    public function englishFulltextData()
    {
        return [
            [
                'term' => 'sit',
                'result' => [
                    'azerbaijani_english' => [
                        [
                            'english' => 'lorem ipsum',
                            'azerbaijani' => 'dolor sit amet',
                            'terminology' => 1,
                            'partOfSpeech' => 1,
                            'transcription' => null,
                            'meaning' => 1,
                            'explanation' => null,
                            'source' => '9',
                        ],
                    ],
                ],
            ],
            [
                'term' => 'sit amet',
                'result' => [
                    'azerbaijani_english' => [
                        [
                            'english' => 'lorem ipsum',
                            'azerbaijani' => 'dolor sit amet',
                            'terminology' => 1,
                            'partOfSpeech' => 1,
                            'transcription' => null,
                            'meaning' => 1,
                            'explanation' => null,
                            'source' => '9',
                        ],
                    ],
                ],
            ],
            [
                'term' => 'ipsum',
                'result' => [
                    'english_azerbaijani' => [
                        [
                            'english' => 'lorem ipsum',
                            'azerbaijani' => 'dolor sit amet',
                            'terminology' => 1,
                            'partOfSpeech' => 1,
                            'transcription' => null,
                            'meaning' => 1,
                            'explanation' => null,
                            'source' => '9',
                        ],
                    ],
                ],
            ],
        ];
    }
}
