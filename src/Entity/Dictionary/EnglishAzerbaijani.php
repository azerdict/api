<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Entity\Dictionary;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(
 *      name="ad_dict_english_azerbaijani",
 *      indexes={@ORM\Index(columns={"english", "azerbaijani"}, flags={"fulltext"})}
 * )
 * @ORM\Entity(repositoryClass="App\Repository\Dictionary\EnglishAzerbaijaniRepository")
 */
class EnglishAzerbaijani
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $english;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    private $azerbaijani;

    /**
     * @var int
     *
     * @ORM\Column(type="smallint")
     */
    private $terminology;

    /**
     * @var int
     *
     * @ORM\Column(name="part_of_speech", type="smallint")
     */
    private $partOfSpeech;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $transcription;

    /**
     * @var int|null
     *
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $meaning;

    /**
     * @var string|null
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $explanation;

    /**
     * @var integer
     *
     * @ORM\Column(type="string", length=100)
     */
    private $source = 9;

    public function __construct(string $english, string $azerbaijani, int $terminology, int $partOfSpeech)
    {
        $this->english = $english;
        $this->azerbaijani = $azerbaijani;
        $this->terminology = $terminology;
        $this->partOfSpeech = $partOfSpeech;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getEnglish(): string
    {
        return $this->english;
    }

    public function setEnglish(string $english): void
    {
        $this->english = $english;
    }

    public function getAzerbaijani(): string
    {
        return $this->azerbaijani;
    }

    public function setAzerbaijani(string $azerbaijani): void
    {
        $this->azerbaijani = $azerbaijani;
    }

    public function getTerminology(): int
    {
        return $this->terminology;
    }

    public function setTerminology(int $terminology): void
    {
        $this->terminology = $terminology;
    }

    public function getPartOfSpeech(): int
    {
        return $this->partOfSpeech;
    }

    public function setPartOfSpeech(int $partOfSpeech): void
    {
        $this->partOfSpeech = $partOfSpeech;
    }

    public function getTranscription(): ?string
    {
        return $this->transcription;
    }

    public function setTranscription(?string $transcription): void
    {
        $this->transcription = $transcription;
    }

    public function getMeaning(): ?int
    {
        return $this->meaning;
    }

    public function setMeaning(?int $meaning): void
    {
        $this->meaning = $meaning;
    }

    public function getExplanation(): ?string
    {
        return $this->explanation;
    }

    public function setExplanation(?string $explanation): void
    {
        $this->explanation = $explanation;
    }

    public function getSource(): int
    {
        return $this->source;
    }
}
