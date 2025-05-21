<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Show checkout page with payment form
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        // Get cart items
        $cart = Session::get('cart', []);
        $cartItems = [];
        $totalPrice = 0;
        $discount = 0;
        $personalizedDiscount = 0;
        
        if (empty($cart)) {
            return redirect()->route('cart')->with('info', 'Sepetiniz boş. Lütfen önce sepetinize ürün ekleyin.');
        }
        
        // Fetch game details for each item in cart
        foreach ($cart as $gameId => $item) {
            $game = Game::find($gameId);
            if ($game) {
                // Default values
                $price = $game->price;
                $discountedPrice = $game->discount_price;
                $isPersonalized = false;
                
                // Check if this is a personalized deal
                if (is_array($item) && isset($item['is_personalized']) && $item['is_personalized']) {
                    $isPersonalized = true;
                    $discountedPrice = $item['personalized_price'];
                }
                
                // Ensure $item is an array and quantity is set
                $quantity = is_array($item) && isset($item['quantity']) ? $item['quantity'] : 1;
                
                $cartItems[] = [
                    'id' => $game->id,
                    'title' => $game->title,
                    'price' => $price,
                    'discount_price' => $discountedPrice,
                    'category' => $game->category,
                    'image' => $game->image,
                    'slug' => $game->slug,
                    'quantity' => $quantity,
                    'is_personalized' => $isPersonalized
                ];
                
                // Calculate totals
                if ($discountedPrice) {
                    $totalPrice += $discountedPrice * $quantity;
                    $itemDiscount = ($price - $discountedPrice) * $quantity;
                    $discount += $itemDiscount;
                    
                    // Track personalized discounts separately
                    if ($isPersonalized) {
                        $personalizedDiscount += $itemDiscount;
                    }
                } else {
                    $totalPrice += $price * $quantity;
                }
            }
        }
        
        return view('checkout', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'discount' => $discount,
            'personalizedDiscount' => $personalizedDiscount,
            'totalCount' => count($cartItems)
        ]);
    }
    
    /**
     * Process payment
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function process(Request $request)
    {
        // Payment processing logic would go here
        // This is a simplified demo version
        
        $cart = session('cart', []);
        
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Sepetiniz boş.');
        }
        
        // Process payment information
        $request->validate([
            'card_number' => 'required|string|size:19', // Format: XXXX XXXX XXXX XXXX
            'card_name' => 'required|string|max:255',
            'expiry' => 'required|string|size:5', // Format: MM/YY
            'cvv' => 'required|string|size:3',
        ]);
        
        // In a real app, you would integrate with a payment gateway here
        // For demo, we'll just simulate a successful payment
        
        // Calculate total
        $total = 0;
        $items = [];
        
        foreach ($cart as $gameId => $gameInfo) {
            // Handle both array format and simple format
            if (is_array($gameInfo)) {
                $game = Game::find($gameId);
                if ($game) {
                    $price = isset($gameInfo['personalized_price']) ? $gameInfo['personalized_price'] : 
                             ($game->discount_price ?: $game->price);
                    
                    $items[] = [
                        'id' => $gameId,
                        'title' => $game->title,
                        'price' => $price,
                        'image' => $game->image
                    ];
                    
                    $total += $price;
                }
            } else {
                // Legacy format where gameInfo is just a game object
                $game = Game::find($gameId);
                if ($game) {
                    $price = $game->discount_price ?: $game->price;
                    
                    $items[] = [
                        'id' => $gameId,
                        'title' => $game->title,
                        'price' => $price,
                        'image' => $game->image
                    ];
                    
                    $total += $price;
                }
            }
        }
        
        // Generate order ID
        $orderId = 'OYN-' . strtoupper(substr(md5(uniqid()), 0, 8));
        
        // Store order information in session for the success page
        $orderDetails = [
            'order_id' => $orderId,
            'date' => now()->format('d.m.Y'),
            'items' => $items,
            'total' => $total,
            'payment_method' => 'Kredi Kartı',
            'card_number' => substr_replace($request->card_number, '************', 0, 15), // Show only last 4 digits
        ];
        
        session(['last_order' => $orderDetails]);
        
        // Add to order history for the user
        $orders = session('orders', []);
        $orders[] = $orderDetails;
        session(['orders' => $orders]);
        
        // Debug info
        \Log::info('Payment processed successfully. Order ID: ' . $orderId);
        \Log::info('Items purchased: ', $items);
        
        // Add purchased games to user's library
        $gameIds = [];
        foreach ($orderDetails['items'] as $item) {
            $gameIds[] = $item['id'];
        }

        // Kullanıcıya oyunları veritabanındaki user_games tablosuna ekle
        $user = auth()->user();
        if ($user) {
            foreach ($gameIds as $gameId) {
                // Check if user already owns this game
                $exists = \App\Models\UserGame::where('user_id', $user->id)
                    ->where('game_id', $gameId)
                    ->exists();
                    
                if (!$exists) {
                    \App\Models\UserGame::create([
                        'user_id' => $user->id,
                        'game_id' => $gameId,
                        'purchased_at' => now()
                    ]);
                }
            }
            
            // Rozet kontrolü
            if (method_exists($user, 'checkPurchaseBadges')) {
                $user->checkPurchaseBadges();
            }
        }

        // Use the library controller to handle any additional logic
        app(\App\Http\Controllers\LibraryController::class)->addGames($gameIds);
        
        return redirect()->route('payment.success', ['orderId' => $orderId]);
    }
    
    /**
     * Display payment success page
     *
     * @param  string  $orderId
     * @return \Illuminate\Http\Response
     */
    public function success($orderId)
    {
        // Order details would typically be retrieved from database
        // For demo, we'll use session data
        $orderDetails = session('last_order');
        
        if (!$orderDetails) {
            return redirect('/')->with('error', 'Sipariş detayları bulunamadı.');
        }
        
        // Clear the cart after successful purchase
        session()->forget('cart');
        
        return view('payment.success', [
            'orderDetails' => $orderDetails
        ]);
    }
} 