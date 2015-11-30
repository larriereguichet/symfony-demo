<?php

namespace FormationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @param string $civility
     * @param string $name
     *
     * @return Response
     */
    public function indexAction($civility, $name)
    {
        return $this->render('FormationBundle:Default:index.html.twig', [
            'civility' => $civility,
            'name'     => $name,
        ]);
    }
}
