<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{

	/**
	 * @Route("/createclient/", name="createclient")
	 */
	public function createClientAction()
	{

		$clientManager = $this->get('fos_oauth_server.client_manager.default');
		$client = $clientManager->createClient();
		$client->setRedirectUris(array('http://www.example.com'));
		$client->setAllowedGrantTypes(array('token', 'password'));
		$clientManager->updateClient($client);

		return new Response('Client Created');
	}
}
