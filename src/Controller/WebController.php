<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class WebController extends AbstractController
{
    /**
     * @Route("/web", name="web")
     */
    public function index()
    {
        return $this->render('web/index.html.twig.', [
            'controller_name' => 'WebController',
        ]);
    }

    /**
     * @Route("/web/peer_video", name="peer")
     */
    public function video()
    {
        return $this->render('web/video.html.twig.', [
            'controller_name' => 'WebController',
        ]);
    }
}
