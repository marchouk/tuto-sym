<?php
/**
 * Created by PhpStorm.
 * User: Mido
 * Date: 30/11/2016
 * Time: 16:19
 */

namespace OC\PlatformBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="application")
 * @ORM\Entity(repositoryClass="OC\PlatformBundle\Repository\ApplicationRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Application
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(name="author", type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(name="content", type="text")
     */

    private $content;

    /**
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="OC\PlatformBundle\Entity\Advert", inversedBy="applications")
     * @ORM\JoinColumn(nullable=false)
     */
    private $advert;

    public function __construct()
    {
        $this->date = new \Datetime();
    }

    public function getId()
    {
        return $this->id;
    }

    public function setAuthor($author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setDate(\Datetime $date)
    {
        $this->date = $date;
    }

    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set advert
     *
     * @param \OC\PlatformBundle\Entity\Advert $advert
     *
     * @return Application
     */
    public function setAdvert(Advert $advert)
    {
        $this->advert = $advert;
    }

    /**
     * Get advert
     *
     * @return \OC\PlatformBundle\Entity\Advert
     */
    public function getAdvert()
    {
        return $this->advert;
    }

    /**
     * @ORM\PrePersist
     */
    public function increase()
    {
        $this->getAdvert()->increaseApplication();
    }

    /**
     * @ORM\PreRemove
     */
    public function decrease()
    {
        $this->getAdvert()->decreaseApplication();
    }
}
