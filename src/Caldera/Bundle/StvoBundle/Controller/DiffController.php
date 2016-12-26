<?php

namespace Caldera\Bundle\StvoBundle\Controller;

use Caldera\Bundle\StvoBundle\Form\Type\DiffType;
use Caldera\Bundle\StvoBundle\StvoDiff\DiffParser;
use SebastianBergmann\Diff\Differ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DiffController extends Controller
{
    public function diffAction(Request $request, string $versionSlug1, string $versionSlug2, string $number): Response
    {
        if ($request->isMethod('post')) {
            $diff = $request->request->get('diff');

            return $this->redirectToRoute('caldera_stvo_diff', [
                'versionSlug1' => $diff['oldVersion'],
                'versionSlug2' => $diff['newVersion'],
                'number' => 2
            ]);
        }

        $version1 = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findOneBySlug($versionSlug1);
        $version2 = $this->getDoctrine()->getRepository('CalderaStvoBundle:Version')->findOneBySlug($versionSlug2);

        $paragraph1 = $this->getDoctrine()->getRepository('CalderaStvoBundle:Paragraph')->findOneByVersionNumber($version1, $number);
        $paragraph2 = $this->getDoctrine()->getRepository('CalderaStvoBundle:Paragraph')->findOneByVersionNumber($version2, $number);

        $differ = new Differ('');
        $diff = $differ->diff($paragraph1->getText(), $paragraph2->getText());

        $diffParser = new DiffParser($diff);
        $diffParser->parse();

        $diffedLines = $diffParser->getDiffedLines();

        $formData = [
            'oldVersion' => $version1,
            'newVersion' => $version2
        ];

        $form = $this->createForm(DiffType::class, $formData);

        return $this->render('CalderaStvoBundle:Diff:view.html.twig',
            [
                'diffedLines' => $diffedLines,
                'diffForm' => $form->createView()
            ]);
    }
}
