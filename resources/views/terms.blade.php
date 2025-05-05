@extends('layouts.app')

@section('title', 'Kullanım Şartları')

@section('content')
<div class="terms-container">
    <div class="terms-header">
        <h1>Kullanım Şartları</h1>
        <p class="terms-updated">Son Güncelleme: 1 Ocak 2023</p>
    </div>

    <div class="terms-content">
        <div class="terms-section">
            <h2>Giriş</h2>
            <p>Bu Kullanım Şartları ("Şartlar"), OyunSepetim platformunu ve hizmetlerini kullanımınızı düzenleyen yasal şartları ve koşulları belirler. Platformumuza erişerek veya platformumuzu kullanarak, bu Şartları kabul etmiş olursunuz.</p>
            <p>Lütfen bu Şartları dikkatlice okuyun. Bu Şartları kabul etmiyorsanız, lütfen platformumuzu kullanmayın.</p>
        </div>

        <div class="terms-section">
            <h2>Tanımlar</h2>
            <ul>
                <li><strong>"OyunSepetim", "biz", "bize" veya "bizim"</strong> - OyunSepetim platformunu ve hizmetlerini işleten şirketi ifade eder.</li>
                <li><strong>"Platform"</strong> - OyunSepetim web sitesi ve ilgili tüm hizmetleri ifade eder.</li>
                <li><strong>"Kullanıcı", "siz", "size" veya "sizin"</strong> - platformu kullanan kişiyi ifade eder.</li>
                <li><strong>"İçerik"</strong> - platformda bulunan tüm metin, görsel, video, ses, veri veya diğer materyalleri ifade eder.</li>
                <li><strong>"Dijital Ürünler"</strong> - platformumuz üzerinden satın alınabilen dijital oyunlar, içerikler ve diğer dijital ürünleri ifade eder.</li>
            </ul>
        </div>

        <div class="terms-section">
            <h2>Hesap Kaydı ve Güvenliği</h2>
            <p>OyunSepetim'de hesap oluşturarak aşağıdaki koşulları kabul etmiş olursunuz:</p>
            <ul>
                <li>Sağladığınız tüm bilgilerin doğru, güncel ve eksiksiz olduğunu taahhüt edersiniz.</li>
                <li>Hesap güvenliğinizden ve şifrenizin gizliliğinden siz sorumlusunuz.</li>
                <li>Hesabınız altında gerçekleşen tüm faaliyetlerden siz sorumlusunuz.</li>
                <li>Hesabınızda yetkisiz bir kullanım veya güvenlik ihlali olduğunda, bizi derhal bilgilendirmeyi kabul edersiniz.</li>
                <li>18 yaşından küçükseniz, platformumuzu ebeveyn veya yasal vasi gözetiminde kullanabilirsiniz.</li>
            </ul>
            <p>OyunSepetim, herhangi bir hesabı önceden bildirmeksizin askıya alma veya sonlandırma hakkını saklı tutar.</p>
        </div>

        <div class="terms-section">
            <h2>Satın Alma ve Ödemeler</h2>
            <p>Platformumuz üzerinden dijital ürün satın alırken aşağıdaki koşullar geçerlidir:</p>
            <ul>
                <li>Ürün fiyatları ve ödeme koşulları satın alma sırasında belirtildiği gibidir.</li>
                <li>Fiyatlar, vergiler dahil veya hariç olarak gösterilebilir, satın alma sırasında nihai fiyat belirtilecektir.</li>
                <li>Ödeme işlemleri güvenli ödeme ağ geçitleri üzerinden gerçekleştirilir ve ödeme bilgileriniz bizim tarafımızdan doğrudan saklanmaz.</li>
                <li>Dijital ürünlerin teslimatı, başarılı ödeme onayının ardından otomatik olarak gerçekleşir.</li>
                <li>Satın alınan dijital ürünlerin lisansı size aittir, ancak bu lisans devredilmez ve satılamaz.</li>
            </ul>
        </div>

        <div class="terms-section">
            <h2>İade Politikası</h2>
            <p>Dijital ürünler için iade politikamız aşağıdaki şekildedir:</p>
            <ul>
                <li>Satın alma tarihinden itibaren 14 gün içinde ve ürünü 2 saatten az kullanmış olmanız durumunda iade talebinde bulunabilirsiniz.</li>
                <li>İade talepleri, hesabınızdaki "Siparişlerim" bölümünden yapılabilir.</li>
                <li>İade onaylandığında, ödeme yaptığınız yöntem üzerinden geri ödeme yapılır.</li>
                <li>Aşağıdaki durumlarda iade talebi reddedilebilir:
                    <ul>
                        <li>Ürün 2 saatten fazla kullanılmışsa</li>
                        <li>Satın alma tarihinden itibaren 14 günden fazla zaman geçmişse</li>
                        <li>Özel indirim veya promosyon kapsamında satın alınan ürünlerde (özellikle belirtilmişse)</li>
                        <li>Oyun içi satın alımlarda veya tüketilmiş içerikte</li>
                    </ul>
                </li>
            </ul>
            <p>Her durumda iade değerlendirmesi OyunSepetim'in takdirindedir.</p>
        </div>

        <div class="terms-section">
            <h2>Kullanıcı Davranışları</h2>
            <p>OyunSepetim platformunu kullanırken aşağıdaki davranışları yapmamayı kabul edersiniz:</p>
            <ul>
                <li>Platformumuzun işlevselliğini engellemek veya bozmak</li>
                <li>Platform güvenliğini aşmak veya test etmek</li>
                <li>Platformdan herhangi bir içeriği, yazılımı veya diğer materyalleri kopyalamak, değiştirmek veya dağıtmak</li>
                <li>Virüs, kötü amaçlı yazılım veya diğer zararlı kodları platformumuza yüklemek</li>
                <li>Platformu yasadışı faaliyetler için kullanmak</li>
                <li>Platformu başka kullanıcıları taciz etmek veya rahatsız etmek için kullanmak</li>
                <li>Diğer kullanıcıların hesaplarına izinsiz erişmeye çalışmak</li>
                <li>Platformdaki ürünleri ticari amaçla yeniden satmak veya dağıtmak</li>
            </ul>
            <p>Bu kurallara uymamanız durumunda, hesabınız askıya alınabilir veya kalıcı olarak kapatılabilir.</p>
        </div>

        <div class="terms-section">
            <h2>Fikri Mülkiyet Hakları</h2>
            <p>Platform üzerindeki tüm içerik, tasarım, logo, yazılım ve diğer materyaller OyunSepetim'in veya lisans verenlerin fikri mülkiyetidir. Bu içeriklerin kopyalanması, değiştirilmesi, dağıtılması veya ticari amaçla kullanımı kesinlikle yasaktır.</p>
            <p>Satın aldığınız dijital ürünleri kullanma lisansına sahipsiniz, ancak bunları çoğaltma, değiştirme veya dağıtma hakkına sahip değilsiniz. Oyunların ve diğer dijital ürünlerin telif hakları ilgili geliştiricilere ve yayıncılara aittir.</p>
        </div>

        <div class="terms-section">
            <h2>Sorumluluk Sınırlaması</h2>
            <p>OyunSepetim, platformun kesintisiz veya hatasız çalışacağını garanti etmez. Platformun kullanımından kaynaklanan veya platformla bağlantılı olarak ortaya çıkan doğrudan, dolaylı, tesadüfi, özel veya sonuç olarak ortaya çıkan herhangi bir zarar için sorumlu değiliz.</p>
            <p>Platformumuz üzerinden erişilebilen üçüncü taraf web siteleri veya hizmetleri için hiçbir sorumluluk kabul etmiyoruz.</p>
        </div>

        <div class="terms-section">
            <h2>Tazminat</h2>
            <p>Bu Şartları ihlal etmeniz veya platformu yanlış kullanmanız durumunda ortaya çıkabilecek tüm iddia, zarar, yükümlülük, kayıp ve masraflara karşı OyunSepetim'i, yöneticilerini, çalışanlarını ve temsilcilerini savunmayı, tazmin etmeyi ve zarar görmemelerini sağlamayı kabul edersiniz.</p>
        </div>

        <div class="terms-section">
            <h2>Değişiklikler</h2>
            <p>OyunSepetim, bu Şartları herhangi bir zamanda değiştirme hakkını saklı tutar. Değişiklikler yapıldığında, sayfanın üst kısmındaki "Son Güncelleme" tarihini güncelleyeceğiz ve önemli değişiklikler durumunda e-posta yoluyla veya platform üzerinde bir bildirim yayınlayarak sizi bilgilendireceğiz.</p>
            <p>Şartlarda yapılan değişikliklerden sonra platformu kullanmaya devam etmeniz, değiştirilmiş Şartları kabul ettiğiniz anlamına gelir.</p>
        </div>

        <div class="terms-section">
            <h2>Fesih</h2>
            <p>Bu Şartlar, siz veya OyunSepetim tarafından feshedilene kadar geçerlidir. Herhangi bir nedenle hesabınızı kapatarak bu anlaşmayı feshedebilirsiniz.</p>
            <p>OyunSepetim, herhangi bir zamanda ve herhangi bir nedenle, önceden bildirimde bulunmaksızın, platform erişiminizi askıya alabilir veya sonlandırabilir.</p>
        </div>

        <div class="terms-section">
            <h2>Genel Hükümler</h2>
            <ul>
                <li><strong>Eksiksiz Anlaşma:</strong> Bu Şartlar, platform kullanımınıza ilişkin sizinle OyunSepetim arasındaki tam anlaşmayı oluşturur.</li>
                <li><strong>Ayrılabilirlik:</strong> Bu Şartların herhangi bir hükmü geçersiz veya uygulanamaz olarak kabul edilirse, diğer hükümler tam olarak yürürlükte kalmaya devam eder.</li>
                <li><strong>Feragat:</strong> OyunSepetim'in bu Şartların herhangi bir hükmünü uygulamadaki başarısızlığı, söz konusu hükümden veya başka herhangi bir hükümden feragat anlamına gelmez.</li>
                <li><strong>Devir:</strong> Bu Şartlar kapsamındaki haklarınızı veya yükümlülüklerinizi OyunSepetim'in önceden yazılı izni olmadan devredemezsiniz.</li>
            </ul>
        </div>

        <div class="terms-section">
            <h2>İletişim</h2>
            <p>Bu Kullanım Şartları hakkındaki sorularınız veya endişeleriniz için lütfen <a href="/contact">iletişim sayfamız</a> aracılığıyla bizimle iletişime geçin.</p>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .terms-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    .terms-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .terms-header h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #fff;
    }
    
    .terms-updated {
        font-size: 1rem;
        color: var(--text-gray);
    }
    
    .terms-content {
        background-color: var(--secondary-dark);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    .terms-section {
        margin-bottom: 2.5rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .terms-section:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: none;
    }
    
    .terms-section h2 {
        font-size: 1.8rem;
        margin-bottom: 1.2rem;
        color: var(--accent-color);
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    .terms-section h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-color), transparent);
    }
    
    .terms-section p {
        font-size: 1.05rem;
        line-height: 1.6;
        color: var(--text-light);
        margin-bottom: 1rem;
    }
    
    .terms-section ul {
        margin-bottom: 1.5rem;
        padding-left: 1.5rem;
    }
    
    .terms-section ul ul {
        margin-top: 0.5rem;
        margin-bottom: 0;
    }
    
    .terms-section li {
        color: var(--text-light);
        margin-bottom: 0.7rem;
        line-height: 1.6;
    }
    
    .terms-section a {
        color: var(--accent-color);
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .terms-section a:hover {
        color: #3aafff;
        text-decoration: underline;
    }
    
    .terms-section strong {
        color: #fff;
        font-weight: 600;
    }
    
    @media (max-width: 768px) {
        .terms-header h1 {
            font-size: 2rem;
        }
        
        .terms-content {
            padding: 1.5rem;
        }
        
        .terms-section h2 {
            font-size: 1.5rem;
        }
    }
</style>
@endsection 