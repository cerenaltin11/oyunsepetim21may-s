<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the cart page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Session::get('cart', []);
        $cartItems = [];
        $totalPrice = 0;
        $discount = 0;
        $personalizedDiscount = 0;
        
        // Fetch game details for each item in cart
        if (!empty($cart)) {
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
        }
        
        return view('cart', [
            'cartItems' => $cartItems,
            'totalPrice' => $totalPrice,
            'discount' => $discount,
            'personalizedDiscount' => $personalizedDiscount,
            'totalCount' => count($cartItems)
        ]);
    }
    
    /**
     * Add a game to the cart
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        $request->validate([
            'game_id' => 'required|exists:games,id'
        ]);
        
        $gameId = $request->game_id;
        $game = Game::find($gameId);
        
        if (!$game) {
            return redirect()->back()->with('error', 'Oyun bulunamadı');
        }
        
        // Kullanıcının kütüphanesini kontrol et
        $library = Session::get('library', []);
        
        // Eğer oyun daha önce satın alındıysa uyarı ver
        if (in_array($gameId, $library)) {
            return redirect()->back()->with('warning', 'Bu oyun zaten kütüphanenizde bulunuyor. Aynı oyunu tekrar satın alamazsınız.');
        }
        
        // Get current cart
        $cart = Session::get('cart', []);
        
        // Check if it's a personalized deal
        $isPersonalized = $request->has('is_personalized') && $request->is_personalized == 'true';
        $personalizedPrice = $request->personalizedPrice ? (float)$request->personalizedPrice : null;
        
        // Add or increment game in cart
        if (isset($cart[$gameId])) {
            // Digital games are typically purchased once, but you could increment for physical items
            // For now, we'll just show a message that the game is already in the cart
            return redirect()->back()->with('info', 'Bu oyun zaten sepetinizde');
        } else {
            // Store as an array with quantity and personalization info
            $cart[$gameId] = [
                'quantity' => 1,
                'is_personalized' => $isPersonalized,
                'personalized_price' => $personalizedPrice,
                // Add essential game info to cart to avoid DB lookups
                'title' => $game->title,
                'price' => $game->discount_price ?: $game->price,
                'image' => $game->image
            ];
        }
        
        // Update cart in session
        Session::put('cart', $cart);
        
        $successMessage = $game->title . ' sepetinize eklendi';
        if ($isPersonalized) {
            $successMessage = 'Kişiye özel indirimli ' . $game->title . ' sepetinize eklendi!';
        }
        
        return redirect()->back()->with('success', $successMessage);
    }
    
    /**
     * Remove a game from the cart
     *
     * @param  int  $gameId
     * @return \Illuminate\Http\Response
     */
    public function remove($gameId)
    {
        // Get current cart
        $cart = Session::get('cart', []);
        
        // Remove game from cart if it exists
        if (isset($cart[$gameId])) {
            unset($cart[$gameId]);
            Session::put('cart', $cart);
            return redirect()->back()->with('success', 'Oyun sepetten kaldırıldı');
        }
        
        return redirect()->back();
    }
    
    /**
     * Clear the entire cart
     *
     * @return \Illuminate\Http\Response
     */
    public function clear()
    {
        Session::forget('cart');
        return redirect()->back()->with('success', 'Sepet temizlendi');
    }
    
    /**
     * Process to checkout
     *
     * @return \Illuminate\Http\Response
     */
    public function checkout()
    {
        // Redirect to the payment checkout page
        return redirect()->route('payment.checkout');
    }
} 