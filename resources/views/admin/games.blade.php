@extends('admin.layout')

@section('title', 'Oyun Yönetimi')

@section('content')
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2 style="margin: 0;">Oyun Listesi</h2>
            <a href="{{ route('admin.games.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Yeni Oyun Ekle
            </a>
        </div>
        
        @if(count($games) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Resim</th>
                            <th>Oyun Adı</th>
                            <th>Kategori</th>
                            <th>Fiyat</th>
                            <th>İndirimli Fiyat</th>
                            <th>Yayın Tarihi</th>
                            <th>Geliştirici</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($games as $game)
                            <tr>
                                <td>
                                    @if($game->image)
                                        <img src="{{ asset('storage/' . $game->image) }}" alt="{{ $game->title }}" style="width: 80px; height: 45px; object-fit: cover; border-radius: 4px;">
                                    @else
                                        <div style="width: 80px; height: 45px; background-color: #f8f9fa; border-radius: 4px; display: flex; align-items: center; justify-content: center;">
                                            <i class="fas fa-image" style="color: #adb5bd;"></i>
                                        </div>
                                    @endif
                                </td>
                                <td>{{ $game->title }}</td>
                                <td>{{ $game->category }}</td>
                                <td>₺{{ $game->price }}</td>
                                <td>{{ $game->discount_price ? '₺' . $game->discount_price : '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($game->release_date)->format('d.m.Y') }}</td>
                                <td>{{ $game->developer }}</td>
                                <td>
                                    <div style="display: flex; gap: 5px;">
                                        <a href="{{ route('admin.games.edit', $game->id) }}" class="btn btn-sm btn-warning" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                                            <i class="fas fa-edit"></i> Düzenle
                                        </a>
                                        
                                        <form action="{{ route('admin.games.delete', $game->id) }}" method="POST" onsubmit="return confirm('Bu oyunu silmek istediğinizden emin misiniz?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                                                <i class="fas fa-trash-alt"></i> Sil
                                            </button>
                                        </form>
                                        
                                        <a href="/games/{{ $game->slug }}" class="btn btn-sm btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;" target="_blank">
                                            <i class="fas fa-eye"></i> Görüntüle
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $games->links() }}
            </div>
        @else
            <div class="alert alert-info">
                Henüz hiç oyun eklenmemiş. <a href="{{ route('admin.games.create') }}">Yeni bir oyun eklemek için tıklayın</a>.
            </div>
        @endif
    </div>
@endsection 