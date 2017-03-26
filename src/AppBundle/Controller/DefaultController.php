<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // http://blog.logicexception.com/2012/04/securing-syfmony2-rest-service-wiith.html

        // http://localhost:8080/app_dev.php/oauth/v2/auth?client_id=2_23c1we6zwpxcw80gc8g0sgogoc8os084s04ck40s44488swgc&redirect_uri=http%3A//www.example.com&response_type=code
        // http://localhost:8080/app_dev.php/oauth/v2/auth?client_id=2_23c1we6zwpxcw80gc8g0sgogoc8os084s04ck40s44488swgc&redirect_uri=http%3A//www.example.com&response_type=token

//        $clientManager = $this->get('fos_oauth_server.client_manager.default');
//        $client = $clientManager->createClient();
//        $client->setRedirectUris(array('http://www.example.com'));
//        $client->setAllowedGrantTypes(array('token', 'authorization_code'));
//        $clientManager->updateClient($client);
//
//        return $this->redirect($this->generateUrl('fos_oauth_server_authorize', array(
//            'client_id'     => $client->getPublicId(),
//            'redirect_uri'  => 'http://www.example.com',
//            'response_type' => 'code'
//        )));

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }
}
