<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CheckerController extends AbstractController
{
    /**
     * @Route("/checker", name="checker")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig', [
            'controller_name' => 'IndexController',
        ]);
    }

    /**
     * @Route("/checker/palidrome", name="check_palidrome")
     * @param Request $request
     * @return Response
     */
    public function isPalindrome(Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('palindrome', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'value' => '',
                    'placeholder' => 'enter text for palindrome',
                ],
                'required' => false,
                'label' => false,
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $text = $data['palindrome'];
            if($text != null) {
                if (strrev($text) == $text){
                    $this->addFlash(
                        'success',
                        'your text is palindrome!'
                    );
                }
                else{
                    $this->addFlash(
                        'warning',
                        'your text is not palindrome!'
                    );
                }
            }else{
                $this->addFlash(
                    'danger',
                    'your text is empty!'
                );
            }
            return $this->redirectToRoute('check_palidrome');
        }
        return $this->render('checker/palidrome.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/checker/anagram", name="check_anagram")
     * @param Request $request
     * @return Response
     */
    public function isAnagram(Request $request) : Response
    {

        $form = $this->createFormBuilder()
            ->add('First_Text', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'value' => '',
                    'placeholder' => 'enter Main text for anagram',
                ],
                'required' => false,
            ])
            ->add('Comparison_Text', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'value' => '',
                    'placeholder' => 'enter Compare text for anagram',
                ],
                'required' => false,
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $text = $data['First_Text'];
            $comparison = $data['Comparison_Text'];
            if($text != null && $comparison != null)
            {
                if (count_chars($text, 1) == count_chars($comparison, 1))
                {
                    $this->addFlash(
                        'success',
                        'your text is anagram!'
                    );
                }
                else
                {
                    $this->addFlash(
                        'warning',
                        'your text is not anagram!'
                    );
                }
            }
            else
            {
                $this->addFlash(
                    'danger',
                    'your text is empty!'
                );
            }
            return $this->redirectToRoute('check_anagram');
        }
        return $this->render('checker/anagram.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/checker/pangram", name="check_pangram")
     * @param Request $request
     * @return Response
     */
    public function isPangram(Request $request) : Response
    {
        $form = $this->createFormBuilder()
            ->add('pangram', TextType::class,[
                'attr' => [
                    'class' => 'form-control',
                    'value' => '',
                    'placeholder' => 'enter text for pangram',
                ],
                'required' => false,
                'label' => false,
            ])
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $text = $data['pangram'];
            if($text != null)
            {
                $alphabetsArray = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z');
                $pangram = false;
                $characterArray = str_split($text);
                foreach ($characterArray as $character) {
                    if(ctype_alpha($character)){
                        if(ctype_upper($character)){
                            $character = strtolower($character);
                        }
                        $findKeyInAlpha = array_search($character,$alphabetsArray);
                        if($findKeyInAlpha !== false){
                            unset($alphabetsArray[$findKeyInAlpha]);
                        }
                    }
                }
                if(!$alphabetsArray)
                {
                    $this->addFlash(
                        'success',
                        'your text is pangram!'
                    );
                }
                else
                {
                    $this->addFlash(
                        'warning',
                        'your text is not pangram!'
                    );
                }
            }
            else
            {
                $this->addFlash(
                    'danger',
                    'your text is empty!'
                );
            }
            return $this->redirectToRoute('check_pangram');

        }
        return $this->render('checker/pangram.html.twig',[
            'form' => $form->createView()
        ]);
    }
}
