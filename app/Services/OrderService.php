<?php

namespace App\Services;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Delivery;
use App\Models\Status;
use Illuminate\Support\Str;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth;

class OrderService  extends GlobalService
{

    /**
     * Undocumented function
     *
     * @return void
     */
    public function get()
    {
        return response()->json([
            'orders' => Order::all()
        ], 200);
    }

    /**
     * Undocumented function
     *
     * @param [type] $request
     * @return void
     */
    public function save($request)
    {

        $request['user_id'] = Auth::id();
        $request['status_id'] = 1;

        $order = Order::create($request->only(
            [
                'order_date',
                'order_number',
                'delivery_type',
                'order_from',
                'user_id',
                'napomena',
                'status_id',
                'price'
            ]
        ));

        $orderItems = array_merge($request->tshirt, $request->badges);

        $order->order_items()->createMany($orderItems);

        $this->saveCustomerAndUpdateOrder($request, $order);

        return response()->json([
            'message' => "Uspešno snimljena porudžbenica " . $request['order_number'],
            'order' => $order->with('order_items')->get(),
        ], 200);
    }

    /**
     * Undocumented function
     *
     * @param integer $id
     * @return void
     */
    public function getOne(int $id)
    {
        $order = Order::with('order_items', 'delivery', 'customer', 'status')->findOrFail($id);

        return response()->json([
            'order' => $order,
            'statuses' => Status::orderByDesc('id')->get(),
        ], 200);
    }

    /**
     * Undocumented function
     *
     * @param Object $customer
     * @param object $order
     * @return void
     */
    private function saveCustomerAndUpdateOrder(object $request, object $order)
    {
        $customer_details = [];

        // if customer address and delivery address is the same, update customer table
        if ($request->customer['customer_details']) {
            $customer_details['street'] = $request->delivery['street'];
            $customer_details['city'] = $request->delivery['city'];
            $customer_details['phone2'] = $request->customer['phone'];
        }

        // merge all to existing request with customer details
        $customer = array_merge($request->customer, $customer_details);

        // create new customer
        $customer = Customer::create($customer);

        // save delivery address
        if ($request['delivery_type'] == 'dostava') {
            $order->delivery()->create($request->delivery);
        }

        // update order with customer id
        $order->customer_id = $customer->id;
        $order->save();
    }

    public function deleteOrder(int $id)
    {
        $order = Order::findOrFail($id);

        try {
            $order->delete();
            $order->order_items->delete();
        } catch (\Throwable $th) {
            info($th->getMessage() . ' ' . $th->getLine() . ' ' . $th->getCode());
            return response()->json([
                'message' => 'Došlo je do greške priliko brisanja'
            ], 400);
        }

        return response()->json([
            'message' => 'Uspešno izbrisana porudžbenica'
        ], 200);
    }
}
