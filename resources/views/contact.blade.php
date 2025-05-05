@extends('layouts.app')

@section('title', 'İletişim')

@section('content')
<div class="contact-container">
    <div class="contact-header">
        <h1>İletişim</h1>
        <p class="contact-subtitle">Sorularınız, önerileriniz veya geri bildirimleriniz için bizimle iletişime geçebilirsiniz.</p>
    </div>

    <div class="contact-content">
        <div class="contact-info">
            <div class="info-section">
                <h2>İletişim Bilgileri</h2>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div class="info-details">
                        <h3>E-posta</h3>
                        <p><a href="mailto:info@oyunsepetim.com">info@oyunsepetim.com</a></p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <div class="info-details">
                        <h3>Müşteri Hizmetleri</h3>
                        <p><a href="mailto:destek@oyunsepetim.com">destek@oyunsepetim.com</a></p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="info-details">
                        <h3>Telefon</h3>
                        <p><a href="tel:+902121234567">+90 (212) 123 45 67</a></p>
                        <p class="info-note">Hafta içi 09:00 - 18:00 arası</p>
                    </div>
                </div>
                
                <div class="info-item">
                    <div class="info-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="info-details">
                        <h3>Adres</h3>
                        <p>Levent, Büyükdere Cad. No:123<br>34394 Şişli/İstanbul</p>
                    </div>
                </div>
            </div>
            
            <div class="social-section">
                <h2>Sosyal Medya</h2>
                <p>Sosyal medya hesaplarımızı takip ederek güncel kampanyalardan ve duyurulardan haberdar olun.</p>
                
                <div class="social-icons">
                    <a href="#" class="social-icon" title="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon" title="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon" title="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon" title="Discord">
                        <i class="fab fa-discord"></i>
                    </a>
                    <a href="#" class="social-icon" title="YouTube">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="contact-form-container">
            <h2>Bize Ulaşın</h2>
            <p>Aşağıdaki formu doldurarak bize mesaj gönderebilirsiniz. En kısa sürede size dönüş yapacağız.</p>
            
            <form id="contactForm" class="contact-form" action="/contact" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="name">Adınız Soyadınız <span class="required">*</span></label>
                    <input type="text" id="name" name="name" required>
                </div>
                
                <div class="form-group">
                    <label for="email">E-posta Adresiniz <span class="required">*</span></label>
                    <input type="email" id="email" name="email" required>
                </div>
                
                <div class="form-group">
                    <label for="subject">Konu <span class="required">*</span></label>
                    <select id="subject" name="subject" required>
                        <option value="" disabled selected>Konu Seçiniz</option>
                        <option value="sipariş">Sipariş Bilgisi</option>
                        <option value="ödeme">Ödeme Sorunları</option>
                        <option value="teknik">Teknik Destek</option>
                        <option value="ortaklık">İş Birliği</option>
                        <option value="diğer">Diğer</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="message">Mesajınız <span class="required">*</span></label>
                    <textarea id="message" name="message" rows="6" required></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary">Gönder</button>
            </form>
        </div>
    </div>
    
    <div class="contact-map">
        <h2>Konum</h2>
        <div class="map-placeholder">
            <i class="fas fa-map-marked-alt"></i>
            <p>Harita yükleniyor...</p>
        </div>
    </div>
    
    <div class="faq-section">
        <h2>Sıkça Sorulan Sorular</h2>
        
        <div class="faq-items">
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Satın aldığım oyunu nasıl indiririm?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Satın aldığınız oyunlar anında kütüphanenize eklenir. Kütüphaneye giderek oyunun yanındaki "İndir" düğmesine tıklayarak indirme işlemini başlatabilirsiniz.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Ödeme işlemlerinde hangi yöntemleri kullanabiliyorum?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>OyunSepetim'de kredi kartı, banka kartı, havale/EFT, mobil ödeme ve dijital cüzdanlar gibi birçok ödeme yöntemini kullanabilirsiniz.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>İade işlemleri nasıl yapılır?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Dijital ürünlerde iade politikamıza göre, satın alma tarihinden itibaren 14 gün içinde ve oyun 2 saatten az oynanmışsa iade talebinde bulunabilirsiniz. İade taleplerinizi hesabınızdaki "Siparişlerim" bölümünden yapabilirsiniz.</p>
                </div>
            </div>
            
            <div class="faq-item">
                <div class="faq-question">
                    <h3>Oyun hediye etmek istiyorum, nasıl yapabilirim?</h3>
                    <span class="faq-toggle"><i class="fas fa-chevron-down"></i></span>
                </div>
                <div class="faq-answer">
                    <p>Hediye etmek istediğiniz oyunun sayfasında "Hediye Et" seçeneğini kullanarak, arkadaşınızın e-posta adresini girerek hediye gönderebilirsiniz. Ödeme işlemi tamamlandıktan sonra arkadaşınıza hediye kodu içeren bir e-posta gönderilecektir.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .contact-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }
    
    .contact-header {
        text-align: center;
        margin-bottom: 3rem;
    }
    
    .contact-header h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #fff;
    }
    
    .contact-subtitle {
        font-size: 1.2rem;
        color: var(--text-gray);
        max-width: 700px;
        margin: 0 auto;
    }
    
    .contact-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 3rem;
    }
    
    .contact-info, .contact-form-container {
        background-color: var(--secondary-dark);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    .info-section, .social-section {
        margin-bottom: 2rem;
    }
    
    h2 {
        font-size: 1.6rem;
        margin-bottom: 1.5rem;
        color: var(--accent-color);
        position: relative;
        padding-bottom: 0.5rem;
    }
    
    h2:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, var(--accent-color), transparent);
    }
    
    .info-item {
        display: flex;
        margin-bottom: 1.5rem;
        gap: 1rem;
    }
    
    .info-icon {
        width: 50px;
        height: 50px;
        background-color: rgba(26, 159, 255, 0.1);
        color: var(--accent-color);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        flex-shrink: 0;
        border: 1px solid rgba(26, 159, 255, 0.2);
    }
    
    .info-details h3 {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #fff;
    }
    
    .info-details p {
        color: var(--text-gray);
    }
    
    .info-details a {
        color: var(--accent-color);
        text-decoration: none;
        transition: color 0.3s;
    }
    
    .info-details a:hover {
        color: #3aafff;
        text-decoration: underline;
    }
    
    .info-note {
        font-size: 0.9rem;
        opacity: 0.7;
        margin-top: 0.25rem;
    }
    
    .social-icons {
        display: flex;
        gap: 1rem;
        margin-top: 1.5rem;
    }
    
    .social-icon {
        width: 45px;
        height: 45px;
        background-color: var(--accent-dark);
        color: var(--text-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        transition: all 0.3s;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .social-icon:hover {
        background-color: var(--accent-color);
        color: white;
        transform: translateY(-3px);
        box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
    }
    
    .contact-form {
        margin-top: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-group label {
        display: block;
        margin-bottom: 0.5rem;
        color: var(--text-light);
        font-weight: 600;
    }
    
    .required {
        color: #ff5252;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem 1rem;
        background-color: var(--accent-dark);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 6px;
        color: var(--text-light);
        font-family: inherit;
        transition: border-color 0.3s, box-shadow 0.3s;
    }
    
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--accent-color);
        outline: none;
        box-shadow: 0 0 0 3px rgba(26, 159, 255, 0.15);
    }
    
    .contact-form .btn {
        padding: 0.8rem 2rem;
        font-size: 1.1rem;
    }
    
    .contact-map {
        margin-bottom: 3rem;
        background-color: var(--secondary-dark);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    .map-placeholder {
        height: 300px;
        background-color: var(--accent-dark);
        border-radius: 8px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        color: var(--text-gray);
        font-size: 2rem;
    }
    
    .map-placeholder p {
        margin-top: 1rem;
        font-size: 1rem;
    }
    
    .faq-section {
        background-color: var(--secondary-dark);
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    
    .faq-items {
        margin-top: 1.5rem;
    }
    
    .faq-item {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    
    .faq-question {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.2rem 0;
        cursor: pointer;
    }
    
    .faq-question h3 {
        font-size: 1.1rem;
        color: var(--text-light);
        margin: 0;
    }
    
    .faq-toggle {
        color: var(--accent-color);
        transition: transform 0.3s;
    }
    
    .faq-answer {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease;
    }
    
    .faq-answer p {
        padding: 0 0 1.2rem;
        color: var(--text-gray);
        line-height: 1.6;
    }
    
    .faq-item.active .faq-toggle {
        transform: rotate(180deg);
    }
    
    .faq-item.active .faq-answer {
        max-height: 300px;
    }
    
    @media (max-width: 768px) {
        .contact-content {
            grid-template-columns: 1fr;
        }
        
        .info-item {
            align-items: flex-start;
        }
        
        .contact-map {
            margin-top: 2rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // FAQ toggle functionality
        const faqItems = document.querySelectorAll('.faq-item');
        
        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            
            question.addEventListener('click', () => {
                // Close other items
                faqItems.forEach(otherItem => {
                    if (otherItem !== item && otherItem.classList.contains('active')) {
                        otherItem.classList.remove('active');
                    }
                });
                
                // Toggle current item
                item.classList.toggle('active');
            });
        });
        
        // Form submission handling
        const contactForm = document.getElementById('contactForm');
        
        if (contactForm) {
            contactForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Simulating form submission
                const submitButton = this.querySelector('button[type="submit"]');
                const originalText = submitButton.innerHTML;
                
                submitButton.disabled = true;
                submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...';
                
                // Simulate a network request
                setTimeout(() => {
                    alert('Mesajınız başarıyla gönderildi. En kısa sürede size dönüş yapacağız.');
                    contactForm.reset();
                    submitButton.disabled = false;
                    submitButton.innerHTML = originalText;
                }, 1500);
            });
        }
    });
</script>
@endsection 