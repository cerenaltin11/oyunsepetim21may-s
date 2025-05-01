@extends('layouts.app')

@section('title', 'Ödeme Sayfası')

@section('styles')
<style>
    .checkout-container {
        padding: 2rem 0;
    }
    
    .checkout-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid var(--accent-dark);
        padding-bottom: 1rem;
    }
    
    .checkout-grid {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 2rem;
    }
    
    .checkout-form {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 1.5rem;
    }
    
    .form-section {
        margin-bottom: 1.5rem;
    }
    
    .form-section-title {
        font-size: 1.2rem;
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--accent-dark);
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .form-section-title i {
        color: var(--accent-color);
    }
    
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    
    .form-group {
        margin-bottom: 1rem;
    }
    
    .form-group.full {
        grid-column: span 2;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    
    .form-input {
        width: 100%;
        padding: 0.8rem;
        border-radius: 4px;
        background-color: var(--accent-dark);
        border: 1px solid transparent;
        color: var(--text-light);
        transition: border-color 0.3s;
    }
    
    .form-input:focus {
        outline: none;
        border-color: var(--accent-color);
        box-shadow: 0 0 0 2px rgba(26, 159, 255, 0.2);
    }
    
    .order-summary {
        background-color: var(--secondary-dark);
        border-radius: 8px;
        padding: 1.5rem;
        height: fit-content;
    }
    
    .summary-title {
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .summary-items {
        max-height: 300px;
        overflow-y: auto;
        margin-bottom: 1rem;
    }
    
    .summary-item {
        display: flex;
        margin-bottom: 1rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--accent-dark);
    }
    
    .summary-item:last-child {
        border-bottom: none;
    }
    
    .summary-item-image {
        width: 60px;
        height: 40px;
        object-fit: cover;
        border-radius: 4px;
        margin-right: 1rem;
    }
    
    .summary-item-info {
        flex: 1;
    }
    
    .summary-item-title {
        font-weight: 600;
        margin-bottom: 0.2rem;
        font-size: 0.9rem;
    }
    
    .summary-item-price {
        color: var(--accent-color);
        font-weight: 600;
        font-size: 0.9rem;
    }
    
    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 1rem;
    }
    
    .summary-label {
        color: var(--text-gray);
    }
    
    .summary-value {
        font-weight: 600;
    }
    
    .summary-total {
        font-size: 1.2rem;
        padding-top: 1rem;
        margin-top: 1rem;
        border-top: 1px solid var(--accent-dark);
    }
    
    .checkout-btn {
        background-color: #4caf50;
        color: white;
        border: none;
        border-radius: 4px;
        padding: 0.8rem 1rem;
        font-weight: 600;
        cursor: pointer;
        width: 100%;
        margin-top: 1rem;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .checkout-btn:hover {
        background-color: #3d9a40;
    }
    
    .payment-info {
        margin-top: 1.5rem;
        font-size: 0.9rem;
        color: var(--text-gray);
        text-align: center;
    }
    
    .payment-cards {
        display: flex;
        gap: 0.5rem;
        justify-content: center;
        margin-top: 0.5rem;
    }
    
    .payment-card {
        width: 40px;
        height: 25px;
        background-color: white;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .card-preview {
        background-color: var(--accent-dark);
        border-radius: 8px;
        padding: 1rem;
        position: relative;
        height: 180px;
        margin-bottom: 1.5rem;
        overflow: hidden;
    }
    
    .card-preview::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(26, 159, 255, 0.1), rgba(26, 159, 255, 0.3));
        z-index: 0;
    }
    
    .card-type {
        position: absolute;
        top: 1rem;
        right: 1rem;
        font-size: 1.5rem;
        z-index: 1;
    }
    
    .card-number {
        position: absolute;
        top: 70px;
        left: 1rem;
        font-size: 1.2rem;
        letter-spacing: 2px;
        z-index: 1;
    }
    
    .card-name {
        position: absolute;
        bottom: 2.5rem;
        left: 1rem;
        font-size: 0.9rem;
        z-index: 1;
        text-transform: uppercase;
    }
    
    .card-expiry {
        position: absolute;
        bottom: 1rem;
        left: 1rem;
        font-size: 0.8rem;
        z-index: 1;
    }
    
    .card-chip {
        position: absolute;
        top: 30px;
        left: 1rem;
        background-color: rgba(255, 215, 0, 0.7);
        width: 40px;
        height: 30px;
        border-radius: 5px;
        z-index: 1;
    }
    
    .cvv-preview {
        position: absolute;
        bottom: 1rem;
        right: 1rem;
        background-color: rgba(255, 255, 255, 0.2);
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        font-size: 0.8rem;
        z-index: 1;
    }
    
    @media (max-width: 768px) {
        .checkout-grid {
            grid-template-columns: 1fr;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .form-group.full {
            grid-column: span 1;
        }
    }
</style>
@endsection

@section('content')
    <div class="checkout-container">
        <h1 class="checkout-title">Ödeme Sayfası</h1>
        
        <div class="checkout-grid">
            <div>
                <form action="{{ route('payment.process') }}" method="POST" class="payment-form">
                    @csrf
                    <div class="card-preview">
                        <div class="card-type" id="cardTypeIcon">
                            <i class="fab fa-cc-visa"></i>
                        </div>
                        <div class="card-number" id="cardNumberPreview">•••• •••• •••• ••••</div>
                        <div class="card-expiry" id="cardExpiryPreview">MM/YY</div>
                        <div class="card-name" id="cardNamePreview">KART SAHİBİ</div>
                        <div class="card-cvv" id="cardCvvPreview">•••</div>
                    </div>
                    
                    <div class="form-sections">
                        <div class="form-section">
                            <h2 class="form-section-title"><i class="far fa-credit-card"></i> Kart Bilgileri</h2>
                            
                            <div class="form-group full">
                                <label for="card_name" class="form-label">Kart Üzerindeki İsim</label>
                                <input type="text" id="card_name" name="card_name" class="form-input" placeholder="Kart sahibinin adı ve soyadı" required>
                            </div>
                            
                            <div class="form-group full">
                                <label for="card_number" class="form-label">Kart Numarası</label>
                                <input type="text" id="card_number" name="card_number" class="form-input" placeholder="1234 5678 9012 3456" required maxlength="19">
                            </div>
                            
                            <div class="form-grid">
                                <div class="form-group">
                                    <label for="expiry" class="form-label">Son Kullanma Tarihi</label>
                                    <input type="text" id="expiry" name="expiry" class="form-input" placeholder="MM/YY" required maxlength="5">
                                </div>
                                
                                <div class="form-group">
                                    <label for="cvv" class="form-label">CVV</label>
                                    <input type="text" id="cvv" name="cvv" class="form-input" placeholder="123" required maxlength="3">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <button type="submit" class="checkout-btn">
                        <i class="fas fa-lock"></i> Güvenli Ödeme Yap
                    </button>
                </form>
            </div>
            
            <div class="order-summary">
                <h2 class="summary-title">Sipariş Özeti</h2>
                
                <div class="summary-items">
                    @foreach($cartItems as $item)
                        <div class="summary-item">
                            <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}" class="summary-item-image">
                            <div class="summary-item-info">
                                <h3 class="summary-item-title">{{ $item['title'] }}</h3>
                                @if($item['is_personalized'])
                                    <small style="color: #e91e63;">Size özel indirim</small>
                                @endif
                                <div class="summary-item-price">
                                    @if($item['discount_price'])
                                        <span>₺{{ $item['discount_price'] }}</span>
                                    @else
                                        <span>₺{{ $item['price'] }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="summary-row">
                    <span class="summary-label">Ürünler ({{ $totalCount }})</span>
                    <span class="summary-value">₺{{ $totalPrice + $discount }}</span>
                </div>
                
                @if($discount > 0)
                    <div class="summary-row">
                        <span class="summary-label">İndirim</span>
                        <span class="summary-value">-₺{{ $discount }}</span>
                    </div>
                @endif
                
                <div class="summary-row">
                    <span class="summary-label">Kargo</span>
                    <span class="summary-value">Ücretsiz</span>
                </div>
                
                <div class="summary-row summary-total">
                    <span class="summary-label">Toplam</span>
                    <span class="summary-value">₺{{ $totalPrice }}</span>
                </div>
                
                <div class="payment-info">
                    <p>Güvenli ödeme ile işlem yapıyorsunuz. Kart bilgileriniz şifrelenir ve güvenli biçimde saklanır.</p>
                    <div class="payment-cards">
                        <div class="payment-card">
                            <i class="fab fa-cc-visa"></i>
                        </div>
                        <div class="payment-card">
                            <i class="fab fa-cc-mastercard"></i>
                        </div>
                        <div class="payment-card">
                            <i class="fab fa-cc-paypal"></i>
                        </div>
                        <div class="payment-card">
                            <i class="fab fa-bitcoin"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cardName = document.getElementById('card_name');
        const cardNumber = document.getElementById('card_number');
        const expiry = document.getElementById('expiry');
        const cvv = document.getElementById('cvv');
        
        const cardNamePreview = document.getElementById('cardNamePreview');
        const cardNumberPreview = document.getElementById('cardNumberPreview');
        const cardExpiryPreview = document.getElementById('cardExpiryPreview');
        const cardCvvPreview = document.getElementById('cardCvvPreview');
        const cardTypeIcon = document.getElementById('cardTypeIcon');
        
        // Update card name preview
        cardName.addEventListener('input', function() {
            cardNamePreview.textContent = this.value || 'KART SAHİBİ';
        });
        
        // Format card number and update preview
        cardNumber.addEventListener('input', function(e) {
            let value = this.value.replace(/\s+/g, '');
            
            // Only allow digits
            value = value.replace(/\D/g, '');
            
            // Reformat with spaces
            if (value.length > 0) {
                value = value.match(/.{1,4}/g).join(' ');
            }
            
            this.value = value;
            
            // Update preview
            if (value) {
                // Show first 4 digits and mask the rest except last 4
                if (value.length > 9) {
                    const firstGroup = value.substring(0, 4);
                    const lastGroup = value.substring(value.length - 4);
                    const middle = value.substring(4, value.length - 4).replace(/[0-9]/g, '•');
                    cardNumberPreview.textContent = firstGroup + ' ' + middle + ' ' + lastGroup;
                } else {
                    cardNumberPreview.textContent = value + '•'.repeat(19 - value.length);
                }
            } else {
                cardNumberPreview.textContent = '•••• •••• •••• ••••';
            }
            
            // Detect card type
            if (value) {
                const firstDigit = value.charAt(0);
                const firstTwoDigits = parseInt(value.substring(0, 2));
                
                // Simple card type detection
                if (firstDigit === '4') {
                    cardTypeIcon.innerHTML = '<i class="fab fa-cc-visa"></i>';
                } else if (firstDigit === '5' && firstTwoDigits >= 51 && firstTwoDigits <= 55) {
                    cardTypeIcon.innerHTML = '<i class="fab fa-cc-mastercard"></i>';
                } else if (firstDigit === '3' && (value.charAt(1) === '4' || value.charAt(1) === '7')) {
                    cardTypeIcon.innerHTML = '<i class="fab fa-cc-amex"></i>';
                } else if (firstDigit === '6') {
                    cardTypeIcon.innerHTML = '<i class="fab fa-cc-discover"></i>';
                } else {
                    cardTypeIcon.innerHTML = '<i class="far fa-credit-card"></i>';
                }
            } else {
                cardTypeIcon.innerHTML = '<i class="fab fa-cc-visa"></i>';
            }
        });
        
        // Format expiry date (MM/YY) and update preview
        expiry.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            
            if (value.length > 0) {
                // Format as MM/YY
                if (value.length > 2) {
                    value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
                
                // Validate month (01-12)
                if (value.length >= 2) {
                    const month = parseInt(value.substring(0, 2));
                    if (month > 12) {
                        value = '12' + value.substring(2);
                    } else if (month === 0) {
                        value = '01' + value.substring(2);
                    }
                }
            }
            
            this.value = value;
            
            // Update preview
            if (value) {
                const parts = value.split('/');
                const month = parts[0] || 'MM';
                const year = parts[1] || 'YY';
                cardExpiryPreview.textContent = month + '/' + year;
            } else {
                cardExpiryPreview.textContent = 'MM/YY';
            }
        });
        
        // Update CVV preview
        cvv.addEventListener('input', function() {
            // Only allow digits
            this.value = this.value.replace(/\D/g, '');
            
            // Update preview
            if (this.value) {
                cardCvvPreview.textContent = '•'.repeat(this.value.length);
            } else {
                cardCvvPreview.textContent = '•••';
            }
        });
    });
</script>
@endsection 