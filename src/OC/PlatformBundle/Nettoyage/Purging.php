<?php
/**
 * Created by PhpStorm.
 * User: Mido
 * Date: 05/12/2016
 * Time: 17:10
 */

namespace OC\PlatformBundle\Nettoyage;

use Doctrine\ORM\EntityManager;

class Purging
{
    /**
    * @var EntityManager
    */
    protected  $em;
    public function __contruct(EntityManager $entityManager)
    {
        $this->em= $entityManager;
    }
    public function purge($days)
    {
        $advertRepository      = $this->em->getRepository('OCPlatformBundle:Advert');
        $advertSkillRepository = $this->em->getRepository('OCPlatformBundle:AdvertSkill');

        $listAdverts = $advertRepository->getAdvertsWithCategories($days);

        foreach ($listAdverts as $advert) {

            $advertSkills = $advertSkillRepository->findBy(array('advert' => $advert));

            foreach ($advertSkills as $advertSkill) {
                $this->em->remove($advertSkill);
            }

            $this->em->remove($advert);
        }

        // Et on n'oublie pas de faire un flush !
        $this->em->flush();
    }

} 