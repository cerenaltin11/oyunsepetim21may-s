@extends('admin.layout')

@section('title', 'Kullanıcı Aktivitesi')

@section('content')
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2 style="margin: 0;">{{ $user->name }} Kullanıcısının Aktivitesi</h2>
            <a href="{{ route('admin.users') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Kullanıcı Listesine Dön
            </a>
        </div>
        
        <div style="display: flex; align-items: center; gap: 20px; margin-bottom: 20px;">
            <div>
                @if($user->photo)
                    <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover;">
                @else
                    <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #3498db; display: flex; align-items: center; justify-content: center; color: white; font-size: 2rem; font-weight: bold;">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                @endif
            </div>
            <div>
                <h3 style="margin: 0; margin-bottom: 5px;">{{ $user->name }}</h3>
                <p style="margin: 0; color: #7f8c8d;">{{ $user->email }}</p>
                <p style="margin: 0; color: #7f8c8d;">Kayıt Tarihi: {{ $user->created_at->format('d.m.Y H:i') }}</p>
                <p style="margin: 5px 0 0;">
                    @if($user->is_admin)
                        <span class="badge" style="background-color: #3498db; color: white; padding: 5px 10px; border-radius: 4px;">Admin</span>
                    @else
                        <span class="badge" style="background-color: #7f8c8d; color: white; padding: 5px 10px; border-radius: 4px;">Kullanıcı</span>
                    @endif
                </p>
            </div>
        </div>
    </div>
    
    <div class="admin-card">
        <h3 style="margin-top: 0;">Kütüphane</h3>
        
        @if(count($libraryItems) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Oyun</th>
                            <th>Kategori</th>
                            <th>Oyun Süresi</th>
                            <th>Son Oynama</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($libraryItems as $game)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        @if($game->image)
                                            <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}" style="width: 60px; height: 34px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div style="width: 60px; height: 34px; background-color: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image" style="color: #adb5bd;"></i>
                                            </div>
                                        @endif
                                        <span>{{ $game->title }}</span>
                                    </div>
                                </td>
                                <td>{{ $game->category }}</td>
                                <td>{{ $game->play_time ?? 0 }} saat</td>
                                <td>{{ $game->last_played ?? 'Hiç oynanmadı' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                Bu kullanıcının kütüphanesinde henüz oyun bulunmuyor.
            </div>
        @endif
    </div>
    
    <div class="admin-card">
        <h3 style="margin-top: 0;">İncelemeler</h3>
        
        @if(count($reviews) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Oyun</th>
                            <th>Puan</th>
                            <th>İnceleme</th>
                            <th>Tarih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                            <tr>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 10px;">
                                        @if($review->game && $review->game->image)
                                            <img src="{{ asset('storage/' . $review->game->image) }}" alt="{{ $review->game->title }}" style="width: 60px; height: 34px; object-fit: cover; border-radius: 4px;">
                                        @else
                                            <div style="width: 60px; height: 34px; background-color: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                                <i class="fas fa-image" style="color: #adb5bd;"></i>
                                            </div>
                                        @endif
                                        <span>{{ $review->game->title ?? 'Silinmiş Oyun' }}</span>
                                    </div>
                                </td>
                                <td>
                                    <div style="display: flex; gap: 2px;">
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= $review->rating)
                                                <i class="fas fa-star" style="color: #f39c12;"></i>
                                            @else
                                                <i class="far fa-star" style="color: #f39c12;"></i>
                                            @endif
                                        @endfor
                                    </div>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($review->content, 100) }}</td>
                                <td>{{ $review->created_at->format('d.m.Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                Bu kullanıcı henüz inceleme yapmamış.
            </div>
        @endif
    </div>
    
    <div class="admin-card">
        <h3 style="margin-top: 0;">Siparişler</h3>
        
        @if(count($orders) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sipariş ID</th>
                            <th>Oyunlar</th>
                            <th>Toplam Tutar</th>
                            <th>Durum</th>
                            <th>Tarih</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{ $order['id'] }}</td>
                                <td>
                                    <ul style="margin: 0; padding-left: 20px;">
                                        @foreach($order['items'] as $item)
                                            <li>{{ $item['title'] }} - ₺{{ $item['price'] }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>₺{{ $order['total'] }}</td>
                                <td>
                                    <span class="badge" style="background-color: #2ecc71; color: white; padding: 5px 10px; border-radius: 4px;">
                                        {{ $order['status'] }}
                                    </span>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($order['date'])->format('d.m.Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-info">
                Bu kullanıcı henüz sipariş vermemiş.
            </div>
        @endif
    </div>
@endsection 