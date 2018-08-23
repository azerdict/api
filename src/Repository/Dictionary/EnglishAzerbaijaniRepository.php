<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Repository\Dictionary;

use App\Entity\Dictionary\EnglishAzerbaijani;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method EnglishAzerbaijani|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnglishAzerbaijani|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnglishAzerbaijani[]    findAll()
 * @method EnglishAzerbaijani[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnglishAzerbaijaniRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, EnglishAzerbaijani::class);
    }

    /**
     * @todo: implement $safeSearch and $limit.
     *
     * @param string $term
     *
     * @return array
     */
    public function search(string $term)
    {
        $safeSearch = false;
        $limit = 300;

        $qb = $this->createQueryBuilder('ea')
            ->where('ea.azerbaijani = :term')
            ->orWhere('ea.english = :term')
            ->orWhere('MATCH_AGAINST(ea.azerbaijani, ea.english, :termForMA) > 0')
            ->setParameter('term', $term)
            ->setParameter('termForMA', str_replace(' ', '+', trim($term)));

        if ($safeSearch) {
            $qb->andWhere('ea.terminology not in :unsafeTerminologies')
                ->setParameter('unsafeTerminologies', [102, 103]);
        }

        return $qb->orderBy('ea.partOfSpeech', 'ASC')
            ->addOrderBy('ea.meaning')
            ->addOrderBy('ea.terminology')
            ->setMaxResults($limit)
            ->getQuery()
            ->getArrayResult();
    }
}
