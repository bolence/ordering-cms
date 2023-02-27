<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PdfController extends Controller
{

    public function orderToPdf(int $orderId)
    {
        $order = Order::with('order_items', 'customer', 'delivery', 'status')->findOrFail($orderId);

        return $this->exportPdf('order', ['order' => $order], "porudžbenica_$order->number");
    }


    private function exportPdf(string $view, $args = [], string $fileName)
    {
        return PDF::loadView('pdf.' . $view, $args)
            ->setPaper('a4')
            ->setOrientation('portrait')
            ->setOption('footer-right', 'Stranica [page] od [toPage]')
            ->setOption('footer-left', 'Kreiran ' . date('d.m.Y H:i'))
            ->download($fileName . '_' . date('d.m.Y') . '.pdf');
    }
}
