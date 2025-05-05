@extends('layouts.app')

@section('title', 'Hakkımızda')

@section('content')
<div class="about-container">
    <div class="about-header">
        <h1>Hakkımızda</h1>
        <p class="about-subtitle">OyunSepetim'e hoş geldiniz - Dijital oyun dünyasının güvenilir adresi.</p>
    </div>

    <div class="about-section">
        <h2>Biz Kimiz?</h2>
        <p>OyunSepetim, 2023 yılında oyun tutkunlarına en iyi dijital oyun deneyimini sunmak amacıyla kurulmuş bir platformdur. Misyonumuz, oyunseverlere geniş bir oyun yelpazesi sunarken aynı zamanda kullanıcı dostu bir alışveriş deneyimi sağlamaktır.</p>
        
        <p>Türkiye'nin önde gelen dijital oyun platformlarından biri olmayı hedefleyen OyunSepetim, yerli ve yabancı tüm oyun geliştiricilerinin ürünlerini uygun fiyatlarla kullanıcılarla buluşturmaktadır.</p>
    </div>

    <div class="about-section">
        <h2>Vizyonumuz</h2>
        <p>Oyun dünyasında güvenilir, kullanıcı dostu ve teknolojik yeniliklere açık bir platform olarak öncü konumda olmayı hedefliyoruz. Her yaştan ve her kesimden oyunsevere hitap eden geniş oyun kataloğumuzla, Türkiye'nin ve bölgenin en sevilen dijital oyun platformu olmayı amaçlıyoruz.</p>
    </div>

    <div class="about-section">
        <h2>Değerlerimiz</h2>
        <ul class="values-list">
            <li>
                <span class="value-icon"><i class="fas fa-shield-alt"></i></span>
                <div class="value-content">
                    <h3>Güvenilirlik</h3>
                    <p>Kullanıcılarımızın güvenliği ve memnuniyeti bizim için her şeyden önemlidir. Tüm işlemlerinizde şeffaflık ve güvenlik sağlıyoruz.</p>
                </div>
            </li>
            <li>
                <span class="value-icon"><i class="fas fa-users"></i></span>
                <div class="value-content">
                    <h3>Kullanıcı Odaklılık</h3>
                    <p>Platformumuzu ve hizmetlerimizi kullanıcılarımızın ihtiyaçlarına ve geri bildirimlerine göre sürekli geliştiriyoruz.</p>
                </div>
            </li>
            <li>
                <span class="value-icon"><i class="fas fa-lightbulb"></i></span>
                <div class="value-content">
                    <h3>Yenilikçilik</h3>
                    <p>Oyun dünyasındaki en son trendleri ve teknolojileri takip ederek platformumuzu sürekli yeniliyoruz.</p>
                </div>
            </li>
            <li>
                <span class="value-icon"><i class="fas fa-handshake"></i></span>
                <div class="value-content">
                    <h3>İş Birliği</h3>
                    <p>Oyun geliştiricileri, yayıncılar ve oyun topluluklarıyla güçlü iş birlikleri kurarak ekosistemi destekliyoruz.</p>
                </div>
            </li>
        </ul>
    </div>

    <div class="about-section">
        <h2>Neden OyunSepetim?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-tags"></i></div>
                <h3>Uygun Fiyatlar</h3>
                <p>Düzenli kampanyalar ve özel indirimlerle en sevdiğiniz oyunlara uygun fiyatlarla sahip olabilirsiniz.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-gamepad"></i></div>
                <h3>Geniş Oyun Kataloğu</h3>
                <p>Farklı türlerde ve platformlarda binlerce oyuna tek bir yerden erişim sağlıyoruz.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-download"></i></div>
                <h3>Hızlı Teslimat</h3>
                <p>Satın aldığınız oyunlar anında kütüphanenize eklenir, beklemeden oynamaya başlayabilirsiniz.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon"><i class="fas fa-headset"></i></div>
                <h3>7/24 Destek</h3>
                <p>Müşteri destek ekibimiz tüm sorularınızı yanıtlamak için her zaman hazır.</p>
            </div>
        </div>
    </div>

    <div class="about-section">
        <h2>Ekibimiz</h2>
        <p>OyunSepetim, oyun tutkunu profesyonellerden oluşan genç ve dinamik bir ekip tarafından yönetilmektedir. Teknoloji, tasarım, pazarlama ve müşteri hizmetleri alanlarında uzman ekip üyelerimiz, size en iyi hizmeti sunmak için çalışmaktadır.</p>
    </div>

    <div class="join-us-section">
        <h2>Bize Katılın</h2>
        <p>OyunSepetim ailesi olarak sizi de aramızda görmekten mutluluk duyarız. Ücretsiz hesap oluşturarak özel fırsatlardan ve kampanyalardan ilk siz haberdar olabilirsiniz.</p>
        <a href="/register" class="btn btn-primary">Hesap Oluştur</a>
    </div>
</div>
@endsection

@section('styles')
<style>
    .about-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    .about-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .about-header h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #fff;
    }
    
    .about-subtitle {
        font-size: 1.2rem;
        color: var(--text-gray);
        max-width: 700px;
        margin: 0 auto;
    }
    
    .about-section {
        margin-bottom: 3rem;
        background-color: var(--secondary-dark);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    .about-section h2 {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: var(--accent-color);
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .about-section h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 80px;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-color), transparent);
    }
    
    .about-section p {
        font-size: 1.1rem;
        line-height: 1.6;
        color: var(--text-light);
        margin-bottom: 1rem;
    }
    
    .values-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .values-list li {
        display: flex;
        gap: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .value-icon {
        background-color: rgba(26, 159, 255, 0.1);
        color: var(--accent-color);
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        flex-shrink: 0;
        border: 1px solid rgba(26, 159, 255, 0.2);
    }
    
    .value-content h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: #fff;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 1.5rem;
    }
    
    .feature-card {
        background-color: var(--accent-dark);
        padding: 1.5rem;
        border-radius: 10px;
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.3);
    }
    
    .feature-icon {
        color: var(--accent-color);
        font-size: 1.8rem;
        margin-bottom: 1rem;
    }
    
    .feature-card h3 {
        font-size: 1.2rem;
        margin-bottom: 0.8rem;
        color: #fff;
    }
    
    .feature-card p {
        font-size: 0.95rem;
        color: var(--text-gray);
    }
    
    .join-us-section {
        text-align: center;
        background: linear-gradient(135deg, #1e3a8a, #1a202c);
        padding: 3rem;
        border-radius: 12px;
        margin-top: 3rem;
    }
    
    .join-us-section h2 {
        font-size: 1.8rem;
        margin-bottom: 1rem;
        color: #fff;
    }
    
    .join-us-section p {
        max-width: 600px;
        margin: 0 auto 1.5rem;
        color: var(--text-light);
    }
    
    .join-us-section .btn {
        padding: 0.8rem 2rem;
        font-size: 1.1rem;
    }
    
    @media (max-width: 768px) {
        .values-list li {
            flex-direction: column;
            gap: 1rem;
        }
        
        .value-icon {
            width: 50px;
            height: 50px;
        }
        
        .features-grid {
            grid-template-columns: 1fr;
        }
        
        .join-us-section {
            padding: 2rem 1rem;
        }
    }
</style>
@endsection 