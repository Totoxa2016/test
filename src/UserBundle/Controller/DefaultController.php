<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use UserBundle\Entity\Usr;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class DefaultController extends Controller
{
    /**
     * @Route("/user/register")
     */
    public function registerAction(Request $request)
    {
        $usr = new Usr();
        $form = $this->createForm(\UserBundle\Form\UsrType::class, $usr)
                ->add('password', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => 'The password fields must match.',
                    'options' => array('attr' => array('class' => 'password-field')),
                    'required' => true,
                    'first_options'  => array('label' => 'Password'),
                    'second_options' => array('label' => 'Repeat Password'),
                ))
                ->add('save', SubmitType::class);
        $form->handleRequest($request);
        
        if ($request->isMethod('POST') && $form->isValid()){
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($usr);
            $em->flush();
            return $this->render('UserBundle:Default:register-success.html.twig', [
                'usr' => $usr
            ]);
        }
        return $this->render('UserBundle:Default:register.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
