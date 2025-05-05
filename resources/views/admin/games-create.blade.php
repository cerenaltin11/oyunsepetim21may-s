@extends('admin.layout')

@section('title', 'Yeni Oyun Ekle')

@section('content')
    <div class="admin-card">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem;">
            <h2 style="margin: 0;">Yeni Oyun Ekle</h2>
            <a href="{{ route('admin.games') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Oyun Listesine Dön
            </a>
        </div>
        
        <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label for="title" class="form-label">Oyun Adı <span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>
            
            <div class="form-group">
                <label for="description" class="form-label">Açıklama <span class="text-danger">*</span></label>
                <textarea class="form-control" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category" class="form-label">Kategori <span class="text-danger">*</span></label>
                        <select class="form-control" id="category" name="category" required>
                            <option value="">Kategori Seçin</option>
                            <option value="Aksiyon" {{ old('category') == 'Aksiyon' ? 'selected' : '' }}>Aksiyon</option>
                            <option value="Macera" {{ old('category') == 'Macera' ? 'selected' : '' }}>Macera</option>
                            <option value="RPG" {{ old('category') == 'RPG' ? 'selected' : '' }}>RPG</option>
                            <option value="Strateji" {{ old('category') == 'Strateji' ? 'selected' : '' }}>Strateji</option>
                            <option value="Simülasyon" {{ old('category') == 'Simülasyon' ? 'selected' : '' }}>Simülasyon</option>
                            <option value="Spor" {{ old('category') == 'Spor' ? 'selected' : '' }}>Spor</option>
                            <option value="Yarış" {{ old('category') == 'Yarış' ? 'selected' : '' }}>Yarış</option>
                            <option value="FPS" {{ old('category') == 'FPS' ? 'selected' : '' }}>FPS</option>
                            <option value="TPS" {{ old('category') == 'TPS' ? 'selected' : '' }}>TPS</option>
                            <option value="Platform" {{ old('category') == 'Platform' ? 'selected' : '' }}>Platform</option>
                            <option value="Puzzle" {{ old('category') == 'Puzzle' ? 'selected' : '' }}>Puzzle</option>
                            <option value="Korku" {{ old('category') == 'Korku' ? 'selected' : '' }}>Korku</option>
                            <option value="Açık Dünya" {{ old('category') == 'Açık Dünya' ? 'selected' : '' }}>Açık Dünya</option>
                        </select>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="release_date" class="form-label">Yayın Tarihi <span class="text-danger">*</span></label>
                        <input type="date" class="form-control" id="release_date" name="release_date" value="{{ old('release_date') }}" required>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="price" class="form-label">Fiyat (₺) <span class="text-danger">*</span></label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price') }}" required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="discount_price" class="form-label">İndirimli Fiyat (₺)</label>
                        <input type="number" step="0.01" class="form-control" id="discount_price" name="discount_price" value="{{ old('discount_price') }}">
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="developer" class="form-label">Geliştirici <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="developer" name="developer" value="{{ old('developer') }}" required>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="publisher" class="form-label">Yayıncı <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="publisher" name="publisher" value="{{ old('publisher') }}" required>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label for="image" class="form-label">Oyun Resmi <span class="text-danger">*</span></label>
                <input type="file" class="form-control" id="image" name="image" required>
                <small class="text-muted">Minimum 640x360 piksel çözünürlükte bir resim yükleyin. Maksimum dosya boyutu: 2MB</small>
            </div>
            
            <div class="form-group" style="margin-top: 2rem;">
                <button type="submit" class="btn btn-success">
                    <i class="fas fa-save"></i> Oyunu Kaydet
                </button>
            </div>
        </form>
    </div>
@endsection

<style>
    .row {
        display: flex;
        flex-wrap: wrap;
        margin-right: -10px;
        margin-left: -10px;
    }
    
    .col-md-6 {
        flex: 0 0 50%;
        max-width: 50%;
        padding-right: 10px;
        padding-left: 10px;
    }
    
    @media (max-width: 768px) {
        .col-md-6 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }
    
    .text-danger {
        color: #e74c3c;
    }
    
    .text-muted {
        color: #7f8c8d;
        font-size: 0.9rem;
    }
</style> 