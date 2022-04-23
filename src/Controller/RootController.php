<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\ProductCards;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class RootController extends AbstractController
{
    #[Route('/root', name: 'app_root')]
    public function index(ManagerRegistry $doctrine, MailerInterface $mailer): Response
    {

    	$email = (new Email())
            ->from('twwoimiv@gmail.com')
            ->to('LavreekSoLacki@yandex.ru')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');

        $mailer->send($email);

    	$repository = $doctrine->getRepository(ProductCards::class);

    	$products = $repository->findAll();

        return $this->render('root/index.html.twig', [
            'products' =>  $products,
        ]);
    }
}
