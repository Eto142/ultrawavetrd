<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'Admin' }} — Chase Devere</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}?v={{ filemtime(public_path('css/admin.css')) }}" rel="stylesheet">
</head>
<body class="bg-dark text-body">

<nav class="sidebar" id="adminSidebar">
    <div class="sidebar-brand">
        <img src="{{ asset('logo.png') }}" alt="Chase Devere" style="height:24px;">
    </div>

    <div class="nav flex-column flex-grow-1">
        <p class="nav-group-label mb-0">Overview</p>
        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>

        <p class="nav-group-label mb-0">Users</p>
        <a href="{{ route('admin.users') }}" class="nav-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> All Users
        </a>
        <a href="{{ route('admin.balances') }}" class="nav-link {{ request()->routeIs('admin.balances*') ? 'active' : '' }}">
            <i class="bi bi-wallet2"></i> Balances
        </a>
        <a href="{{ route('admin.transactions') }}" class="nav-link {{ request()->routeIs('admin.transactions*') ? 'active' : '' }}">
            <i class="bi bi-list-ul"></i> Transactions
        </a>
        <a href="{{ route('admin.kyc') }}" class="nav-link {{ request()->routeIs('admin.kyc*') ? 'active' : '' }}">
            <i class="bi bi-patch-check"></i> KYC Review
        </a>

        <p class="nav-group-label mb-0">Finance</p>
        <a href="{{ route('admin.deposits') }}" class="nav-link {{ request()->routeIs('admin.deposits*') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-in-down"></i> Deposits
        </a>
        <a href="{{ route('admin.withdrawals') }}" class="nav-link {{ request()->routeIs('admin.withdrawals*') ? 'active' : '' }}">
            <i class="bi bi-box-arrow-up"></i> Withdrawals
        </a>
        <a href="{{ route('admin.profits') }}" class="nav-link {{ request()->routeIs('admin.profits*') ? 'active' : '' }}">
            <i class="bi bi-graph-up"></i> Profits
        </a>
        <a href="{{ route('admin.bonuses') }}" class="nav-link {{ request()->routeIs('admin.bonuses*') ? 'active' : '' }}">
            <i class="bi bi-gift"></i> Bonuses
        </a>
        <a href="{{ route('admin.loans') }}" class="nav-link {{ request()->routeIs('admin.loans*') ? 'active' : '' }}">
            <i class="bi bi-cash-coin"></i> Loans
        </a>
        <a href="{{ route('admin.investments') }}" class="nav-link {{ request()->routeIs('admin.investments*') ? 'active' : '' }}">
            <i class="bi bi-graph-up-arrow"></i> Investments
        </a>

        <p class="nav-group-label mb-0">Markets</p>
        <a href="{{ route('admin.stocks') }}" class="nav-link {{ request()->routeIs('admin.stocks*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i> Stocks
        </a>
        <a href="{{ route('admin.stock-orders') }}" class="nav-link {{ request()->routeIs('admin.stock-orders*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i> Stock Orders
        </a>
        <a href="{{ route('admin.pre-ipo-companies') }}" class="nav-link {{ request()->routeIs('admin.pre-ipo-companies*') ? 'active' : '' }}">
            <i class="bi bi-building"></i> Pre-IPO Companies
        </a>
        <a href="{{ route('admin.pre-ipo-holdings') }}" class="nav-link {{ request()->routeIs('admin.pre-ipo-holdings*') ? 'active' : '' }}">
            <i class="bi bi-briefcase"></i> Pre-IPO Holdings
        </a>

        <p class="nav-group-label mb-0">Trading Platform</p>
        <a href="{{ route('admin.trading-assets') }}" class="nav-link {{ request()->routeIs('admin.trading-assets*') ? 'active' : '' }}">
            <i class="bi bi-globe"></i> Trading Assets
        </a>
        <a href="{{ route('admin.trades') }}" class="nav-link {{ request()->routeIs('admin.trades*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i> Trades
        </a>
        <a href="{{ route('admin.traders') }}" class="nav-link {{ request()->routeIs('admin.traders*') ? 'active' : '' }}">
            <i class="bi bi-person-badge"></i> Traders
        </a>
        <a href="{{ route('admin.copy-trading-subscriptions') }}" class="nav-link {{ request()->routeIs('admin.copy-trading-subscriptions*') ? 'active' : '' }}">
            <i class="bi bi-people-fill"></i> Copy Trading Subs
        </a>

        <p class="nav-group-label mb-0">NFT Marketplace</p>
        <a href="{{ route('admin.nft-collections') }}" class="nav-link {{ request()->routeIs('admin.nft-collections*') ? 'active' : '' }}">
            <i class="bi bi-collection"></i> Collections
        </a>
        <a href="{{ route('admin.nfts') }}" class="nav-link {{ request()->routeIs('admin.nfts*') ? 'active' : '' }}">
            <i class="bi bi-gem"></i> NFTs
        </a>

        <p class="nav-group-label mb-0">Education</p>
        <a href="{{ route('admin.course-categories') }}" class="nav-link {{ request()->routeIs('admin.course-categories*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i> Categories
        </a>
        <a href="{{ route('admin.courses') }}" class="nav-link {{ request()->routeIs('admin.courses*', 'admin.lessons*') ? 'active' : '' }}">
            <i class="bi bi-mortarboard"></i> Courses
        </a>
        <a href="{{ route('admin.course-enrollments') }}" class="nav-link {{ request()->routeIs('admin.course-enrollments*') ? 'active' : '' }}">
            <i class="bi bi-person-check"></i> Enrollments
        </a>

        <p class="nav-group-label mb-0">Signals</p>
        <a href="{{ route('admin.signal-plans') }}" class="nav-link {{ request()->routeIs('admin.signal-plans*') ? 'active' : '' }}">
            <i class="bi bi-award"></i> Signal Plans
        </a>
        <a href="{{ route('admin.signals') }}" class="nav-link {{ request()->routeIs('admin.signals') || request()->routeIs('admin.signals.*') ? 'active' : '' }}">
            <i class="bi bi-broadcast"></i> Signals
        </a>
        <a href="{{ route('admin.signal-subscriptions') }}" class="nav-link {{ request()->routeIs('admin.signal-subscriptions*') ? 'active' : '' }}">
            <i class="bi bi-card-checklist"></i> Subscriptions
        </a>

        <p class="nav-group-label mb-0">System</p>
        <a href="{{ route('admin.admins') }}" class="nav-link {{ request()->routeIs('admin.admins*') ? 'active' : '' }}">
            <i class="bi bi-shield-lock"></i> Admin Accounts
        </a>
    </div>

    <div class="sidebar-footer">
        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-danger w-100">
                <i class="bi bi-box-arrow-right"></i> Logout
            </button>
        </form>
    </div>
</nav>

<div class="sidebar-backdrop" id="adminSidebarBackdrop" onclick="closeAdminSidebar()"></div>

<header class="topbar">
    <div class="d-flex align-items-center gap-3">
        <button class="btn btn-sm btn-outline-secondary d-lg-none" type="button" onclick="toggleAdminSidebar()">
            <i class="bi bi-list"></i>
        </button>
        <h1 class="h5 mb-0 text-light">{{ $heading ?? ($title ?? 'Dashboard') }}</h1>
    </div>
    <div class="d-flex align-items-center gap-2">
        <span class="small text-body-secondary">{{ auth('admin')->user()->name }}</span>
        <span class="d-inline-flex align-items-center justify-content-center rounded-circle bg-primary bg-opacity-25 text-primary fw-semibold" style="width:36px;height:36px;">
            {{ strtoupper(substr(auth('admin')->user()->name, 0, 1)) }}
        </span>
    </div>
</header>

<div class="main-panel">
    <div class="content bg-dark">
        <div class="page-inner">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
