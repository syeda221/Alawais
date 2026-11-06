@extends('admin_panel.layout.app')
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <style>
        /* ===== BASE ===== */
        body {
            padding-bottom: 180px;
            background: #f0f2f5;
        }

        /* ===== TOP HEADER CARD ===== */
        .sale-header-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            margin-bottom: 18px;
        }

        .sale-header-bar {
            background: linear-gradient(135deg, #1e3a5f 0%, #2d5f8a 100%);
            padding: 14px 24px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .sale-header-bar i {
            font-size: 22px;
            color: #fff;
            opacity: 0.85;
        }

        .sale-header-bar h5 {
            margin: 0;
            color: #fff;
            font-weight: 700;
            font-size: 17px;
            letter-spacing: 0.3px;
        }

        .sale-header-bar .header-date {
            margin-left: auto;
            color: rgba(255,255,255,0.7);
            font-size: 13px;
            font-weight: 500;
        }

        .sale-header-body {
            padding: 18px 24px;
        }

        .field-group label {
            font-size: 11.5px;
            font-weight: 700;
            color: #5a6a85;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }

        .field-group .form-control,
        .field-group .form-select {
            border-radius: 8px;
            border: 1.5px solid #dfe3ea;
            font-size: 14px;
            padding: 8px 12px;
            transition: border-color 0.2s, box-shadow 0.2s;
            background: #fbfcfd;
        }

        .field-group .form-control:focus,
        .field-group .form-select:focus {
            border-color: #2d5f8a;
            box-shadow: 0 0 0 3px rgba(45, 95, 138, 0.1);
            background: #fff;
        }

        /* Select2 styling overrides */
        .select2-container {
            width: 100% !important;
        }

        .select2-container--default .select2-selection--single {
            border-radius: 8px !important;
            border: 1.5px solid #dfe3ea !important;
            height: 38px !important;
            padding: 4px 8px;
            background: #fbfcfd !important;
            display: flex;
            align-items: center;
        }

        .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px !important;
            font-size: 14px;
            color: #333;
        }

        .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 36px !important;
        }

        .select2-container--open .select2-selection--single {
            border-color: #2d5f8a !important;
            box-shadow: 0 0 0 3px rgba(45, 95, 138, 0.1) !important;
        }

        .select2-dropdown {
            border-radius: 8px !important;
            border: 1.5px solid #2d5f8a !important;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15) !important;
            z-index: 99999 !important;
        }

        .select2-results__options {
            max-height: 200px !important;
        }

        .select2-results__option--highlighted[aria-selected] {
            background: #2d5f8a !important;
        }

        /* ===== CUSTOMER BALANCE INFO BAR ===== */
        .customer-balance-bar {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            border-radius: 12px;
            padding: 12px 20px;
            display: none;
            align-items: center;
            gap: 0;
            box-shadow: 0 4px 16px rgba(15, 52, 96, 0.25);
            animation: slideDown 0.3s ease;
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-8px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .customer-balance-bar.show {
            display: flex;
        }

        .balance-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 18px;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
        }

        .balance-item:first-child {
            padding-left: 0;
        }

        .balance-item:last-child {
            border-right: none;
            padding-right: 0;
        }

        .balance-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #8899b0;
            margin-bottom: 2px;
        }

        .balance-value {
            font-size: 17px;
            font-weight: 900;
            color: #fff;
        }

        .balance-value.warning { color: #fbbf24; }
        .balance-value.danger { color: #f87171; }
        .balance-value.success { color: #34d399; }

        .cust-name-display {
            font-size: 13px;
            font-weight: 700;
            color: #e2e8f0;
        }

        .bal-loading {
            display: none;
            color: #8899b0;
            font-size: 12px;
            margin-top: 4px;
        }

        /* ===== PRODUCT SEARCH ===== */
        .product-search-wrapper {
            position: relative;
        }

        .product-dropdown {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            z-index: 9999;
            max-height: 280px;
            overflow-y: auto;
            background: #fff;
            border: 1px solid #e2e6ed;
            border-top: none;
            border-radius: 0 0 10px 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            display: none;
        }

        .product-dropdown::-webkit-scrollbar {
            width: 5px;
        }

        .product-dropdown::-webkit-scrollbar-thumb {
            background: #c5cdd8;
            border-radius: 10px;
        }

        .product-dropdown-item {
            padding: 10px 14px;
            cursor: pointer;
            border-bottom: 1px solid #f5f5f5;
            transition: all 0.15s;
        }

        .product-dropdown-item:hover,
        .product-dropdown-item.active {
            background: linear-gradient(135deg, #2d5f8a, #1e3a5f);
            color: #fff;
        }

        .product-dropdown-item:last-child {
            border-bottom: none;
        }

        .product-dropdown-item .product-name {
            font-weight: 600;
            font-size: 13.5px;
        }

        .product-dropdown-item .product-meta {
            font-size: 11.5px;
            opacity: 0.7;
        }

        .product-dropdown-item:hover .product-meta,
        .product-dropdown-item.active .product-meta {
            opacity: 1;
        }

        /* ===== PRODUCTS TABLE ===== */
        .products-card {
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 16px rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .products-card .table {
            margin-bottom: 0;
        }

        .products-card .table thead th {
            background: linear-gradient(135deg, #f8fafc 0%, #eef2f7 100%);
            font-weight: 700;
            font-size: 11.5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: #5a6a85;
            vertical-align: middle;
            text-align: center;
            padding: 12px 8px;
            border-bottom: 2px solid #e2e6ed;
            border-top: none;
        }

        .products-card .table tbody tr {
            transition: background 0.15s;
        }

        .products-card .table tbody tr:nth-child(even) {
            background: #fafbfd;
        }

        .products-card .table tbody tr:hover {
            background: #f0f5ff;
        }

        .products-card .table tbody td {
            vertical-align: middle;
            padding: 6px 6px;
            border-color: #eef1f5;
        }

        .products-card .table tbody input.form-control {
            border-radius: 6px;
            border: 1.5px solid #e2e6ed;
            font-size: 13px;
            font-weight: 500;
            padding: 6px 8px;
            text-align: center;
            background: #fff;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .products-card .table tbody input.form-control:focus {
            border-color: #2d5f8a;
            box-shadow: 0 0 0 2px rgba(45, 95, 138, 0.1);
        }

        .products-card .table tbody input.form-control[readonly] {
            background: #f8f9fb;
            border-color: transparent;
            color: #555;
        }

        .products-card .table tbody .productSearch {
            text-align: left;
            font-weight: 600;
            color: #1e3a5f;
        }

        .products-card .table tbody .productSearch.bg-light {
            background: #eef5ff !important;
            border-color: #bdd4ee !important;
        }

        .product-col {
            width: 25% !important;
            min-width: 250px;
        }

        .btn-remove-row {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: none;
            background: #fee2e2;
            color: #dc2626;
            font-size: 13px;
            transition: all 0.2s;
        }

        .btn-remove-row:hover {
            background: #dc2626;
            color: #fff;
            transform: scale(1.1);
        }

        /* ===== FIXED SUMMARY BAR ===== */
        .fixed-summary-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            z-index: 9999;
            background: #fff;
            box-shadow: 0 -6px 30px rgba(0, 0, 0, 0.1);
            border-top: none;
            padding: 0 !important;
        }

        .summary-top-row {
            background: linear-gradient(135deg, #f8fafc 0%, #eef2f7 100%);
            border-bottom: 1.5px solid #e2e6ed;
        }

        .summary-section {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 6px 10px;
            border-right: 1.5px solid #e2e6ed;
            min-width: 0;
        }

        .summary-section:last-child {
            border-right: none;
        }

        .summary-section .sum-label {
            font-size: 9.5px;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #8899b0;
            margin-bottom: 3px;
            white-space: nowrap;
        }

        .summary-section input.form-control {
            border-radius: 6px;
            font-size: 14px !important;
            font-weight: 700;
            text-align: center;
            padding: 4px 6px !important;
            height: 32px !important;
            border: 1.5px solid #dfe3ea;
            background: #fff;
        }

        .summary-section input.form-control:focus {
            border-color: #2d5f8a;
            box-shadow: 0 0 0 2px rgba(45, 95, 138, 0.12);
        }

        .summary-section input.form-control[readonly] {
            background: #f5f7fa;
            border-color: transparent;
            color: #333;
        }

        /* Special highlight inputs */
        .sum-net input {
            background: #eff8ff !important;
            color: #1e3a5f !important;
            font-size: 15px !important;
            font-weight: 900 !important;
            border-color: #bdd4ee !important;
        }

        .sum-prevbal input {
            background: #fffbeb !important;
            color: #92400e !important;
            font-weight: 800 !important;
            border-color: #fcd34d !important;
        }

        .sum-closing input {
            background: #fef2f2 !important;
            color: #b91c1c !important;
            font-size: 15px !important;
            font-weight: 900 !important;
            border-color: #fca5a5 !important;
        }

        .sum-change input {
            background: #ecfdf5 !important;
            color: #059669 !important;
            font-size: 16px !important;
            font-weight: 900 !important;
            border-color: #6ee7b7 !important;
        }

        .big-change-input {
            font-size: 16px !important;
            font-weight: 900 !important;
        }

        /* Payment section */
        #paymentAccountsContainer,
        #paymentAmountsContainer {
            max-height: 80px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        #paymentAccountsContainer::-webkit-scrollbar,
        #paymentAmountsContainer::-webkit-scrollbar {
            width: 0;
            display: none;
        }

        .payment-row {
            margin-bottom: 3px !important;
        }

        .payment-row .pay-account-select {
            font-size: 12px !important;
            height: 28px !important;
            padding: 0 6px !important;
            border-radius: 6px;
        }

        .payment-row .pay-amount-input {
            font-size: 13px !important;
            font-weight: 700;
            height: 28px !important;
            padding: 0 8px !important;
            border-radius: 6px;
        }

        .payment-row .remove-payment-row {
            height: 28px !important;
            font-size: 12px !important;
            padding: 0 8px !important;
            line-height: 1;
            border-radius: 6px;
        }

        #totalPaidLabel {
            font-size: 10.5px;
            display: block;
            margin-top: 2px;
            color: #64748b;
        }

        #addPaymentRowBtn {
            font-size: 10px !important;
            padding: 1px 6px !important;
            height: 20px !important;
            line-height: 1;
            vertical-align: middle;
            border-radius: 5px;
        }

        /* Summary bottom row: words + buttons */
        .summary-bottom-row {
            padding: 8px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border-top: 1.5px solid #e8ecf1;
            background: #fff;
        }

        .amount-words-block {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12.5px;
            color: #64748b;
        }

        .amount-words-block .words-label {
            font-weight: 700;
            color: #5a6a85;
            white-space: nowrap;
        }

        .amount-words-block #amountWordsText {
            font-style: italic;
            color: #94a3b8;
        }

        .total-units-badge {
            background: linear-gradient(135deg, #ecfdf5, #d1fae5);
            border: 1.5px solid #6ee7b7;
            border-radius: 10px;
            padding: 5px 16px;
            font-size: 13px;
            font-weight: 800;
            color: #065f46;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .total-units-badge span {
            font-size: 17px;
            font-weight: 900;
            color: #059669;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 8px;
            align-items: center;
        }

        .btn-book {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 8px 24px;
            font-weight: 700;
            font-size: 14px;
            transition: all 0.2s;
            box-shadow: 0 3px 10px rgba(217, 119, 6, 0.3);
        }

        .btn-book:hover {
            transform: translateY(-1px);
            box-shadow: 0 5px 16px rgba(217, 119, 6, 0.4);
            color: #fff;
            background: linear-gradient(135deg, #d97706, #b45309);
        }

        .btn-sale {
            background: linear-gradient(135deg, #10b981, #059669);
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 40px;
            font-weight: 800;
            font-size: 18px;
            transition: all 0.2s;
            box-shadow: 0 4px 14px rgba(5, 150, 105, 0.35);
            letter-spacing: 0.3px;
        }

        .btn-sale:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(5, 150, 105, 0.45);
            color: #fff;
            background: linear-gradient(135deg, #059669, #047857);
        }

        .btn-close-sale {
            background: #f1f5f9;
            color: #64748b;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s;
            text-decoration: none;
        }

        .btn-close-sale:hover {
            background: #e2e8f0;
            color: #475569;
            border-color: #cbd5e1;
        }

        /* ===== ROW HIGHLIGHT ON SCAN ===== */
        .qty-highlight {
            background-color: #ecfdf5 !important;
            animation: flashRow 0.8s ease-out;
        }

        @keyframes flashRow {
            from { background-color: #a7f3d0; }
            to { background-color: transparent; }
        }

        .qty-pulse {
            animation: pulseQty 0.6s ease-out;
        }

        @keyframes pulseQty {
            0% { box-shadow: 0 0 0 0 rgba(16, 185, 129, 0.8); }
            100% { box-shadow: 0 0 0 10px rgba(16, 185, 129, 0); }
        }

        /* ===== BRAND FILTER BADGES ===== */
        .brand-filter-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
            align-items: center;
            padding: 4px 0;
        }

        .brand-badge {
            cursor: pointer;
            border-radius: 20px;
            padding: 4px 14px;
            font-size: 11.5px;
            font-weight: 600;
            border: 1.5px solid #dfe3ea;
            background: #fff;
            color: #5a6a85;
            transition: all 0.18s;
            user-select: none;
        }

        .brand-badge:hover,
        .brand-badge.active {
            background: #2d5f8a;
            border-color: #2d5f8a;
            color: #fff;
        }

        .brand-badge.all-badge.active {
            background: #10b981;
            border-color: #10b981;
            color: #fff;
        }

        /* ===== LABOUR INPUT HIGHLIGHT ===== */
        .labour-input {
            background: #fffbeb !important;
            border-color: #fbbf24 !important;
            font-weight: 700 !important;
        }

        /* ===== CLOSING BAL BOX ===== */
        .closing-bal-box {
            background: #fff3cd;
            border-radius: 6px;
            padding: 2px 8px;
            font-weight: 800;
            font-size: 13px;
            color: #856404;
        }

        /* Invoice summary table (kept for layout compat) */
        .invoice-summary-table {
            table-layout: fixed;
            width: 100%;
            white-space: nowrap;
        }

        .invoice-summary-table th,
        .invoice-summary-table td {
            padding: 3px !important;
            font-size: 11px !important;
            text-align: center;
            vertical-align: middle;
        }

        /* Sale btn legacy class */
        .sale-btn {
            /* handled by .btn-sale now */
        }

        .total-pieces-box {
            font-size: 18px;
            font-weight: 800;
        }

        .total-pieces-box span {
            font-size: 20px;
            font-weight: 900;
            color: #10b981;
            margin-left: 6px;
        }

        /* ===== MODALS ===== */
        .modal-content {
            border-radius: 14px;
            overflow: hidden;
            border: none;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        .modal-header-custom {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: #fff;
            padding: 16px 20px;
        }

        .modal-header-custom .modal-title {
            font-weight: 700;
            font-size: 16px;
        }

        /* Alerts styling */
        .sale-alert {
            border-radius: 10px;
            border: none;
            font-weight: 500;
            font-size: 13.5px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1200px) {
            .summary-section {
                padding: 4px 6px;
            }
        }

        @media (max-width: 768px) {
            .sale-header-body {
                padding: 14px 16px;
            }

            .customer-balance-bar {
                flex-wrap: wrap;
                gap: 8px;
            }

            .balance-item {
                padding: 4px 10px;
            }
        }
    </style>

    <div class="container-fluid px-3 px-lg-4">

        {{-- Session alerts --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show sale-alert mt-2" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show sale-alert mt-2" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form id="salesForm" action="{{ route('sales.store') }}" method="POST">
            @csrf

            {{-- ===== HEADER CARD ===== --}}
            <div class="sale-header-card">
                <div class="sale-header-bar">
                    <i class="fas fa-gas-pump"></i>
                    <h5>New Sale</h5>
                    <span class="header-date"><i class="far fa-calendar-alt me-1"></i>{{ now()->format('D, d M Y') }}</span>
                </div>
                <div class="sale-header-body">
                    <div class="row g-3 align-items-end">
                        <div class="col-lg-3 col-md-4 field-group">
                            <label><i class="fas fa-user me-1"></i>Customer</label>
                            <select name="customer" id="customerSelect" class="form-control" required>
                                <option value="Walk-in Customer">Walk-in Customer</option>
                                @foreach ($Customer as $c)
                                    <option value="{{ $c->id }}">
                                        {{ $c->customer_name }}{{ !empty($c->customer_id) ? ' [' . $c->customer_id . ']' : '' }}{{ !empty($c->mobile) ? ' - ' . $c->mobile : '' }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="bal-loading" id="balLoading"><i class="fas fa-spinner fa-spin"></i> Loading...</span>
                        </div>
                        <div class="col-lg-2 col-md-3 field-group">
                            <label><i class="far fa-calendar me-1"></i>Date</label>
                            <input type="date" name="created_at" class="form-control" value="{{ now()->toDateString() }}">
                        </div>
                        <div class="col-lg-3 col-md-4 field-group">
                            <label><i class="fas fa-comment-dots me-1"></i>Remarks (Optional)</label>
                            <textarea name="remarks" class="form-control" rows="1" placeholder="Enter remarks..." style="resize:none;"></textarea>
                        </div>
                    </div>

                    {{-- Customer Balance Bar --}}
                    <div class="customer-balance-bar mt-3" id="customerBalanceBar">
                        <div class="balance-item">
                            <span class="balance-label"><i class="fas fa-user-circle me-1"></i>Customer</span>
                            <span class="cust-name-display" id="custNameDisplay">-</span>
                        </div>
                        <div class="balance-item">
                            <span class="balance-label"><i class="fas fa-history me-1"></i>Previous Balance</span>
                            <span class="balance-value warning" id="prevBalDisplay">Rs 0</span>
                        </div>
                        <div class="balance-item">
                            <span class="balance-label"><i class="fas fa-receipt me-1"></i>Current Bill</span>
                            <span class="balance-value" id="currentBillDisplay">Rs 0</span>
                        </div>
                        <div class="balance-item">
                            <span class="balance-label"><i class="fas fa-hand-holding-usd me-1"></i>Paid Now</span>
                            <span class="balance-value success" id="paidNowDisplay">Rs 0</span>
                        </div>
                        <div class="balance-item">
                            <span class="balance-label"><i class="fas fa-balance-scale me-1"></i>Closing Balance</span>
                            <span class="balance-value danger" id="closingBalDisplay">Rs 0</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Hidden fields --}}
            <input type="hidden" name="advance_payment" id="advance_payment" value="0">
            <input type="hidden" name="reference" value="">

            {{-- ===== PRODUCTS TABLE ===== --}}
            <div class="products-card">
                <div class="d-flex justify-content-between align-items-center p-3 border-bottom bg-light">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary px-3 py-2" style="font-size:13px;"><i class="fas fa-boxes me-1"></i> Product Items</span>
                        <small class="text-muted d-none d-md-inline">Type product name or scan barcode to add items</small>
                    </div>
                    <button type="button" class="btn btn-sm btn-primary px-3 fw-bold shadow-sm" id="btnAddNewRow">
                        <i class="fas fa-plus me-1"></i> Add Item Row
                    </button>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-sm align-middle text-center">
                        <thead>
                            <tr>
                                <th class="product-col text-start" style="padding-left:16px;">
                                    <i class="fas fa-search me-1" style="opacity:0.5;"></i>Product (Type to search)
                                </th>
                                <th>Code</th>
                                <th style="display:none;">Brand</th>
                                <th>Unit</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th style="width:80px;">Qty</th>
                                <th>Total</th>
                                <th style="width:50px;"></th>
                            </tr>
                        </thead>
                        <tbody id="purchaseItems">
                            <tr>
                                <td class="product-col">
                                    <div class="product-search-wrapper">
                                        <input type="hidden" name="product_id[]" class="product_id">
                                        <input type="text" class="form-control productSearch"
                                            placeholder="Type product name..." autocomplete="off">
                                        <div class="product-dropdown"></div>
                                    </div>
                                </td>
                                <td><input type="text" name="item_code[]" class="form-control form-control-sm" readonly></td>
                                <td style="display:none;"><input type="text" name="uom[]" class="form-control form-control-sm" readonly></td>
                                <td><input type="text" name="unit[]" class="form-control form-control-sm" readonly></td>
                                <td><input type="number" step="0.01" name="price[]" class="form-control form-control-sm price"></td>
                                <td><input type="text" name="item_disc[]" class="form-control form-control-sm item_disc" placeholder="0"></td>
                                <td><input type="number" name="qty[]" class="form-control form-control-sm quantity" min="0.01" step="0.01"></td>
                                <td><input type="text" name="total[]" class="form-control form-control-sm row-total" readonly></td>
                                <td><button type="button" class="btn-remove-row remove-row"><i class="fas fa-times"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- ===== FIXED SUMMARY BAR ===== --}}
            <div class="fixed-summary-bar">
                {{-- Summary values row --}}
                <div class="d-flex summary-top-row">
                    {{-- Bill --}}
                    <div class="summary-section" style="flex:1;">
                        <span class="sum-label"><i class="fas fa-file-invoice-dollar me-1"></i>Bill</span>
                        <input type="text" id="billAmount" name="total_subtotal" class="form-control" readonly>
                    </div>
                    {{-- Item Disc --}}
                    <div class="summary-section" style="flex:1;">
                        <span class="sum-label"><i class="fas fa-tags me-1"></i>Item Disc</span>
                        <input type="text" id="itemDiscount" name="total_discount" class="form-control" readonly>
                    </div>
                    {{-- Extra Disc --}}
                    <div class="summary-section" style="flex:1;">
                        <span class="sum-label"><i class="fas fa-percentage me-1"></i>Ex. Disc</span>
                        <input type="number" id="extraDiscount" name="total_extra_cost" class="form-control" value="0">
                    </div>
                    {{-- Labour --}}
                    <div class="summary-section" style="flex:1;">
                        <span class="sum-label"><i class="fas fa-tools me-1"></i>Labour</span>
                        <input type="number" id="labourCharges" name="labour_charges" class="form-control labour-input" value="0" min="0" step="0.01" placeholder="0">
                    </div>
                    {{-- Net Amount --}}
                    <div class="summary-section sum-net" style="flex:1.1;">
                        <span class="sum-label"><i class="fas fa-calculator me-1"></i>Net Amount</span>
                        <input type="text" id="netAmount" name="total_net" class="form-control" readonly>
                    </div>
                    {{-- Prev Balance --}}
                    <div class="summary-section sum-prevbal" style="flex:1;">
                        <span class="sum-label"><i class="fas fa-history me-1"></i>Prev Bal</span>
                        <input type="text" id="prevBalBar" class="form-control" readonly>
                    </div>
                    {{-- Closing --}}
                    <div class="summary-section sum-closing" style="flex:1;">
                        <span class="sum-label"><i class="fas fa-balance-scale me-1"></i>Closing</span>
                        <input type="text" id="closingBalBar" class="form-control" readonly>
                    </div>
                    {{-- Account --}}
                    <div class="summary-section" style="flex:1.3;">
                        <span class="sum-label"><i class="fas fa-university me-1"></i>Account</span>
                        <div id="paymentAccountsContainer" class="w-100">
                            <div class="payment-row mb-1" data-row="0">
                                <select name="pay_account_id[]" class="form-select form-select-sm pay-account-select w-100">
                                    @foreach ($accounts as $account)
                                        <option value="{{ $account->id }}" {{ str_contains(strtolower($account->title), 'cash') ? 'selected' : '' }}>
                                            {{ $account->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    {{-- Amount --}}
                    <div class="summary-section" style="flex:1.3;">
                        <span class="sum-label"><i class="fas fa-money-bill-wave me-1"></i>Amount
                            <button type="button" id="addPaymentRowBtn" class="btn btn-success btn-sm ms-1 d-inline-flex align-items-center justify-content-center" style="height:20px; width:22px; padding:0; border-radius:4px;" title="Add another account"><i class="fas fa-plus" style="font-size:10px;"></i></button>
                        </span>
                        <div id="paymentAmountsContainer" class="w-100">
                            <div class="payment-row d-flex gap-1 mb-1 align-items-center" data-row="0">
                                <input type="number" name="pay_amount[]" class="form-control form-control-sm pay-amount-input text-center w-100" placeholder="0" value="0" min="0" step="0.01">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-payment-row d-inline-flex align-items-center justify-content-center" style="height:28px; width:28px; border-radius:6px; flex-shrink:0; display:none;" title="Remove"><i class="fas fa-times" style="font-size:12px;"></i></button>
                            </div>
                        </div>
                        <input type="hidden" id="cash" name="cash" value="0">
                        <input type="hidden" id="card" name="card" value="0">
                        <small class="text-muted d-block mt-1" id="totalPaidLabel">Total Paid: <strong>Rs 0</strong></small>
                    </div>
                    {{-- Change --}}
                    <div class="summary-section sum-change" style="flex:1;">
                        <span class="sum-label"><i class="fas fa-coins me-1"></i>Change</span>
                        <input type="text" id="change" name="change" class="form-control big-change-input" readonly>
                    </div>
                </div>

                {{-- Bottom row: words + buttons --}}
                <div class="summary-bottom-row">
                    <div class="amount-words-block">
                        <span class="words-label"><i class="fas fa-spell-check me-1"></i>Amount in Words:</span>
                        <span id="amountWordsText"></span>
                        <input type="hidden" name="total_amount_Words" id="amountWordsInput">
                        <input type="hidden" name="total_items" id="totalItemsInput">
                        <input type="hidden" name="total_pieces" value="0">
                        <input type="hidden" name="total_yard" value="0">
                        <input type="hidden" name="total_meter" value="0">
                    </div>

                    <div class="total-units-badge">
                        <i class="fas fa-cubes"></i> TOTAL UNITS: <span id="totalUnits">0</span>
                    </div>

                    <div class="action-buttons">
                        {{-- Book button commented out as requested --}}
                        {{-- <button type="submit" name="action" value="booking" class="btn-book">
                            <i class="fas fa-bookmark me-1"></i>Book
                        </button> --}}
                        <button type="submit" name="action" value="sale" class="btn-sale sale-btn">
                            <i class="fas fa-cash-register me-1"></i>Sale
                        </button>
                        <a href="{{ route('sale.index') }}" class="btn-close-sale">
                            <i class="fas fa-times me-1"></i>Close
                        </a>
                    </div>
                </div>
            </div>

        </form>
    </div>

    <!-- Booking Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title"><i class="fas fa-bookmark me-2"></i>Booking - Advance Payment</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3 field-group">
                        <label class="form-label">Net Amount</label>
                        <input type="text" id="modalNetAmount" class="form-control" readonly>
                    </div>
                    <div class="mb-2 field-group">
                        <label class="form-label">Advance Payment</label>
                        <input type="number" step="0.01" id="modalAdvance" class="form-control" min="0" value="0">
                    </div>
                </div>
                <div class="modal-footer border-0 pt-0">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal" data-dismiss="modal">Cancel</button>
                    <button type="button" id="confirmBookingBtn" class="btn-book">
                        <i class="fas fa-check me-1"></i>Confirm Booking
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Customer Ledger Modal -->
    <div class="modal fade" id="customerLedgerModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header modal-header-custom">
                    <h5 class="modal-title"><i class="fas fa-book me-2"></i>Customer Ledger</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-0">
                    <div id="ledgerModalContent" class="p-4 text-center text-muted">
                        <i class="fas fa-user-circle fa-2x mb-2 d-block" style="opacity:0.3;"></i>
                        Select a customer to view ledger.
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        // ===== CACHED PRODUCTS - LOAD ONCE ON PAGE LOAD =====
        let allProducts = [];
        let productsLoaded = false;
        let activeBrandFilter = 'all';
        let customerPreviousBalance = 0;

        // Load all products once on page load for instant search
        function loadAllProducts() {
            $.get("{{ route('search-product-name') }}", { q: '' }, function (res) {
                allProducts = res;
                productsLoaded = true;
                console.log('✅ Products loaded:', allProducts.length);
            });
        }

        // Quick local search from cached products with brand filter
        function searchProducts(query) {
            if (!query || query.length < 1) return [];
            const q = query.toLowerCase();

            return allProducts.filter(p => {
                const matchesQuery = (p.item_name && p.item_name.toLowerCase().includes(q)) ||
                    (p.item_code && p.item_code.toLowerCase().includes(q)) ||
                    (p.brand && p.brand.toLowerCase().includes(q));

                // apply brand filter
                if (activeBrandFilter !== 'all') {
                    return matchesQuery && p.brand && p.brand.toLowerCase() === activeBrandFilter;
                }
                return matchesQuery;
            }).slice(0, 15);
        }

        // ===== HELPER FUNCTIONS =====
        function num(n) {
            return isNaN(parseFloat(n)) ? 0 : parseFloat(n);
        }

        
        function formatRs(val) {
            return 'Rs ' + parseFloat(val || 0).toLocaleString('en-PK', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
        }

        function formatDrCrRs(val) {
            let num = parseFloat(val || 0);
            let absVal = Math.abs(num);
            let str = 'Rs ' + absVal.toLocaleString('en-PK', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
            let suffix = num > 0 ? ' Dr' : (num < 0 ? ' Cr' : '');
            return str + suffix;
        }

        function formatDrCrNum(val) {
            let num = parseFloat(val || 0);
            let absVal = Math.abs(num);
            let str = absVal.toFixed(2);
            let suffix = num > 0 ? ' Dr' : (num < 0 ? ' Cr' : '');
            return str + suffix;
        }

        function numberToWords(num) {
            const a = ["", "One", "Two", "Three", "Four", "Five", "Six", "Seven", "Eight", "Nine",
                "Ten", "Eleven", "Twelve", "Thirteen", "Fourteen", "Fifteen", "Sixteen", "Seventeen",
                "Eighteen", "Nineteen"];
            const b = ["", "", "Twenty", "Thirty", "Forty", "Fifty", "Sixty", "Seventy", "Eighty", "Ninety"];

            if (!num || isNaN(num)) return '';
            num = Math.floor(num);
            if (num > 999999999) return "Overflow";

            const n = ("000000000" + num).slice(-9).match(/^(\d{2})(\d{2})(\d{2})(\d{3})$/);
            if (!n) return '';

            let str = "";
            str += n[1] != 0 ? (a[n[1]] || b[n[1][0]] + " " + a[n[1][1]]) + " Crore " : "";
            str += n[2] != 0 ? (a[n[2]] || b[n[2][0]] + " " + a[n[2][1]]) + " Lakh " : "";
            str += n[3] != 0 ? (a[n[3]] || b[n[3][0]] + " " + a[n[3][1]]) + " Thousand " : "";
            str += n[4] != 0 ? (a[n[4]] || b[n[4][0]] + " " + a[n[4][1]]) : "";

            return str.trim() + " Rupees Only";
        }

        function recalcRow($row) {
            const qty = num($row.find('.quantity').val());
            const price = num($row.find('.price').val());

            let discRaw = ($row.find('.item_disc').val() || '').toString().trim();
            let totalDiscount = 0;

            if (discRaw.endsWith('%')) {
                const percent = parseFloat(discRaw);
                if (!isNaN(percent)) totalDiscount = (price * percent / 100) * qty;
            } else {
                const perQtyDisc = parseFloat(discRaw);
                if (!isNaN(perQtyDisc)) totalDiscount = perQtyDisc * qty;
            }

            let total = (qty * price) - totalDiscount;
            if (total < 0) total = 0;

            $row.find('.row-total').val(total.toFixed(2));
            $row.data('row-discount', totalDiscount);
        }

        function recalcSummary() {
            let billAmount = 0, itemDiscount = 0;
            let totalUnits = 0;

            $('#purchaseItems tr').each(function () {
                const qty = num($(this).find('.quantity').val());
                totalUnits += qty;
                billAmount += num($(this).find('.row-total').val());
                itemDiscount += num($(this).data('row-discount'));
            });

            const extraDiscount = num($('#extraDiscount').val());
            const labourCharges = num($('#labourCharges').val());
            // Sum all payment rows
            let paid = 0;
            $('.pay-amount-input').each(function () { paid += num($(this).val()); });
            const net = billAmount - extraDiscount + labourCharges;
            const change = paid - net;
            const closingBal = customerPreviousBalance + net - paid;
            // Sync hidden cash field for controller
            $('#cash').val(paid.toFixed(2));

            $('#billAmount').val(billAmount.toFixed(2));
            $('#itemDiscount').val(itemDiscount.toFixed(2));
            $('#netAmount').val(net.toFixed(2));
            $('#change').val(change.toFixed(2));

            // Update summary bar ledger columns
            $('#prevBalBar').val(customerPreviousBalance === 0 ? "0.00" : formatDrCrNum(customerPreviousBalance));
            $('#closingBalBar').val(closingBal === 0 ? "0.00" : formatDrCrNum(closingBal));

            // Update top balance panel (if visible)
            $('#currentBillDisplay').text(formatRs(net));
            $('#paidNowDisplay').text(formatRs(paid));
            $('#closingBalDisplay').text(closingBal === 0 ? "Rs 0" : formatDrCrRs(closingBal));
            if (closingBal > 0) {
                $('#closingBalDisplay').removeClass('success warning').addClass('danger');
            } else if (closingBal < 0) {
                $('#closingBalDisplay').removeClass('danger warning').addClass('success');
            } else {
                $('#closingBalDisplay').removeClass('danger success').addClass('warning');
            }

            $('#totalUnits').text(totalUnits);
            $('#totalItemsInput').val(totalUnits);

            const words = numberToWords(Math.round(net));
            $('#amountWordsText').text(words);
            $('#amountWordsInput').val(words);
        }

        // ===== LOAD CUSTOMER BALANCE =====
        function loadCustomerBalance(customerId) {
            if (!customerId || customerId === 'Walk-in Customer') {
                customerPreviousBalance = 0;
                $('#customerBalanceBar').removeClass('show');
                recalcSummary();
                return;
            }

            $('#balLoading').show();
            $.get('/sale/customer-balance/' + customerId, function (data) {
                customerPreviousBalance = parseFloat(data.closing_balance || 0);
                const custName = $('#customerSelect option:selected').text();
                $('#custNameDisplay').text(custName);
                $('#prevBalDisplay').text(customerPreviousBalance === 0 ? "Rs 0" : formatDrCrRs(customerPreviousBalance));
                if (customerPreviousBalance > 0) {
                    $('#prevBalDisplay').removeClass('success warning').addClass('danger');
                } else {
                    $('#prevBalDisplay').removeClass('danger warning').addClass('success');
                }
                $('#customerBalanceBar').addClass('show');
                recalcSummary();
                $('#balLoading').hide();
            }).fail(function () {
                customerPreviousBalance = 0;
                $('#customerBalanceBar').removeClass('show');
                recalcSummary();
                $('#balLoading').hide();
            });
        }

        // ===== NEW ROW =====
        function appendBlankRow() {
            const newRow = `
        <tr>
            <td class="product-col">
                <div class="product-search-wrapper">
                    <input type="hidden" name="product_id[]" class="product_id">
                    <input type="text" class="form-control productSearch" placeholder="Type product name..." autocomplete="off">
                    <div class="product-dropdown"></div>
                </div>
            </td>
            <td><input type="text" name="item_code[]" class="form-control form-control-sm" readonly></td>
            <td style="display:none;"><input type="text" name="uom[]" class="form-control form-control-sm" readonly></td>
            <td><input type="text" name="unit[]" class="form-control form-control-sm" readonly></td>
            <td><input type="number" step="0.01" name="price[]" class="form-control form-control-sm price"></td>
            <td><input type="text" name="item_disc[]" class="form-control form-control-sm item_disc" placeholder="0"></td>
            <td><input type="number" name="qty[]" class="form-control form-control-sm quantity" min="0.01" step="0.01"></td>
            <td><input type="text" name="total[]" class="form-control form-control-sm row-total" readonly></td>
            <td><button type="button" class="btn-remove-row remove-row"><i class="fas fa-times"></i></button></td>
        </tr>`;
            $('#purchaseItems').append(newRow);
            setTimeout(() => { $('#purchaseItems tr:last .productSearch').focus(); }, 10);
        }

        // ===== DOCUMENT READY =====
        $(document).ready(function () {
            // Load products on page load
            loadAllProducts();

            // Initialize Select2 on customer dropdown
            $('#customerSelect').select2({
                placeholder: 'Search customer...',
                allowClear: false,
                width: '100%'
            });

            // Focus first product search
            setTimeout(() => { $('.productSearch:first').focus(); }, 300);

            // ===== CUSTOMER SELECT CHANGE =====
            $('#customerSelect').on('change', function () {
                const val = $(this).val();
                loadCustomerBalance(val);
            });

            // ===== BRAND FILTER =====
            $(document).on('click', '.brand-badge', function () {
                $('.brand-badge').removeClass('active');
                $(this).addClass('active');
                activeBrandFilter = $(this).data('brand');
            });

            // ===== ADD ITEM ROW BUTTON =====
            $('#btnAddNewRow').on('click', function () {
                appendBlankRow();
            });

            // ===== RENDER PRODUCT DROPDOWN ITEMS =====
            function renderDropdownItems($input, $dropdown, results) {
                if (!results || results.length === 0) {
                    positionDropdown($input, $dropdown);
                    $dropdown.html('<div class="product-dropdown-item text-muted py-2 px-3"><i class="fas fa-info-circle me-1"></i>No matching products found</div>').show();
                    return;
                }

                let html = '';
                results.forEach((p, index) => {
                    const priceVal = parseFloat(p.price || 0);
                    const priceDisplay = p.has_discount
                        ? `<span style="text-decoration:line-through; font-size:11px; opacity:0.7;">Rs ${p.original_price}</span> <span class="text-danger fw-bold ms-1">Rs ${priceVal.toFixed(2)}</span>`
                        : `<span class="fw-bold">Rs ${priceVal.toFixed(2)}</span>`;

                    const brandText = p.brand ? (typeof p.brand === 'object' ? (p.brand.name || '') : p.brand) : '';

                    html += `
                    <div class="product-dropdown-item ${index === 0 ? 'active' : ''}"
                         data-id="${p.id}"
                         data-name="${p.item_name || ''}"
                         data-code="${p.item_code || ''}"
                         data-price="${priceVal}"
                         data-unit="${p.unit_id || ''}"
                         data-brand="${brandText}"
                         data-note="${p.note || ''}">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="product-name">${p.item_name || ''}</span>
                            <span class="product-price ms-2">${priceDisplay}</span>
                        </div>
                        <div class="product-meta mt-1 d-flex gap-1 align-items-center flex-wrap">
                            <span class="badge bg-light text-secondary border font-monospace">${p.item_code || 'CODE'}</span>
                            ${p.unit_id ? `<span class="badge bg-light text-muted border">${p.unit_id}</span>` : ''}
                            ${brandText ? `<span class="badge bg-light text-primary border">${brandText}</span>` : ''}
                        </div>
                    </div>`;
                });

                positionDropdown($input, $dropdown);
                $dropdown.html(html).show();
            }

            // ===== INSTANT & AJAX PRODUCT SEARCH =====
            let searchTimeout = null;
            $(document).on('input', '.productSearch', function () {
                const $input = $(this);
                const $dropdown = $input.siblings('.product-dropdown');
                const query = $input.val().trim();
                const $row = $input.closest('tr');

                // Already selected? Don't search
                if ($row.find('.product_id').val()) return;

                if (query.length < 1) {
                    $dropdown.hide().empty();
                    return;
                }

                // Check local cached results first for instant display
                const localResults = searchProducts(query);
                if (localResults.length > 0) {
                    renderDropdownItems($input, $dropdown, localResults);
                }

                // Debounced AJAX search for latest/uncached products
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function () {
                    $.get("{{ route('search-product-name') }}", { q: query }, function (res) {
                        if (res && res.length > 0) {
                            renderDropdownItems($input, $dropdown, res);
                        } else if (localResults.length === 0) {
                            renderDropdownItems($input, $dropdown, []);
                        }
                    });
                }, 180);
            });

            // Helper to position dropdown fixed
            function positionDropdown($input, $dropdown) {
                const rect = $input[0].getBoundingClientRect();
                $dropdown.css({
                    'position': 'fixed',
                    'top': (rect.bottom) + 'px',
                    'left': rect.left + 'px',
                    'width': rect.width + 'px',
                    'z-index': 999999,
                    'max-height': '300px',
                    'display': 'block'
                });
            }

            // Auto-close any open dropdown on window scroll so it never floats or overlaps
            $(window).on('scroll', function () {
                if ($('#customerSelect').hasClass('select2-hidden-accessible')) {
                    $('#customerSelect').select2('close');
                }
                $('.product-dropdown').hide().empty();
            });

            $(window).on('resize', function () {
                $('.product-dropdown:visible').each(function () {
                    const $input = $(this).siblings('.productSearch');
                    if ($input.length) positionDropdown($input, $(this));
                });
            });

            // ===== SELECT PRODUCT FROM DROPDOWN =====
            $(document).on('mousedown', '.product-dropdown-item', function () {
                const $item = $(this);
                const $row = $item.closest('tr');
                const $dropdown = $item.closest('.product-dropdown');

                // Fill row data
                $row.find('.product_id').val($item.data('id'));
                $row.find('.productSearch').val($item.data('name')).prop('readonly', true).addClass('bg-light');
                $row.find('[name="item_code[]"]').val($item.data('code'));
                $row.find('[name="uom[]"]').val($item.data('brand'));
                $row.find('[name="unit[]"]').val($item.data('unit'));
                $row.find('.price').val($item.data('price'));
                $row.find('.quantity').val(1);
                $row.find('.item_disc').val(0);

                recalcRow($row);
                recalcSummary();

                $dropdown.hide().empty();
                $row.find('.quantity').focus().select();
            });

            // ===== KEYBOARD NAVIGATION =====
            $(document).on('keydown', '.productSearch', function (e) {
                const $dropdown = $(this).siblings('.product-dropdown');
                const $items = $dropdown.find('.product-dropdown-item');

                if (!$items.length) return;

                let $active = $items.filter('.active');
                let index = $items.index($active);

                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    index = (index + 1) % $items.length;
                    $items.removeClass('active').eq(index).addClass('active');
                    $items.eq(index)[0].scrollIntoView({ block: 'nearest' });
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    index = (index - 1 + $items.length) % $items.length;
                    $items.removeClass('active').eq(index).addClass('active');
                    $items.eq(index)[0].scrollIntoView({ block: 'nearest' });
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    if ($active.length) $active.trigger('mousedown');
                } else if (e.key === 'Escape') {
                    $dropdown.hide().empty();
                }
            });

            // Hide dropdown on blur
            $(document).on('blur', '.productSearch', function () {
                setTimeout(() => { $(this).siblings('.product-dropdown').hide(); }, 200);
            });

            // ===== QUANTITY ENTER -> NEW ROW =====
            $(document).on('keydown', '.quantity', function (e) {
                if (e.key !== 'Enter') return;
                e.preventDefault();

                const $row = $(this).closest('tr');
                if (!$row.find('.product_id').val()) {
                    alert('Please select a product first');
                    return;
                }

                // Check if empty row exists
                let emptyRow = $('#purchaseItems tr').filter(function () {
                    return !$(this).find('.product_id').val();
                }).first();

                if (emptyRow.length) {
                    emptyRow.find('.productSearch').focus();
                } else {
                    appendBlankRow();
                }
            });

            // ===== ROW CALCULATIONS =====
            $(document).on('input', '.quantity, .price, .item_disc, #extraDiscount, #labourCharges', function () {
                const $row = $(this).closest('tr');
                if ($row.length && $row.find('.quantity').length) recalcRow($row);
                recalcSummary();
            });

            // ===== ADD PAYMENT ROW =====
            const accountOptions = `@foreach($accounts as $account)<option value="{{ $account->id }}">{{ $account->title }}</option>@endforeach`;
            let paymentRowId = 1;

            // Sync scroll
            $('#paymentAccountsContainer').on('scroll', function () { $('#paymentAmountsContainer').scrollTop($(this).scrollTop()); });
            $('#paymentAmountsContainer').on('scroll', function () { $('#paymentAccountsContainer').scrollTop($(this).scrollTop()); });

            $('#addPaymentRowBtn').on('click', function () {
                const rowId = paymentRowId++;
                const accRow = `
            <div class="payment-row mb-1" data-row="${rowId}">
                <select name="pay_account_id[]" class="form-select form-select-sm pay-account-select w-100">${accountOptions}</select>
            </div>`;
                const amtRow = `
            <div class="payment-row d-flex gap-1 mb-1 align-items-center" data-row="${rowId}">
                <input type="number" name="pay_amount[]" class="form-control form-control-sm pay-amount-input text-center w-100" placeholder="0" value="0" min="0" step="0.01">
                <button type="button" class="btn btn-outline-danger btn-sm remove-payment-row d-inline-flex align-items-center justify-content-center" style="height:28px; width:28px; border-radius:6px; flex-shrink:0;" title="Remove"><i class="fas fa-times"></i></button>
            </div>`;
                $('#paymentAccountsContainer').append(accRow);
                $('#paymentAmountsContainer').append(amtRow);

                // Show all remove buttons when > 1 row
                updateRemoveBtnVisibility();
                recalcSummary();
            });

            // ===== REMOVE PAYMENT ROW =====
            $(document).on('click', '.remove-payment-row', function () {
                if ($('#paymentAmountsContainer .payment-row').length > 1) {
                    const rowId = $(this).closest('.payment-row').data('row');
                    $('#paymentAccountsContainer .payment-row[data-row="' + rowId + '"]').remove();
                    $('#paymentAmountsContainer .payment-row[data-row="' + rowId + '"]').remove();
                    updateRemoveBtnVisibility();
                    recalcSummary();
                }
            });

            // ===== PAYMENT AMOUNT INPUT =====
            $(document).on('input', '.pay-amount-input', function () {
                recalcSummary();
            });

            function updateRemoveBtnVisibility() {
                const rows = $('#paymentAmountsContainer .payment-row');
                if (rows.length <= 1) {
                    rows.find('.remove-payment-row').hide();
                } else {
                    rows.find('.remove-payment-row').show();
                }
            }

            // Update totalPaidLabel whenever recalcSummary is called
            const origRecalc = recalcSummary;
            recalcSummary = function () {
                origRecalc();
                let paid = 0;
                $('.pay-amount-input').each(function () { paid += num($(this).val()); });
                $('#totalPaidLabel strong').text('Rs ' + paid.toLocaleString('en-PK', { minimumFractionDigits: 0, maximumFractionDigits: 2 }));
            };

            // ===== REMOVE ROW =====
            $(document).on('click', '.remove-row', function () {
                const $tbody = $('#purchaseItems');
                if ($tbody.find('tr').length > 1) {
                    $(this).closest('tr').remove();
                    recalcSummary();
                } else {
                    const $row = $(this).closest('tr');
                    $row.find('input, textarea').val('');
                    $row.find('.product_id').val('');
                    $row.find('.productSearch').prop('readonly', false).removeClass('bg-light').focus();
                    recalcSummary();
                }
            });

            // Initial calculation
            recalcRow($('#purchaseItems tr:first'));
            recalcSummary();

            // ===== BOOKING MODAL =====
            $(document).on('click', 'button[name="action"][value="booking"]', function (e) {
                e.preventDefault();
                const bill = parseFloat($('#billAmount').val()) || 0;
                const extra = parseFloat($('#extraDiscount').val()) || 0;
                const labour = parseFloat($('#labourCharges').val()) || 0;
                const net = bill - extra + labour;
                $('#modalNetAmount').val(net.toFixed(2));
                $('#modalAdvance').val(0);
                if (typeof $.fn.modal === 'function') {
                    $('#bookingModal').modal('show');
                } else if (window.bootstrap && bootstrap.Modal) {
                    var bookingModal = bootstrap.Modal.getOrCreateInstance ? 
                        bootstrap.Modal.getOrCreateInstance(document.getElementById('bookingModal')) : 
                        new bootstrap.Modal(document.getElementById('bookingModal'));
                    bookingModal.show();
                }
            });

            // Explicit close handler for Booking Modal
            $(document).on('click', '#bookingModal [data-dismiss="modal"], #bookingModal [data-bs-dismiss="modal"], #bookingModal .btn-close', function () {
                $('#bookingModal').modal('hide');
                try {
                    if (window.bootstrap && bootstrap.Modal) {
                        var inst = bootstrap.Modal.getInstance ? bootstrap.Modal.getInstance(document.getElementById('bookingModal')) : null;
                        if (inst && inst.hide) inst.hide();
                    }
                } catch (err) {}
            
            });

            $('#confirmBookingBtn').on('click', function () {
                const net = parseFloat($('#modalNetAmount').val()) || 0;
                let advance = parseFloat($('#modalAdvance').val()) || 0;

                if (advance < 0) { alert('Advance cannot be negative'); return; }
                if (advance > net && !confirm('Advance is more than Net amount. Continue?')) return;

                $('#advance_payment').val(advance.toFixed(2));

                const $form = $('#salesForm');
                if ($form.find('input[name="action"]').length === 0) {
                    $('<input>').attr({ type: 'hidden', name: 'action', value: 'booking' }).appendTo($form);
                } else {
                    $form.find('input[name="action"]').val('booking');
                }
                $form.submit();
            });

            // ===== BARCODE SCANNER SUPPORT =====
            let scanBuffer = '';
            let scanTimer = null;

            $(document).on('keydown', function (e) {
                if ($(e.target).is('input, textarea, select')) return;

                if (e.key === 'Enter') {
                    e.preventDefault();
                    if (scanBuffer.length >= 5) {
                        handleBarcode(scanBuffer);
                    }
                    scanBuffer = '';
                    return;
                }

                if (e.key.length === 1) scanBuffer += e.key;

                clearTimeout(scanTimer);
                scanTimer = setTimeout(() => { scanBuffer = ''; }, 120);
            });

            function handleBarcode(barcode) {
                $.get("{{ route('search-product-by-barcode') }}", { barcode }, function (res) {
                    if (!res || !res.id) { alert('Product not found!'); return; }

                    // Check if product already exists
                    let foundRow = null;
                    $('#purchaseItems tr').each(function () {
                        if (parseInt($(this).find('.product_id').val()) === parseInt(res.id)) {
                            foundRow = $(this);
                            return false;
                        }
                    });

                    if (foundRow) {
                        const qtyInput = foundRow.find('.quantity');
                        qtyInput.val((parseInt(qtyInput.val()) || 0) + 1);
                        recalcRow(foundRow);
                        recalcSummary();
                        foundRow.addClass('qty-highlight');
                        qtyInput.addClass('qty-pulse');
                        setTimeout(() => { foundRow.removeClass('qty-highlight'); qtyInput.removeClass('qty-pulse'); }, 1000);
                        return;
                    }

                    // Find empty row or create new
                    let $row = $('#purchaseItems tr').filter(function () { return !$(this).find('.product_id').val(); }).first();
                    if (!$row.length) { appendBlankRow(); $row = $('#purchaseItems tr:last'); }

                    $row.find('.productSearch').val(res.name).prop('readonly', true).addClass('bg-light');
                    $row.find('.product_id').val(res.id);
                    $row.find('[name="item_code[]"]').val(res.code);
                    $row.find('[name="uom[]"]').val(res.uom);
                    $row.find('[name="unit[]"]').val(res.unit);
                    $row.find('.price').val(res.price);
                    $row.find('.quantity').val(1);
                    $row.find('.item_disc').val(0);

                    recalcRow($row);
                    recalcSummary();
                    $row.find('.quantity').focus();
                    appendBlankRow();
                });
            }

            // ===== FORM SUBMISSION VALIDATION =====
            $('#salesForm').on('submit', function (e) {
                // Auto-heal empty numbers so they never fail database null constraints
                if ($('#extraDiscount').val().trim() === '') $('#extraDiscount').val(0);
                if ($('#labourCharges').val().trim() === '') $('#labourCharges').val(0);
                if ($('#cash').val().trim() === '') $('#cash').val(0);
                if ($('#card').val().trim() === '') $('#card').val(0);
                $('#purchaseItems tr').each(function () {
                    const $disc = $(this).find('input[name="item_disc[]"]');
                    if ($disc.length && $disc.val().trim() === '') $disc.val(0);
                });
                recalcSummary();

                // Get the active action (clicked button or hidden input)
                let action = $(document.activeElement).val();
                if (!action) action = $('input[name="action"]').val();

                const customer = $('#customerSelect').val();

                // Validate at least one valid product row
                let validRows = 0;
                let rowError = '';
                $('#purchaseItems tr').each(function (idx) {
                    const pid = $(this).find('input[name="product_id[]"]').val();
                    const qty = parseFloat($(this).find('input[name="qty[]"]').val()) || 0;
                    const price = parseFloat($(this).find('input[name="price[]"]').val()) || 0;
                    if (pid) {
                        if (qty <= 0) { rowError = 'Row #' + (idx + 1) + ' quantity must be greater than 0.'; return false; }
                        if (price <= 0) { rowError = 'Row #' + (idx + 1) + ' price must be greater than 0.'; return false; }
                        validRows++;
                    }
                });

                if (rowError) {
                    e.preventDefault();
                    if (typeof showAlert === 'function') { showAlert('Validation Error', rowError, 'warning'); }
                    else { alert(rowError); }
                    return false;
                }

                if (validRows === 0) {
                    e.preventDefault();
                    if (typeof showAlert === 'function') { showAlert('Validation Error', 'Please add at least one product with quantity and price.', 'warning'); }
                    else { alert('Please add at least one product with quantity and price.'); }
                    return false;
                }

                if (action === 'sale' && customer === 'Walk-in Customer') {
                    const net = parseFloat($('#netAmount').val()) || 0;
                    const cash = parseFloat($('#cash').val()) || 0;
                    const card = parseFloat($('#card').val()) || 0;
                    const paid = cash + card;

                    if (paid < net - 0.01) { // 0.01 margin for float errors
                        e.preventDefault();
                        if (typeof showAlert === 'function') {
                            showAlert('Full Payment Required', 'For Walk-in Customer, full payment is required!\nNet Amount: Rs ' + net.toFixed(2) + '\nPaid Amount: Rs ' + paid.toFixed(2), 'warning');
                        } else {
                            alert('For Walk-in Customer, full payment is required!\nNet Amount: Rs ' + net.toFixed(2) + '\nPaid Amount: Rs ' + paid.toFixed(2));
                        }
                        $('#cash').focus().select();
                        return false;
                    }
                }
            });

            // ===== CTRL+S = SALE =====
            document.addEventListener('keydown', function (e) {
                if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 's') {
                    e.preventDefault();
                    const form = document.getElementById('salesForm');
                    if (!form) return;

                    let actionInput = form.querySelector('input[name="action"]');
                    if (!actionInput) {
                        actionInput = document.createElement('input');
                        actionInput.type = 'hidden';
                        actionInput.name = 'action';
                        form.appendChild(actionInput);
                    }
                    actionInput.value = 'sale';

                    // Trigger submit event manually to catch the validation
                    $(form).submit();
                }
            });
        });
    </script>
@endsection
