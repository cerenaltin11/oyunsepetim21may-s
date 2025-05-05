@extends('admin.layout')

@section('title', 'Dashboard')

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
        <h2>Hoş Geldiniz!</h2>
        <p>OyunSepetim yönetim paneline hoş geldiniz. Sol taraftaki menüyü kullanarak farklı bölümlere ulaşabilirsiniz.</p>
        
        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; margin-top: 20px;">
            <a href="{{ route('admin.panel') }}" style="text-decoration: none; color: inherit;">
                <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; transition: all 0.3s; border: 1px solid #eee;">
                    <i class="fas fa-cogs" style="font-size: 2rem; color: #3498db; margin-bottom: 10px;"></i>
                    <h4>Yönetim Paneli</h4>
                    <p style="font-size: 0.9rem; color: #7f8c8d;">Ana yönetim paneli</p>
                </div>
            </a>
            
            <a href="{{ route('admin.users') }}" style="text-decoration: none; color: inherit;">
                <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; transition: all 0.3s; border: 1px solid #eee;">
                    <i class="fas fa-users" style="font-size: 2rem; color: #3498db; margin-bottom: 10px;"></i>
                    <h4>Kullanıcılar</h4>
                    <p style="font-size: 0.9rem; color: #7f8c8d;">Kullanıcıları yönet</p>
                </div>
            </a>
            
            <a href="{{ route('admin.games') }}" style="text-decoration: none; color: inherit;">
                <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; transition: all 0.3s; border: 1px solid #eee;">
                    <i class="fas fa-gamepad" style="font-size: 2rem; color: #2ecc71; margin-bottom: 10px;"></i>
                    <h4>Oyunlar</h4>
                    <p style="font-size: 0.9rem; color: #7f8c8d;">Oyunları yönet</p>
                </div>
            </a>
            
            <a href="{{ route('home') }}" target="_blank" style="text-decoration: none; color: inherit;">
                <div style="background-color: #f8f9fa; padding: 15px; border-radius: 5px; text-align: center; transition: all 0.3s; border: 1px solid #eee;">
                    <i class="fas fa-external-link-alt" style="font-size: 2rem; color: #9b59b6; margin-bottom: 10px;"></i>
                    <h4>Siteye Git</h4>
                    <p style="font-size: 0.9rem; color: #7f8c8d;">Ana sayfayı görüntüle</p>
                </div>
            </a>
        </div>
    </div>
    
    <div class="admin-card">
        <h2>Son Kaydolan Kullanıcılar</h2>
        
        @if(count($recentUsers) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Kullanıcı Adı</th>
                        <th>E-posta</th>
                        <th>Kayıt Tarihi</th>
                        <th>Durum</th>
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
                                    <span class="badge" style="background-color: #3498db; color: white; padding: 5px 10px; border-radius: 4px;">Admin</span>
                                @else
                                    <span class="badge" style="background-color: #7f8c8d; color: white; padding: 5px 10px; border-radius: 4px;">Kullanıcı</span>
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
            
            <div style="text-align: right; margin-top: 10px;">
                <a href="{{ route('admin.users') }}" class="btn btn-primary">Tüm Kullanıcıları Görüntüle</a>
            </div>
        @else
            <div class="alert alert-info">
                Henüz hiç kullanıcı bulunmuyor.
            </div>
        @endif
    </div>
@endsection 