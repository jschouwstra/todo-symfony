<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;

/**
 * Class TaskController
 * @package AppBundle\Controller
 */
class TaskController extends Controller
{
//    /**
//     * @Route("/", name="home")
//     */
//    public function home(Request $request)
//    {
//        // replace this example code with whatever you need
//        return $this->render('task/list.html.twig', [
//            'title' => 'Task list',
//        ]);
//    }

    /**
     * @Route("/task", name="task_list")
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Task');
        $tasks = $repository->findAll();
//        $tasks = $this->getDoctrine()
//            ->getRepository('AppBundle:Task')
//            ->findAll();

        return $this->render('task/list.html.twig', [
            'tasks' => $tasks,
            'title' => 'Task list'
        ]);
    }

    /**
     * @Route("/task/create", name="task_create")
     */
    public function createAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();

            $doctrine = $this->getDoctrine()->getManager();
            $doctrine->persist($task);
            $doctrine->flush();
            return $this->redirectToRoute('home');

        }

        return $this->render('task/new.html.twig', [
            'title' => 'New task',
            'form' => $form->createView(),
        ]);

    }
    /**
     * @Route("/task/{id}/edit", name="task_edit")
     */
    public function editAction(Request $request, Task $task)
    {
        $editForm = $this->createForm('AppBundle\Form\TaskType', $task);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_edit', array('id' => $task->getId()));
        }

        return $this->render('task/new.html.twig', array(
            'title' => 'Task edit',
            'task' => $task,
            'form' => $editForm->createView(),
        ));
    }
}
