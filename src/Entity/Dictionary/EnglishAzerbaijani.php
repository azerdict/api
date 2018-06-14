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
     * @ORM\Column(type="smallint")
     */
    private $terminology;

    /**
     * @var int
     * @ORM\Column(name="part_of_speech", type="smallint")
     */
    private $partOfSpeech;

    /**
     * @var string
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $transcription;

    /**
     * @var int
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $meaning;

    /**
     * @var string
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $explanation;

    /**
     * @var integer
     * @ORM\Column(type="string", length=100)
     */
    private $source;

    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getEnglish(): string
    {
        return $this->english;
    }

    /**
     * @param string $english
     */
    public function setEnglish(string $english): void
    {
        $this->english = $english;
    }

    /**
     * @return string
     */
    public function getAzerbaijani(): string
    {
        return $this->azerbaijani;
    }

    /**
     * @param string $azerbaijani
     */
    public function setAzerbaijani(string $azerbaijani): void
    {
        $this->azerbaijani = $azerbaijani;
    }

    /**
     * @return int
     */
    public function getTerminology(): int
    {
        return $this->terminology;
    }

    /**
     * @param int $terminology
     */
    public function setTerminology(int $terminology): void
    {
        $this->terminology = $terminology;
    }

    /**
     * @return int
     */
    public function getPartOfSpeech(): int
    {
        return $this->partOfSpeech;
    }

    /**
     * @param int $partOfSpeech
     */
    public function setPartOfSpeech(int $partOfSpeech): void
    {
        $this->partOfSpeech = $partOfSpeech;
    }

    /**
     * @return string
     */
    public function getTranscription(): ?string
    {
        return $this->transcription;
    }

    /**
     * @param string $transcription
     */
    public function setTranscription(?string $transcription): void
    {
        $this->transcription = $transcription;
    }

    /**
     * @return int
     */
    public function getMeaning(): ?int
    {
        return $this->meaning;
    }

    /**
     * @param int $meaning
     */
    public function setMeaning(?int $meaning): void
    {
        $this->meaning = $meaning;
    }

    /**
     * @return string
     */
    public function getExplanation(): ?string
    {
        return $this->explanation;
    }

    /**
     * @param string $explanation
     */
    public function setExplanation(?string $explanation): void
    {
        $this->explanation = $explanation;
    }

    /**
     * @return int
     */
    public function getSource(): int
    {
        return $this->source;
    }

    /**
     * @param int $source
     */
    public function setSource(int $source): void
    {
        $this->source = $source;
    }
}
