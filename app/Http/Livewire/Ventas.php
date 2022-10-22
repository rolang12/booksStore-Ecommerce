<?php

namespace App\Http\Livewire;

use App\Models\Denomination;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use Darryldecode\Cart\Facades\CartFacade as Cart;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class Ventas extends Component
{
    public $total,  $itemsQuantity,  $efectivo, $change;


    public function mount(){
        $this->efectivo = 0;        
        $this->change = 0;        
        $this->total = Cart::getTotal();        
        $this->itemsQuantity = Cart::getTotalQuantity();
    }

    public function render()
    {
        $title_page = 'Sales';
        return view('livewire.ventas.component',[
        'denominations' => Denomination::orderBy('value','desc')->get(), 'cart' => Cart::getContent()->sortBy('name'),
           

        ])
        ->extends('layouts.theme.app',compact('title_page'))->section('content');
    }

    public function ACash($value)
    {
        //Si el usuario teclea que es exacto, le asigno el total, y si no al ue le dió click
        $this->efectivo += ($value == 0 ? $this->total : $value);
        $this->change = ($this->efectivo - $this->total);
    }

    public function ScanCode($barcode, $cant = 1)
    {
        $product = Product::where('barcode', $barcode)->first();
        if ($product == null || empty($empty) ) {
            $this->emit('scan-notfound', 'Product is not registered');
        } else {
            if ($this->InCart($product->id)) {
                return;
            }

            if ($product->stock < 1) {
                $this->emit('no-stock','Insufficient Stock :/');
                return;
            }

            Cart::add($product->id,$product->name,$product->price,$cant,$product->image);
            $this->total = Cart::getTotal();

            $this->emit('scan-ok','Product added');

        }
    }




    protected $listeners = [
        'scan-code' => 'ScanCode',
        'removeItem' => 'removeItem',
        'cleanCart' => 'clearCart',
        'saveSale' => 'saveSale',
    ];


   
    public function InCart($productId)
    {
        $exist = Cart::get($productId);

        if ($exist) {
            return true;
        }

        return false;
        
    }

    public function increaseQty($productId, $cant = 1)
    {
        $title = '';
        $product = Product::find($productId);
        $exist = Cart::get($productId);

        if ($exist) {
            $title = 'Quantity update';
        }

        $title = 'Product added';

        if ($exist)
        {
            if ($product->stock < ($cant + $exist->quantity)) {
                $this->emit('no-stock', 'Insufficient Stock :/');

                return; 
            }    
        }

        Cart::add($product->id,$product->name,$product->price,$product->quantity,$product->image);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', $title);

    }

    public function updateQty($productId, $cant = 1)
    {
        $title = '';
        $product = Product::find($productId);

        $exist = Cart::get($productId);

        if ($exist) {
            $title = 'Quantity update';
        }

        $title = 'Product added';

        if ($exist)
        {
            if ($product->stock < $cant) {

                $this->emit('no-stock', 'Insufficient Stock :/');
                return; 
            }    
        }

        $this->removeItem($productId);

        if ($cant > 0)
        {
            Cart::add($product->id,$product->name,$product->price,$product->quantity,$product->image);
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();

            $this->emit('scan-ok', $title);
        } else {
            $this->emit('scan-notok', $title); //aqui poner que debe ser mayor a 0
        }

    }

    public function removeItem($productId)
    {
        Cart::remove($productId);
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();

        $this->emit('scan-ok', 'product deleted');
    }

    public function decreaseQty($productId){
        $item = Cart::get($productId);
        Cart::remove($productId);

        $newQty = ($item->quantity) - 1;

        if ($newQty > 0) {
            Cart:add($item->id, $item->name, $item->price, $newQty,$item->attributes[0]);
        }

        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok', 'Quantity updated');


    }

    public function clearCart()
    {
        Cart::clear();
        $this->efectivo = 0;
        $this->change = 0;
        $this->total = Cart::getTotal();
        $this->itemsQuantity = Cart::getTotalQuantity();
        $this->emit('scan-ok','Cart empty');
    }

    public function saveSale()
    {
        if ($this->total <= 0 ) {
            $this->emit('sale-error', 'Add products in your sale');
            return;
        }

        if ($this->efectivo <= 0 ) {
            $this->emit('sale-error', 'Enter the cash');
            return;
        }

         if ($this->total > $this->efectivo  ) {
            $this->emit('sale-error', 'Cash must be major or qeual than total');
            return;
        }

        DB::beginTransaction();
        try {
            $sale = Sale::create([
            'total' => $this->total,
            'items' => $this->itemsQuantity,
            'cash' => $this->efectivo,
            'change' => $this->change,
            'user_id' => Auth()->user()->id

            ]);

            if ($sale)
            {
                $items = Cart::getContent();
                foreach ($items as $item) {
                    SaleDetail::create([
                    'price' => $item->price,
                    'quantity' => $item->quantity,
                    'product_id' => $item->id,
                    'sale_id' => $sale->id,
                    ]);
                    //update stock
                    $product = Product::find($item->id);
                    $product->stock = $product->stock - $item->quantity;
                    $product->save();
                }
            }

            DB::commit();

            Cart::clear();
            $this->efectivo = 0;
            $this->change = 0;
            $this->total = Cart::getTotal();
            $this->itemsQuantity = Cart::getTotalQuantity();
            $this->emit('sale-ok','Sale Registered Successfully');
            $this->emit('print-ticket',$sale->id);

        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('sale-error',$e->getMessage());
        }


    }

    public function printTicket($sale)
    {
        return Redirect::to("print://sale->id");
    }

}
