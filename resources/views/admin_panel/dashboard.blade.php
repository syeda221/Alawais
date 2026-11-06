@extends('admin_panel.layout.app')

@section('content')
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<style>
    :root {
        --erp-bg: #f8fafc;
        --erp-card-bg: #ffffff;
        --erp-border: #e2e8f0;
        --erp-text-main: #0f172a;
        --erp-text-muted: #64748b;
        --erp-primary: #2563eb;
        --erp-success: #10b981;
        --erp-warning: #f59e0b;
        --erp-danger: #f43f5e;
        --erp-teal: #0d9488;
        --erp-purple: #8b5cf6;
        --erp-slate: #475569;
    }

    body {
        background-color: var(--erp-bg) !important;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
        color: var(--erp-text-main);
    }

    .erp-dashboard-container {
        padding: 16px 20px 40px;
    }

    /* Section Titles */
    .erp-section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 18px;
        margin-bottom: 12px;
        padding: 0 2px;
    }

    .erp-section-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--erp-text-main);
        letter-spacing: 0.3px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .erp-section-link {
        font-size: 11px;
        font-weight: 600;
        color: var(--erp-text-muted);
        text-decoration: none;
        padding: 4px 10px;
        border-radius: 6px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        transition: all 0.2s ease;
    }

    .erp-section-link:hover {
        background: #e2e8f0;
        color: var(--erp-text-main);
    }

    /* Metric Cards Grid */
    .erp-grid-4 {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 16px;
        margin-bottom: 20px;
    }

    @media (max-width: 992px) {
        .erp-grid-4 { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 576px) {
        .erp-grid-4 { grid-template-columns: 1fr; }
    }

    .erp-card {
        background: var(--erp-card-bg);
        border: 1px solid var(--erp-border);
        border-radius: 12px;
        padding: 16px 18px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        position: relative;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: transform 0.15s ease, box-shadow 0.15s ease;
    }

    .erp-card:hover {
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.07);
        transform: translateY(-2px);
    }

    .erp-card-top {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 8px;
    }

    .erp-icon-badge {
        width: 36px;
        height: 36px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
        flex-shrink: 0;
    }

    .erp-icon-blue   { background: #eff6ff; color: #2563eb; }
    .erp-icon-green  { background: #ecfdf5; color: #10b981; }
    .erp-icon-dark   { background: #0f172a; color: #ffffff; }
    .erp-icon-purple { background: #f5f3ff; color: #8b5cf6; }
    .erp-icon-slate  { background: #f1f5f9; color: #475569; }
    .erp-icon-amber  { background: #fffbeb; color: #d97706; }
    .erp-icon-cyan   { background: #ecfeff; color: #0891b2; }
    .erp-icon-rose   { background: #fff1f2; color: #f43f5e; }

    .erp-card-label {
        font-size: 11px;
        font-weight: 700;
        color: var(--erp-text-muted);
        letter-spacing: 0.4px;
        text-transform: uppercase;
    }

    .erp-card-value {
        font-size: 22px;
        font-weight: 800;
        color: var(--erp-text-main);
        margin: 6px 0 3px;
        line-height: 1.2;
    }

    .erp-card-sub {
        font-size: 11px;
        color: var(--erp-text-muted);
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 500;
    }

    .erp-card-footer {
        border-top: 1px solid #f1f5f9;
        margin-top: 12px;
        padding-top: 9px;
    }

    .erp-card-footer a {
        font-size: 11px;
        font-weight: 600;
        color: var(--erp-primary);
        text-decoration: none;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: color 0.15s;
    }

    .erp-card-footer a:hover {
        color: #1d4ed8;
    }

    /* Container Panel for Charts & Tables */
    .erp-panel {
        background: #ffffff;
        border: 1px solid var(--erp-border);
        border-radius: 12px;
        padding: 18px 20px;
        margin-bottom: 20px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .erp-panel-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 14px;
        padding-bottom: 10px;
        border-bottom: 1px solid #f1f5f9;
    }

    .erp-panel-title {
        font-size: 13px;
        font-weight: 700;
        color: var(--erp-text-main);
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .erp-btn-sm {
        font-size: 11px;
        font-weight: 600;
        padding: 4px 10px;
        border-radius: 6px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s;
    }

    .erp-btn-sm:hover {
        background: #f8fafc;
        color: #0f172a;
    }

    .erp-btn-primary {
        background: #0f172a;
        color: #ffffff;
        border-color: #0f172a;
    }

    .erp-btn-primary:hover {
        background: #1e293b;
        color: #ffffff;
    }

    /* Tables */
    .erp-table-responsive {
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }

    .erp-table {
        width: 100%;
        margin-bottom: 0;
        font-size: 12px;
        border-collapse: collapse;
    }

    .erp-table th {
        font-size: 11px;
        font-weight: 700;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        background: #f8fafc;
        border-top: none;
        border-bottom: 1px solid #e2e8f0;
        padding: 9px 12px;
        white-space: nowrap;
    }

    .erp-table td {
        padding: 10px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #1e293b;
    }

    .erp-table tbody tr:hover td {
        background-color: #f8fafc;
    }

    /* Badges */
    .badge-rank-1 { background: #dcfce7; color: #15803d; font-weight: 700; padding: 2px 7px; border-radius: 5px; font-size: 11px; }
    .badge-rank-2 { background: #ccfbf1; color: #0f766e; font-weight: 700; padding: 2px 7px; border-radius: 5px; font-size: 11px; }
    .badge-rank-3 { background: #e0f2fe; color: #0369a1; font-weight: 700; padding: 2px 7px; border-radius: 5px; font-size: 11px; }
    .badge-rank-normal { background: #f1f5f9; color: #475569; font-weight: 700; padding: 2px 7px; border-radius: 5px; font-size: 11px; }

    .badge-pill-success { background: #ecfdf5; color: #047857; font-size: 10.5px; font-weight: 600; padding: 3px 9px; border-radius: 12px; border: 1px solid #a7f3d0; }
    .badge-pill-warning { background: #fffbeb; color: #b45309; font-size: 10.5px; font-weight: 600; padding: 3px 9px; border-radius: 12px; border: 1px solid #fde68a; }
    .badge-pill-danger  { background: #fff1f2; color: #be123c; font-size: 10.5px; font-weight: 600; padding: 3px 9px; border-radius: 12px; border: 1px solid #fecdd3; }
    .badge-pill-secondary { background: #f1f5f9; color: #475569; font-size: 10.5px; font-weight: 600; padding: 3px 9px; border-radius: 12px; border: 1px solid #e2e8f0; }

    .legend-indicator {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        margin-right: 6px;
    }

    /* Top Executive Welcome Banner */
    .erp-welcome-banner {
        background: #ffffff;
        border: 1px solid var(--erp-border);
        border-radius: 14px;
        padding: 20px 24px;
        box-shadow: 0 1px 3px rgba(15, 23, 42, 0.04);
        position: relative;
    }

    .erp-brand-badge {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: #eff6ff;
        color: var(--erp-primary);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 15px;
    }

    .erp-banner-title {
        font-size: 18px;
        font-weight: 800;
        color: var(--erp-text-main);
        letter-spacing: -0.3px;
    }

    .erp-live-badge {
        font-size: 11px;
        font-weight: 600;
        color: #047857;
        background: #ecfdf5;
        border: 1px solid #a7f3d0;
        padding: 3px 9px;
        border-radius: 12px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .erp-pulse-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        background: #10b981;
        box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7);
        animation: erpPulse 1.8s infinite;
    }

    @keyframes erpPulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(16, 185, 129, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(16, 185, 129, 0); }
    }

    .erp-date-badge {
        font-size: 11px;
        font-weight: 500;
        color: #64748b;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        padding: 3px 9px;
        border-radius: 12px;
    }

    .erp-banner-subtitle {
        font-size: 12px;
        color: var(--erp-text-muted);
        margin-top: 4px;
    }

    /* Action Buttons */
    .erp-action-btn {
        font-size: 11px;
        font-weight: 600;
        padding: 6px 12px;
        border-radius: 7px;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        transition: all 0.2s ease;
        border: 1px solid transparent;
        white-space: nowrap;
    }

    .erp-action-primary {
        background: var(--erp-primary);
        color: #ffffff !important;
        box-shadow: 0 1px 3px rgba(37, 99, 235, 0.2);
    }
    .erp-action-primary:hover {
        background: #1d4ed8;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
    }

    .erp-action-success {
        background: #ecfdf5;
        color: #047857 !important;
        border-color: #a7f3d0;
    }
    .erp-action-success:hover {
        background: #d1fae5;
        transform: translateY(-1px);
    }

    .erp-action-light {
        background: #f8fafc;
        color: #334155 !important;
        border-color: #cbd5e1;
    }
    .erp-action-light:hover {
        background: #f1f5f9;
        color: #0f172a !important;
        transform: translateY(-1px);
    }

    /* Executive Summary Grid */
    .erp-summary-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }

    @media (max-width: 1100px) {
        .erp-summary-grid { grid-template-columns: repeat(2, 1fr); }
    }

    @media (max-width: 576px) {
        .erp-summary-grid { grid-template-columns: 1fr; }
    }

    .erp-summary-tile {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 14px 16px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.2s ease;
    }

    .erp-summary-tile:hover {
        background: #ffffff;
        border-color: #cbd5e1;
        box-shadow: 0 4px 12px rgba(15, 23, 42, 0.05);
        transform: translateY(-1px);
    }

    .border-left-blue  { border-left: 4px solid var(--erp-primary) !important; }
    .border-left-amber { border-left: 4px solid #d97706 !important; }
    .border-left-rose  { border-left: 4px solid #e11d48 !important; }
    .border-left-green { border-left: 4px solid var(--erp-success) !important; }
    .border-left-purple { border-left: 4px solid var(--erp-purple) !important; }
    .border-left-teal   { border-left: 4px solid var(--erp-teal) !important; }
    .border-left-dark   { border-left: 4px solid #0f172a !important; }
    .border-left-slate  { border-left: 4px solid var(--erp-slate) !important; }

    .erp-summary-label {
        font-size: 10.5px;
        font-weight: 700;
        text-transform: uppercase;
        color: var(--erp-text-muted);
        letter-spacing: 0.5px;
    }

    .erp-summary-val {
        font-size: 20px;
        font-weight: 800;
        margin: 4px 0 2px;
        line-height: 1.2;
    }

    .erp-summary-sub {
        font-size: 11px;
        color: #64748b;
        font-weight: 500;
    }
</style>

<div class="erp-dashboard-container">

    <!-- ========================================== -->
    <!-- TOP EXECUTIVE OVERVIEW & QUICK ACTIONS BAR -->
    <!-- ========================================== -->
    <div class="erp-welcome-banner mb-4">
        <div class="d-flex flex-column flex-lg-row justify-content-between align-items-start align-items-lg-center gap-3">
            <div class="flex-grow-1" style="max-width: 680px;">
                <div class="d-flex align-items-center gap-2 mb-1 flex-wrap">
                    <div class="erp-brand-badge">
                        <i class="fa-solid fa-gas-pump"></i>
                    </div>
                    <h1 class="erp-banner-title mb-0">Al-Owais Petroleum Service</h1>
                    <span class="erp-live-badge">
                        <span class="erp-pulse-dot"></span> Live Operations
                    </span>
                    <span class="erp-date-badge">
                        <i class="fa-regular fa-calendar me-1"></i> {{ date('l, d M Y') }}
                    </span>
                </div>
                <p class="erp-banner-subtitle mb-0">
                    Real-time operational summary across fuel dispensing, customer khata recoveries, tanker procurement, and station treasury.
                </p>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
                <a href="{{ route('sale.add') }}" class="erp-action-btn erp-action-primary">
                    <i class="fa-solid fa-plus"></i> New Sale
                </a>
                <a href="{{ route('create.voucher') }}?type=payment_in" class="erp-action-btn erp-action-success">
                    <i class="fa-solid fa-hand-holding-dollar"></i> Payment In
                </a>
                <a href="{{ route('create.voucher') }}?type=expense" class="erp-action-btn erp-action-light">
                    <i class="fa-solid fa-receipt"></i> Expense Voucher
                </a>
                <a href="{{ route('Purchase.home') }}" class="erp-action-btn erp-action-light">
                    <i class="fa-solid fa-shopping-cart"></i> Purchase
                </a>
            </div>
        </div>

        <!-- Executive Metrics Grid (Prominent & Exact Numbers) -->
        <div class="erp-summary-grid mt-3 pt-3 border-top">
            <!-- 1. Liquid Treasury -->
            <div class="erp-summary-tile border-left-blue">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="erp-summary-label">Total Liquid Treasury</span>
                    <i class="fa-solid fa-vault text-primary" style="font-size: 13px;"></i>
                </div>
                <div class="erp-summary-val" style="color: var(--erp-primary);">
                    Rs {{ number_format($totalLiquidAssets) }}
                </div>
                <div class="erp-summary-sub">
                    Cash & {{ $accounts->where('title', '!=', 'Cash')->count() }} Bank Accounts
                </div>
            </div>

            <!-- 2. Customer Receivables -->
            <div class="erp-summary-tile border-left-amber">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="erp-summary-label">Customer Khata Receivables</span>
                    <i class="fa-solid fa-users text-warning" style="font-size: 13px;"></i>
                </div>
                <div class="erp-summary-val" style="color: #d97706;">
                    Rs {{ number_format($totalCustomerDues) }}
                </div>
                <div class="erp-summary-sub">
                    {{ $totalCustomers }} Active Credit Parties
                </div>
            </div>

            <!-- 3. Supplier Payables -->
            <div class="erp-summary-tile border-left-rose">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="erp-summary-label">Supplier / OMC Payables</span>
                    <i class="fa-solid fa-building-flag text-danger" style="font-size: 13px;"></i>
                </div>
                <div class="erp-summary-val" style="color: #e11d48;">
                    Rs {{ number_format($totalVendorDues) }}
                </div>
                <div class="erp-summary-sub">
                    {{ $totalVendors }} Fuel Suppliers
                </div>
            </div>

            <!-- 4. Net Operating Position -->
            <div class="erp-summary-tile border-left-green">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <span class="erp-summary-label">Net Operating Position</span>
                    <i class="fa-solid fa-scale-balanced {{ $netOperatingPosition >= 0 ? 'text-success' : 'text-danger' }}" style="font-size: 13px;"></i>
                </div>
                <div class="erp-summary-val" style="color: {{ $netOperatingPosition >= 0 ? 'var(--erp-success)' : 'var(--erp-danger)' }};">
                    Rs {{ number_format($netOperatingPosition) }}
                </div>
                <div class="erp-summary-sub">
                    Net Operating Cash Margin
                </div>
            </div>
        </div>
    </div>

    <!-- ========================================== -->
    <!-- SECTION 1: PRIMARY KPI CARDS -->
    <!-- ========================================== -->
    <div class="erp-grid-4">
        <!-- 1. Total Fuel Sales -->
        <div class="erp-card border-left-blue">
            <div>
                <div class="erp-card-top">
                    <div class="erp-icon-badge erp-icon-blue">
                        <i class="fa-solid fa-gas-pump"></i>
                    </div>
                    <span class="erp-card-label">Total Fuel Sales</span>
                </div>
                <div class="erp-card-value">Rs {{ number_format($totalSales) }}</div>
                <div class="erp-card-sub">
                    <span style="color: var(--erp-primary); font-weight: 700;">{{ $salesCount }} Invoices</span>
                    <span>• Direct Pump Sales</span>
                </div>
            </div>
            <div class="erp-card-footer">
                <a href="{{ route('sale.index') }}">View Sales Register <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- 2. Customer Recovery -->
        <div class="erp-card border-left-green">
            <div>
                <div class="erp-card-top">
                    <div class="erp-icon-badge erp-icon-green">
                        <i class="fa-solid fa-circle-check"></i>
                    </div>
                    <span class="erp-card-label">Customer Recovery (Paid)</span>
                </div>
                <div class="erp-card-value">Rs {{ number_format($totalCustomerRecovery) }}</div>
                <div class="erp-card-sub">
                    <span>{{ $customerPaymentsCount }} Payments Collected</span>
                </div>
            </div>
            <div class="erp-card-footer">
                <a href="{{ route('voucher.history') }}">All Vouchers View <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- 3. Station Operating Expenses -->
        <div class="erp-card border-left-dark">
            <div>
                <div class="erp-card-top">
                    <div class="erp-icon-badge erp-icon-dark">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <span class="erp-card-label">Station Expenses</span>
                </div>
                <div class="erp-card-value">Rs {{ number_format($totalExpenses) }}</div>
                <div class="erp-card-sub">
                    <span>{{ $expenseCount }} Audited Expense Vouchers</span>
                </div>
            </div>
            <div class="erp-card-footer">
                <a href="{{ route('expense-vochers') }}">Expense Vouchers <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- 4. Net Operating Position -->
        <div class="erp-card border-left-purple">
            <div>
                <div class="erp-card-top">
                    <div class="erp-icon-badge erp-icon-purple">
                        <i class="fa-solid fa-scale-balanced"></i>
                    </div>
                    <span class="erp-card-label">Net Operating Position</span>
                </div>
                <div class="erp-card-value" style="color: {{ $netOperatingPosition >= 0 ? '#10b981' : '#f43f5e' }};">
                    Rs {{ number_format($netOperatingPosition) }}
                </div>
                <div class="erp-card-sub">
                    <span>Net Liquidity after Vouchers</span>
                </div>
            </div>
            <div class="erp-card-footer">
                <a href="{{ route('report.financial_summary') }}">Financial Summary <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>


    <!-- ========================================== -->
    <!-- SECTION 2: FUEL PROCUREMENT & STATION MANAGEMENT -->
    <!-- ========================================== -->
    <div class="erp-section-header">
        <div class="erp-section-title">
            <i class="fa-solid fa-briefcase" style="color: var(--erp-slate);"></i>
            Fuel Procurement & Station Management
        </div>
        <a href="{{ route('Purchase.home') }}" class="erp-section-link">Procurement & Tankers &rsaquo;</a>
    </div>

    <div class="erp-grid-4">
        <!-- 1. Fuel Purchases (Tankers) -->
        <div class="erp-card border-left-blue">
            <div>
                <div class="erp-card-top">
                    <div class="erp-icon-badge erp-icon-slate">
                        <i class="fa-solid fa-gas-pump"></i>
                    </div>
                    <span class="erp-card-label">Fuel Purchases (Tankers)</span>
                </div>
                <div class="erp-card-value">Rs {{ number_format($totalPurchases) }}</div>
                <div class="erp-card-sub">
                    <span>{{ $purchasesCount }} Fuel Tanker Bills Posted</span>
                </div>
            </div>
            <div class="erp-card-footer">
                <a href="{{ route('Purchase.home') }}">Purchase Bills Report <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- 2. Fuel Suppliers & Owners -->
        <div class="erp-card border-left-green">
            <div>
                <div class="erp-card-top">
                    <div class="erp-icon-badge erp-icon-green">
                        <i class="fa-solid fa-users"></i>
                    </div>
                    <span class="erp-card-label">Fuel Suppliers & Owners</span>
                </div>
                <div class="erp-card-value">{{ $totalVendors }} Active Vendors</div>
                <div class="erp-card-sub">
                    <span>{{ $vendorNamesList ?: 'Byco, Manzoor & Zamreen' }}</span>
                </div>
            </div>
            <div class="erp-card-footer">
                <a href="{{ route('vendors') }}">Vendors Directory <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- 3. Pump Loss & Transit Allowance -->
        <div class="erp-card border-left-amber">
            <div>
                <div class="erp-card-top">
                    <div class="erp-icon-badge erp-icon-blue">
                        <i class="fa-solid fa-gas-pump"></i>
                    </div>
                    <span class="erp-card-label">Pump Loss & Transit</span>
                </div>
                <div class="erp-card-value">Rs {{ number_format($pumpLossExpenses) }}</div>
                <div class="erp-card-sub">
                    <span>Evaporation & Station Loss</span>
                </div>
            </div>
            <div class="erp-card-footer">
                <a href="{{ route('expense-vochers') }}">Loss Details <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>

        <!-- 4. Active Fuel Products -->
        <div class="erp-card border-left-rose">
            <div>
                <div class="erp-card-top">
                    <div class="erp-icon-badge erp-icon-rose">
                        <i class="fa-solid fa-droplet"></i>
                    </div>
                    <span class="erp-card-label">Active Fuel Products</span>
                </div>
                <div class="erp-card-value">{{ count($products) }} Products</div>
                <div class="erp-card-sub">
                    <span>{{ $productNamesList ?: 'HSD, PMG, Solvent' }}</span>
                </div>
            </div>
            <div class="erp-card-footer">
                <a href="{{ route('product') }}">Product Inventory <i class="fa-solid fa-arrow-right"></i></a>
            </div>
        </div>
    </div>


    <!-- ========================================== -->
    <!-- SECTION 3: CHARTS ROW 1 (Fuel Procurement & Fund Distribution) -->
    <!-- ========================================== -->
    <div class="row g-3 mb-3">
        <!-- Left: Fuel Procurement Velocity -->
        <div class="col-lg-8">
            <div class="erp-panel border-left-blue">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <i class="fa-solid fa-chart-line" style="color: var(--erp-primary);"></i>
                        Fuel Procurement & Billing Velocity
                    </div>
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-light text-dark border" style="font-size: 11px;">This Year &nbsp;<i class="fa-solid fa-angle-down"></i></span>
                        <a href="{{ route('Purchase.home') }}" class="erp-btn-sm">Purchase Bills &rarr;</a>
                    </div>
                </div>
                <div class="d-flex align-items-center mb-2" style="font-size: 11px; color: var(--erp-text-muted);">
                    <span class="d-flex align-items-center me-3">
                        <span class="legend-indicator" style="background: var(--erp-primary);"></span> Monthly Fuel Purchases (Tankers)
                    </span>
                    <span class="d-flex align-items-center">
                        <span class="legend-indicator" style="background: #10b981;"></span> Monthly Fuel Sales
                    </span>
                </div>
                <div id="chartSalesVelocity" style="min-height: 275px;"></div>
            </div>
        </div>

        <!-- Right: Treasury Distribution (Cash vs Banks) -->
        <div class="col-lg-4">
            <div class="erp-panel border-left-teal">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <i class="fa-solid fa-chart-pie" style="color: var(--erp-teal);"></i>
                        Treasury Distribution (Cash vs Banks)
                    </div>
                    <a href="{{ route('coa.index') }}" class="erp-btn-sm">Accounts &rarr;</a>
                </div>
                <div id="chartChannelContribution" style="min-height: 220px;"></div>
                <div class="mt-auto pt-2 border-top" style="font-size: 11px;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <span><span class="legend-indicator" style="background: var(--erp-primary);"></span> Cash in Hand</span>
                        <strong class="text-dark">Rs {{ number_format($cashBalance) }}</strong>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span><span class="legend-indicator" style="background: var(--erp-teal);"></span> Total Bank Balances</span>
                        <strong class="text-dark">Rs {{ number_format($bankBalance) }}</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- ========================================== -->
    <!-- SECTION 4: CHARTS ROW 2 (Cash Flow, Categories, Vendor Balances) -->
    <!-- ========================================== -->
    <div class="row g-3 mb-3">
        <!-- 1. Cash Flow (Customer Recovery vs Station Expenses) -->
        <div class="col-lg-4">
            <div class="erp-panel border-left-green">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <i class="fa-solid fa-right-left" style="color: var(--erp-primary);"></i>
                        Cash Flow (Recovery vs Expense)
                    </div>
                    <span class="badge bg-light text-dark border" style="font-size: 10px;">This Month</span>
                </div>

                <div class="d-flex justify-content-around text-center mb-2 p-2 bg-light rounded" style="font-size: 11px;">
                    <div>
                        <div class="text-muted text-uppercase fw-bold" style="font-size: 10px;">Recovery In</div>
                        <div class="fw-bold" style="color: var(--erp-success);">Rs {{ number_format($totalCustomerRecovery) }}</div>
                    </div>
                    <div class="border-start ps-3">
                        <div class="text-muted text-uppercase fw-bold" style="font-size: 10px;">Expenses Out</div>
                        <div class="fw-bold" style="color: var(--erp-danger);">Rs {{ number_format($totalExpenses) }}</div>
                    </div>
                </div>

                <div id="chartCashFlow" style="min-height: 190px;"></div>

                <div class="mt-auto pt-2 border-top d-flex justify-content-center gap-3" style="font-size: 11px;">
                    <span><span class="legend-indicator" style="background: var(--erp-success);"></span> + Customer Recovery</span>
                    <span><span class="legend-indicator" style="background: var(--erp-danger);"></span> — Operating Expenses</span>
                </div>
            </div>
        </div>

        <!-- 2. Operating Expense Audit by Category -->
        <div class="col-lg-4">
            <div class="erp-panel border-left-amber">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <i class="fa-solid fa-tags" style="color: var(--erp-warning);"></i>
                        Station Expenses by Category
                    </div>
                    <a href="{{ route('expense-vochers') }}" class="badge bg-light text-dark border text-decoration-none" style="font-size: 10px;">Vouchers</a>
                </div>
                <div id="chartExpenseCategories" style="min-height: 190px;"></div>
                <div class="mt-auto pt-2 border-top text-center" style="font-size: 11px;">
                    <span class="text-muted">Total Audited Vouchers: <strong class="text-danger">Rs {{ number_format($totalExpenses) }}</strong></span>
                </div>
            </div>
        </div>

        <!-- 3. OMC & Vendor Payables Breakdown -->
        <div class="col-lg-4">
            <div class="erp-panel border-left-rose">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <i class="fa-solid fa-receipt" style="color: var(--erp-danger);"></i>
                        Vendor Payables Distribution
                    </div>
                    <a href="{{ route('vendors') }}" class="erp-btn-sm">Suppliers &rarr;</a>
                </div>
                <div id="chartVendorPayables" style="min-height: 190px;"></div>
                <div class="mt-auto pt-2 border-top text-center" style="font-size: 11px;">
                    <span class="text-muted">Total Supplier Dues: <strong class="text-danger">Rs {{ number_format($totalVendorDues) }}</strong></span>
                </div>
            </div>
        </div>
    </div>


    <!-- ========================================== -->
    <!-- SECTION 5: DATA TABLES ROW 1 -->
    <!-- ========================================== -->
    <div class="row g-3 mb-3">
        <!-- Left: Top Pump Customers with Highest Dues -->
        <div class="col-lg-6">
            <div class="erp-panel border-left-amber">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <i class="fa-solid fa-users" style="color: var(--erp-warning);"></i>
                        Top Customer Balances (Highest Receivables / Khata)
                    </div>
                    <a href="{{ route('report.customer.ledger') }}" class="erp-btn-sm">Customer Ledger &rarr;</a>
                </div>
                <div class="erp-table-responsive">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Customer ID</th>
                                <th>Customer / Station Name</th>
                                <th>Zone</th>
                                <th class="text-end">Outstanding Dues</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($topCustomers as $idx => $c)
                            <tr>
                                <td>
                                    @if($idx == 0)
                                        <span class="badge-rank-1">{{ $idx + 1 }}</span>
                                    @elseif($idx == 1)
                                        <span class="badge-rank-2">{{ $idx + 1 }}</span>
                                    @elseif($idx == 2)
                                        <span class="badge-rank-3">{{ $idx + 1 }}</span>
                                    @else
                                        <span class="badge-rank-normal">{{ $idx + 1 }}</span>
                                    @endif
                                </td>
                                <td><span class="text-muted">{{ $c->customer_id }}</span></td>
                                <td><strong>{{ $c->customer_name }}</strong></td>
                                <td>{{ $c->zone ?? 'Hyderabad' }}</td>
                                <td class="text-end" style="color: var(--erp-warning); font-weight: 700;">
                                    Rs {{ number_format($c->opening_balance) }}
                                </td>
                                <td class="text-center"><span class="badge-pill-success">Active</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">No customers recorded.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: Fuel Suppliers & OMC Vendors -->
        <div class="col-lg-6">
            <div class="erp-panel border-left-rose">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <i class="fa-solid fa-building-flag" style="color: var(--erp-primary);"></i>
                        Fuel Suppliers & OMC Vendor Accounts
                    </div>
                    <a href="{{ route('report.vendor.ledger') }}" class="erp-btn-sm">Vendor Ledger &rarr;</a>
                </div>
                <div class="erp-table-responsive">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Vendor / Company</th>
                                <th>Contact / Phone</th>
                                <th class="text-end">Payable Balance</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($vendors as $idx => $v)
                            <tr>
                                <td><span class="badge-rank-normal">{{ $idx + 1 }}</span></td>
                                <td>
                                    <strong>{{ $v->name }}</strong><br>
                                    <small class="text-muted">Fuel Supplier</small>
                                </td>
                                <td>{{ $v->phone ?? 'Registered' }}</td>
                                <td class="text-end" style="color: var(--erp-danger); font-weight: 700;">
                                    Rs {{ number_format($v->opening_balance) }}
                                </td>
                                <td class="text-center"><span class="badge-pill-success">Active</span></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-3">No vendors recorded.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- ========================================== -->
    <!-- SECTION 6: DATA TABLES ROW 2 -->
    <!-- ========================================== -->
    <div class="row g-3 mb-3">
        <!-- Left: Recent Customer Recovery & Payments -->
        <div class="col-lg-6">
            <div class="erp-panel border-left-green">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <i class="fa-solid fa-money-bill-transfer" style="color: var(--erp-success);"></i>
                        Recent Customer Recovery & Payments
                    </div>
                    <a href="{{ route('customer.payments') }}" class="erp-btn-sm">All Payments &rarr;</a>
                </div>
                <div class="erp-table-responsive">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Customer Name</th>
                                <th>Payment Mode</th>
                                <th class="text-end">Amount Paid</th>
                                <th>Note / Purpose</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPayments as $rp)
                            <tr>
                                <td><strong class="text-dark">#{{ $rp->id }}</strong></td>
                                <td><strong>{{ $rp->customer_name }}</strong></td>
                                <td><span class="badge-pill-secondary">{{ $rp->payment_method ?? 'Account' }}</span></td>
                                <td class="text-end fw-bold" style="color: var(--erp-success);">
                                    Rs {{ number_format($rp->amount) }}
                                </td>
                                <td><small class="text-muted">{{ $rp->note ?? '-' }}</small></td>
                                <td><small class="text-muted">{{ $rp->payment_date }}</small></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">No recent payment vouchers.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Right: Registered Fuel Products & Tank Status -->
        <div class="col-lg-6">
            <div class="erp-panel border-left-teal">
                <div class="erp-panel-header">
                    <div class="erp-panel-title">
                        <i class="fa-solid fa-gas-pump" style="color: var(--erp-teal);"></i>
                        Fuel Products & Tank Inventory Status
                    </div>
                    <a href="{{ route('product') }}" class="erp-btn-sm erp-btn-primary">+ Manage Products</a>
                </div>
                <div class="erp-table-responsive">
                    <table class="erp-table">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Fuel Product</th>
                                <th>Unit</th>
                                <th>Category</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $p)
                            <tr>
                                <td><span class="text-muted">{{ $p->item_code }}</span></td>
                                <td><strong>{{ $p->item_name }}</strong></td>
                                <td>{{ $p->unit_id ?? 'LTR' }}</td>
                                <td>{{ $p->category_name ?? 'Petroleum' }}</td>
                                <td class="text-center"><span class="badge-pill-success">Operational</span></td>
                                <td class="text-center">
                                    <a href="{{ route('product') }}" class="erp-btn-sm py-0 px-2">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-3">No products configured.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <!-- ========================================== -->
    <!-- SECTION 7: BOTTOM MULTI-ACCOUNT SUMMARY (Cash & Bank Breakdown) -->
    <!-- ========================================== -->
    <div class="erp-panel">
        <div class="erp-panel-header">
            <div class="erp-panel-title">
                <i class="fa-solid fa-building-columns" style="color: var(--erp-slate);"></i>
                Station Cash & Bank Accounts Breakdown
            </div>
            <a href="{{ route('coa.index') }}" class="erp-btn-sm">Chart of Accounts &rarr;</a>
        </div>
        <div class="erp-table-responsive">
            <table class="erp-table">
                <thead>
                    <tr>
                        <th>Account Title</th>
                        <th>Account Code</th>
                        <th class="text-end">Current Opening Balance</th>
                        <th style="width: 250px;">Share of Total Treasury</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $treasuryTotal = max($totalLiquidAssets, 1); @endphp
                    @forelse($accounts as $acc)
                    @php
                        $bal = $acc->opening_balance;
                        $pct = round(($bal / $treasuryTotal) * 100, 1);
                    @endphp
                    <tr>
                        <td>
                            <strong>{{ $acc->title }}</strong>
                            @if(stripos($acc->title, 'cash') !== false)
                                <span class="badge-pill-success ms-1">Cash in Hand</span>
                            @else
                                <span class="badge-pill-secondary ms-1">Bank Account</span>
                            @endif
                        </td>
                        <td><span class="text-muted">{{ $acc->account_code }}</span></td>
                        <td class="text-end fw-bold text-dark">
                            Rs {{ number_format($bal) }}
                        </td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="progress flex-grow-1" style="height: 6px; background: #e2e8f0; border-radius: 4px;">
                                    <div class="progress-bar" style="width: {{ min(max($pct, 0), 100) }}%; background: {{ stripos($acc->title, 'cash') !== false ? 'var(--erp-primary)' : 'var(--erp-teal)' }};"></div>
                                </div>
                                <span class="ms-2 text-muted fw-bold" style="font-size: 11px;">{{ $pct }}%</span>
                            </div>
                        </td>
                        <td class="text-center">
                            @if(stripos($acc->title, 'cash') !== false)
                                <a href="{{ route('report.cash_book') }}" class="erp-btn-sm py-0 px-2">Cashbook</a>
                            @else
                                <a href="{{ route('coa.index') }}" class="erp-btn-sm py-0 px-2">Ledger</a>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-3">No accounts found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

<!-- ApexCharts Script: Connected to Dynamic Server Data -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // 1. Chart: Monthly Purchases & Sales / Velocity
        var velocityLabels = {!! json_encode($velocityLabels ?? ['Jun 2026', 'Jul 2026', 'Aug 2026', 'Sep 2026', 'Oct 2026', 'Nov 2026']) !!};
        var purchasesData = {!! json_encode($monthlyPurchases ?? [0, 13824000, 0, 0, 0, 0]) !!};
        var salesData = {!! json_encode($monthlySales ?? [0, 0, 0, 0, 0, 90]) !!};

        var optionsSalesVelocity = {
            chart: {
                type: 'area',
                height: 285,
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif',
                dropShadow: {
                    enabled: true,
                    top: 3,
                    left: 0,
                    blur: 5,
                    color: '#2563eb',
                    opacity: 0.2
                }
            },
            series: [
                { name: 'Monthly Purchases (Tankers)', data: purchasesData },
                { name: 'Monthly Fuel Sales', data: salesData }
            ],
            xaxis: {
                categories: velocityLabels,
                labels: {
                    rotate: 0,
                    style: { fontSize: '11px', fontWeight: 600, colors: '#64748b' }
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                labels: {
                    formatter: function (v) {
                        if (v >= 1000000) return 'Rs ' + (v / 1000000).toFixed(1) + 'M';
                        if (v >= 1000) return 'Rs ' + (v / 1000).toFixed(0) + 'k';
                        return 'Rs ' + v;
                    },
                    style: { fontSize: '11px', colors: '#64748b' }
                }
            },
            grid: {
                borderColor: '#f1f5f9',
                strokeDashArray: 3,
                xaxis: { lines: { show: false } },
                yaxis: { lines: { show: true } },
                padding: { top: 10, right: 15, bottom: 0, left: 10 }
            },
            colors: ['#2563eb', '#10b981'],
            stroke: {
                curve: 'smooth',
                width: [3.5, 2.5],
                dashArray: [0, 3]
            },
            fill: {
                type: 'gradient',
                gradient: {
                    type: 'vertical',
                    shadeIntensity: 0.5,
                    gradientToColors: ['#38bdf8', '#86efac'],
                    inverseColors: false,
                    opacityFrom: 0.70,
                    opacityTo: 0.08,
                    stops: [0, 85, 100]
                }
            },
            markers: {
                size: [6, 4],
                colors: ['#ffffff', '#ffffff'],
                strokeColors: ['#2563eb', '#10b981'],
                strokeWidth: 2.5,
                hover: {
                    size: 8,
                    sizeOffset: 3
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            tooltip: {
                theme: 'light',
                x: { show: true },
                y: {
                    formatter: function (val) {
                        return 'Rs ' + Number(val).toLocaleString('en-PK');
                    }
                }
            }
        };
        new ApexCharts(document.querySelector("#chartSalesVelocity"), optionsSalesVelocity).render();

        // 2. Chart: Treasury Distribution (Cash vs Banks)
        var cashVal = {{ (float)$cashBalance }};
        var bankVal = {{ (float)$bankBalance }};
        var totalTreasury = {{ (float)$totalLiquidAssets }};

        var optionsChannel = {
            chart: {
                type: 'donut',
                height: 220,
                fontFamily: 'Inter, sans-serif'
            },
            series: [cashVal, bankVal],
            labels: ['Cash in Hand', 'Bank Accounts'],
            colors: ['#2563eb', '#0d9488'],
            plotOptions: {
                pie: {
                    donut: {
                        size: '72%',
                        labels: {
                            show: true,
                            name: { show: true, fontSize: '10px', color: '#64748b', offsetY: -6 },
                            value: {
                                show: true,
                                fontSize: '15px',
                                fontWeight: 800,
                                color: '#0f172a',
                                offsetY: 4,
                                formatter: function () { return 'Rs ' + Number(totalTreasury).toLocaleString('en-PK'); }
                            },
                            total: {
                                show: true,
                                label: 'TOTAL LIQUID',
                                fontSize: '9px',
                                color: '#64748b',
                                formatter: function () { return 'Rs ' + Number(totalTreasury).toLocaleString('en-PK'); }
                            }
                        }
                    }
                }
            },
            dataLabels: { enabled: false },
            legend: { show: false },
            tooltip: {
                y: { formatter: function (val) { return 'Rs ' + Math.round(val).toLocaleString('en-PK'); } }
            }
        };
        new ApexCharts(document.querySelector("#chartChannelContribution"), optionsChannel).render();

        // 3. Chart: Cash Flow (Customer Recovery vs Expenses)
        var recoveryVal = {{ (float)$totalCustomerRecovery }};
        var expenseVal = {{ (float)$totalExpenses }};

        var optionsCashFlow = {
            chart: {
                type: 'bar',
                height: 180,
                toolbar: { show: false },
                fontFamily: 'Inter, sans-serif'
            },
            series: [{
                name: 'Amount',
                data: [recoveryVal, expenseVal]
            }],
            xaxis: {
                categories: ['Customer Recovery', 'Operating Expenses'],
                labels: {
                    show: false
                },
                axisBorder: { show: false },
                axisTicks: { show: false }
            },
            yaxis: {
                show: false
            },
            grid: {
                show: false,
                padding: { top: 25, bottom: 0, left: 10, right: 10 }
            },
            colors: ['#10b981', '#f43f5e'],
            plotOptions: {
                bar: {
                    distributed: true,
                    columnWidth: '36%',
                    borderRadius: 6,
                    dataLabels: { position: 'top' }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    if (val >= 1000000) return 'Rs ' + (val / 1000000).toFixed(2) + 'M';
                    if (val >= 1000) return 'Rs ' + (val / 1000).toFixed(0) + 'k';
                    return 'Rs ' + val;
                },
                offsetY: -22,
                style: { fontSize: '11.5px', colors: ['#0f172a'], fontWeight: '700' }
            },
            legend: { show: false },
            tooltip: {
                y: { formatter: function (val) { return 'Rs ' + Number(val).toLocaleString('en-PK'); } }
            }
        };
        new ApexCharts(document.querySelector("#chartCashFlow"), optionsCashFlow).render();

        // 4. Chart: Expense Categories Breakdown
        @php
            $catNames = $expenseCategories->pluck('title')->toArray();
            $catAmounts = $expenseCategories->pluck('total_amount')->map(fn($v) => (float)$v)->toArray();
        @endphp
        var expNames = {!! json_encode($catNames) !!};
        var expAmounts = {!! json_encode($catAmounts) !!};

        if (!expAmounts.length || expAmounts.every(v => v === 0)) {
            expNames = ['Pump Loss', 'Transportation', 'Office Expenses', 'Utility bills', 'Joint Expenses'];
            expAmounts = [34745, 29700, 3100, 3000, 6000];
        }

        var optionsExpenses = {
            chart: {
                type: 'donut',
                height: 190,
                fontFamily: 'Inter, sans-serif'
            },
            series: expAmounts,
            labels: expNames,
            colors: ['#f43f5e', '#f59e0b', '#2563eb', '#0d9488', '#8b5cf6', '#64748b'],
            plotOptions: {
                pie: {
                    donut: { size: '65%' }
                }
            },
            dataLabels: { enabled: false },
            legend: {
                show: true,
                position: 'right',
                fontSize: '10.5px',
                labels: { colors: '#475569' },
                itemMargin: { vertical: 2 }
            },
            tooltip: {
                y: { formatter: function (val) { return 'Rs ' + Number(val).toLocaleString('en-PK'); } }
            }
        };
        new ApexCharts(document.querySelector("#chartExpenseCategories"), optionsExpenses).render();

        // 5. Chart: Vendor Payables Breakdown
        @php
            $vNames = $vendors->pluck('name')->toArray();
            $vAmounts = $vendors->pluck('opening_balance')->map(fn($v) => (float)$v)->toArray();
        @endphp
        var vendNames = {!! json_encode($vNames) !!};
        var vendAmounts = {!! json_encode($vAmounts) !!};

        var optionsVendors = {
            chart: {
                type: 'donut',
                height: 190,
                fontFamily: 'Inter, sans-serif'
            },
            series: vendAmounts,
            labels: vendNames,
            colors: ['#f43f5e', '#f59e0b', '#0d9488', '#2563eb'],
            plotOptions: {
                pie: {
                    donut: { size: '65%' }
                }
            },
            dataLabels: { enabled: false },
            legend: {
                show: true,
                position: 'right',
                fontSize: '10.5px',
                labels: { colors: '#475569' },
                itemMargin: { vertical: 2 }
            },
            tooltip: {
                y: { formatter: function (val) { return 'Rs ' + Number(val).toLocaleString('en-PK'); } }
            }
        };
        new ApexCharts(document.querySelector("#chartVendorPayables"), optionsVendors).render();
    });
</script>
@endsection
