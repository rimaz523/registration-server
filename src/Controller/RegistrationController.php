<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Form\SearchClientsForm;
use Symfony\Component\HttpFoundation\Request;
use App\Formatter\RegisteredUsersCSVExportFormatter;

/**
 * Description of RegistrationController
 *
 * @author rimaz
 */
class RegistrationController extends Controller
{

    /**
     * @Route("/home",  name="home")
     * @Method({"GET", "POST"})
     * @return Response
     */
    public function home(Request $request)
    {
        $form = $this->createForm(SearchClientsForm::class);
        $searchParameters = array('isExport' => false, 'limit' => $this->getParameter('app.items_per_page'), 'offset' => 0);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $searchParameters = $this->buildClientSearchParameters($form->getData());
        }
        
        $registeredClients = $this->getDoctrine()->getRepository(\App\Entity\RegUsers::class)->searchRegisteredUsers($searchParameters);
        if ($searchParameters['isExport']) {
            $csvformatter = new RegisteredUsersCSVExportFormatter();
            $response = new Response($csvformatter->getCSVData($registeredClients));
            $response->headers->set('Content-Type', $csvformatter->getContentType());
            $response->headers->set('Content-Disposition', sprintf('attachment; filename="%s"', $csvformatter->getFileName()));
            return $response;
        }
        $totalCount = $this->getDoctrine()->getRepository(\App\Entity\RegUsers::class)->searchRegisteredUsers($searchParameters, true);
        return $this->render('registration/home.html.twig', array('registeredClients' => $registeredClients,
                    'form' => $form->createView(), 'total' => $totalCount, 'limit' => $this->getParameter('app.items_per_page'), 'offset' => $searchParameters['offset']));
    }

    private function buildClientSearchParameters($formData)
    {
        $searchParameters = array('limit' => $this->getParameter('app.items_per_page'), 'orderBy' => array('field' => 'date', 'order' => 'DESC'));
        $searchParameters['company'] = $formData['company'];
        $searchParameters['countryCode'] = $formData['countryCode'];
        $searchParameters['offset'] = $formData['offset'];
        $searchParameters['isExport'] = $formData['actionType'] == 'export';
        return $searchParameters;
    }
}
