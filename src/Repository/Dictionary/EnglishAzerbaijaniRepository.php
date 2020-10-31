<?php

/*
 * (c) Farhad Safarov <ferhad@azerdict.com>
 *
 * @license https://www.mozilla.org/en-US/MPL/2.0/ Mozilla Public License Version 2.0
 */

namespace App\Repository\Dictionary;

use App\Entity\Dictionary\EnglishAzerbaijani;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EnglishAzerbaijani|null find($id, $lockMode = null, $lockVersion = null)
 * @method EnglishAzerbaijani|null findOneBy(array $criteria, array $orderBy = null)
 * @method EnglishAzerbaijani[]    findAll()
 * @method EnglishAzerbaijani[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EnglishAzerbaijaniRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EnglishAzerbaijani::class);
    }

    public function search(string $term, bool $safeSearch = false): array
    {
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
            ->setMaxResults(300)
            ->getQuery()
            ->getArrayResult();
    }
}
