<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/pressure", name="pressure_index")
     */
    public function pressureAction(Request $request)
    {
        $array = array();

        $items = $this->getDoctrine()
            ->getRepository('AppBundle:Pressure')
            ->findAll();

        foreach ($items as $item){

            $json = array(
                'id' => $item->getId(),
                'value' => $item->getValue()
            );

            array_push($array,$json);
        }

        $json = json_encode($array);

        return new Response($json);
    }

    /**
     * @Route("/pressure/{id}", name="pressure_detail")
     */
    public function pressureDetailAction(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $item = $this->getDoctrine()
                ->getRepository('AppBundle:Pressure')
                ->find($id);

            $value = $request->request->get('value');

            $item->setValue($value);

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
        }

        $item = $this->getDoctrine()
            ->getRepository('AppBundle:Pressure')
            ->find($id);

//            $json = array(
//                'id'=>$item->getId(),
//                'value' => $item->getValue()
//            );

        $json = json_encode($item->getValue());

        $response = new Response($json);

        $response->headers->set('Content-Type', 'text/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }

    /**
     * @Route("/ultrasonic", name="ultrasonic_index")
     */
    public function ultrasonicAction(Request $request)
    {
        $array = array();

        $items = $this->getDoctrine()
            ->getRepository('AppBundle:Ultrasonic')
            ->findAll();

        foreach ($items as $item){

            $json = array(
                'id'=>$item->getId(),
                'value' => $item->getValue()
            );

            array_push($array,$json);
        }

        $json = json_encode($array);

        return new Response($json);
    }

    /**
     * @Route("/ultrasonic/{id}", name="homepage")
     */
    public function ultrasonicDetailAction(Request $request, $id)
    {
        if ($request->isMethod('POST')) {
            $item = $this->getDoctrine()
                ->getRepository('AppBundle:Ultrasonic')
                ->find($id);

            $value = $request->request->get('value');

            $item->setValue($value);

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();
        }

        $item = $this->getDoctrine()
            ->getRepository('AppBundle:Ultrasonic')
            ->find($id);

//        $json = array(
//            'id'=>$item->getId(),
//            'value' => $item->getValue()
//        );

//        $json = json_encode($json);

//        return new Response($json);
        $json = json_encode($item->getValue());

        $response = new Response($json);

        $response->headers->set('Content-Type', 'text/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        return $response;
    }
}
