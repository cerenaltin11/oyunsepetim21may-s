@extends('admin.layout')

@section('title', 'Panel')

@section('content')
    <div class="dashboard-stats">
        <div class="stat-card">
            <div class="stat-icon stat-users">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalUsers }}</h3>
                <p>Toplam Kullanıcı</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon stat-games">
                <i class="fas fa-gamepad"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalGames }}</h3>
                <p>Toplam Oyun</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon stat-reviews">
                <i class="fas fa-star"></i>
            </div>
            <div class="stat-info">
                <h3>{{ $totalReviews }}</h3>
                <p>Toplam İnceleme</p>
            </div>
        </div>
    </div>
    
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2 style="margin: 0;">Yönetim Paneli</h2>
        </div>
        
        <p>Oyun Sepetim yönetim paneline hoş geldiniz. Bu panel üzerinden kullanıcıları ve oyunları yönetebilirsiniz.</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-top: 2rem;">
            <a href="{{ route('admin.users') }}" class="panel-action-card" style="text-decoration: none; color: inherit;">
                <div style="background-color: var(--accent-dark); padding: 20px; border-radius: 8px; text-align: center; transition: all 0.3s; border: 1px solid rgba(255, 255, 255, 0.05); cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 8px 16px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='';this.style.boxShadow='';">
                    <i class="fas fa-users" style="font-size: 3rem; color: #3498db; margin-bottom: 10px;"></i>
                    <h3>Kullanıcı Yönetimi</h3>
                    <p style="color: var(--text-gray);">Kullanıcıları görüntüle, yönet ve admin yetkileri ata</p>
                </div>
            </a>
            
            <a href="{{ route('admin.games') }}" class="panel-action-card" style="text-decoration: none; color: inherit;">
                <div style="background-color: var(--accent-dark); padding: 20px; border-radius: 8px; text-align: center; transition: all 0.3s; border: 1px solid rgba(255, 255, 255, 0.05); cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)';this.style.boxShadow='0 8px 16px rgba(0,0,0,0.2)';" onmouseout="this.style.transform='';this.style.boxShadow='';">
                    <i class="fas fa-gamepad" style="font-size: 3rem; color: #2ecc71; margin-bottom: 10px;"></i>
                    <h3>Oyun Yönetimi</h3>
                    <p style="color: var(--text-gray);">Oyunları görüntüle, ekle, düzenle veya sil</p>
                </div>
            </a>
        </div>
    </div>
    
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2 style="margin: 0;">Son Kullanıcılar</h2>
            <a href="{{ route('admin.users') }}" class="btn btn-primary">Tüm Kullanıcılar</a>
        </div>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Kullanıcı Adı</th>
                    <th>E-posta</th>
                    <th>Kayıt Tarihi</th>
                    <th>Admin</th>
                    <th>İşlemler</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentUsers as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d.m.Y H:i') }}</td>
                        <td>
                            @if($user->is_admin)
                                <span class="badge" style="background-color: var(--accent-color); color: white; padding: 5px 10px; border-radius: 50px;">Admin</span>
                            @else
                                <span class="badge" style="background-color: var(--accent-dark); color: var(--text-gray); padding: 5px 10px; border-radius: 50px;">Kullanıcı</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.users.activity', $user->id) }}" class="btn btn-sm btn-warning" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                                <i class="fas fa-chart-line"></i> Aktivite
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2 style="margin: 0;">Son Eklenen Oyunlar</h2>
            <a href="{{ route('admin.games') }}" class="btn btn-primary">Tüm Oyunlar</a>
        </div>
        
        @if(count($recentGames) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Resim</th>
                        <th>Oyun Adı</th>
                        <th>Kategori</th>
                        <th>Fiyat</th>
                        <th>İşlemler</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentGames as $game)
                        <tr>
                            <td>
                                @if($game->image)
                                    <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}" style="width: 80px; height: 45px; object-fit: cover; border-radius: 8px;">
                                @else
                                    <div style="width: 80px; height: 45px; background-color: var(--accent-dark); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-image" style="color: var(--text-gray);"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $game->title }}</td>
                            <td>{{ $game->category }}</td>
                            <td>₺{{ $game->price }}</td>
                            <td>
                                <a href="{{ route('admin.games.edit', $game->id) }}" class="btn btn-sm btn-warning" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                                    <i class="fas fa-edit"></i> Düzenle
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Henüz hiç oyun eklenmemiş.</p>
        @endif
    </div>
@endsection 