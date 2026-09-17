<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\OtpController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\DepositController;
use App\Http\Controllers\User\EducationController;
use App\Http\Controllers\User\InvestmentController;
use App\Http\Controllers\User\KYCController;
use App\Http\Controllers\User\LoanController;
use App\Http\Controllers\User\NewsController;
use App\Http\Controllers\User\NFTController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\PortfolioController;
use App\Http\Controllers\User\PreIpoController;
use App\Http\Controllers\User\ProfileController;
use App\Http\Controllers\User\ReferralController;
use App\Http\Controllers\User\SecurityController;
use App\Http\Controllers\User\SignalController;
use App\Http\Controllers\User\StockController;
use App\Http\Controllers\User\SupportController;
use App\Http\Controllers\User\TradeController;
use App\Http\Controllers\User\TransactionController;
use App\Http\Controllers\User\WalletController;
use App\Http\Controllers\User\WithdrawalController;
use Illuminate\Support\Facades\Route;






Route::get('/', function () {
    return view('home.homepage');
});

Route::get('/contact', function () {
    return view('home.contact');
});

Route::get('/education', function () {
    return view('home.education');
});

Route::get('/cryptocurrencies', function () {
    return view('home.cryptocurrencies');
});

Route::get('/forex', function () {
    return view('home.forex');
});

Route::get('/shares', function () {
    return view('home.shares');
});

Route::get('/indices', function () {
    return view('home.indices');
});

Route::get('/etfs', function () {
    return view('home.etfs');
});



Route::get('/trade', function () {
    return view('home.trade');
});

Route::get('/copy-trading', function () {
    return view('home.copy-trading');
});

Route::get('/automated-trading', function () {
    return view('home.automated-trading');
});

Route::get('/about', function () {
    return view('home.about');
});

Route::get('/why-us', function () {
    return view('home.why-us');
});

Route::get('/faq', function () {
    return view('home.faq');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
});

Route::get('/terms-and-conditions', function () {
    return view('home.terms-and-conditions');
});

Route::get('/privacy-policy', function () {
    return view('home.privacy-policy');
});



//AUTHENTICATION ROUTES

Route::middleware('guest')->group(function () {
    Route::view('/login', 'auth.login')->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.user');

    Route::view('/register', 'auth.register')->name('register');
    Route::post('/register', [RegisterController::class, 'register'])->name('register.store');
});

Route::get('/ref/{code}', [ReferralController::class, 'redirect'])->name('ref.redirect');

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

//OTP VERIFICATION ROUTES

Route::middleware('auth')->group(function () {
    Route::get('/verify-otp', [OtpController::class, 'show'])->name('otp.verify');
    Route::post('/verify-otp', [OtpController::class, 'verify'])->name('otp.verify.submit');
    Route::post('/verify-otp/resend', [OtpController::class, 'resend'])->name('otp.verify.resend');
});

//USER ROUTES

Route::prefix('user')->middleware(['auth', 'otp.verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('user.dashboard');
    Route::get('/pre-ipo', [PreIpoController::class, 'index'])->name('user.pre-ipo');
    Route::get('/pre-ipo/holdings', [PreIpoController::class, 'holdings'])->name('user.pre-ipo.holdings');
    Route::get('/pre-ipo/{company}', [PreIpoController::class, 'show'])->name('user.pre-ipo.show');
    Route::post('/pre-ipo/{company}/buy', [PreIpoController::class, 'buy'])->name('user.pre-ipo.buy');
    Route::get('/stocks', [StockController::class, 'index'])->name('user.stocks');
    Route::get('/stocks/portfolio', [StockController::class, 'portfolio'])->name('user.stocks.portfolio');
    Route::get('/stocks/history', [StockController::class, 'history'])->name('user.stocks.history');
    Route::get('/stocks/{stock}', [StockController::class, 'show'])->name('user.stocks.show');
    Route::post('/stocks/{stock}/buy', [StockController::class, 'buy'])->name('user.stocks.buy');
    Route::post('/stocks/{stock}/sell', [StockController::class, 'sell'])->name('user.stocks.sell');
    Route::get('/signals', [SignalController::class, 'signals'])->name('user.signals');
    Route::get('/signal-plans', [SignalController::class, 'signalplans'])->name('user.signal-plans');
    Route::post('/signal-plans/subscribe', [SignalController::class, 'subscribe'])->name('user.signal-plans.subscribe');
    Route::get('/my-subscriptions', [SignalController::class, 'mysubscriptions'])->name('user.my-subscriptions');
    Route::get('/deposit', [DepositController::class, 'index'])->name('user.deposit');
    Route::post('/deposit', [DepositController::class, 'store'])->name('user.deposit.store');
    Route::post('/deposit/other', [DepositController::class, 'storeOther'])->name('user.deposit.other');
    Route::get('/withdrawal', [WithdrawalController::class, 'index'])->name('user.withdrawal');
    Route::post('/withdrawal', [WithdrawalController::class, 'store'])->name('user.withdrawal.store');
    Route::get('/transactions', [TransactionController::class, 'index'])->name('user.transactions');
    Route::get('/loans', [LoanController::class, 'index'])->name('user.loans');
    Route::post('/loans/calculate-preview', [LoanController::class, 'calculatePreview'])->name('user.loans.preview');
    Route::post('/loans/store', [LoanController::class, 'store'])->name('user.loans.store');
    Route::get('/my-loans', [LoanController::class, 'myLoans'])->name('user.loans.my');
    Route::get('/investment-plan', [InvestmentController::class, 'index'])->name('user.investment.plan');
    Route::post('/investment-plan/store', [InvestmentController::class, 'store'])->name('user.investment.store');
    Route::get('/my-investments', [InvestmentController::class, 'myPlans'])->name('user.investment.my');
    Route::get('/profile', [ProfileController::class, 'index'])->name('user.profile');
    Route::post('/profile/info', [ProfileController::class, 'updateInfo'])->name('user.profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('user.profile.password');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('user.profile.avatar');
    Route::get('/security', [SecurityController::class, 'index'])->name('user.security');
    Route::get('/kyc', [KYCController::class, 'index'])->name('user.kyc');
    Route::get('/kyc/apply', [KYCController::class, 'create'])->name('user.kyc.create');
    Route::post('/kyc', [KYCController::class, 'store'])->name('user.kyc.store');
    Route::get('/support', [SupportController::class, 'index'])->name('user.support');
    Route::get('/referrals', [ReferralController::class, 'index'])->name('user.referrals');
    Route::get('/nfts', [NFTController::class, 'index'])->name('user.nfts');
    Route::get('/nft-gallery', [NFTController::class, 'NftGallery'])->name('user.nft-gallery');
    Route::get('/my-collection', [NFTController::class, 'MyCollection'])->name('user.my-collection');
    Route::get('/mint-nft', [NFTController::class, 'MintNft'])->name('user.mint-nft');
    Route::post('/nfts/store', [NFTController::class, 'store'])->name('user.nfts.store');
    Route::get('/nfts/{nft}', [NFTController::class, 'show'])->name('user.nfts.show');
    Route::post('/nfts/{nft}/like', [NFTController::class, 'like'])->name('user.nfts.like');
    Route::get('/portfolio', [PortfolioController::class, 'index'])->name('user.portfolio');
    Route::get('/trade', [TradeController::class, 'index'])->name('user.trade');
    Route::post('/trade/store', [TradeController::class, 'store'])->name('user.trade.store');
    Route::post('/trade/{trade}/close', [TradeController::class, 'closeRequest'])->name('user.trade.close');
    Route::get('/markets', [TradeController::class, 'markets'])->name('user.markets');
    Route::get('/markets-news', [TradeController::class, 'marketsnews'])->name('user.market-news');
    Route::get('/copy-trading', [TradeController::class, 'copyTrading'])->name('user.copy-trading');
    Route::get('/copy-trading/expert/{trader}', [TradeController::class, 'showExpert'])->name('user.copy-trading.show');
    Route::post('/copy-trading/subscribe', [TradeController::class, 'copySubscribe'])->name('user.copy-trading.subscribe');
    Route::get('/trading-history', [TradeController::class, 'history'])->name('user.trading-history');
    Route::get('/courses', [EducationController::class, 'index'])->name('user.courses');
    Route::get('/my-courses', [EducationController::class, 'myCourses'])->name('user.my-courses');
    Route::get('/courses/{course}', [EducationController::class, 'show'])->name('user.courses.show');
    Route::post('/courses/enroll', [EducationController::class, 'enroll'])->name('user.courses.enroll');
    Route::get('/news', [NewsController::class, 'index'])->name('user.news');
    Route::get('/notifications', [NotificationController::class, 'index'])->name('user.notifications');
    Route::get('/notifications/unread', [NotificationController::class, 'unread'])->name('user.notifications.unread');
    Route::post('/notifications/read-all', [NotificationController::class, 'readAll'])->name('user.notifications.read-all');
     Route::get('/connect-wallet', [WalletController::class, 'connect'])->name('user.connect-wallet');
});