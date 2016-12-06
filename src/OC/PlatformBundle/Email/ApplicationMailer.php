<?php
/**
 * Created by PhpStorm.
 * User: Mido
 * Date: 02/12/2016
 * Time: 17:17
 */

namespace OC\PlatformBundle\Email;

use OC\PlatformBundle\Entity\Application;

class ApplicationMailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendNewNotification(Application $application)
    {
        $message = new \Swift_Message(
            'Nouvelle candidature',
            'Vous avez reçu une nouvelle candidature.'
        );

        $message// Ici bien sûr il faudrait un attribut "email", j'utilise "author" à la place
            ->addTo($application->getAdvert()->getAuthor())
            ->addFrom($application->getAuthor())
        ;

        $this->mailer->send($message);
    }
}