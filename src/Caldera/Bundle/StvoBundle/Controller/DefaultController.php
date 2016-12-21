<?php

namespace Caldera\Bundle\StvoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function overviewAction(Request $request): Response
    {
        $paragraphList = $this->getDoctrine()->getRepository('CalderaStvoBundle:Paragraph')->findAll();

        return $this->render(
            'CalderaStvoBundle:Stvo:overview.html.twig',
            [
                'paragraphList' => $paragraphList
            ]
        );
    }
}
