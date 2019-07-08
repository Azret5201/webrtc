<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index()
    {
        return $this->render('index/index.html.twig.', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/index/peer", name="peerr")
     */
    public function peer(){
        return $this->render('index/per.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("index/mes", name="mes")
     */
    public function mes(){
        return $this->render('index/mes.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }
}
