@extends('layouts.app')

@section('title', 'Ana Sayfa')

@section('styles')
<style>
    .hero-banner {
        background-color: #000;
        border-radius: 8px;
        height: 400px;
        margin-bottom: 2rem;
        overflow: hidden;
        position: relative;
        box-shadow: 0 10px 30px -5px rgba(0, 0, 0, 0.3);
    }
    
    .hero-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 3;
        width: 80%;
    }
    
    .hero-title {
        font-size: 3rem;
        margin-bottom: 1rem;
        color: #fff;
        text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.7);
    }
    
    .hero-description {
        font-size: 1.2rem;
        color: #e0e0e0;
        margin-bottom: 2rem;
        text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.7);
    }
    
    .game-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }
    
    .game-card {
        background-color: #1a1a1a;
        border-radius: 8px;
        overflow: hidden;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    
    .game-card:hover {
        transform: translateY(-5px);
    }
    
    .game-thumb {
        width: 100%;
        height: 150px;
        object-fit: cover;
    }
    
    .game-info {
        padding: 1rem;
    }
    
    .game-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #fff;
    }
    
    .section-title {
        font-size: 1.8rem;
        margin-bottom: 1.5rem;
        color: #fff;
        border-left: 3px solid #007bff;
        padding-left: 10px;
    }
    
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        color: white;
        font-weight: 500;
        transition: background-color 0.3s;
    }
    
    .btn-primary:hover {
        background-color: #0069d9;
    }
    
    .category-tag {
        display: inline-block;
        background-color: #333;
        color: #ddd;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        font-size: 0.7rem;
        margin-right: 0.5rem;
        margin-bottom: 0.5rem;
    }
    
    .price {
        color: #007bff;
        font-weight: 700;
    }
    
    .game-price {
        margin-top: 0.5rem;
        display: flex;
        justify-content: space-between;
    }
    
    .discount {
        background-color: #28a745;
        color: white;
        padding: 0.1rem 0.4rem;
        border-radius: 4px;
        font-size: 0.8rem;
    }
    
    /* Daily Reward Modal styles */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 1050;
        animation: fadeIn 0.3s ease-in-out;
        overflow-y: auto;
    }
    
    .modal-content {
        position: relative;
        margin: 10vh auto;
        width: 90%;
        max-width: 500px;
        background: linear-gradient(145deg, rgba(25, 25, 30, 0.95), rgba(15, 15, 20, 0.98));
        border-radius: 15px;
        box-shadow: 0 15px 50px rgba(0, 0, 0, 0.5);
        overflow: hidden;
        animation: slideIn 0.4s ease-out;
        border: 1px solid rgba(40, 40, 50, 0.5);
    }
    
    .modal-header {
        padding: 1.2rem 1.5rem;
        background: linear-gradient(to right, #1a9fff, #60efff);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .modal-header h2 {
        color: white;
        margin: 0;
        font-size: 1.5rem;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .modal-close {
        color: white;
        font-size: 1.8rem;
        cursor: pointer;
        transition: all 0.2s;
        opacity: 0.8;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }
    
    .modal-close:hover {
        transform: scale(1.1);
        opacity: 1;
        background: rgba(0, 0, 0, 0.2);
    }
    
    .modal-body {
        padding: 2rem;
        text-align: center;
    }
    
    .daily-reward-animation {
        margin: 0 auto 2rem;
    }
    
    .gift-box {
        width: 120px;
        height: 120px;
        background: linear-gradient(145deg, #2c6dd1, #1a9fff);
        border-radius: 50%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3.5rem;
        color: white;
        box-shadow: 0 0 30px rgba(26, 159, 255, 0.5);
        animation: pulse 2s infinite;
    }
    
    .daily-reward-info h3 {
        color: white;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }
    
    .daily-reward-info p {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1.5rem;
        font-size: 1.1rem;
    }
    
    .streak-counter {
        background: rgba(26, 159, 255, 0.1);
        color: #1a9fff;
        padding: 1rem;
        border-radius: 10px;
        font-weight: 600;
        margin: 1.5rem auto;
        max-width: 200px;
        font-size: 1.2rem;
        border: 1px solid rgba(26, 159, 255, 0.2);
    }
    
    .streak-counter span {
        font-size: 2rem;
        font-weight: 700;
        color: #1a9fff;
        display: block;
        margin-bottom: 0.2rem;
    }
    
    .modal-footer {
        padding: 1.5rem;
        text-align: center;
    }
    
    #claim-reward-btn {
        padding: 1rem 2rem;
        font-size: 1.1rem;
        letter-spacing: 0.5px;
        background: linear-gradient(to right, #1a9fff, #60efff);
        box-shadow: 0 5px 15px rgba(26, 159, 255, 0.3);
        transform: translateY(0);
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    #claim-reward-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(26, 159, 255, 0.5);
    }
    
    /* Badge earned styles */
    .badge-earned-container {
        background: rgba(76, 175, 80, 0.1);
        padding: 1.5rem;
        border-radius: 12px;
        margin-top: 1.5rem;
        border-left: 4px solid #4caf50;
    }
    
    .badge-earned-animation {
        margin-bottom: 1.5rem;
    }
    
    .badge-earned-container .badge-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(145deg, #4caf50, #43a047);
        border-radius: 50%;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: white;
        box-shadow: 0 0 25px rgba(76, 175, 80, 0.5);
        animation: bounce 1s ease-in-out;
    }
    
    .badge-earned-container h3 {
        color: #4caf50;
        margin-bottom: 1rem;
        font-size: 1.5rem;
    }
    
    .badge-earned-container p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1.1rem;
        line-height: 1.5;
        margin-bottom: 1.2rem;
    }
    
    .btn-success {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 0.8rem 1.8rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        font-size: 1rem;
        margin-top: 0.5rem;
    }
    
    .btn-success:hover {
        background-color: #43a047;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(76, 175, 80, 0.3);
    }
    
    .hidden {
        display: none;
    }
    
    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    
    @keyframes slideIn {
        from { transform: translateY(-50px); opacity: 0; }
        to { transform: translateY(0); opacity: 1; }
    }
    
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.05); }
        100% { transform: scale(1); }
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-20px); }
        60% { transform: translateY(-10px); }
    }
</style>
@endsection

@section('content')
    <section class="hero-banner">
        <div class="hero-content">
            <h1 class="hero-title">OyunSepetim'e Hoş Geldiniz</h1>
            <p class="hero-description">En sevdiğiniz oyunları keşfedin, satın alın ve kütüphanenizde saklayın.</p>
            <a href="/games" class="btn btn-primary">Oyunları Keşfet</a>
        </div>
    </section>

    <!-- Daily Rewards Modal -->
    @auth
    <div id="daily-reward-modal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2><i class="fas fa-gift"></i> Günlük Ödül</h2>
                <span class="modal-close">&times;</span>
            </div>
            <div class="modal-body">
                <div class="daily-reward-animation">
                    <div class="gift-box">
                        <i class="fas fa-gift"></i>
                    </div>
                </div>
                <div class="daily-reward-info">
                    <h3>Günlük Giriş Ödülünüz</h3>
                    <p>Sitemize her gün giriş yaparak süreklilik rozeti kazanabilirsiniz!</p>
                    <div class="streak-counter">
                        <span id="days-streak">0</span> gün seri giriş
                    </div>
                </div>
                <div class="badge-earned-container hidden" id="badge-earned">
                    <div class="badge-earned-animation">
                        <div class="badge-icon">
                            <i class="fas fa-award" id="badge-icon"></i>
                        </div>
                    </div>
                    <h3>Yeni Rozet Kazandınız!</h3>
                    <p id="badge-description">Tebrikler! Deneyimli kullanıcı rozeti kazandınız.</p>
                    <a href="{{ route('profile.badges') }}" class="btn btn-success" id="view-profile-btn" style="display: none;">Rozetlerimi Görüntüle</a>
                </div>
            </div>
            <div class="modal-footer">
                <button id="claim-reward-btn" class="btn btn-primary">Ödülü Al</button>
            </div>
        </div>
    </div>
    @endauth

    <section>
        <h2 class="section-title">Popüler Oyunlar</h2>
        <div class="game-grid">
            <div class="game-card">
                <a href="/games/cyberpunk-2077">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg" alt="Cyberpunk 2077" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Aksiyon</div>
                        <div class="category-tag">RPG</div>
                        <h3 class="game-title">Cyberpunk 2077</h3>
                        <div class="game-price">
                            <span class="price">₺499</span>
                            <span class="discount">-25%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/red-dead-redemption-2">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1174180/header.jpg" alt="Red Dead Redemption 2" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Açık Dünya</div>
                        <div class="category-tag">Macera</div>
                        <h3 class="game-title">Red Dead Redemption 2</h3>
                        <div class="game-price">
                            <span class="price">₺349</span>
                            <span class="discount">-35%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/fifa-23">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1811260/header.jpg" alt="FIFA 23" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Spor</div>
                        <h3 class="game-title">FIFA 23</h3>
                        <div class="game-price">
                            <span class="price">₺699</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/elden-ring">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1245620/header.jpg" alt="Elden Ring" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">RPG</div>
                        <div class="category-tag">Aksiyon</div>
                        <h3 class="game-title">Elden Ring</h3>
                        <div class="game-price">
                            <span class="price">₺599</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/call-of-duty-modern-warfare-2">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1938090/header.jpg" alt="Call of Duty: Modern Warfare 2" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">FPS</div>
                        <div class="category-tag">Aksiyon</div>
                        <h3 class="game-title">Call of Duty: Modern Warfare 2</h3>
                        <div class="game-price">
                            <span class="price">₺699</span>
                            <span class="discount">-15%</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <section>
        <h2 class="section-title">Strateji Oyunları</h2>
        <div class="game-grid">
            <div class="game-card">
                <a href="/games/age-of-empires-iv">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1466860/header.jpg" alt="Age of Empires IV" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Strateji</div>
                        <div class="category-tag">Tarih</div>
                        <h3 class="game-title">Age of Empires IV</h3>
                        <div class="game-price">
                            <span class="price">₺249</span>
                            <span class="discount">-50%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/civilization-vi">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/289070/header.jpg" alt="Civilization VI" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Strateji</div>
                        <div class="category-tag">Sıra Tabanlı</div>
                        <h3 class="game-title">Sid Meier's Civilization VI</h3>
                        <div class="game-price">
                            <span class="price">₺179</span>
                            <span class="discount">-70%</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
    
    <section>
        <h2 class="section-title">Korku Oyunları</h2>
        <div class="game-grid">
            <div class="game-card">
                <a href="/games/resident-evil-village">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1196590/header.jpg" alt="Resident Evil Village" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Korku</div>
                        <h3 class="game-title">Resident Evil Village</h3>
                        <div class="game-price">
                            <span class="price">₺499</span>
                            <span class="discount">-20%</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-title">Aksiyon Oyunları</h2>
        <div class="game-grid">
            <div class="game-card">
                <a href="/games/call-of-duty-modern-warfare-2">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1938090/header.jpg" alt="Call of Duty: Modern Warfare 2" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">FPS</div>
                        <div class="category-tag">Aksiyon</div>
                        <h3 class="game-title">Call of Duty: Modern Warfare 2</h3>
                        <div class="game-price">
                            <span class="price">₺699</span>
                            <span class="discount">-15%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/cyberpunk-2077">
                    <img src="https://cdn.akamai.steamstatic.com/steam/apps/1091500/header.jpg" alt="Cyberpunk 2077" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Aksiyon</div>
                        <div class="category-tag">RPG</div>
                        <h3 class="game-title">Cyberpunk 2077</h3>
                        <div class="game-price">
                            <span class="price">₺499</span>
                            <span class="discount">-25%</span>
                        </div>
                    </div>
                </a>
            </div>
            <div class="game-card">
                <a href="/games/god-of-war-ragnarok">
                    <img src="https://image.api.playstation.com/vulcan/ap/rnd/202207/1210/4xJ8XB3bi888QTLZYdl7Oi0s.png" alt="God of War Ragnarök" class="game-thumb">
                    <div class="game-info">
                        <div class="category-tag">Aksiyon</div>
                        <div class="category-tag">Macera</div>
                        <h3 class="game-title">God of War Ragnarök</h3>
                        <div class="game-price">
                            <span class="price">₺799</span>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Daily rewards modal functionality
        const dailyRewardModal = document.getElementById('daily-reward-modal');
        const closeModal = document.querySelector('.modal-close');
        const claimRewardBtn = document.getElementById('claim-reward-btn');
        const daysStreakElement = document.getElementById('days-streak');
        const badgeEarnedContainer = document.getElementById('badge-earned');
        const badgeDescription = document.getElementById('badge-description');
        
        // Check if user has a daily reward available
        function checkDailyReward() {
            fetch('/daily-reward/check')
                .then(response => response.json())
                .then(data => {
                    console.log('Daily reward check response:', data); // Debug log
                    if (data.reward_available) {
                        // Update streak count
                        daysStreakElement.textContent = data.consecutive_days || 0;
                        
                        // Show the modal
                        dailyRewardModal.style.display = 'block';
                    } else {
                        console.log('No reward available'); // Debug log
                    }
                })
                .catch(error => console.error('Error checking daily reward:', error));
        }
        
        // Claim the daily reward
        function claimDailyReward() {
            console.log('Claiming reward...'); // Debug log
            
            fetch('/daily-reward/claim', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log('Claim response:', data); // Debug log
                
                if (data.success) {
                    // Update the streak counter
                    daysStreakElement.textContent = data.consecutive_days || 0;
                    
                    // Hide the claim button temporarily
                    claimRewardBtn.style.display = 'none';
                    
                    // Check if user earned any new badges
                    if (data.new_badges && data.new_badges.length > 0) {
                        // Show the badge earned container
                        badgeEarnedContainer.classList.remove('hidden');
                        
                        // Update badge icon and description
                        const badge = data.new_badges[0];
                        document.getElementById('badge-icon').className = `fas ${badge.icon}`;
                        badgeDescription.textContent = `Tebrikler! ${badge.description} kazandınız.`;
                        
                        // Show the view profile button
                        const viewProfileBtn = document.getElementById('view-profile-btn');
                        viewProfileBtn.style.display = 'inline-block';
                        
                        // Change claim button to a close button
                        claimRewardBtn.textContent = 'Kapat';
                        claimRewardBtn.style.display = 'block';
                        claimRewardBtn.onclick = function() {
                            dailyRewardModal.style.display = 'none';
                            window.location.href = viewProfileBtn.getAttribute('href');
                        };
                    } else {
                        // If no new badges, show a success message and redirect to profile
                        badgeEarnedContainer.classList.remove('hidden');
                        document.getElementById('badge-icon').className = 'fas fa-check-circle';
                        badgeDescription.textContent = `Günlük giriş ödülünüz alındı! Toplamda ${data.consecutive_days} gün giriş yaptınız.`;
                        
                        // Show the view profile button
                        const viewProfileBtn = document.getElementById('view-profile-btn');
                        viewProfileBtn.style.display = 'inline-block';
                        viewProfileBtn.textContent = 'Profilime Git';
                        viewProfileBtn.href = "/dashboard"; // Redirect to profile page
                        
                        // Change claim button to a close button
                        claimRewardBtn.textContent = 'Kapat';
                        claimRewardBtn.style.display = 'block';
                        claimRewardBtn.onclick = function() {
                            dailyRewardModal.style.display = 'none';
                            window.location.href = viewProfileBtn.getAttribute('href');
                        };
                        
                        // Auto close after 5 seconds if no badge earned
                        setTimeout(() => {
                            dailyRewardModal.style.display = 'none';
                        }, 5000);
                    }
                } else {
                    console.error('Claim failed:', data.message);
                }
            })
            .catch(error => console.error('Error claiming daily reward:', error));
        }
        
        // Close modal when clicking the close button
        if (closeModal) {
            closeModal.addEventListener('click', function() {
                dailyRewardModal.style.display = 'none';
            });
        }
        
        // Claim reward button click
        if (claimRewardBtn) {
            claimRewardBtn.addEventListener('click', claimDailyReward);
        }
        
        // Check for daily reward when page loads
        setTimeout(checkDailyReward, 1000); // Sayfa yüklenişine biraz daha fazla zaman tanı
        
        // Close modal when clicking outside of it
        window.addEventListener('click', function(event) {
            if (event.target === dailyRewardModal) {
                dailyRewardModal.style.display = 'none';
            }
        });
    });
</script>
@endsection 