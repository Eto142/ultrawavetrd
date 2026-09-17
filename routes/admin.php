<?php

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\BalanceController;
use App\Http\Controllers\Admin\BonusController;
use App\Http\Controllers\Admin\CopyTradingSubscriptionController;
use App\Http\Controllers\Admin\CourseCategoryController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\CourseEnrollmentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DepositController;
use App\Http\Controllers\Admin\InvestmentController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\NftCollectionController;
use App\Http\Controllers\Admin\NftController;
use App\Http\Controllers\Admin\PreIpoCompanyController;
use App\Http\Controllers\Admin\PreIpoHoldingController;
use App\Http\Controllers\Admin\ProfitController;
use App\Http\Controllers\Admin\SignalController;
use App\Http\Controllers\Admin\SignalPlanController;
use App\Http\Controllers\Admin\SignalSubscriptionController;
use App\Http\Controllers\Admin\StockController;
use App\Http\Controllers\Admin\StockOrderController;
use App\Http\Controllers\Admin\TradeController;
use App\Http\Controllers\Admin\TraderController;
use App\Http\Controllers\Admin\TradingAssetController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WithdrawalController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware('admin.guest')->group(function () {
        Route::get('/login', [LoginController::class, 'show'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('login.submit');
    });

    Route::middleware('admin.auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Users
        Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions');
        Route::get('/balances', [BalanceController::class, 'index'])->name('balances');
        Route::get('/users', [UserController::class, 'index'])->name('users');
        Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::post('/users/{user}/credit', [UserController::class, 'credit'])->name('users.credit');
        Route::post('/users/{user}/mail', [UserController::class, 'sendMail'])->name('users.mail');

        // KYC
        Route::get('/kyc', [KycController::class, 'index'])->name('kyc');
        Route::get('/kyc/{kyc}', [KycController::class, 'show'])->name('kyc.show');
        Route::post('/kyc/{kyc}/approve', [KycController::class, 'approve'])->name('kyc.approve');
        Route::post('/kyc/{kyc}/reject', [KycController::class, 'reject'])->name('kyc.reject');

        // Finance
        Route::get('/deposits', [DepositController::class, 'index'])->name('deposits');
        Route::post('/deposits/{deposit}/approve', [DepositController::class, 'approve'])->name('deposits.approve');

        Route::get('/withdrawals', [WithdrawalController::class, 'index'])->name('withdrawals');
        Route::post('/withdrawals/{withdrawal}/approve', [WithdrawalController::class, 'approve'])->name('withdrawals.approve');

        Route::get('/profits', [ProfitController::class, 'index'])->name('profits');
        Route::post('/users/{user}/profits', [ProfitController::class, 'store'])->name('profits.store');

        Route::get('/bonuses', [BonusController::class, 'index'])->name('bonuses');
        Route::post('/users/{user}/bonuses', [BonusController::class, 'store'])->name('bonuses.store');

        Route::get('/loans', [LoanController::class, 'index'])->name('loans');
        Route::post('/loans/{loan}/approve', [LoanController::class, 'approve'])->name('loans.approve');

        Route::get('/investments', [InvestmentController::class, 'index'])->name('investments');
        Route::post('/investments/{investment}/approve', [InvestmentController::class, 'approve'])->name('investments.approve');

        // NFT Marketplace
        Route::get('/nft-collections', [NftCollectionController::class, 'index'])->name('nft-collections');
        Route::get('/nft-collections/create', [NftCollectionController::class, 'create'])->name('nft-collections.create');
        Route::post('/nft-collections', [NftCollectionController::class, 'store'])->name('nft-collections.store');
        Route::get('/nft-collections/{nftCollection}/edit', [NftCollectionController::class, 'edit'])->name('nft-collections.edit');
        Route::put('/nft-collections/{nftCollection}', [NftCollectionController::class, 'update'])->name('nft-collections.update');
        Route::delete('/nft-collections/{nftCollection}', [NftCollectionController::class, 'destroy'])->name('nft-collections.destroy');

        Route::get('/nfts', [NftController::class, 'index'])->name('nfts');
        Route::post('/nfts/{nft}/toggle-feature', [NftController::class, 'toggleFeature'])->name('nfts.toggle-feature');
        Route::delete('/nfts/{nft}', [NftController::class, 'destroy'])->name('nfts.destroy');

        // Education
        Route::get('/course-categories', [CourseCategoryController::class, 'index'])->name('course-categories');
        Route::get('/course-categories/create', [CourseCategoryController::class, 'create'])->name('course-categories.create');
        Route::post('/course-categories', [CourseCategoryController::class, 'store'])->name('course-categories.store');
        Route::get('/course-categories/{courseCategory}/edit', [CourseCategoryController::class, 'edit'])->name('course-categories.edit');
        Route::put('/course-categories/{courseCategory}', [CourseCategoryController::class, 'update'])->name('course-categories.update');
        Route::delete('/course-categories/{courseCategory}', [CourseCategoryController::class, 'destroy'])->name('course-categories.destroy');

        Route::get('/courses', [CourseController::class, 'index'])->name('courses');
        Route::get('/courses/create', [CourseController::class, 'create'])->name('courses.create');
        Route::post('/courses', [CourseController::class, 'store'])->name('courses.store');
        Route::get('/courses/{course}/edit', [CourseController::class, 'edit'])->name('courses.edit');
        Route::put('/courses/{course}', [CourseController::class, 'update'])->name('courses.update');
        Route::delete('/courses/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');

        Route::get('/courses/{course}/lessons', [LessonController::class, 'index'])->name('lessons');
        Route::get('/courses/{course}/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
        Route::post('/courses/{course}/lessons', [LessonController::class, 'store'])->name('lessons.store');
        Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
        Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
        Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');

        Route::get('/course-enrollments', [CourseEnrollmentController::class, 'index'])->name('course-enrollments');
        Route::post('/course-enrollments/{enrollment}/approve', [CourseEnrollmentController::class, 'approve'])->name('course-enrollments.approve');

        // Signals
        Route::get('/signal-plans', [SignalPlanController::class, 'index'])->name('signal-plans');
        Route::get('/signal-plans/create', [SignalPlanController::class, 'create'])->name('signal-plans.create');
        Route::post('/signal-plans', [SignalPlanController::class, 'store'])->name('signal-plans.store');
        Route::get('/signal-plans/{signalPlan}/edit', [SignalPlanController::class, 'edit'])->name('signal-plans.edit');
        Route::put('/signal-plans/{signalPlan}', [SignalPlanController::class, 'update'])->name('signal-plans.update');
        Route::delete('/signal-plans/{signalPlan}', [SignalPlanController::class, 'destroy'])->name('signal-plans.destroy');

        Route::get('/signals', [SignalController::class, 'index'])->name('signals');
        Route::get('/signals/create', [SignalController::class, 'create'])->name('signals.create');
        Route::post('/signals', [SignalController::class, 'store'])->name('signals.store');
        Route::get('/signals/{signal}/edit', [SignalController::class, 'edit'])->name('signals.edit');
        Route::put('/signals/{signal}', [SignalController::class, 'update'])->name('signals.update');
        Route::delete('/signals/{signal}', [SignalController::class, 'destroy'])->name('signals.destroy');

        Route::get('/signal-subscriptions', [SignalSubscriptionController::class, 'index'])->name('signal-subscriptions');
        Route::post('/signal-subscriptions/{subscription}/approve', [SignalSubscriptionController::class, 'approve'])->name('signal-subscriptions.approve');

        // Pre-IPO
        Route::get('/pre-ipo-companies', [PreIpoCompanyController::class, 'index'])->name('pre-ipo-companies');
        Route::get('/pre-ipo-companies/create', [PreIpoCompanyController::class, 'create'])->name('pre-ipo-companies.create');
        Route::post('/pre-ipo-companies', [PreIpoCompanyController::class, 'store'])->name('pre-ipo-companies.store');
        Route::get('/pre-ipo-companies/{preIpoCompany}/edit', [PreIpoCompanyController::class, 'edit'])->name('pre-ipo-companies.edit');
        Route::put('/pre-ipo-companies/{preIpoCompany}', [PreIpoCompanyController::class, 'update'])->name('pre-ipo-companies.update');
        Route::delete('/pre-ipo-companies/{preIpoCompany}', [PreIpoCompanyController::class, 'destroy'])->name('pre-ipo-companies.destroy');

        Route::get('/pre-ipo-holdings', [PreIpoHoldingController::class, 'index'])->name('pre-ipo-holdings');
        Route::post('/pre-ipo-holdings/{holding}/approve', [PreIpoHoldingController::class, 'approve'])->name('pre-ipo-holdings.approve');

        // Stocks
        Route::get('/stocks', [StockController::class, 'index'])->name('stocks');
        Route::get('/stocks/create', [StockController::class, 'create'])->name('stocks.create');
        Route::post('/stocks', [StockController::class, 'store'])->name('stocks.store');
        Route::get('/stocks/{stock}/edit', [StockController::class, 'edit'])->name('stocks.edit');
        Route::put('/stocks/{stock}', [StockController::class, 'update'])->name('stocks.update');
        Route::delete('/stocks/{stock}', [StockController::class, 'destroy'])->name('stocks.destroy');

        Route::get('/stock-orders', [StockOrderController::class, 'index'])->name('stock-orders');
        Route::post('/stock-orders/{order}/approve', [StockOrderController::class, 'approve'])->name('stock-orders.approve');

        // Trading
        Route::get('/trading-assets', [TradingAssetController::class, 'index'])->name('trading-assets');
        Route::get('/trading-assets/create', [TradingAssetController::class, 'create'])->name('trading-assets.create');
        Route::post('/trading-assets', [TradingAssetController::class, 'store'])->name('trading-assets.store');
        Route::get('/trading-assets/{tradingAsset}/edit', [TradingAssetController::class, 'edit'])->name('trading-assets.edit');
        Route::put('/trading-assets/{tradingAsset}', [TradingAssetController::class, 'update'])->name('trading-assets.update');
        Route::delete('/trading-assets/{tradingAsset}', [TradingAssetController::class, 'destroy'])->name('trading-assets.destroy');

        Route::get('/traders', [TraderController::class, 'index'])->name('traders');
        Route::get('/traders/create', [TraderController::class, 'create'])->name('traders.create');
        Route::post('/traders', [TraderController::class, 'store'])->name('traders.store');
        Route::get('/traders/{trader}/edit', [TraderController::class, 'edit'])->name('traders.edit');
        Route::put('/traders/{trader}', [TraderController::class, 'update'])->name('traders.update');
        Route::delete('/traders/{trader}', [TraderController::class, 'destroy'])->name('traders.destroy');

        Route::get('/trades', [TradeController::class, 'index'])->name('trades');
        Route::get('/trades/{trade}/settle', [TradeController::class, 'settle'])->name('trades.settle');
        Route::put('/trades/{trade}', [TradeController::class, 'update'])->name('trades.update');

        Route::get('/copy-trading-subscriptions', [CopyTradingSubscriptionController::class, 'index'])->name('copy-trading-subscriptions');
        Route::post('/copy-trading-subscriptions/{subscription}/approve', [CopyTradingSubscriptionController::class, 'approve'])->name('copy-trading-subscriptions.approve');

        // Admin accounts
        Route::get('/admins', [AdminUserController::class, 'index'])->name('admins');
        Route::get('/admins/create', [AdminUserController::class, 'create'])->name('admins.create');
        Route::post('/admins', [AdminUserController::class, 'store'])->name('admins.store');
        Route::get('/admins/{admin}/edit', [AdminUserController::class, 'edit'])->name('admins.edit');
        Route::put('/admins/{admin}', [AdminUserController::class, 'update'])->name('admins.update');
        Route::delete('/admins/{admin}', [AdminUserController::class, 'destroy'])->name('admins.destroy');
    });
});
