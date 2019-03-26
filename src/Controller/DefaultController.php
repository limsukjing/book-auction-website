<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $template = 'default/index.html.twig';
        $args = [
        ];

        return $this->render($template, $args);
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        $template = 'default/about.html.twig';
        $args = [
        ];

        return $this->render($template, $args);
    }

    /**
     * @Route("/sitemap", name="sitemap")
     */
    public function sitemapAction()
    {
        $template = 'default/sitemap.html.twig';
        $args = [
        ];

        return $this->render($template, $args);
    }


}
