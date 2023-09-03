<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Medicine, App\Models\Sell, App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public int $medicine_in_stock;
    public int $total_sales;
    public int $total_purchases;
    public int $count_of_suppliers;
    public int $total_medicine_items;
    public float $money_receive_on_sales;
    public float $money_spent_on_purchases;
    public int $total_items_sold;

    public function render() : View
    {
        $this->medicine_in_stock = Medicine::sum('stock');
        $this->total_sales = Sell::count();
        $this->total_purchases = Purchase::count();
        $this->count_of_suppliers = Supplier::count();
        $this->total_medicine_items = Medicine::count();
        $this->money_receive_on_sales = Sell::sum('total_sell');
        $this->money_spent_on_purchases = Purchase::sum('total_purchase');
        $this->total_items_sold = DB::table('medicine_sell')->sum('quantity');
        return view('livewire.dashboard');
    }
}
