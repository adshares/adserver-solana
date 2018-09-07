<?php
/**
 * Copyright (c) 2018 Adshares sp. z o.o.
 *
 * This file is part of AdServer
 *
 * AdServer is free software: you can redistribute it and/or modify it
 * under the terms of the GNU General Public License as published
 * by the Free Software Foundation, either version 3 of the License,
 * or (at your option) any later version.
 *
 * AdServer is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty
 * of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with AdServer.  If not, see <https://www.gnu.org/licenses/>
 */

namespace Adshares\Controller;

use Adshares\Entity\Campaign;
use Adshares\Helper\GzippedStreamedResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Some historic controller. Probably not used
 *
 */
class WebsiteController extends Controller
{

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        
        Campaign::getRepository($em)->findAll();
        
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR
        ));
    }

    /**
     * @Route("/hashTest")
     */
    public function hashTestAction(Request $request)
    {
        if ($this->container->has('profiler')) {
            $this->container->get('profiler')->disable();
        }
        $em = $this->getDoctrine()->getManager();
        
        Campaign::getRepository($em)->findAll();
        
        // replace this example code with whatever you need
        return $this->render('default/hash_test.html.twig', array(
            'base_dir' => realpath($this->container->getParameter('kernel.root_dir') . '/..') . DIRECTORY_SEPARATOR
        ));
    }

    /**
     * @Route("/hashTest/iframe", methods={"GET", "OPTIONS"})
     */
    public function hashTestIframeAction(Request $request)
    {
        if ($request->getRealMethod() == 'OPTIONS') {
            $response = new Response('', 204);
        } else {
            $response = new GzippedStreamedResponse();
        }
        
        if ($request->headers->has("Origin")) {
            $response->headers->set("Access-Control-Allow-Origin", $request->headers->get("Origin"));
            $response->headers->set("Access-Control-Allow-Credentials", "true");
            $response->headers->set("Access-Control-Allow-Methods", "GET, POST, OPTIONS");
        }
        
        if ($request->getRealMethod() == 'OPTIONS') {
            $response->headers->set('Access-Control-Max-Age', 1728000);
            return $response;
        }
        
        $response->setCallback(function () {
            echo '<!DOCTYPE html>
        <head>
        <meta charset="UTF-8" />
        <meta name="keywords" content="gry online,gra online,mmorpg,rpg,fantasy,mfo3,mf3">
        <title>Welcome!</title>
                <link rel="icon" type="image/x-icon" href="/favicon.ico" />
	    
            </head>    <body>
            <div id="log"></div>
            <div id="wrapper">
    	NOSCRIPT </div>
   		<script type="text/javascript">
            
            document.getElementById(\'wrapper\').innerHTML = \'YESSCRIPT\';

            </script>
            <script type="text/javascript">
            //top.document.getElementById(\'secret\').innerHTML = \'thisissecret\';

            </script>
            <script type="text/javascript" src="http://adshares.zel.pl/js/supply/test/test_iframe.js"></script>
   </body></html>';
        });
        
        return $response;
    }
}
