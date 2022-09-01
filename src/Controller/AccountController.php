<?php

namespace App\Controller;

use App\Entity\ObjectToSell;
use App\Entity\Shop;
use App\Form\ObjectType;
use App\Form\ShopType;
use App\Repository\ShopRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{

    protected EntityManagerInterface $em;
    protected UserRepository $userRepo;
    protected ShopRepository $shopRepo;
    public function __construct(EntityManagerInterface $em, UserRepository $userRepo, ShopRepository $shopRepo)
    {
        $this->em = $em;
        $this->userRepo = $userRepo;
        $this->shopRepo = $shopRepo;
    }

    #[Route('/account', name: 'account')]
    public function account(Request $request): Response
    {
        $shop = new Shop();
        $objectToSell = new ObjectToSell();

        $shopForm = $this->createForm(ShopType::class, $shop)->handleRequest($request);
        $objectForm = $this->createForm(ObjectType::class, $objectToSell)->handleRequest($request);

        $showShopForm = true;
        $userShop = $this->shopRepo->findOneBy(['user' => 9]);
        if ($this->getUser()->getId() == $userShop->getUser()->getId()) {
            $showShopForm = false;
        }


        if ($shopForm->isSubmitted() && $shopForm->isValid()) {
            $shop->setUser($this->getUser());

            $this->em->persist($shop);
            $this->em->flush();

            return $this->redirectToRoute("account");
        }

        if ($objectForm->isSubmitted() && $objectForm->isValid()) {
            $objectToSell->setShop($userShop);
            $objectToSell->setCreatedAt(new \DateTimeImmutable());
            $objectToSell->setUpdatedAt(new \DateTimeImmutable());

            $this->em->persist($objectToSell);
            $this->em->flush();

            return $this->redirectToRoute("account");
        }


        return $this->render('account/account.html.twig', [
            "shopForm" => $shopForm->createView(),
            "objectForm" => $objectForm->createView(),
            "showShopForm" => $showShopForm,
            "shop" => $userShop
        ]);
    }
}
