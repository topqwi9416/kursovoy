<?php
namespace App\Filament\Pages;

use App\Models\Order;
use Filament\Pages\Page;

class OrderAnalytics extends Page
{
    protected static ?string $navigationLabel = 'Аналитика заказов';
    protected string $view = 'filament.pages.order-analytics';

    public string $search = '';
    public string $customer_filter = '';
    public string $status_filter = '';
    public string $date_from = '';
    public string $date_to = '';

    public function getOrders()
    {
        return Order::with('items')
            ->when($this->search, fn($q) => $q->where(function ($q) {
                $q->where('customer_name', 'ilike', "%{$this->search}%")
                  ->orWhere('customer_phone', 'ilike', "%{$this->search}%");
            }))
            ->when($this->customer_filter, fn($q) =>
                $q->where('customer_name', $this->customer_filter))
            ->when($this->status_filter, fn($q) =>
                $q->where('status', $this->status_filter))
            ->when($this->date_from, fn($q) =>
                $q->whereDate('created_at', '>=', $this->date_from))
            ->when($this->date_to, fn($q) =>
                $q->whereDate('created_at', '<=', $this->date_to))
            ->get();
    }

    public function getStats()
    {
        $orders = $this->getOrders();
        return [
            'total_orders' => $orders->count(),
            'total_sum'    => $orders->sum('total_amount'),
            'avg_sum'      => $orders->count()
                ? round($orders->sum('total_amount') / $orders->count())
                : 0,
        ];
    }
}