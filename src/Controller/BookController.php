<?php

namespace App\Controller;
use App\Entity\Book;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\BookRepository;

class BookController extends AbstractController
{
  

    private $repo ;

    public function __construct(BookRepository $r)
    {
       $this->repo=$r; 
    }  
      /**
     * @Route("/", name="book.index")
     */
    public function index()
    {
        return $this->render('book/index.html.twig', [
            'controller_name' => 'BookController',
        ]);
    }

    /**
     * @Route("/list", name="book.list")
     */
    public function list()
    {
        $books=$this->getDoctrine()->getRepository(Book::class)->findAll();
        return $this->render('book/list.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/show/{id}", name="book.show")
     */
    public function show($id)
    {
        
        $books=$this->getDoctrine()->getRepository(Book::class)->find($id);
      
        if (!$books) {
            throw $this->createNotFoundException(
                'Le livre de id :   '.$id. 'est inexistant...'
            );
        }
       
        return $this->render('book/show.html.twig', [
            'books' => $books,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="book_delete")
     */
    public function delete($id)
    {
        $book=$this->getDoctrine()->getRepository(Book::class)->find($id);
      
        if (!$book) {
            throw $this->createNotFoundException(
                'Le livre de id :   '.$id. 'est inexistant...'
            );
        }
        $em=$this->getDoctrine()->getManager();
        $em->remove($book);
        $em->flush();
        return $this->redirectToRoute('book.list');
    }

}
