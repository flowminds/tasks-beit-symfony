<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Task;
use AppBundle\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    /**
     * @Route("/", name="home")
     * @Route("/tasks", name="tasks.index")
     */
    public function indexAction()
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task, array(
            'action' => $this->generateUrl('tasks.store')
        ));

        $tasks = $this->getDoctrine()
            ->getRepository('AppBundle:Task')
            ->findBy(
                array('userId' => $this->getUser()->getId()),
                array('id' => 'DESC')
            );

        return $this->render('AppBundle:Task:index.html.twig', array(
            'tasks' => $tasks,
            'form'  => $form->createView()
        ));
    }

    /**
     * @Route("/tasks/store", name="tasks.store")
     */
    public function storeAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task->setIsCompleted(0);
            $task->setUserId($this->getUser()->getId());

            $em = $this->getDoctrine()->getManager();
            $em->persist($task);
            $em->flush();

            return $this->redirectToRoute('tasks.index');
        }

        return $this->render('AppBundle:Task:store.html.twig', array(
            'form'  => $form->createView()
        ));
    }

    /**
     * @Route("/tasks/{id}/update", name="tasks.update")
     */
    public function updateAction($id)
    {
        return $this->render('AppBundle:Task:update.html.twig', array(
            // ...
        ));
    }

    /**
     * @Route("/tasks/{id}/complete", name="tasks.complete")
     */
    public function completeAction($id)
    {
        $task = $this->getDoctrine()
            ->getRepository('AppBundle:Task')
            ->find($id);

        $task->setIsCompleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return (new JsonResponse());
    }

    /**
     * @Route("/tasks/{id}/incomplete", name="tasks.incomplete")
     */
    public function incompleteAction($id)
    {
        $task = $this->getDoctrine()
            ->getRepository('AppBundle:Task')
            ->find($id);

        $task->setIsCompleted(false);

        $em = $this->getDoctrine()->getManager();
        $em->persist($task);
        $em->flush();

        return (new JsonResponse());
    }

}
