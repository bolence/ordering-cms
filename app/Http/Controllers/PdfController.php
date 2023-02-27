<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PdfController extends Controller
{

    /**
     * Undocumented function
     *
     * @param integer $orderId
     * @return void
     */
    public function orderToPdf(int $orderId)
    {
        $order = Order::with('order_items', 'customer', 'delivery', 'status')->findOrFail($orderId);

        return $this->exportPdf('order', ['order' => $order], "porudžbenica_$order->number");
    }

    /**
     * Undocumented function
     *
     * @return void
     */
    public function todayOrders()
    {
        $orders = Order::withCount('order_items')->with('customer', 'delivery', 'status')->whereDate('created_at', today())->get();

        return $this->exportPdf('today_orders', ['orders' => $orders], "sve_porudžbenice_" . today()->format('d.m.Y'), 'landscape');
    }


    private function exportPdf(string $view, $args = [], string $fileName, $orientation = 'portrait')
    {
        return PDF::loadView('pdf.' . $view, $args)
            ->setPaper('a4')
            ->setOrientation($orientation)
            ->setOption('footer-right', 'Stranica [page] od [toPage]')
            ->setOption('footer-left', 'Kreiran ' . date('d.m.Y H:i'))
            ->download($fileName . '_' . date('d.m.Y') . '.pdf');
    }
}
