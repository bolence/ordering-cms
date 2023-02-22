<?php

namespace App\Http\Controllers\Api;

use App\Models\OrderItem;
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
}
