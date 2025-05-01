@extends('layouts.app')

@section('title', 'Satın Alma Geçmişi')

@section('styles')
<style>
    .orders-container {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 2rem;
        margin-bottom: 2rem;
    }
    
    .orders-header {
        margin-bottom: 2rem;
        border-bottom: 1px solid var(--accent-dark);
        padding-bottom: 1rem;
    }
    
    .orders-header h1 {
        margin-top: 0;
    }
    
    .empty-orders {
        padding: 3rem 0;
        text-align: center;
    }
    
    .empty-orders i {
        font-size: 4rem;
        color: var(--accent-dark);
        margin-bottom: 1.5rem;
    }
    
    .empty-orders h2 {
        margin-top: 0;
        margin-bottom: 1rem;
    }
    
    .empty-orders p {
        color: var(--text-gray);
        margin-bottom: 1.5rem;
    }
    
    .orders-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .orders-table th {
        text-align: left;
        padding: 1rem;
        border-bottom: 1px solid var(--accent-dark);
        color: var(--text-gray);
    }
    
    .orders-table td {
        padding: 1rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .order-status {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
        font-weight: 600;
    }
    
    .status-completed {
        background-color: #4caf50;
        color: white;
    }
    
    .status-processing {
        background-color: #2196f3;
        color: white;
    }
    
    .status-cancelled {
        background-color: #f44336;
        color: white;
    }

    .order-items {
        background-color: var(--accent-dark);
        padding: 1rem;
        border-radius: 4px;
        margin-top: 1rem;
    }

    .order-item {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
        padding: 0.5rem;
        border-bottom: 1px solid var(--secondary-dark);
    }

    .order-item:last-child {
        margin-bottom: 0;
        border-bottom: none;
    }

    .order-item-image {
        width: 60px;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 1rem;
    }

    .order-item-details {
        flex: 1;
    }

    .order-item-title {
        font-weight: bold;
        margin-bottom: 0.2rem;
    }

    .order-item-price {
        color: var(--text-gray);
        font-size: 0.9rem;
    }

    .order-details {
        margin-top: 1rem;
        padding: 1rem;
        background-color: var(--accent-dark);
        border-radius: 4px;
    }

    .order-detail-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.5rem;
    }

    .order-detail-label {
        color: var(--text-gray);
    }
</style>
@endsection

@section('content')
    <div class="orders-container">
        <div class="orders-header">
            <h1>Satın Alma Geçmişi</h1>
            <p>Satın aldığınız oyunları ve ödeme geçmişinizi buradan takip edebilirsiniz.</p>
        </div>
        
        @php
            // For demo purposes, we'll create some sample orders
            // In a real app, these would come from the database
            $orders = session('orders', []);
        @endphp
        
        @if(count($orders) > 0)
            <table class="orders-table">
                <thead>
                    <tr>
                        <th>Sipariş No</th>
                        <th>Tarih</th>
                        <th>Ürünler</th>
                        <th>Toplam</th>
                        <th>Durum</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>#{{ $order['order_id'] }}</td>
                            <td>{{ $order['date'] }}</td>
                            <td>
                                <div class="order-items">
                                    @foreach($order['items'] as $item)
                                        <div class="order-item">
                                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="order-item-image">
                                            <div class="order-item-details">
                                                <div class="order-item-title">{{ $item['title'] }}</div>
                                                <div class="order-item-price">₺{{ number_format($item['price'], 2, ',', '.') }}</div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td>₺{{ number_format($order['total'], 2, ',', '.') }}</td>
                            <td><span class="order-status status-completed">Tamamlandı</span></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="empty-orders">
                <i class="fas fa-shopping-bag"></i>
                <h2>Henüz bir satın alma işlemi yapmadınız</h2>
                <p>Kütüphanenize oyun eklemek için oyunları keşfetmeye başlayabilirsiniz.</p>
                <a href="/games" class="btn btn-primary">Oyunları Keşfet</a>
            </div>
        @endif
    </div>
@endsection 