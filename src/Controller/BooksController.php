<?php
// src/Controller/BooksController.php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Ksiazki;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\KsiazkiType;
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class BooksController extends AbstractController
{   
    #[Route('/', name: 'home')]
    public function index() : Response
    {
        return $this->render('index.html.twig', [
            'app_name' => $_ENV["APP_NAME"]
        ]);
    }
    
    #[Route('/books/index/{pageNum}', defaults: ['pageNum' => 1], name: 'books_index', requirements: ['pageNum' => '\d+'])]
    public function books_index(EntityManagerInterface $entityManager, int $pageNum) : Response
    {
        $numRows = (int)$_ENV["PAGINATION_NUM_ROWS"];
        
        if ($pageNum == 1)
        {
            $offset = 0;
        }
        else if ($pageNum > 1)
        {
            $offset = ($pageNum - 1) * $numRows;
        }
        
        $ksiazki = $entityManager->getRepository(Ksiazki::class)->getAllPagination($numRows, $offset);
        
        $countRows = (int)$entityManager->getRepository(Ksiazki::class)->getCountAllRows();
        
        if (($offset + $numRows) <= $countRows)
        {
            $a = $offset + $numRows;
        }
        else
        {
            $a = $countRows;
        }
        
        if ($countRows > 0)
        {
            if ($countRows % $numRows == 0)
            {
                $countPages = (int)($countRows / $numRows);
            }
            else
            {
                $countPages = ceil($countRows / $numRows);
            }
        }
        else
        {
            $countPages = 0;
        }
        
        if ($pageNum > $countPages and $countPages > 0)
        {
            $view = $this->renderView('bundles/TwigBundle/Exception/error404.html.twig', [
                'app_name' => $_ENV["APP_NAME"],
            ], 404);
            
            return new Response($view, 404);
        }
        
        return $this->render('books/index.html.twig', [
            'app_name' => $_ENV["APP_NAME"],
            'ksiazki' => $ksiazki,
            'numRows' => $numRows,
            'offset' => $offset,
            'pageNum' => $pageNum,
            'countRows' => $countRows,
            'a' => $a,
            'countPages' => $countPages
        ]);
    }
    
    #[Route('/books/add', name: 'books_add', methods: ['GET', 'POST'])]
    public function books_add(Request $request, EntityManagerInterface $entityManager) : Response
    {
        $ksiazki = new Ksiazki();
        $form = $this->createForm(KsiazkiType::class, $ksiazki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->persist($ksiazki);
            $entityManager->flush();
            $this->addFlash('success', 'Książka została dodana');

            return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('books/add_edit.html.twig', [
            'app_name' => $_ENV["APP_NAME"],
            'form' => $form
        ]);
    }
    
    #[Route('/books/edit/{id}', name: 'books_edit', methods: ['GET', 'POST'])]
    public function books_edit(Request $request, Ksiazki $ksiazki, EntityManagerInterface $entityManager) : Response
    {
        $form = $this->createForm(KsiazkiType::class, $ksiazki);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $entityManager->flush();
            $this->addFlash('success', 'Książka została zaktualizowana');
            
            return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('books/add_edit.html.twig', [
            'app_name' => $_ENV["APP_NAME"],
            'form' => $form
        ]);
    }
    
    #[Route('/books/delete/{id}', name: 'books_delete', methods: ['POST'])]
    public function books_delete(Request $request, Ksiazki $ksiazki, EntityManagerInterface $entityManager) : Response
    {
        if ($this->isCsrfTokenValid('delete'.$ksiazki->getId(), $request->request->get('_token')))
        {
            $entityManager->remove($ksiazki);
            $entityManager->flush();
            $this->addFlash('success', 'Książka została usunięta');
        }

        return $this->redirectToRoute('books_index', [], Response::HTTP_SEE_OTHER);
    }
}
