<?php

declare(strict_types=1);

namespace App\Controller;

use App\Form\CalculatePriceForm;
use App\Service\CalculatePriceService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CommonController extends AbstractController
{
    /**
     * Понимаю что метод POST, и, возможно, подразумевалось создание сущности - если да, готов доработать.
     */
    #[Route('/calculate-price', methods: ['POST'])]
    public function calculatePrice(Request $request, CalculatePriceService $calculatePriceService): Response
    {
        $form = $this->createForm(CalculatePriceForm::class);
        $form->submit($request->getPayload()->all());

        if (!$form->isValid()) {
            $errors = (string) $form->getErrors(deep: true, flatten: false);

            return $this->json(data: ['errors' => $errors], status: 400);
        }

        $data = $form->getData();
        $calculatedPrice = $calculatePriceService->calculate(
            product: $data['product'],
            taxNumber: $data['taxNumber'],
            couponEnum: $data['couponCode'],
        );

        return $this->json(data: ['calculatedPrice' => $calculatedPrice], status: 200);
    }
}
