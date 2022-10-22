<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sale as RequestsSale;
use App\Mail\CashouReport;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

use function PHPUnit\Framework\returnSelf;

class SalesController extends Controller
{

    public function index()
    {
        return view('livewire.users.checkout');
    }


    public function payment_see($id)
    {
        return view('livewire.index2',compact('id'));
        // return view('users.order-client-resume',compact('orders'))->with( 'status', 'Su pedido ha sido enviado exitosamente!');

    }

    public function saveSale(RequestsSale $request)
    {
        $request->validated();
        if (!$request) {
            return redirect()->route('users.checkout')->withErrors('Errores');
        }
        $data = array();
        $cartCollection = Cart::getContent();
        // Obtener los diferentes id's de los productos
        foreach ($cartCollection as $item) {
            $id[] = $item->id;
            
        }

        $items = count($id);

        if ($request['option'] == 'number:3' ) {

            $methodPayment = 'Debit Card';

        } elseif($request['option'] == 'number:2') {

            $methodPayment = 'Credit Card';

        } else {
            $methodPayment = 'Cash';
        }

        DB::beginTransaction();

        try {

            //aqui se crea la orden
            $sale['status'] = 'PAID';
            $sale['user_id'] = Auth()->user()->getAuthIdentifier();
            $sale['items'] = $items;
            $sale['paymentway'] = $methodPayment;
            $sale['total'] =  $total = Cart::getTotal();
            $sale = Sale::create($sale);
            $saleId = $sale->id;
            
            if ($sale) {
                
                foreach (Cart::getContent() as $item) {

                    //Aqui se crea la tabla pivote
                    $saleDetail =  new SaleDetail();
                    $saleDetail->product_id = $item->id;
                    $saleDetail->sale_id = $sale->id;
                    $saleDetail->quantity = $item->quantity;
                    $saleDetail->price = $item->price;
                    
                
                    /* Actualizar el stock del producto */
                    $product = Product::where('id', $saleDetail->product_id)
                    ->first();

                    $saleDetail->save();

                    $product->stock = $product->stock - $saleDetail->quantity;

                    if ($product->stock < $product->alerts ) {
                        return redirect()->route('users.checkout')->withErrors('We are so sorry, we have no more stock in our store, try again later');
                    }

                    $product->save();

                }
            }
            
            DB::commit();
            
            $data = SaleDetail::with('sale','products')->where('sale_id', $saleId)->get()->toArray();
        
            $pdf = PDF::loadView('emails.sale-invoice');
            
            $messageData = ['Gracias por su compra'];

            $pdf = Mail::send('emails.sale-invoice', $messageData, function ($mail) use ($pdf) {
                $mail->from('Books@hotmail.com', 'Books Company');
                $mail->to(Auth()->user()->email);
                $mail->attachData($pdf->output(), 'Ticket-Purchase-BookStore.pdf');
            });

            Cart::clear();

            return view('livewire.users.invoice',compact('cartCollection','methodPayment','saleId'))->with('status','El pago se ha realizado con éxito');

        }catch (Exception $e) {

            DB::rollBack();
            return redirect()->route('users.checkout')->withErrors('We are so sorry, we had troubles in your purchase, try again');

        }


    }


}
