<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;

class TaskController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function home(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('task/list.html.twig', [
            'title' => 'Task list',
        ]);
    }

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
        $task = new Task();
        $task->setName('Write a blog post');
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($task);
            $doctrine->flush();
        }

        return $this->render('task/new.html.twig', [
            'title' => 'Task list',
            'form' => $form->createView(),
        ]);

    }
}
