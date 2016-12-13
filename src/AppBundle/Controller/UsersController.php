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
        $address = $request->request->get('address');
        if (empty($name)) {
            return new View('Ingrese el nombre del usuario.', Response::HTTP_NOT_ACCEPTABLE);
        }
        $data = new Users();
        $data->setName($name);
        $data->setAddress($address);
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
        $name = $request->request->get('name');
        $address = $request->request->get('address');
        $user = $this->getDoctrine()->getRepository('AppBundle:Users')->find($id);
        if (empty($user)) {
            return new View('El usuario solicitado no existe.', Response::HTTP_NOT_FOUND);
        }
        if (empty($name)) {
            return new View('Ingrese el nombre del usuario.', Response::HTTP_NOT_ACCEPTABLE);
        }
        $user->setName($name);
        if ($address) {
            $user->setAddress($address);
        }
        $em = $this->getDoctrine()->getManager();
        $em->flush();

        return new View('El usuario fue actualizado correctamente.', Response::HTTP_OK);
    }

    /**
     * @Rest\Post("/users/upload/{id}")
     */
    public function uploadAction($id, Request $request)
    {
        $user = $this->getDoctrine()->getRepository('AppBundle:Users')->find($id);
        if (empty($user)) {
            return new View('El usuario solicitado no existe.', Response::HTTP_NOT_FOUND);
        }
        if (!$request->files->get('file')) {
            return new View('Ingrese la imagen.', Response::HTTP_NOT_FOUND);
        }
        if ($request->files->get('file')->getClientOriginalExtension() !== 'jpg' && $request->files->get('file')->getClientOriginalExtension() !== 'gif') {
            return new View('Ingrese una imagen en formato jpg o gif.', Response::HTTP_NOT_FOUND);
        }
        $filename = $request->files->get('file')->getPathname();
        $uploadfile = sprintf('/tmp/%s', $request->files->get('file')->getClientOriginalName());
        copy($filename, $uploadfile);
        // Reemplazar el uso de shell_exec.
        $result = shell_exec("curl -s -XPOST https://api.olx.com/v1.0/users/images -F 'file=@$uploadfile'");
        unlink($uploadfile);
        $response = json_decode($result);
        if (!isset($response->url)) {
            return new View('La imagen no se pudo actualizar.', Response::HTTP_NOT_ACCEPTABLE);
        }
        $user->setPicture('https://images01.olx-st.com/'.$response->url);
        $this->getDoctrine()->getManager()->flush();

        return new View('La imagen fue actualizada correctamente.', Response::HTTP_OK);
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
