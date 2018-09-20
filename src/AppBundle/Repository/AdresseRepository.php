<?php

namespace AppBundle\Repository;
use AppBundle\Entity\Contact;

/**
 * Class AdresseRepository
 */
class AdresseRepository extends  \Doctrine\ORM\EntityRepository
{
    /**
     * @return array
     */
    public function findAllByContactAdresse(Contact $contact)
    {

        $qb = $this->createQueryBuilder('ad')
            ->andWhere('ad.contact = :contact')
            ->setParameter('contact', $contact)
            ->getQuery()
            ->execute();
        return $qb;
    }
  
}