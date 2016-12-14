<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Users;

class UsersController extends FOSRestController
{
    /**
     * @Rest\Get("/users")
     */
    public function getAction()
    {
        $users = $this->getDoctrine()->getRepository('AppBundle:Users')->findAll();
        if ($users == null) {
            return new View('Actualmente no hay usuarios.', Response::HTTP_NOT_FOUND);
        }

        return $users;
    }

    /**
     * @Rest\Get("/users/{id}")
     */
    public function idAction($id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:Users')->find($id);
        if ($user === null) {
            return new View('El usuario solicitado no existe.', Response::HTTP_NOT_FOUND);
        }

        return $user;
    }

    /**
     * @Rest\Post("/users/")
     */
    public function postAction(Request $request)
    {
        $name = $request->request->get('name');
        $email = $request->request->get('email');
        if (empty($name)) {
            return new View('Ingrese el nombre del usuario.', Response::HTTP_NOT_ACCEPTABLE);
        }
        $data = new Users();
        $data->setName($name);
        $data->setEmail($email);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();

        return new View('El usuario fue creado correctamente.', Response::HTTP_OK);
    }

    /**
     * @Rest\Put("/users/{id}")
     */
    public function updateAction($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:Users')->find($id);
        if (empty($user)) {
            return new View('El usuario solicitado no existe.', Response::HTTP_NOT_FOUND);
        }
        $name = $request->request->get('name');
        if (empty($name)) {
            return new View('Ingrese el nombre del usuario.', Response::HTTP_NOT_ACCEPTABLE);
        }
        $user->setName($name);
        $email = $request->request->get('email');
        if ($email) {
            $user->setEmail($email);
        }
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new View('El usuario fue actualizado correctamente.', Response::HTTP_OK);
    }

    /**
     * @Rest\Delete("/users/{id}")
     */
    public function deleteAction($id)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:Users')->find($id);
        if (empty($user)) {
            return new View('El usuario solicitado no existe.', Response::HTTP_NOT_FOUND);
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($user);
        $em->flush();

        return new View('El usuario fue eliminado correctamente.', Response::HTTP_OK);
    }
}
