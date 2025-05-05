@extends('layouts.app')

@section('title', 'Gizlilik Politikası')

@section('content')
<div class="privacy-container">
    <div class="privacy-header">
        <h1>Gizlilik Politikası</h1>
        <p class="privacy-updated">Son Güncelleme: 1 Ocak 2023</p>
    </div>

    <div class="privacy-content">
        <div class="privacy-section">
            <h2>Giriş</h2>
            <p>OyunSepetim olarak, müşterilerimizin gizliliğine büyük önem veriyoruz. Bu Gizlilik Politikası, platformumuzu kullanırken hangi bilgileri topladığımızı, bu bilgileri nasıl kullandığımızı ve koruduğumuzu açıklamaktadır.</p>
            <p>Platformumuzu kullanarak, bu politikada belirtilen veri toplama ve kullanım uygulamalarını kabul etmiş olursunuz. Politikamızı zaman zaman güncelleyebiliriz, bu nedenle düzenli olarak kontrol etmenizi öneririz.</p>
        </div>

        <div class="privacy-section">
            <h2>Topladığımız Bilgiler</h2>
            <p>OyunSepetim, hizmetlerimizi sunmak, geliştirmek ve korumak için aşağıdaki türde bilgileri toplayabilir:</p>
            
            <div class="sub-section">
                <h3>Kişisel Bilgiler</h3>
                <ul>
                    <li>Ad, soyad, e-posta adresi, telefon numarası gibi hesap oluşturma sırasında sağladığınız bilgiler</li>
                    <li>Fatura adresi, teslimat adresi ve ödeme bilgileri gibi satın alma işlemleri için gerekli bilgiler</li>
                    <li>Kullanıcı adı, profil fotoğrafı ve diğer profil bilgileri</li>
                </ul>
            </div>
            
            <div class="sub-section">
                <h3>Otomatik Olarak Toplanan Bilgiler</h3>
                <ul>
                    <li>IP adresi, cihaz türü, tarayıcı bilgisi ve işletim sistemi</li>
                    <li>Platform üzerindeki tıklama ve gezinme davranışları</li>
                    <li>Platformu ziyaret ettiğiniz tarih ve saat</li>
                    <li>Oynadığınız oyunlar, oyun süresi ve satın alma geçmişi</li>
                    <li>Çerezler ve benzer teknolojiler aracılığıyla toplanan bilgiler</li>
                </ul>
            </div>
        </div>

        <div class="privacy-section">
            <h2>Bilgilerin Kullanımı</h2>
            <p>Topladığımız bilgileri aşağıdaki amaçlarla kullanabiliriz:</p>
            <ul>
                <li>Hesabınızı oluşturmak ve yönetmek</li>
                <li>Siparişlerinizi işleme koymak ve ürünleri teslim etmek</li>
                <li>Teknik destek ve müşteri hizmetleri sağlamak</li>
                <li>İlgi alanlarınıza göre özelleştirilmiş içerik ve öneriler sunmak</li>
                <li>Platformumuzu ve hizmetlerimizi geliştirmek</li>
                <li>Dolandırıcılık ve yetkisiz erişimi önlemek</li>
                <li>Pazarlama iletişimleri göndermek (onayınız olması durumunda)</li>
                <li>Yasal yükümlülüklerimizi yerine getirmek</li>
            </ul>
        </div>

        <div class="privacy-section">
            <h2>Bilgilerin Paylaşımı</h2>
            <p>Bilgilerinizi aşağıdaki durumlarda üçüncü taraflarla paylaşabiliriz:</p>
            <ul>
                <li><strong>Hizmet Sağlayıcılar:</strong> Ödeme işleme, veri analizi, e-posta gönderimi, hosting hizmetleri gibi faaliyetleri gerçekleştirmemize yardımcı olan hizmet sağlayıcılarla</li>
                <li><strong>İş Ortakları:</strong> Size talep ettiğiniz ürün ve hizmetleri sunmak için iş birliği yaptığımız oyun geliştiricileri ve yayıncıları ile</li>
                <li><strong>Yasal Gereklilikler:</strong> Yasal bir yükümlülüğe uymak, yasal bir süreci yerine getirmek veya yasal hakları korumak için gerektiğinde</li>
                <li><strong>İşletme Transferleri:</strong> Şirketin birleşme, satın alma veya varlıklarının satışı durumunda</li>
            </ul>
            <p>Kişisel bilgilerinizi pazarlama amacıyla üçüncü taraflara satmayız veya kiralamayız.</p>
        </div>

        <div class="privacy-section">
            <h2>Çerezler ve Benzer Teknolojiler</h2>
            <p>Platformumuzda, sizin deneyiminizi geliştirmek ve analiz amacıyla çerezler ve benzer teknolojiler kullanıyoruz. Bu teknolojiler, oturum bilgilerini hatırlamak, kullanım istatistiklerini toplamak ve ilgi alanlarınıza göre içerik sağlamak için kullanılmaktadır.</p>
            <p>Çoğu web tarayıcısı, çerezleri kabul etmek üzere ayarlanmıştır ancak tarayıcı ayarlarınızı değiştirerek çerezleri reddedebilir veya çerez alındığında sizi uyaracak şekilde ayarlayabilirsiniz.</p>
        </div>

        <div class="privacy-section">
            <h2>Veri Güvenliği</h2>
            <p>Kişisel bilgilerinizi yetkisiz erişime, değişikliğe, ifşaya veya yok edilmeye karşı korumak için endüstri standardı güvenlik önlemleri uyguluyoruz. Kullandığımız güvenlik önlemleri arasında şunlar bulunur:</p>
            <ul>
                <li>SSL şifreleme ile veri iletimi</li>
                <li>Hassas bilgiler için şifreleme teknolojileri</li>
                <li>Düzenli güvenlik değerlendirmeleri ve testleri</li>
                <li>Fiziksel erişim kontrolleri ve güvenlik sistemleri</li>
                <li>Çalışanlar için veri gizliliği eğitimleri</li>
            </ul>
            <p>Ancak hiçbir internet iletimi veya elektronik depolama yöntemi %100 güvenli değildir. Bu nedenle, kişisel bilgilerinizin mutlak güvenliğini garanti edemeyiz.</p>
        </div>

        <div class="privacy-section">
            <h2>Veri Saklama</h2>
            <p>Kişisel bilgilerinizi, hesabınız aktif olduğu sürece veya hizmetlerimizi sunmak için gerekli olduğu sürece saklarız. Yasal yükümlülüklerimizi yerine getirmek, anlaşmazlıkları çözmek ve politikalarımızı uygulamak için gerekli olduğunda da bilgileri saklayabiliriz.</p>
        </div>

        <div class="privacy-section">
            <h2>Kullanıcı Hakları</h2>
            <p>OyunSepetim kullanıcıları olarak aşağıdaki haklara sahipsiniz:</p>
            <ul>
                <li>Kişisel verilerinize erişim talep etme</li>
                <li>Yanlış veya eksik bilgilerin düzeltilmesini isteme</li>
                <li>Belirli koşullar altında kişisel verilerinizin silinmesini talep etme</li>
                <li>Verilerinizin işlenmesine itiraz etme</li>
                <li>Veri taşınabilirliği talep etme</li>
                <li>Daha önce verdiğiniz izinleri geri çekme</li>
            </ul>
            <p>Bu haklarınızı kullanmak için <a href="/contact">iletişim sayfamız</a> aracılığıyla bizimle iletişime geçebilirsiniz.</p>
        </div>

        <div class="privacy-section">
            <h2>Çocukların Gizliliği</h2>
            <p>OyunSepetim, 18 yaşından küçük çocuklara yönelik değildir. Bilerek 18 yaşın altındaki kişilerden kişisel bilgi toplamıyoruz. Platformumuz üzerinden 18 yaşın altındaki bir kişinin kişisel bilgilerini topladığımızı fark edersek, bu bilgileri derhal silmek için adımlar atarız.</p>
        </div>

        <div class="privacy-section">
            <h2>Değişiklikler</h2>
            <p>Bu Gizlilik Politikası'nı zaman zaman güncelleyebiliriz. Değişiklikler yapıldığında, sayfanın üst kısmındaki "Son Güncelleme" tarihini değiştireceğiz ve önemli değişiklikler olması durumunda e-posta yoluyla veya platformumuz üzerinde bir bildirim yayınlayarak sizi bilgilendireceğiz.</p>
        </div>

        <div class="privacy-section">
            <h2>İletişim</h2>
            <p>Bu Gizlilik Politikası hakkında sorularınız veya endişeleriniz varsa, lütfen <a href="/contact">iletişim sayfamız</a> aracılığıyla bizimle iletişime geçin.</p>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .privacy-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    .privacy-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .privacy-header h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #fff;
    }
    
    .privacy-updated {
        font-size: 1rem;
        color: var(--text-gray);
    }
    
    .privacy-content {
        background-color: var(--secondary-dark);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    .privacy-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .privacy-section:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .privacy-section h2 {
        font-size: 1.8rem;
        margin-bottom: 1.2rem;
        color: var(--accent-color);
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .privacy-section h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-color), transparent);
    }
    
    .sub-section {
        margin-bottom: 1.5rem;
        margin-top: 1.5rem;
    }
    
    .sub-section h3 {
        font-size: 1.3rem;
        margin-bottom: 1rem;
        color: #fff;
    }
    
    .privacy-section p, .sub-section p {
        font-size: 1.05rem;
        line-height: 1.6;
        color: var(--text-light);
        margin-bottom: 1rem;
    }
    
    .privacy-section ul, .sub-section ul {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    
    .privacy-section li, .sub-section li {
        color: var(--text-light);
        margin-bottom: 0.7rem;
        line-height: 1.6;
    }
    
    .privacy-section a {
        color: var(--accent-color);
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .privacy-section a:hover {
        color: #3aafff;
        text-decoration: underline;
    }
    
    .privacy-section strong {
        color: #fff;
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .privacy-header h1 {
            font-size: 2rem;
        }
        
        .privacy-content {
            padding: 1.5rem;
        }
        
        .privacy-section h2 {
            font-size: 1.5rem;
        }
        
        .sub-section h3 {
            font-size: 1.2rem;
        }
    }
</style>
@endsection 