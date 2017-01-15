<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    /**
     * @Route("/task/list", name="task_list")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('task/list.html.twig', [
            'title' => 'Task list',
        ]);
    }

    /**
     * @Route("/task/create", name="task_create")
     */
    public function createAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('task/list.html.twig', [
            'title' => 'Task list',
        ]);
    }
}
