<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ApiOrderItemController extends Controller
{

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $orderItem = OrderItem::findOrFail($id);

        try {
            $orderItem->delete();
        } catch (\Throwable $th) {
            info('Order item deletion ' . $th->getMessage() . ' ' . $th->getLine() . ' ' . $th->getCode());
            return response()->json([
                'message' => 'Došlo je do greške prilikom brisanja',
            ], 400);
        }

        info("Order item $orderItem->id deleted");

        return response()->json([
            'message' => 'Uspešno izbrisano'
        ], 200);
    }

    /**
     * Update order items
     *
     * @param Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id): \Illuminate\Http\JsonResponse
    {
        $orderItem = OrderItem::findOrFail($id);

        try {
            $orderItem->update($request->all());
        } catch (\Throwable $th) {
            info($th);
            return response()->json(['message' => 'Doslo je do greške prilikom izmene proizvoda'], 400);
        }

        return response()->json(['message' => 'Uspešno izmenjen proizvod'], 200);
    }

    /**
     * Show single order item
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'order_items' => OrderItem::findOrFail($id),
        ], 200);
    }
}
