<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Encoder\JsonEncoder;

class WebServiceController extends AbstractController
{
    
    /**
     * @Route("/ws", name="state_web_service", methods={"GET"})
     */
    public function index()
    {
        $data = array('State Web Service' => 'Activo');
        return $this->typeJsonReturn($data);
    }

    /**
     * @Route("/bbdd", name="state_bbdd", methods={"GET"})
     */
    public function stateBBDD()
    {
        //composer require geerlingguy/ping
        $host = '192.168.4.62';
        $ping = new \JJG\Ping($host);
        $latency = $ping->ping();

        if($latency !== false)
        {
            $data = array('State BBDD' => 'Activo');
        }
        else
        {
            $data = array('State BBDD' => 'Activo');
        }

        return $this->typeJsonReturn($data);

    }
    /*
     * public function devolverDatos()
     * {
     *
     * }
     * */
    //Method of how to return json
    public function typeJsonReturn($data)
    {
        $normalizers = array(new GetSetMethodNormalizer());
        $encoders = array("json" => new JsonEncoder());
        $serializer = new Serializer($normalizers, $encoders);
        $json = $serializer->serialize($data, 'json');
        $response = new Response();
        $response->setContent($json);
        $response->headers->set("Content-Type","application/json");
        return $response;
    }
}
