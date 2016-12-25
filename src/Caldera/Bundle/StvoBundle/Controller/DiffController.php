<?php

namespace Caldera\Bundle\StvoBundle\Controller;

use SebastianBergmann\Diff\Differ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DiffController extends Controller
{
    public function diffAction(Request $request, string $versionSlug1, string $versionSlug2, string $number): Response
    {
        $law = $this->getDoctrine()->getRepository('CalderaStvoBundle:Law')->find(1);

        $version1 = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findOneBySlug($versionSlug1);
        $version2 = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findOneBySlug($versionSlug2);

        $paragraph1 = $this->getDoctrine()->getRepository('CalderaStvoBundle:Paragraph')->findOneByVersionNumber($version1, $number);
        $paragraph2 = $this->getDoctrine()->getRepository('CalderaStvoBundle:Paragraph')->findOneByVersionNumber($version2, $number);

        $differ = new Differ();

        print_r($differ->diff($paragraph1->getText(), $paragraph2->getText()));
        return new Response();
    }
}
