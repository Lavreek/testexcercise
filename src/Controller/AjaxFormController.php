<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\ProductCardsRepository;
use App\Entity\ProductCards;



class AjaxFormController extends AbstractController
{
    #[Route('/ajaxform/', methods: ['POST'], name: 'ajax_form')]
    public function index(Request $request): Response
    {
    	return new JsonResponse($request->request->get('name'));

    	if ($request->isXMLHttpRequest()) {         
	        return new JsonResponse(array('data' => 'this is a json response'));
	    }

	    return new Response('This is not ajax!', 400);
        // return $this->render('ajax_form/index.html.twig', [
        //     'controller_name' => $test,
        // ]);
    }

    #[Route('/ajaxform/create', methods: ['POST'], name: 'ajaxformcreate')]
    public function create(Request $request, ManagerRegistry $doctrine): Response
    {
    	$entityManager = $doctrine->getManager();

    	$product = new ProductCards();
        $product->setHeader($request->request->get('header'));
        $product->setBodydescription($request->request->get('bodydescription'));

        $entityManager->persist($product);

        $entityManager->flush();

    	return new JsonResponse(json_encode(array('ok' => "true")));
    }

    #[Route('/ajaxform/get', methods: ['POST'], name: 'ajaxformget')]
    public function get(Request $request, ProductCardsRepository $productCardsRepository): Response
    {
    	$id = explode("_", $request->request->get('element'))[1];


    	$product = $productCardsRepository
            ->find($id);

    	return new JsonResponse(json_encode(array('header' => $product->getHeader(), 'description' => $product->getBodydescription())));
    }
}
