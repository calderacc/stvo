<?php

namespace Caldera\Bundle\StvoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request): Response
    {
        $law = $this->getDoctrine()->getRepository('CalderaStvoBundle:Law')->find(1);
        $version = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findOneBySlug('2013-neufassung');

        $paragraphList = $this->getDoctrine()->getRepository('CalderaStvoBundle:Paragraph')->findByLawVersion($law, $version);

        return $this->render(
            'CalderaStvoBundle:Stvo:overview.html.twig',
            [
                'paragraphList' => $paragraphList
            ]
        );
    }

    public function paragraphVersionAction(Request $request, string $version): Response
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
