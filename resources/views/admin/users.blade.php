@extends('admin.layout')

@section('title', 'Kullanıcı Yönetimi')

@section('content')
    <div class="admin-card">
        <h2>Kullanıcı Listesi</h2>
        
        @if(count($users) > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Avatar</th>
                            <th>Kullanıcı Adı</th>
                            <th>E-posta</th>
                            <th>Kayıt Tarihi</th>
                            <th>Durum</th>
                            <th>İşlemler</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    @if($user->photo)
                                        <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="user-avatar">
                                    @else
                                        <div class="user-avatar" style="background-color: #3498db; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </td>
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
                                    <div style="display: flex; gap: 5px;">
                                        <a href="{{ route('admin.users.activity', $user->id) }}" class="btn btn-sm btn-primary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                                            <i class="fas fa-chart-line"></i> Aktivite
                                        </a>
                                        
                                        @if(Auth::id() != $user->id)
                                            <form action="{{ route('admin.users.toggle-admin', $user->id) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm {{ $user->is_admin ? 'btn-warning' : 'btn-success' }}" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                                                    @if($user->is_admin)
                                                        <i class="fas fa-user"></i> Admin İptal
                                                    @else
                                                        <i class="fas fa-user-shield"></i> Admin Yap
                                                    @endif
                                                </button>
                                            </form>
                                        @else
                                            <button disabled class="btn btn-sm btn-secondary" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">
                                                <i class="fas fa-user-shield"></i> Siz
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-4">
                {{ $users->links() }}
            </div>
        @else
            <div class="alert alert-info">
                Henüz hiç kullanıcı bulunmuyor.
            </div>
        @endif
    </div>
@endsection 