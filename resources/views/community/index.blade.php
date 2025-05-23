@extends('layouts.app')

@section('title', 'Topluluk')

@section('styles')
<style>
    :root {
        --primary-dark: #121212;
        --secondary-dark: #1e1e1e;
        --accent-dark: #2a2a2a;
        --text-light: #f1f1f1;
        --text-gray: #a0a0a0;
        --accent-color: #1a9fff;
        --accent-hover: #0d8bf0;
        --border-color: rgba(255, 255, 255, 0.1);
    }
    
    body {
        background-color: var(--primary-dark);
        color: var(--text-light);
    }
    
    .community-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 20px;
    }
    
    .community-header {
        text-align: center;
        margin-bottom: 40px;
    }
    
    .community-title {
        color: var(--text-light);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 10px;
    }
    
    .community-desc {
        color: var(--text-gray);
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Quick Actions */
    .quick-actions {
        display: flex;
        justify-content: center;
        gap: 16px;
        margin-bottom: 40px;
        flex-wrap: wrap;
    }
    
    .action-btn {
        background: linear-gradient(135deg, var(--accent-color), var(--accent-hover));
        color: white;
        border: none;
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 8px;
        box-shadow: 0 4px 15px rgba(26, 159, 255, 0.3);
    }
    
    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(26, 159, 255, 0.4);
        color: white;
        text-decoration: none;
    }
    
    /* Content Tabs */
    .content-tabs {
        display: flex;
        justify-content: center;
        background: var(--secondary-dark);
        border-radius: 12px;
        padding: 8px;
        margin-bottom: 30px;
        overflow-x: auto;
    }
    
    .tab-btn {
        background: transparent;
        color: var(--text-gray);
        border: none;
        padding: 12px 20px;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
    }
    
    .tab-btn:hover {
        color: var(--text-light);
        background: var(--accent-dark);
    }
    
    .tab-btn.active {
        background: var(--accent-color);
        color: white;
    }
    
    /* Content Grid */
    .content-section {
        display: none;
    }
    
    .content-section.active {
        display: block;
    }
    
    .content-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }
    
    .content-card {
        background: var(--secondary-dark);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid var(--border-color);
    }
    
    .content-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        border-color: var(--accent-color);
    }
    
         .card-image {
         width: 100%;
         height: 180px;
         object-fit: cover;
         background: var(--accent-dark);
     }
     
     .card-video-container {
         position: relative;
         cursor: pointer;
     }
     
     .card-video {
         width: 100%;
         height: 180px;
         object-fit: cover;
         background: #000;
     }
     
     .video-overlay {
         position: absolute;
         top: 50%;
         left: 50%;
         transform: translate(-50%, -50%);
         color: rgba(255, 255, 255, 0.8);
         font-size: 3rem;
         pointer-events: none;
         transition: all 0.3s ease;
     }
     
     .card-video-container:hover .video-overlay {
         color: var(--accent-color);
         transform: translate(-50%, -50%) scale(1.1);
     }
    
    .card-content {
        padding: 16px;
    }
    
    .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: var(--text-light);
    }
    
    .card-game {
        color: var(--accent-color);
        font-size: 0.9rem;
        margin-bottom: 8px;
    }
    
    .card-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        color: var(--text-gray);
        font-size: 0.85rem;
    }
    
    .card-author {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .author-avatar {
        width: 24px;
        height: 24px;
        border-radius: 50%;
        background: var(--accent-color);
    }
    
         .card-stats {
         display: flex;
         gap: 12px;
     }
     
     .stat {
         display: flex;
         align-items: center;
         gap: 4px;
         cursor: pointer;
         padding: 4px 8px;
         border-radius: 4px;
         transition: all 0.2s;
     }
     
     .stat:hover {
         background: var(--accent-dark);
         color: var(--accent-color);
     }
     
     .stat.liked {
         color: #ff4757;
     }
     
     .stat.commented {
         color: var(--accent-color);
     }
     
     /* Yorum alanı */
     .comments-section {
         border-top: 1px solid var(--border-color);
         padding: 12px 16px 0;
         display: none;
     }
     
     .comments-section.show {
         display: block;
     }
     
     .comment-form {
         display: flex;
         gap: 8px;
         margin-bottom: 12px;
     }
     
     .comment-input {
         flex: 1;
         background: var(--accent-dark);
         border: 1px solid var(--border-color);
         border-radius: 6px;
         padding: 8px 12px;
         color: var(--text-light);
         font-size: 0.85rem;
         resize: none;
         min-height: 36px;
         max-height: 100px;
     }
     
     .comment-input:focus {
         outline: none;
         border-color: var(--accent-color);
     }
     
     .comment-btn {
         background: var(--accent-color);
         color: white;
         border: none;
         border-radius: 6px;
         padding: 8px 16px;
         font-size: 0.85rem;
         font-weight: 600;
         cursor: pointer;
         transition: background 0.2s;
         height: fit-content;
     }
     
     .comment-btn:hover {
         background: var(--accent-hover);
     }
     
     .comment-btn:disabled {
         background: var(--border-color);
         cursor: not-allowed;
     }
     
     .comment-item {
         display: flex;
         gap: 8px;
         margin-bottom: 8px;
         padding: 8px;
         background: rgba(255, 255, 255, 0.02);
         border-radius: 6px;
     }
     
     .comment-avatar {
         width: 24px;
         height: 24px;
         border-radius: 50%;
         background: var(--accent-color);
         flex-shrink: 0;
     }
     
     .comment-content {
         flex: 1;
     }
     
     .comment-author {
         font-size: 0.8rem;
         font-weight: 600;
         color: var(--accent-color);
         margin-bottom: 2px;
     }
     
     .comment-text {
         font-size: 0.85rem;
         color: var(--text-light);
         line-height: 1.4;
         margin-bottom: 4px;
     }
     
     .comment-time {
         font-size: 0.7rem;
         color: var(--text-gray);
     }
    
    /* Popular Games Sidebar */
    .popular-games {
        background: var(--secondary-dark);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid var(--border-color);
    }
    
    .sidebar-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 16px;
        color: var(--text-light);
    }
    
    .game-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 0;
        border-bottom: 1px solid var(--border-color);
    }
    
    .game-item:last-child {
        border-bottom: none;
    }
    
    .game-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        background: var(--accent-dark);
    }
    
    .game-info h4 {
        font-size: 0.95rem;
        margin: 0 0 4px 0;
        color: var(--text-light);
    }
    
    .game-info p {
        font-size: 0.8rem;
        margin: 0;
        color: var(--text-gray);
    }
    
    /* Quick Post */
    .quick-post {
        background: var(--secondary-dark);
        border-radius: 12px;
        padding: 20px;
        margin-bottom: 30px;
        border: 1px solid var(--border-color);
    }
    
    .post-header {
        margin-bottom: 16px;
    }
    
    .current-user-info {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .current-user-name {
        font-weight: 600;
        color: var(--text-light);
        font-size: 1rem;
    }
    
    .post-input {
        width: 100%;
        background: var(--accent-dark);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        padding: 12px;
        color: var(--text-light);
        resize: none;
        margin-bottom: 12px;
        min-height: 60px;
        position: relative;
    }
    
    .post-input:focus {
        outline: none;
        border-color: var(--accent-color);
    }
    
    /* Friend Suggestions */
    .friend-suggestions {
        position: absolute;
        background: var(--secondary-dark);
        border: 1px solid var(--border-color);
        border-radius: 8px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        width: 250px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }
    
    .friend-suggestion-item {
        padding: 10px 12px;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 10px;
        transition: background 0.2s;
    }
    
    .friend-suggestion-item:hover {
        background: var(--accent-dark);
    }
    
    .friend-suggestion-avatar {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: bold;
        font-size: 0.8rem;
    }
    
    .friend-suggestion-name {
        color: var(--text-light);
        font-size: 0.9rem;
    }
    
    /* Image Preview */
    .image-preview {
        margin-bottom: 12px;
        position: relative;
    }
    
    .preview-container {
        position: relative;
        display: inline-block;
    }
    
    .remove-image {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: background 0.2s;
    }
    
    .remove-image:hover {
        background: rgba(255, 0, 0, 0.7);
    }
    
    /* Mention styling */
    .mention {
        color: var(--accent-color);
        font-weight: 600;
        background: rgba(26, 159, 255, 0.1);
        padding: 2px 4px;
        border-radius: 4px;
        text-decoration: none;
    }
    
    .mention:hover {
        background: rgba(26, 159, 255, 0.2);
    }
    
    .post-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .post-options {
        display: flex;
        gap: 12px;
    }
    
    .post-option {
        background: var(--accent-dark);
        border: 1px solid var(--border-color);
        color: var(--text-gray);
        padding: 8px 12px;
        border-radius: 6px;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .post-option:hover {
        background: var(--accent-color);
        color: white;
        border-color: var(--accent-color);
    }
    
    .post-btn {
        background: var(--accent-color);
        color: white;
        border: none;
        padding: 8px 20px;
        border-radius: 6px;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    
    .post-btn:hover {
        background: var(--accent-hover);
    }
    
    /* Layout */
    .main-layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 30px;
    }
    
    @media (max-width: 992px) {
        .main-layout {
            grid-template-columns: 1fr;
        }
        
        .quick-actions {
            flex-direction: column;
        align-items: center;
        }
        
        .action-btn {
            width: 200px;
            justify-content: center;
        }
    }
    
         /* Loading skeleton */
     .skeleton {
         background: linear-gradient(90deg, var(--accent-dark) 25%, rgba(255,255,255,0.1) 50%, var(--accent-dark) 75%);
         background-size: 200% 100%;
         animation: loading 1.5s infinite;
     }
     
     @keyframes loading {
         0% { background-position: 200% 0; }
         100% { background-position: -200% 0; }
     }
     
     @keyframes slideIn {
         from {
             transform: translateX(100%);
             opacity: 0;
         }
         to {
             transform: translateX(0);
             opacity: 1;
         }
     }
     
     /* Modals */
     .modal-overlay {
         position: fixed;
         top: 0;
         left: 0;
         width: 100%;
         height: 100%;
         background: rgba(0, 0, 0, 0.8);
        display: flex;
         justify-content: center;
        align-items: center;
         z-index: 1000;
         opacity: 0;
         visibility: hidden;
         transition: all 0.3s ease;
     }
     
     .modal-overlay.show {
         opacity: 1;
         visibility: visible;
     }
     
     .modal {
         background: var(--secondary-dark);
         border-radius: 12px;
         padding: 24px;
         width: 90%;
         max-width: 500px;
         border: 1px solid var(--border-color);
         transform: scale(0.9);
         transition: transform 0.3s ease;
     }
     
     .modal-overlay.show .modal {
         transform: scale(1);
     }
     
     .modal-header {
         display: flex;
         justify-content: space-between;
        align-items: center;
         margin-bottom: 20px;
     }
     
     .modal-title {
         font-size: 1.3rem;
         font-weight: 600;
         color: var(--text-light);
     }
     
     .modal-close {
         background: none;
         border: none;
         color: var(--text-gray);
         font-size: 1.5rem;
         cursor: pointer;
         transition: color 0.2s;
         padding: 4px;
     }
     
     .modal-close:hover {
         color: var(--text-light);
     }
     
     .form-group {
         margin-bottom: 16px;
     }
     
     .form-label {
         display: block;
        color: var(--text-light);
         font-size: 0.9rem;
        font-weight: 600;
         margin-bottom: 6px;
     }
     
     .form-input, .form-select, .form-textarea {
         width: 100%;
         background: var(--accent-dark);
         border: 1px solid var(--border-color);
         border-radius: 8px;
         padding: 12px;
         color: var(--text-light);
        font-size: 0.9rem;
         transition: border-color 0.2s;
         box-sizing: border-box;
     }
     
     .form-input:focus, .form-select:focus, .form-textarea:focus {
         outline: none;
         border-color: var(--accent-color);
     }
     
     .form-textarea {
         resize: vertical;
         min-height: 100px;
     }
     
     .form-file-input {
         background: var(--accent-dark);
         border: 2px dashed var(--border-color);
         border-radius: 8px;
         padding: 20px;
         text-align: center;
         cursor: pointer;
         transition: all 0.2s;
     }
     
     .form-file-input:hover {
         border-color: var(--accent-color);
         background: rgba(26, 159, 255, 0.05);
     }
     
     .form-file-input:active {
         transform: scale(0.98);
     }
     
     .form-file-input input[type="file"] {
         display: none;
     }
     
     .form-file-input.file-selected {
         border-color: var(--accent-color);
         background: rgba(26, 159, 255, 0.1);
     }
     
     .file-upload-text {
        color: var(--text-gray);
        font-size: 0.9rem;
     }
     
     .file-upload-icon {
         color: var(--accent-color);
         font-size: 2rem;
         margin-bottom: 8px;
     }
     
     .modal-footer {
        display: flex;
         justify-content: flex-end;
         gap: 12px;
         margin-top: 20px;
     }
     
     .btn-cancel {
         background: var(--accent-dark);
         color: var(--text-light);
         border: 1px solid var(--border-color);
         padding: 10px 20px;
         border-radius: 8px;
         cursor: pointer;
         transition: all 0.2s;
     }
     
     .btn-cancel:hover {
         background: var(--border-color);
     }
     
     .btn-submit {
         background: var(--accent-color);
         color: white;
         border: none;
         padding: 10px 20px;
         border-radius: 8px;
         font-weight: 600;
         cursor: pointer;
         transition: background 0.2s;
     }
     
     .btn-submit:hover {
         background: var(--accent-hover);
     }
     
     /* Post option states */
     .post-option.active {
         background: var(--accent-color);
         color: white;
         border-color: var(--accent-color);
     }
     
     .post-expanded {
         background: var(--accent-dark);
         border-radius: 8px;
         padding: 12px;
         margin-top: 12px;
         border: 1px solid var(--border-color);
     }
     
     .file-input {
         margin: 8px 0;
     }
     
     .url-input {
         width: 100%;
         background: var(--secondary-dark);
         border: 1px solid var(--border-color);
         border-radius: 6px;
         padding: 8px;
        color: var(--text-light);
         margin: 8px 0;
     }
     
     .url-input:focus {
         outline: none;
         border-color: var(--accent-color);
    }
</style>
@endsection

@section('content')
<div class="community-container">
    <!-- Header -->
    <div class="community-header">
        <h1 class="community-title">Topluluk Merkezi</h1>
        <p class="community-desc">
            Oyun severlerin buluşma noktası. İçerik paylaş, tartış, keşfet.
        </p>
    </div>

         <!-- Quick Actions -->
     <div class="quick-actions">
         <button class="action-btn" onclick="openModal('screenshotModal')">
             <i class="fas fa-camera"></i> Ekran Görüntüsü Paylaş
         </button>
         <button class="action-btn" onclick="openModal('videoModal')">
             <i class="fas fa-video"></i> Video Paylaş
         </button>
         <button class="action-btn" onclick="openModal('discussionModal')">
             <i class="fas fa-comments"></i> Tartışma Başlat
         </button>
                            </div>

        <!-- Content Tabs -->
    <div class="content-tabs">
        <button class="tab-btn active" onclick="showTab('all')">Tümü</button>
        <button class="tab-btn" onclick="showTab('screenshots')">Ekran Görüntüleri</button>
        <button class="tab-btn" onclick="showTab('videos')">Videolar</button>
        <button class="tab-btn" onclick="showTab('discussions')">Tartışmalar</button>
        <button class="tab-btn" onclick="showTab('guides')">Rehberler</button>
    </div>

    <!-- Main Layout -->
    <div class="main-layout">
        <!-- Main Content -->
        <div class="main-content">
                        <!-- Quick Post -->
            <div class="quick-post">
                <div class="post-header">
                    <div class="current-user-info">
                        <div class="current-user-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">
                            ${currentUser.avatar}
                        </div>
                        <span class="current-user-name">${currentUser.name}</span>
                    </div>
                </div>
                <textarea class="post-input" placeholder="Toplulukla ne paylaşmak istiyorsun? Arkadaşlarını etiketlemek için @ kullan..."></textarea>
                
                <!-- Suggestions Dropdown -->
                <div class="friend-suggestions" id="friendSuggestions" style="display: none;">
                    <!-- Arkadaş önerileri buraya eklenecek -->
                </div>
                
                <!-- Image Preview -->
                <div class="image-preview" id="imagePreview" style="display: none;">
                    <div class="preview-container">
                        <img id="previewImage" src="" alt="Preview" style="max-width: 100%; max-height: 200px; border-radius: 8px;">
                        <button class="remove-image" onclick="removeQuickPostImage()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                
                <div class="post-actions">
                    <div class="post-options">
                        <button class="post-option" onclick="openQuickPostImageDialog()">
                            <i class="fas fa-image"></i> Görsel
                        </button>
                        <button class="post-option"><i class="fas fa-link"></i> Link</button>
                        <button class="post-option"><i class="fas fa-gamepad"></i> Oyun</button>
                    </div>
                    <button class="post-btn">Paylaş</button>
                </div>
                
                <!-- Hidden file input -->
                <input type="file" id="quickPostImageInput" accept="image/*" style="display: none;" onchange="handleQuickPostImage(this)">
            </div>

                        <!-- All Content -->
            <div id="all-content" class="content-section active">
                <div class="content-grid">
                    <!-- Dinamik içerikler buraya eklenecek -->
                </div>
            </div>
                        
                                      <!-- Screenshots Content -->
             <div id="screenshots-content" class="content-section">
                 <div class="content-grid">
                     <!-- Dinamik ekran görüntüleri buraya eklenecek -->
                 </div>
             </div>

                          <!-- Videos Content -->
             <div id="videos-content" class="content-section">
                 <div class="content-grid">
                     <!-- Dinamik videolar buraya eklenecek -->
                 </div>
             </div>
                        
                          <!-- Discussions Content -->
             <div id="discussions-content" class="content-section">
                 <div class="content-grid">
                     <!-- Dinamik tartışmalar buraya eklenecek -->
                 </div>
             </div>
                    
                          <!-- Guides Content -->
             <div id="guides-content" class="content-section">
                 <div class="content-grid">
                     <!-- Dinamik rehberler buraya eklenecek -->
                 </div>
             </div>
                        </div>
                        
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Popular Games -->
            <div class="popular-games">
                <h3 class="sidebar-title">Popüler Oyunlar</h3>
                <div class="game-item">
                    <div class="game-icon"></div>
                    <div class="game-info">
                        <h4>Cyberpunk 2077</h4>
                        <p>1.2k aktif tartışma</p>
                            </div>
                                    </div>
                <div class="game-item">
                    <div class="game-icon"></div>
                    <div class="game-info">
                        <h4>Elden Ring</h4>
                        <p>856 yeni içerik</p>
                                        </div>
                                        </div>
                <div class="game-item">
                    <div class="game-icon"></div>
                    <div class="game-info">
                        <h4>GTA V</h4>
                        <p>634 mod paylaşımı</p>
                                    </div>
                                </div>
                <div class="game-item">
                    <div class="game-icon"></div>
                    <div class="game-info">
                        <h4>Counter-Strike 2</h4>
                        <p>423 yeni klip</p>
                        </div>
                    </div>
                </div>
                
            <!-- Trending Topics -->
            <div class="popular-games">
                <h3 class="sidebar-title">Trend Konular</h3>
                <div class="game-item">
                    <div class="game-info">
                        <h4>#Cyberpunk2077DLC</h4>
                        <p>245 gönderi</p>
                                            </div>
                                        </div>
                <div class="game-item">
                    <div class="game-info">
                        <h4>#EldenRingSecrets</h4>
                        <p>189 gönderi</p>
                                            </div>
                                            </div>
                <div class="game-item">
                    <div class="game-info">
                        <h4>#MinecraftBuilds</h4>
                        <p>156 gönderi</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
                
 <!-- Modals -->
 
 <!-- Screenshot Modal -->
 <div class="modal-overlay" id="screenshotModal">
     <div class="modal">
         <div class="modal-header">
             <h2 class="modal-title">Ekran Görüntüsü Paylaş</h2>
             <button class="modal-close" onclick="closeModal('screenshotModal')">
                 <i class="fas fa-times"></i>
             </button>
                                            </div>
         <form id="screenshotForm">
             <div class="form-group">
                 <label class="form-label">Başlık</label>
                 <input type="text" class="form-input" name="title" placeholder="Ekran görüntünüz için bir başlık...">
                                        </div>
             
             <div class="form-group">
                 <label class="form-label">Oyun</label>
                 <select class="form-select" name="game">
                     <option value="">Oyun seçin...</option>
                     <option value="cyberpunk">Cyberpunk 2077</option>
                     <option value="elden-ring">Elden Ring</option>
                     <option value="gta5">GTA V</option>
                     <option value="cs2">Counter-Strike 2</option>
                     <option value="minecraft">Minecraft</option>
                 </select>
                                            </div>
             
                          <div class="form-group">
                 <label class="form-label">Görsel</label>
                 <div class="form-file-input" onclick="openFileDialog('screenshotFile')">
                     <div class="file-upload-icon">
                         <i class="fas fa-cloud-upload-alt"></i>
                     </div>
                     <div class="file-upload-text" id="screenshotFileText">
                         Dosya seçmek için tıklayın veya sürükleyip bırakın
                     </div>
                     <input type="file" id="screenshotFile" accept="image/*" onchange="updateFileText('screenshotFile', 'screenshotFileText')">
                 </div>
             </div>
             
             <div class="form-group">
                 <label class="form-label">Açıklama</label>
                 <textarea class="form-textarea" name="description" placeholder="Bu ekran görüntüsü hakkında bir şeyler yazın..."></textarea>
                            </div>
             
             <div class="modal-footer">
                 <button type="button" class="btn-cancel" onclick="closeModal('screenshotModal')">İptal</button>
                 <button type="button" class="btn-cancel" onclick="this.form.querySelector('[name=title]').value='Test Screenshot'; this.form.querySelector('[name=game]').value='cyberpunk';">Test Doldur</button>
                 <button type="submit" class="btn-submit">Paylaş</button>
             </div>
         </form>
                    </div>
                </div>
                
 <!-- Video Modal -->
 <div class="modal-overlay" id="videoModal">
     <div class="modal">
         <div class="modal-header">
             <h2 class="modal-title">Video Paylaş</h2>
             <button class="modal-close" onclick="closeModal('videoModal')">
                 <i class="fas fa-times"></i>
             </button>
                                </div>
         <form id="videoForm">
             <div class="form-group">
                 <label class="form-label">Başlık</label>
                 <input type="text" class="form-input" name="title" placeholder="Videonuz için bir başlık...">
                                            </div>
             
             <div class="form-group">
                 <label class="form-label">Oyun</label>
                 <select class="form-select" name="game">
                     <option value="">Oyun seçin...</option>
                     <option value="cyberpunk">Cyberpunk 2077</option>
                     <option value="elden-ring">Elden Ring</option>
                     <option value="gta5">GTA V</option>
                     <option value="cs2">Counter-Strike 2</option>
                     <option value="minecraft">Minecraft</option>
                 </select>
                                        </div>
             
                          <div class="form-group">
                 <label class="form-label">Video</label>
                 <div class="form-file-input" onclick="openFileDialog('videoFile')">
                     <div class="file-upload-icon">
                         <i class="fas fa-video"></i>
                     </div>
                     <div class="file-upload-text" id="videoFileText">
                         Video dosyası seçin (MP4, AVI, MOV)
                     </div>
                     <input type="file" id="videoFile" accept="video/*" onchange="updateFileText('videoFile', 'videoFileText')">
                 </div>
             </div>
             
             <div class="form-group">
                 <label class="form-label">Açıklama</label>
                 <textarea class="form-textarea" name="description" placeholder="Video hakkında bilgi verin..."></textarea>
                                </div>
             
                          <div class="modal-footer">
                 <button type="button" class="btn-cancel" onclick="closeModal('videoModal')">İptal</button>
                 <button type="button" class="btn-cancel" onclick="this.form.querySelector('[name=title]').value='Test Video'; this.form.querySelector('[name=game]').value='gta5';">Test Doldur</button>
                 <button type="submit" class="btn-submit">Paylaş</button>
             </div>
         </form>
                    </div>
                </div>
                
 <!-- Discussion Modal -->
 <div class="modal-overlay" id="discussionModal">
     <div class="modal">
         <div class="modal-header">
             <h2 class="modal-title">Tartışma Başlat</h2>
             <button class="modal-close" onclick="closeModal('discussionModal')">
                 <i class="fas fa-times"></i>
             </button>
                                            </div>
         <form id="discussionForm">
             <div class="form-group">
                 <label class="form-label">Konu</label>
                 <input type="text" class="form-input" name="title" placeholder="Tartışma konunuz...">
                                        </div>
             
             <div class="form-group">
                 <label class="form-label">Kategori</label>
                 <select class="form-select" name="category">
                     <option value="">Kategori seçin...</option>
                     <option value="question">Soru</option>
                     <option value="bug">Hata Bildirimi</option>
                     <option value="suggestion">Öneri</option>
                     <option value="general">Genel</option>
                 </select>
                                            </div>
             
             <div class="form-group">
                 <label class="form-label">Oyun (Opsiyonel)</label>
                 <select class="form-select" name="game">
                     <option value="">Belirtilmemiş</option>
                     <option value="cyberpunk">Cyberpunk 2077</option>
                     <option value="elden-ring">Elden Ring</option>
                     <option value="gta5">GTA V</option>
                     <option value="cs2">Counter-Strike 2</option>
                     <option value="minecraft">Minecraft</option>
                 </select>
                                            </div>
             
             <div class="form-group">
                 <label class="form-label">Mesajınız</label>
                 <textarea class="form-textarea" name="message" placeholder="Tartışmak istediğiniz konuyu detaylı olarak açıklayın..." style="min-height: 120px;"></textarea>
                                        </div>
             
             <div class="modal-footer">
                 <button type="button" class="btn-cancel" onclick="closeModal('discussionModal')">İptal</button>
                 <button type="submit" class="btn-submit">Başlat</button>
                                    </div>
         </form>
                                </div>
                            </div>

   
 <script>
 // Kullanıcı bilgileri - Sabit kullanıcı
 const currentUser = {
     name: 'Ceren',
     avatar: 'C',
     id: 'user-ceren'
 };
 console.log('Aktif kullanıcı:', currentUser);
 
 // Örnek diğer kullanıcılar (arkadaş listesi olarak kullanılacak)
 const friendsList = [
     { id: 1, name: 'GameMaster', avatar: 'G', color: '#ff6b6b', isOnline: true },
     { id: 2, name: 'ProGamer99', avatar: 'P', color: '#4ecdc4', isOnline: false },
     { id: 3, name: 'NoobSlayer', avatar: 'N', color: '#45b7d1', isOnline: true },
     { id: 4, name: 'LegendKiller', avatar: 'L', color: '#96ceb4', isOnline: false },
     { id: 5, name: 'ShadowHunter', avatar: 'S', color: '#feca57', isOnline: true },
     { id: 6, name: 'DragonBorn', avatar: 'D', color: '#ff9ff3', isOnline: true },
     { id: 7, name: 'CyberNinja', avatar: 'C', color: '#54a0ff', isOnline: false },
     { id: 8, name: 'PixelMaster', avatar: 'P', color: '#5f27cd', isOnline: true }
 ];
 
 // Eski sampleUsers referansı için
 const sampleUsers = friendsList;
 
 // Bildirim sistemi
 let notifications = [];
 let quickPostImage = null;
 
 function getRandomUser() {
     return sampleUsers[Math.floor(Math.random() * sampleUsers.length)];
 }

 // Hızlı post görsel fonksiyonları
 function openQuickPostImageDialog() {
     document.getElementById('quickPostImageInput').click();
 }

 function handleQuickPostImage(input) {
     if (input.files && input.files[0]) {
         const file = input.files[0];
         const reader = new FileReader();
         
         reader.onload = function(e) {
             quickPostImage = e.target.result;
             document.getElementById('previewImage').src = quickPostImage;
             document.getElementById('imagePreview').style.display = 'block';
             console.log('Hızlı post görseli yüklendi');
         };
         
         reader.readAsDataURL(file);
     }
 }

 function removeQuickPostImage() {
     quickPostImage = null;
     document.getElementById('imagePreview').style.display = 'none';
     document.getElementById('quickPostImageInput').value = '';
     console.log('Hızlı post görseli kaldırıldı');
 }

 // Arkadaş etiketleme sistemi
 function showFriendSuggestions(query, position) {
     const suggestions = document.getElementById('friendSuggestions');
     const filteredFriends = friendsList.filter(friend => 
         friend.name.toLowerCase().includes(query.toLowerCase())
     );
     
     if (filteredFriends.length === 0 || query.length < 1) {
         suggestions.style.display = 'none';
         return;
     }
     
     suggestions.innerHTML = '';
     filteredFriends.slice(0, 5).forEach(friend => {
         const item = document.createElement('div');
         item.className = 'friend-suggestion-item';
         item.onclick = () => selectFriend(friend);
         
         item.innerHTML = `
             <div class="friend-suggestion-avatar" style="background: ${friend.color};">
                 ${friend.avatar}
             </div>
             <div class="friend-suggestion-name">
                 ${friend.name}
                 ${friend.isOnline ? '<span style="color: #4caf50; font-size: 0.7rem;">●</span>' : ''}
             </div>
         `;
         
         suggestions.appendChild(item);
     });
     
     // Position the suggestions
     suggestions.style.left = position.left + 'px';
     suggestions.style.top = position.top + 'px';
     suggestions.style.display = 'block';
 }

 function selectFriend(friend) {
     const input = document.querySelector('.post-input');
     const text = input.value;
     const atIndex = text.lastIndexOf('@');
     
     if (atIndex !== -1) {
         const beforeAt = text.substring(0, atIndex);
         const afterQuery = text.substring(input.selectionStart);
         
         input.value = beforeAt + `@${friend.name} ` + afterQuery;
         input.focus();
         
         // Cursor'u mention'dan sonraya taşı
         const newPosition = beforeAt.length + friend.name.length + 2;
         input.setSelectionRange(newPosition, newPosition);
     }
     
     document.getElementById('friendSuggestions').style.display = 'none';
 }

 // Bildirim gönderme fonksiyonu
 function sendMentionNotification(mentionedUsers, postContent) {
     mentionedUsers.forEach(user => {
         const notification = {
             id: Date.now() + Math.random(),
             userId: user.id,
             fromUser: currentUser.name,
             type: 'mention',
             content: postContent,
             timestamp: new Date().toISOString(),
             read: false
         };
         
         notifications.push(notification);
         console.log(`Bildirim gönderildi: ${user.name} - ${currentUser.name} sizi bir gönderide etiketledi`);
         
         // Gerçek uygulamada burası API çağrısı olurdu
         showNotificationToast(`${user.name} etiketlendi!`);
     });
 }

 // Toast bildirim gösterme
 function showNotificationToast(message) {
     const toast = document.createElement('div');
     toast.style.cssText = `
         position: fixed;
         top: 20px;
         right: 20px;
         background: var(--accent-color);
         color: white;
         padding: 12px 20px;
         border-radius: 8px;
         z-index: 10000;
         animation: slideIn 0.3s ease;
     `;
     toast.textContent = message;
     
     document.body.appendChild(toast);
     
     setTimeout(() => {
         toast.remove();
     }, 3000);
 }

 // Mention'ları parse etme fonksiyonu
 function parseMentions(text) {
     const mentionRegex = /@(\w+)/g;
     const mentions = [];
     let match;
     
     while ((match = mentionRegex.exec(text)) !== null) {
         const mentionedUser = friendsList.find(friend => 
             friend.name.toLowerCase() === match[1].toLowerCase()
         );
         if (mentionedUser) {
             mentions.push(mentionedUser);
         }
     }
     
     return mentions;
 }

 // Text'i mention'larla birlikte HTML'e çevirme
 function formatPostText(text) {
     return text.replace(/@(\w+)/g, (match, username) => {
         const user = friendsList.find(friend => 
             friend.name.toLowerCase() === username.toLowerCase()
         );
         if (user) {
             return `<span class="mention" data-user-id="${user.id}">@${user.name}</span>`;
         }
         return match;
     });
 }

 // Modal açma fonksiyonu
 function openModal(modalId) {
     console.log('Modal açılmaya çalışılıyor:', modalId); // Debug
     const modal = document.getElementById(modalId);
     console.log('Modal elementi bulundu:', !!modal); // Debug
     
     if (modal) {
         modal.classList.add('show');
         console.log('Modal açıldı:', modalId); // Debug
     } else {
         console.error('Modal bulunamadı:', modalId); // Debug
         alert('Modal bulunamadı: ' + modalId);
     }
 }

 // Modal kapatma fonksiyonu
 function closeModal(modalId) {
     const modal = document.getElementById(modalId);
     if (modal) {
         modal.classList.remove('show');
     }
 }

 // File dialog açma fonksiyonu
 function openFileDialog(fileInputId) {
     console.log('File dialog açılıyor:', fileInputId); // Debug
     const fileInput = document.getElementById(fileInputId);
     
     if (fileInput) {
         console.log('File input bulundu, tıklanıyor...'); // Debug
         fileInput.click();
     } else {
         console.error('File input bulunamadı:', fileInputId); // Debug
         alert('Dosya seçici bulunamadı!');
     }
 }

 // File seçim feedback fonksiyonu
 function updateFileText(fileInputId, textElementId) {
     console.log('File seçildi, güncelleniyor...'); // Debug
     const fileInput = document.getElementById(fileInputId);
     const textElement = document.getElementById(textElementId);
     const fileContainer = fileInput?.parentElement;
     
     if (fileInput && textElement && fileInput.files.length > 0) {
         const fileName = fileInput.files[0].name;
         const fileSize = (fileInput.files[0].size / 1024 / 1024).toFixed(2); // MB
         textElement.innerHTML = `<i class="fas fa-check" style="color: #4caf50;"></i> Seçilen dosya: ${fileName} (${fileSize} MB)`;
         textElement.style.color = 'var(--accent-color)';
         
         // Container'a seçildi sınıfı ekle
         if (fileContainer) {
             fileContainer.classList.add('file-selected');
         }
         
         console.log('Dosya bilgileri güncellendi:', fileName, fileSize + 'MB'); // Debug
     } else {
         // Dosya seçimi temizlendi
         if (textElement) {
             if (fileInputId.includes('screenshot')) {
                 textElement.textContent = 'Dosya seçmek için tıklayın veya sürükleyip bırakın';
             } else {
                 textElement.textContent = 'Video dosyası seçin (MP4, AVI, MOV)';
             }
             textElement.style.color = 'var(--text-gray)';
         }
         
         if (fileContainer) {
             fileContainer.classList.remove('file-selected');
         }
     }
 }

 // Tab değiştirme fonksiyonu
 function showTab(tabName) {
     // Tüm içerikleri gizle
     document.querySelectorAll('.content-section').forEach(section => {
         section.classList.remove('active');
     });
     
     // Tüm tab butonlarından active sınıfını kaldır
     document.querySelectorAll('.tab-btn').forEach(btn => {
         btn.classList.remove('active');
     });
     
     // Seçilen içeriği göster
     const content = document.getElementById(tabName + '-content');
     if (content) {
         content.classList.add('active');
     }
     
     // Tıklanan tab butonuna active sınıfı ekle
     if (event && event.target) {
         event.target.classList.add('active');
     }
 }

  // LocalStorage yardımcı fonksiyonları
 function saveToLocalStorage(type, data) {
     try {
         const existingData = JSON.parse(localStorage.getItem('communityContent') || '[]');
         const newItem = {
             id: Date.now(), // Benzersiz ID
             type: type,
             data: data,
             timestamp: new Date().toISOString(),
             likes: 0,
             liked: false,
             comments: []
         };
         existingData.unshift(newItem); // En başa ekle
         localStorage.setItem('communityContent', JSON.stringify(existingData));
         console.log('LocalStorage\'a kaydedildi:', newItem);
         console.log('Toplam kayıtlı içerik sayısı:', existingData.length);
         console.log('Kaydedilen veri detayı:', { type, data });
         return newItem.id; // ID'yi geri döndür
     } catch (error) {
         console.error('LocalStorage kaydetme hatası:', error);
         return null;
     }
 }

 // Beğeni durumunu kaydetme
 function saveLikeStatus(cardId, liked, likeCount) {
     try {
         const content = JSON.parse(localStorage.getItem('communityContent') || '[]');
         const itemIndex = content.findIndex(item => item.id == cardId);
         if (itemIndex !== -1) {
             content[itemIndex].liked = liked;
             content[itemIndex].likes = likeCount;
             localStorage.setItem('communityContent', JSON.stringify(content));
             console.log('Beğeni durumu kaydedildi:', cardId, liked, likeCount);
         }
     } catch (error) {
         console.error('Beğeni kaydetme hatası:', error);
     }
 }

 // Yorum kaydetme
 function saveComment(cardId, comment) {
     try {
         const content = JSON.parse(localStorage.getItem('communityContent') || '[]');
         const itemIndex = content.findIndex(item => item.id == cardId);
         if (itemIndex !== -1) {
             if (!content[itemIndex].comments) content[itemIndex].comments = [];
             content[itemIndex].comments.unshift(comment);
             localStorage.setItem('communityContent', JSON.stringify(content));
             console.log('Yorum kaydedildi:', cardId, comment);
         }
     } catch (error) {
         console.error('Yorum kaydetme hatası:', error);
     }
 }

 function loadFromLocalStorage() {
     try {
         const savedContent = JSON.parse(localStorage.getItem('communityContent') || '[]');
         console.log('LocalStorage\'dan yüklendi:', savedContent.length, 'adet içerik');
         console.log('Yüklenen veriler:', savedContent);
         
         // Verileri tarihe göre sırala (en yeni önce)
         savedContent.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));
         
         savedContent.forEach((item, index) => {
             console.log(`İçerik ${index + 1}:`, item.type, item.data);
             addContentCardFromStorage(item);
         });
     } catch (error) {
         console.error('LocalStorage yükleme hatası:', error);
     }
 }

      // İçerik ekleme fonksiyonu
 function addContentCard(type, data) {
     console.log('İçerik ekleniyor:', type, data); // Debug
     
     const allGrid = document.querySelector('#all-content .content-grid');
     const categoryGrid = document.querySelector(`#${type}-content .content-grid`);
     
     console.log('Grid bulundu - All:', !!allGrid, 'Category:', !!categoryGrid); // Debug
     
     // LocalStorage'a kaydet ve ID al
     const cardId = saveToLocalStorage(type, data);
     
     // Yeni card oluştur
     const card = document.createElement('div');
     card.className = 'content-card';
     card.setAttribute('data-card-id', cardId);
     
     let cardHTML = '';
     const currentTime = new Date().toLocaleTimeString('tr-TR', {hour: '2-digit', minute: '2-digit'});
     
     if (type === 'screenshots') {
         // Gerçek görsel göster
         const imageUrl = data.imageUrl || 'https://via.placeholder.com/300x180/2a2a2a/1a9fff?text=Yeni+Screenshot';
         cardHTML = `
             <img src="${imageUrl}" class="card-image" alt="Screenshot" style="object-fit: cover;">
             <div class="card-content">
                 <h3 class="card-title">${data.title}</h3>
                 <div class="card-game">${data.game || 'Bilinmeyen Oyun'}</div>
                 <div class="card-meta">
                     <div class="card-author">
                         <div class="author-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                             ${currentUser.avatar}
                         </div>
                         <span>${currentUser.name}</span>
                     </div>
                     <div class="card-stats">
                         <div class="stat like-btn" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">0</span></div>
                         <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">0</span></div>
                         <div class="stat"><i class="fas fa-clock"></i> ${currentTime}</div>
                     </div>
                 </div>
             </div>
             <div class="comments-section">
                 <div class="comment-form">
                     <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                     <button class="comment-btn" onclick="addComment(this)">Gönder</button>
                 </div>
                 <div class="comments-list"></div>
             </div>
         `;
     } else if (type === 'videos') {
         // Gerçek video göster
         if (data.videoUrl) {
             cardHTML = `
                 <div class="card-video-container" style="position: relative; width: 100%; height: 180px; background: #000; border-radius: 8px 8px 0 0; overflow: hidden;">
                     <video src="${data.videoUrl}" class="card-video" style="width: 100%; height: 100%; object-fit: cover;" controls preload="metadata">
                         Video desteklenmiyor.
                     </video>
                 </div>
                 <div class="card-content">
                     <h3 class="card-title">${data.title}</h3>
                     <div class="card-game">${data.game || 'Bilinmeyen Oyun'}</div>
                     <div class="card-meta">
                         <div class="card-author">
                             <div class="author-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                                 ${currentUser.avatar}
                             </div>
                             <span>${currentUser.name}</span>
                         </div>
                         <div class="card-stats">
                             <div class="stat like-btn" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">0</span></div>
                             <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">0</span></div>
                             <div class="stat"><i class="fas fa-clock"></i> ${currentTime}</div>
                         </div>
                     </div>
                 </div>
                 <div class="comments-section">
                     <div class="comment-form">
                         <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                         <button class="comment-btn" onclick="addComment(this)">Gönder</button>
                     </div>
                     <div class="comments-list"></div>
                 </div>
             `;
         } else {
             // Fallback placeholder
             cardHTML = `
                 <img src="https://via.placeholder.com/300x180/2a2a2a/1a9fff?text=▶+Video" class="card-image" alt="Video">
                 <div class="card-content">
                     <h3 class="card-title">${data.title}</h3>
                     <div class="card-game">${data.game || 'Bilinmeyen Oyun'}</div>
                     <div class="card-meta">
                         <div class="card-author">
                             <div class="author-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                                 ${currentUser.avatar}
                             </div>
                             <span>${currentUser.name}</span>
                         </div>
                         <div class="card-stats">
                             <div class="stat like-btn" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">0</span></div>
                             <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">0</span></div>
                             <div class="stat"><i class="fas fa-clock"></i> ${currentTime}</div>
                         </div>
                     </div>
                 </div>
                 <div class="comments-section">
                     <div class="comment-form">
                         <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                         <button class="comment-btn" onclick="addComment(this)">Gönder</button>
                     </div>
                     <div class="comments-list"></div>
                 </div>
             `;
         }
     } else if (type === 'discussions') {
         const categoryIcon = data.category === 'question' ? 'fas fa-question-circle' : 
                             data.category === 'bug' ? 'fas fa-bug' : 
                             data.category === 'suggestion' ? 'fas fa-lightbulb' : 'fas fa-comments';
         const categoryColor = data.category === 'question' ? 'var(--accent-color)' : 
                              data.category === 'bug' ? '#ff4757' : 
                              data.category === 'suggestion' ? '#feca57' : 'var(--accent-color)';
         
         cardHTML = `
             <div class="card-content" style="padding-top: 0;">
                 <div style="padding: 16px 0;">
                     <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                         <i class="${categoryIcon}" style="color: ${categoryColor};"></i>
                         <span style="color: ${categoryColor}; font-size: 0.8rem;">${data.categoryText}</span>
                                </div>
                     <h3 class="card-title">${data.title}</h3>
                     <div class="card-game">${data.game || 'Genel'}</div>
                     <div class="card-meta">
                         <div class="card-author">
                             <div class="author-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                                 ${currentUser.avatar}
                             </div>
                             <span>${currentUser.name}</span>
                            </div>
                         <div class="card-stats">
                             <div class="stat like-btn" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">0</span></div>
                             <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">0</span></div>
                             <div class="stat"><i class="fas fa-clock"></i> ${currentTime}</div>
                    </div>
                </div>
            </div>
            <div class="comments-section">
                <div class="comment-form">
                    <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                    <button class="comment-btn" onclick="addComment(this)">Gönder</button>
                </div>
                <div class="comments-list"></div>
            </div>
    </div>
         `;
     }
     
     card.innerHTML = cardHTML;
     console.log('Card HTML oluşturuldu:', cardHTML.substring(0, 100) + '...'); // Debug
     
     // Kartı en başa ekle
     if (allGrid) {
         allGrid.insertBefore(card.cloneNode(true), allGrid.firstChild);
         console.log('All grid\'e eklendi, toplam kart sayısı:', allGrid.children.length); // Debug
     } else {
         console.error('All grid bulunamadı!'); // Debug
     }
     
     if (categoryGrid) {
         categoryGrid.insertBefore(card, categoryGrid.firstChild);
         console.log('Category grid\'e eklendi, toplam kart sayısı:', categoryGrid.children.length); // Debug
     } else {
         console.error('Category grid bulunamadı:', `#${type}-content .content-grid`); // Debug
     }
     
     // Smooth scroll animation
     card.style.opacity = '0';
     card.style.transform = 'translateY(-20px)';
     setTimeout(() => {
         card.style.transition = 'all 0.3s ease';
         card.style.opacity = '1';
         card.style.transform = 'translateY(0)';
     }, 100);
 }

 // LocalStorage'dan içerik yükleme fonksiyonu (animasyon olmadan)
 function addContentCardFromStorage(item) {
     const type = item.type;
     const data = item.data;
     const allGrid = document.querySelector('#all-content .content-grid');
     const categoryGrid = document.querySelector(`#${type}-content .content-grid`);
     
     // Yeni card oluştur
     const card = document.createElement('div');
     card.className = 'content-card';
     card.setAttribute('data-card-id', item.id);
     
     let cardHTML = '';
     const savedTime = data.timestamp ? new Date(data.timestamp).toLocaleTimeString('tr-TR', {hour: '2-digit', minute: '2-digit'}) : 
                     new Date().toLocaleTimeString('tr-TR', {hour: '2-digit', minute: '2-digit'});
     
     if (type === 'screenshots') {
         const imageUrl = data.imageUrl || 'https://via.placeholder.com/300x180/2a2a2a/1a9fff?text=Yeni+Screenshot';
         cardHTML = `
             <img src="${imageUrl}" class="card-image" alt="Screenshot" style="object-fit: cover;">
             <div class="card-content">
                 <h3 class="card-title">${data.title}</h3>
                 <div class="card-game">${data.game || 'Bilinmeyen Oyun'}</div>
                 <div class="card-meta">
                     <div class="card-author">
                         <div class="author-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                             ${currentUser.avatar}
                         </div>
                         <span>${currentUser.name}</span>
                     </div>
                     <div class="card-stats">
                         <div class="stat like-btn ${item.liked ? 'liked' : ''}" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">${item.likes || 0}</span></div>
                         <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">${item.comments ? item.comments.length : 0}</span></div>
                         <div class="stat"><i class="fas fa-clock"></i> ${savedTime}</div>
                     </div>
                 </div>
             </div>
             <div class="comments-section">
                 <div class="comment-form">
                     <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                     <button class="comment-btn" onclick="addComment(this)">Gönder</button>
                 </div>
                 <div class="comments-list">
                     ${item.comments ? item.comments.map(comment => `
                         <div class="comment-item">
                             <div class="comment-avatar"></div>
                             <div class="comment-content">
                                 <div class="comment-author">${comment.author}</div>
                                 <div class="comment-text">${comment.text}</div>
                                 <div class="comment-time">${comment.time}</div>
                             </div>
                         </div>
                     `).join('') : ''}
                 </div>
             </div>
         `;
     } else if (type === 'videos') {
         if (data.videoUrl) {
             cardHTML = `
                 <div class="card-video-container" style="position: relative; width: 100%; height: 180px; background: #000; border-radius: 8px 8px 0 0; overflow: hidden;">
                     <video src="${data.videoUrl}" class="card-video" style="width: 100%; height: 100%; object-fit: cover;" controls preload="metadata">
                         Video desteklenmiyor.
                     </video>
                 </div>
                 <div class="card-content">
                     <h3 class="card-title">${data.title}</h3>
                     <div class="card-game">${data.game || 'Bilinmeyen Oyun'}</div>
                     <div class="card-meta">
                         <div class="card-author">
                             <div class="author-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                                 ${currentUser.avatar}
                             </div>
                             <span>${currentUser.name}</span>
                         </div>
                         <div class="card-stats">
                             <div class="stat like-btn ${item.liked ? 'liked' : ''}" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">${item.likes || 0}</span></div>
                             <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">${item.comments ? item.comments.length : 0}</span></div>
                             <div class="stat"><i class="fas fa-clock"></i> ${savedTime}</div>
                         </div>
                     </div>
                 </div>
                 <div class="comments-section">
                     <div class="comment-form">
                         <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                         <button class="comment-btn" onclick="addComment(this)">Gönder</button>
                     </div>
                     <div class="comments-list">
                         ${item.comments ? item.comments.map(comment => `
                             <div class="comment-item">
                                 <div class="comment-avatar" style="background: ${comment.author === currentUser.name ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : '#ff6b6b'}; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                                     ${comment.author === currentUser.name ? currentUser.avatar : comment.author.charAt(0).toUpperCase()}
                                 </div>
                                 <div class="comment-content">
                                     <div class="comment-author">${comment.author}</div>
                                     <div class="comment-text">${comment.text}</div>
                                     <div class="comment-time">${comment.time}</div>
                                 </div>
                             </div>
                         `).join('') : ''}
                     </div>
                 </div>
             `;
         } else {
             cardHTML = `
                 <img src="https://via.placeholder.com/300x180/2a2a2a/1a9fff?text=▶+Video" class="card-image" alt="Video">
                 <div class="card-content">
                     <h3 class="card-title">${data.title}</h3>
                     <div class="card-game">${data.game || 'Bilinmeyen Oyun'}</div>
                     <div class="card-meta">
                         <div class="card-author">
                             <div class="author-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                                 ${currentUser.avatar}
                             </div>
                             <span>${currentUser.name}</span>
                         </div>
                         <div class="card-stats">
                             <div class="stat like-btn ${item.liked ? 'liked' : ''}" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">${item.likes || 0}</span></div>
                             <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">${item.comments ? item.comments.length : 0}</span></div>
                             <div class="stat"><i class="fas fa-clock"></i> ${savedTime}</div>
                         </div>
                     </div>
                 </div>
                 <div class="comments-section">
                     <div class="comment-form">
                         <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                         <button class="comment-btn" onclick="addComment(this)">Gönder</button>
                     </div>
                     <div class="comments-list">
                         ${item.comments ? item.comments.map(comment => `
                             <div class="comment-item">
                                 <div class="comment-avatar" style="background: ${comment.author === currentUser.name ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : '#ff6b6b'}; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                                     ${comment.author === currentUser.name ? currentUser.avatar : comment.author.charAt(0).toUpperCase()}
                                 </div>
                                 <div class="comment-content">
                                     <div class="comment-author">${comment.author}</div>
                                     <div class="comment-text">${comment.text}</div>
                                     <div class="comment-time">${comment.time}</div>
                                 </div>
                             </div>
                         `).join('') : ''}
                     </div>
                 </div>
             `;
         }
     } else if (type === 'discussions') {
         const categoryIcon = data.category === 'question' ? 'fas fa-question-circle' : 
                             data.category === 'bug' ? 'fas fa-bug' : 
                             data.category === 'suggestion' ? 'fas fa-lightbulb' : 'fas fa-comments';
         const categoryColor = data.category === 'question' ? 'var(--accent-color)' : 
                              data.category === 'bug' ? '#ff4757' : 
                              data.category === 'suggestion' ? '#feca57' : 'var(--accent-color)';
         
         cardHTML = `
             <div class="card-content" style="padding-top: 0;">
                 <div style="padding: 16px 0;">
                     <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                         <i class="${categoryIcon}" style="color: ${categoryColor};"></i>
                         <span style="color: ${categoryColor}; font-size: 0.8rem;">${data.categoryText}</span>
                     </div>
                     <h3 class="card-title">${data.title}</h3>
                     <div class="card-game">${data.game || 'Genel'}</div>
                     <div class="card-meta">
                         <div class="card-author">
                             <div class="author-avatar"></div>
                             <span>Sen</span>
                         </div>
                         <div class="card-stats">
                             <div class="stat like-btn ${item.liked ? 'liked' : ''}" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">${item.likes || 0}</span></div>
                             <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">${item.comments ? item.comments.length : 0}</span></div>
                             <div class="stat"><i class="fas fa-clock"></i> ${savedTime}</div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="comments-section">
                 <div class="comment-form">
                     <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                     <button class="comment-btn" onclick="addComment(this)">Gönder</button>
                 </div>
                 <div class="comments-list">
                     ${item.comments ? item.comments.map(comment => `
                         <div class="comment-item">
                             <div class="comment-avatar"></div>
                             <div class="comment-content">
                                 <div class="comment-author">${comment.author}</div>
                                 <div class="comment-text">${comment.text}</div>
                                 <div class="comment-time">${comment.time}</div>
                             </div>
                         </div>
                     `).join('') : ''}
                 </div>
             </div>
         `;
          } else if (type === 'quickpost') {
         // Görsel varsa ekle
         let imageHTML = '';
         if (data.imageUrl) {
             imageHTML = `<img src="${data.imageUrl}" class="card-image" alt="Quick Post Image" style="object-fit: cover;">`;
         }
         
         // Content'i mention'larla birlikte formatla
         const formattedContent = data.content ? formatPostText(data.content) : 'Hızlı paylaşım';
         
         cardHTML = `
             ${imageHTML}
             <div class="card-content" style="padding-top: 0;">
                 <div style="padding: 16px 0;">
                     <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                         <i class="fas fa-comment" style="color: var(--accent-color);"></i>
                         <span style="color: var(--accent-color); font-size: 0.8rem;">Hızlı Post</span>
                     </div>
                     <div class="card-title" style="font-size: 1rem; line-height: 1.4;">${formattedContent}</div>
                     <div class="card-game">Topluluk</div>
                     <div class="card-meta">
                         <div class="card-author">
                             <div class="author-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                                 ${currentUser.avatar}
                             </div>
                             <span>${currentUser.name}</span>
                         </div>
                         <div class="card-stats">
                             <div class="stat like-btn ${item.liked ? 'liked' : ''}" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">${item.likes || 0}</span></div>
                             <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">${item.comments ? item.comments.length : 0}</span></div>
                             <div class="stat"><i class="fas fa-clock"></i> ${savedTime}</div>
                         </div>
                     </div>
                 </div>
             </div>
             <div class="comments-section">
                 <div class="comment-form">
                     <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                     <button class="comment-btn" onclick="addComment(this)">Gönder</button>
                 </div>
                 <div class="comments-list">
                     ${item.comments ? item.comments.map(comment => `
                         <div class="comment-item">
                             <div class="comment-avatar" style="background: ${comment.author === currentUser.name ? 'linear-gradient(135deg, #667eea 0%, #764ba2 100%)' : '#ff6b6b'}; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                                 ${comment.author === currentUser.name ? currentUser.avatar : comment.author.charAt(0).toUpperCase()}
                             </div>
                             <div class="comment-content">
                                 <div class="comment-author">${comment.author}</div>
                                 <div class="comment-text">${comment.text}</div>
                                 <div class="comment-time">${comment.time}</div>
                             </div>
                         </div>
                     `).join('') : ''}
                 </div>
             </div>
         `;
     }
     
     card.innerHTML = cardHTML;
     
     // Kartı griddlere ekle
     if (allGrid) {
         allGrid.insertBefore(card.cloneNode(true), allGrid.firstChild);
     }
     
     if (categoryGrid && type !== 'quickpost') {
         categoryGrid.insertBefore(card, categoryGrid.firstChild);
     }
 }

 // Quick post ekleme fonksiyonu
function addQuickPost(content, imageUrl = null, mentions = []) {
    // Mention'lara bildirim gönder
    if (mentions.length > 0) {
        sendMentionNotification(mentions, content);
    }
    
    // localStorage'a kaydet ve ID al
    const postData = { 
        content: content, 
        imageUrl: imageUrl,
        mentions: mentions.map(m => m.name),
        timestamp: new Date().toISOString() 
    };
    const cardId = saveToLocalStorage('quickpost', postData);
    
    const allGrid = document.querySelector('#all-content .content-grid');
    const currentTime = new Date().toLocaleTimeString('tr-TR', {hour: '2-digit', minute: '2-digit'});
    
    const card = document.createElement('div');
    card.className = 'content-card';
    card.setAttribute('data-card-id', cardId);
    
    // Content'i mention'larla birlikte formatla
    const formattedContent = formatPostText(content);
    
    // Görsel varsa ekle
    let imageHTML = '';
    if (imageUrl) {
        imageHTML = `<img src="${imageUrl}" class="card-image" alt="Post Image" style="object-fit: cover;">`;
    }
    
    card.innerHTML = `
        ${imageHTML}
        <div class="card-content" style="padding-top: 0;">
            <div style="padding: 16px 0;">
                <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 8px;">
                    <i class="fas fa-comment" style="color: var(--accent-color);"></i>
                    <span style="color: var(--accent-color); font-size: 0.8rem;">Hızlı Post</span>
                </div>
                <div class="card-title" style="font-size: 1rem; line-height: 1.4;">${formattedContent}</div>
                <div class="card-game">Topluluk</div>
                <div class="card-meta">
                    <div class="card-author">
                        <div class="author-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                            ${currentUser.avatar}
                        </div>
                        <span>${currentUser.name}</span>
                    </div>
                    <div class="card-stats">
                        <div class="stat like-btn" onclick="toggleLike(this)"><i class="fas fa-heart"></i> <span class="like-count">0</span></div>
                        <div class="stat comment-btn" onclick="toggleComments(this)"><i class="fas fa-comment"></i> <span class="comment-count">0</span></div>
                        <div class="stat"><i class="fas fa-clock"></i> ${currentTime}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="comments-section">
            <div class="comment-form">
                <textarea class="comment-input" placeholder="Yorum yazın..." maxlength="500"></textarea>
                <button class="comment-btn" onclick="addComment(this)">Gönder</button>
            </div>
            <div class="comments-list"></div>
        </div>
    `;
    
    if (allGrid) {
        allGrid.insertBefore(card, allGrid.firstChild);
    }
    
    // Animation
    card.style.opacity = '0';
    card.style.transform = 'translateY(-20px)';
    setTimeout(() => {
        card.style.transition = 'all 0.3s ease';
        card.style.opacity = '1';
        card.style.transform = 'translateY(0)';
    }, 100);
}

 // Sayfa yüklendiğinde çalışacak kodlar
 document.addEventListener('DOMContentLoaded', function() {
     // Modal dışına tıklama ile kapatma
     document.querySelectorAll('.modal-overlay').forEach(overlay => {
         overlay.addEventListener('click', function(e) {
             if (e.target === this) {
                 closeModal(this.id);
             }
         });
     });
     
     // ESC tuşu ile modal kapatma
     document.addEventListener('keydown', function(e) {
         if (e.key === 'Escape') {
             document.querySelectorAll('.modal-overlay.show').forEach(modal => {
                 closeModal(modal.id);
             });
         }
     });
     
     // İlk tab'ı aktif yap
     const firstTab = document.querySelector('.tab-btn');
     if (firstTab) {
         firstTab.classList.add('active');
     }
     
     // İlk içeriği göster
     const firstContent = document.getElementById('all-content');
     if (firstContent) {
         firstContent.classList.add('active');
     }
     
     // LocalStorage'dan kaydedilmiş içerikleri yükle
     loadFromLocalStorage();
     
     // Mevcut statik kartlara ID ekle
     addIdsToExistingCards();
     
     // Quick post kullanıcı bilgilerini güncelle
     const userAvatar = document.querySelector('.current-user-avatar');
     const userName = document.querySelector('.current-user-name');
     if (userAvatar && userName) {
         userAvatar.textContent = currentUser.avatar;
         userName.textContent = currentUser.name;
     }
     
     // Debug: localStorage içeriğini göster
     console.log('Sayfa yüklendiğinde localStorage içeriği:');
     console.log(JSON.parse(localStorage.getItem('communityContent') || '[]'));
     
     // Random yorumlar ekle (simülasyon)
     setTimeout(() => {
         addRandomComments();
     }, 10000); // 10 saniye sonra random yorumlar eklenmeye başlar
     
     // Quick post butonu
     const postBtn = document.querySelector('.post-btn');
     if (postBtn) {
         postBtn.addEventListener('click', function() {
             const input = document.querySelector('.post-input');
             if (input && input.value.trim()) {
                 const content = input.value.trim();
                 const mentions = parseMentions(content);
                 
                 addQuickPost(content, quickPostImage, mentions);
                 
                 let message = 'Paylaşımınız eklendi!';
                 if (mentions.length > 0) {
                     message += ` ${mentions.length} arkadaşınız etiketlendi.`;
                 }
                 alert(message);
                 
                 input.value = '';
                 removeQuickPostImage(); // Görseli temizle
                 
                 // Post seçeneklerini temizle
                 document.querySelectorAll('.post-option').forEach(opt => {
                     opt.classList.remove('active');
                 });
             } else {
                 alert('Lütfen bir şeyler yazın!');
             }
         });
     }
     
     // Quick post input için mention özelliği
     const postInput = document.querySelector('.post-input');
     if (postInput) {
         let mentionMode = false;
         let mentionStart = 0;
         
         postInput.addEventListener('input', function(e) {
             const text = this.value;
             const cursorPos = this.selectionStart;
             
             // @ karakteri kontrolü
             if (text[cursorPos - 1] === '@') {
                 mentionMode = true;
                 mentionStart = cursorPos - 1;
             }
             
             if (mentionMode) {
                 const mentionText = text.substring(mentionStart + 1, cursorPos);
                 
                 // Boşluk gelirse mention modunu kapat
                 if (mentionText.includes(' ') || mentionText.length > 20) {
                     mentionMode = false;
                     document.getElementById('friendSuggestions').style.display = 'none';
                     return;
                 }
                 
                 // Suggestion'ları göster
                 if (mentionText.length >= 0) {
                     const rect = this.getBoundingClientRect();
                     const position = {
                         left: rect.left,
                         top: rect.bottom + 5
                     };
                     showFriendSuggestions(mentionText, position);
                 }
             }
         });
         
         postInput.addEventListener('keydown', function(e) {
             if (e.key === 'Escape') {
                 mentionMode = false;
                 document.getElementById('friendSuggestions').style.display = 'none';
             }
         });
         
         // Input dışına tıklayınca suggestions'ı kapat
         document.addEventListener('click', function(e) {
             if (!e.target.closest('.quick-post')) {
                 document.getElementById('friendSuggestions').style.display = 'none';
             }
         });
     }
     
     // Post option butonları
     document.querySelectorAll('.post-option').forEach(option => {
         option.addEventListener('click', function() {
             // Diğer seçeneklerden active kaldır
             document.querySelectorAll('.post-option').forEach(opt => {
                 opt.classList.remove('active');
             });
             
             // Bu seçeneği aktif yap
             this.classList.add('active');
         });
     });
     
     // Form gönderim olayları
     const screenshotForm = document.getElementById('screenshotForm');
     console.log('Screenshot form bulundu:', !!screenshotForm); // Debug
     
     if (screenshotForm) {
         screenshotForm.addEventListener('submit', function(e) {
             e.preventDefault();
             console.log('Screenshot form submit edildi!'); // Debug
             
             const title = this.querySelector('[name="title"]').value.trim();
             const game = this.querySelector('[name="game"]').value;
             const description = this.querySelector('[name="description"]').value;
             const fileInput = this.querySelector('#screenshotFile');
             
             console.log('Form verileri:', {title, game, description, file: !!fileInput.files[0]}); // Debug
             
             // Başlık yoksa varsayılan başlık ver
             const finalTitle = title || 'Yeni Ekran Görüntüsü';
             const finalGame = game || 'Bilinmeyen Oyun';
             
             // Dosya varsa oku ve göster
             if (fileInput.files && fileInput.files[0]) {
                 const file = fileInput.files[0];
                 const reader = new FileReader();
                 
                 reader.onload = function(e) {
                     console.log('Görsel okundu, ekleniyor...'); // Debug
                     addContentCard('screenshots', {
                         title: finalTitle,
                         game: finalGame,
                         description: description,
                         imageUrl: e.target.result
                     });
                     
                     alert('Ekran görüntüsü başarıyla eklendi!');
                 };
                 
                 reader.readAsDataURL(file);
             } else {
                 // Dosya yoksa placeholder ile ekle
                 addContentCard('screenshots', {
                     title: finalTitle,
                     game: finalGame,
                     description: description
                 });
                 
                 alert('Ekran görüntüsü başarıyla eklendi!');
             }
             
             closeModal('screenshotModal');
             this.reset();
             
             // File text'i resetle
             const fileText = document.getElementById('screenshotFileText');
             if (fileText) {
                 fileText.textContent = 'Dosya seçmek için tıklayın veya sürükleyip bırakın';
                 fileText.style.color = 'var(--text-gray)';
             }
         });
     } else {
         console.error('Screenshot form bulunamadı!'); // Debug
     }
     
     const videoForm = document.getElementById('videoForm');
     console.log('Video form bulundu:', !!videoForm); // Debug
     
     if (videoForm) {
         videoForm.addEventListener('submit', function(e) {
             e.preventDefault();
             console.log('Video form submit edildi!'); // Debug
             
             const title = this.querySelector('[name="title"]').value.trim();
             const game = this.querySelector('[name="game"]').value;
             const description = this.querySelector('[name="description"]').value;
             const fileInput = this.querySelector('#videoFile');
             
             console.log('Video form verileri:', {title, game, description, file: !!fileInput.files[0]}); // Debug
             
             // Başlık yoksa varsayılan başlık ver
             const finalTitle = title || 'Yeni Video';
             const finalGame = game || 'Bilinmeyen Oyun';
             
             // Video dosyası varsa oku ve göster
             if (fileInput.files && fileInput.files[0]) {
                 const file = fileInput.files[0];
                 const reader = new FileReader();
                 
                 reader.onload = function(e) {
                     console.log('Video base64 olarak okundu, ekleniyor...'); // Debug
                     addContentCard('videos', {
                         title: finalTitle,
                         game: finalGame,
                         description: description,
                         videoUrl: e.target.result
                     });
                     
                     alert('Video başarıyla eklendi!');
                 };
                 
                 reader.readAsDataURL(file);
             } else {
                 // Dosya yoksa placeholder ile ekle
                 addContentCard('videos', {
                     title: finalTitle,
                     game: finalGame,
                     description: description
                 });
                 
                 alert('Video başarıyla eklendi!');
             }
             
             closeModal('videoModal');
             this.reset();
             
             // File text'i resetle
             const fileText = document.getElementById('videoFileText');
             if (fileText) {
                 fileText.textContent = 'Video dosyası seçin (MP4, AVI, MOV)';
                 fileText.style.color = 'var(--text-gray)';
             }
         });
     } else {
         console.error('Video form bulunamadı!'); // Debug
     }
     
     const discussionForm = document.getElementById('discussionForm');
     if (discussionForm) {
         discussionForm.addEventListener('submit', function(e) {
             e.preventDefault();
             
             const title = this.querySelector('[name="title"]').value;
             const category = this.querySelector('[name="category"]').value;
             const game = this.querySelector('[name="game"]').value;
             const message = this.querySelector('[name="message"]').value;
             
             if (title.trim() && category && message.trim()) {
                 const categoryTexts = {
                     'question': 'Soru',
                     'bug': 'Hata',
                     'suggestion': 'Öneri',
                     'general': 'Genel'
                 };
                 
                 addContentCard('discussions', {
                     title: title,
                     category: category,
                     categoryText: categoryTexts[category] || 'Genel',
                     game: game,
                     message: message
                 });
                 alert('Tartışma başarıyla başlatıldı!');
                 closeModal('discussionModal');
                 this.reset();
             } else {
                 alert('Lütfen tüm gerekli alanları doldurun!');
             }
         });
     }
});

// Yorum sistemi fonksiyonları
function toggleLike(element) {
    const likeCount = element.querySelector('.like-count');
    const currentCount = parseInt(likeCount.textContent);
    const card = element.closest('.content-card');
    const cardId = card.getAttribute('data-card-id');
    
    if (element.classList.contains('liked')) {
        // Unlike
        element.classList.remove('liked');
        const newCount = currentCount - 1;
        likeCount.textContent = newCount;
        if (cardId) saveLikeStatus(cardId, false, newCount);
    } else {
        // Like
        element.classList.add('liked');
        const newCount = currentCount + 1;
        likeCount.textContent = newCount;
        if (cardId) saveLikeStatus(cardId, true, newCount);
    }
}

function toggleComments(element) {
    const card = element.closest('.content-card');
    const commentsSection = card.querySelector('.comments-section');
    
    if (commentsSection) {
        if (commentsSection.classList.contains('show')) {
            commentsSection.classList.remove('show');
            element.classList.remove('commented');
        } else {
            commentsSection.classList.add('show');
            element.classList.add('commented');
            // Yorum input'una focus
            setTimeout(() => {
                const commentInput = commentsSection.querySelector('.comment-input');
                if (commentInput) {
                    commentInput.focus();
                }
            }, 100);
        }
    }
}

function addComment(buttonElement) {
    const commentForm = buttonElement.closest('.comment-form');
    const commentInput = commentForm.querySelector('.comment-input');
    const commentText = commentInput.value.trim();
    
    if (!commentText) {
        alert('Lütfen bir yorum yazın!');
        return;
    }
    
    if (commentText.length > 500) {
        alert('Yorum çok uzun! Maksimum 500 karakter olmalı.');
        return;
    }
    
    // Yorum listesini bul
    const card = buttonElement.closest('.content-card');
    const cardId = card.getAttribute('data-card-id');
    const commentsList = card.querySelector('.comments-list');
    const commentCountElement = card.querySelector('.comment-count');
    
    // Yeni yorum oluştur
    const comment = document.createElement('div');
    comment.className = 'comment-item';
    
    const currentTime = new Date().toLocaleTimeString('tr-TR', {hour: '2-digit', minute: '2-digit'});
    
    const commentData = {
        author: currentUser.name,
        text: commentText,
        time: currentTime,
        timestamp: new Date().toISOString()
    };
    
    comment.innerHTML = `
        <div class="comment-avatar" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
            ${currentUser.avatar}
        </div>
        <div class="comment-content">
            <div class="comment-author">${commentData.author}</div>
            <div class="comment-text">${commentData.text}</div>
            <div class="comment-time">${commentData.time}</div>
        </div>
    `;
    
    // Yorumu en üste ekle
    commentsList.insertBefore(comment, commentsList.firstChild);
    
    // Yorum sayısını güncelle
    const currentCount = parseInt(commentCountElement.textContent);
    commentCountElement.textContent = currentCount + 1;
    
    // localStorage'a kaydet
    if (cardId) {
        saveComment(cardId, commentData);
    }
    
    // Input'u temizle
    commentInput.value = '';
    
    // Animation
    comment.style.opacity = '0';
    comment.style.transform = 'translateY(-10px)';
    setTimeout(() => {
        comment.style.transition = 'all 0.3s ease';
        comment.style.opacity = '1';
        comment.style.transform = 'translateY(0)';
    }, 50);
    
    console.log('Yorum eklendi ve kaydedildi:', commentText);
}

// Textarea auto-resize
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('comment-input')) {
        const textarea = e.target;
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 100) + 'px';
    }
});

// Enter tuşu ile yorum gönderme (Shift+Enter ile yeni satır)
document.addEventListener('keydown', function(e) {
    if (e.target.classList.contains('comment-input')) {
        if (e.key === 'Enter' && !e.shiftKey) {
            e.preventDefault();
            const commentBtn = e.target.closest('.comment-form').querySelector('.comment-btn');
            if (commentBtn) {
                addComment(commentBtn);
            }
        }
    }
});

// Temizleme fonksiyonu kaldırıldı

// Mevcut statik kartlara ID ekleme fonksiyonu
function addIdsToExistingCards() {
    const existingCards = document.querySelectorAll('.content-card:not([data-card-id])');
    console.log('ID eklenen statik kart sayısı:', existingCards.length);
    
    existingCards.forEach((card, index) => {
        // Benzersiz ID ekle (statik kartlar için negative ID kullan)
        const staticId = `static-${Date.now()}-${index}`;
        card.setAttribute('data-card-id', staticId);
        console.log('Statik karta ID eklendi:', staticId);
    });
}

// Random yorum ekleme fonksiyonu
function addRandomComments() {
    const sampleComments = [
        'Harika paylaşım! 👍',
        'Bu oyunu çok seviyorum!',
        'Nasıl yaptın bunu?',
        'Epic moment! 🔥',
        'Kesinlikle deneyeceğim',
        'Çok iyi taktik',
        'Bende de aynı sorun var',
        'Teşekkürler bilgi için',
        'Muhteşem gameplay!',
        'Bu modunu nereden indirebilirim?'
    ];
    
    const cards = document.querySelectorAll('.content-card[data-card-id]');
    
    if (cards.length > 0) {
        // Random bir kart seç
        const randomCard = cards[Math.floor(Math.random() * cards.length)];
        const randomUser = getRandomUser();
        const randomComment = sampleComments[Math.floor(Math.random() * sampleComments.length)];
        
        // Yorumu ekle
        const commentsList = randomCard.querySelector('.comments-list');
        const commentCountElement = randomCard.querySelector('.comment-count');
        
        if (commentsList && commentCountElement) {
            const comment = document.createElement('div');
            comment.className = 'comment-item';
            
            const currentTime = new Date().toLocaleTimeString('tr-TR', {hour: '2-digit', minute: '2-digit'});
            
            comment.innerHTML = `
                <div class="comment-avatar" style="background: ${randomUser.color}; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; font-size: 0.7rem;">
                    ${randomUser.avatar}
                </div>
                <div class="comment-content">
                    <div class="comment-author">${randomUser.name}</div>
                    <div class="comment-text">${randomComment}</div>
                    <div class="comment-time">${currentTime}</div>
                </div>
            `;
            
            // Yorumu en üste ekle
            commentsList.insertBefore(comment, commentsList.firstChild);
            
            // Yorum sayısını güncelle
            const currentCount = parseInt(commentCountElement.textContent);
            commentCountElement.textContent = currentCount + 1;
            
            // Animation
            comment.style.opacity = '0';
            comment.style.transform = 'translateY(-10px)';
            setTimeout(() => {
                comment.style.transition = 'all 0.3s ease';
                comment.style.opacity = '1';
                comment.style.transform = 'translateY(0)';
            }, 50);
            
            console.log(`${randomUser.name} yorum ekledi: ${randomComment}`);
        }
    }
    
    // 15-30 saniye arasında random bir süre sonra tekrar çalıştır
    const nextInterval = Math.random() * (30000 - 15000) + 15000;
    setTimeout(addRandomComments, nextInterval);
}
</script>
@endsection 