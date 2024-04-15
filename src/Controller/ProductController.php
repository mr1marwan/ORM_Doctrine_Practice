<?php

// src/Controller/ProductController.php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProductController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/', name: 'product_index', methods: ['GET'])]
    public function index(): Response
    {
        $products = $this->entityManager->getRepository(Product::class)->findAll();

        return $this->render('product/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/create', name: 'product_create', methods: ['GET'])]
    public function create(): Response
    {
        return $this->render('product/create.html.twig');
    }

    #[Route('', name: 'product_store', methods: ['POST'])]
    public function store(Request $request): Response
    {
        $product = new Product();
        $product->setName($request->request->get('name'));
        $product->setPrice($request->request->get('price'));

        $this->entityManager->persist($product);
        $this->entityManager->flush();

        return $this->redirectToRoute('product_index');
    }

    #[Route('/edit/{id}', name: 'editproduct', methods: ['GET'])]
    public function edit(int $id): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->find($id);
        
        if (!$product) {
            return $this->json(['message' => 'Product not found'], 404);
        }
        
        return $this->render('product/edit.html.twig', [
            'product' => $product,
        ]);
    }
    
    
    
    #[Route('/updateprod/{id}', name: 'product_update', methods: ['POST', 'PUT'])]
    public function update(Request $request, int $id)
    {
        $product = $this->entityManager->getRepository(Product::class)->find($id);
    
        if (!$product) {
            return $this->json(['message' => 'Product not found'], 404);
        }
    
        $data = $request->request->all();
    
        if (isset($data['name'])) {
            $product->setName($data['name']);
        }
        if (isset($data['price'])) {
            $product->setPrice($data['price']);
        }
        
        $this->entityManager->flush(); 
        
        
        return $this->redirectToRoute('product_index');
    }

    #[Route('/deleteprod/{id}', name: 'deleteprod', methods: ['GET'])]
    public function delete(int $id): Response
    {
        $product = $this->entityManager->getRepository(Product::class)->find($id);
    
        if (!$product) {
            return $this->json(['message' => 'Product not found'], 404);
        }
    
        $this->entityManager->remove($product);
        $this->entityManager->flush();
    
        return $this->redirectToRoute('product_index');
    }
}
