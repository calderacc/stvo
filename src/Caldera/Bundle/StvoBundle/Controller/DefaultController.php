<?php

namespace Caldera\Bundle\StvoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function indexAction(Request $request, string $versionSlug = null): Response
    {
        $law = $this->getDoctrine()->getRepository('CalderaStvoBundle:Law')->find(1);

        if ($versionSlug) {
            $version = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findOneBySlug($versionSlug);
        } else {
            $version = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findCurrentVersionForLaw($law);
        }

        $versionList = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findAll();
        $paragraphList = $this->getDoctrine()->getRepository('CalderaStvoBundle:Paragraph')->findByVersion($version);

        return $this->render(
            'CalderaStvoBundle:Stvo:overview.html.twig',
            [
                'paragraphList' => $paragraphList,
                'law' => $law,
                'version' => $version,
                'versionList' => $versionList
            ]);
    }

    public function paragraphVersionAction(Request $request, string $number, string $versionSlug = null): Response
    {
        $law = $this->getDoctrine()->getRepository('CalderaStvoBundle:Law')->find(1);

        if ($versionSlug) {
            $version = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findOneBySlug($versionSlug);
        } else {
            $version = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findCurrentVersionForLaw($law);
        }

        $versionList = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findAll();
        $paragraph = $this->getDoctrine()->getRepository('CalderaStvoBundle:Paragraph')->findOneByVersionNumber($version, $number);

        return $this->render(
            'CalderaStvoBundle:Stvo:paragraph.html.twig',
            [
                'law' => $law,
                'version' => $version,
                'versionList' => $versionList,
                'paragraph' => $paragraph
            ]
        );
    }
}
