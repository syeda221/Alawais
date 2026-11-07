@extends('admin_panel.layout.app')
@section('content')

<style>
    /* ===== PAGE BASE & STATS ===== */
    .sales-kpi-card {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #eef2f7;
        padding: 10px 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        display: flex;
        align-items: center;
        gap: 12px;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .sales-kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
    }
    .kpi-icon-box {
        width: 42px;
        height: 42px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .kpi-icon-green { background: #ecfdf5; color: #059669; }
    .kpi-icon-blue  { background: #eff6ff; color: #2563eb; }
    .kpi-icon-amber { background: #fffbeb; color: #d97706; }
    .kpi-icon-purple{ background: #f5f3ff; color: #7c3aed; }

    .kpi-title {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #64748b;
        margin-bottom: 1px;
    }
    .kpi-value {
        font-size: 18px;
        font-weight: 800;
        color: #0f172a;
        line-height: 1.2;
    }
    .kpi-sub {
        font-size: 10.5px;
        color: #94a3b8;
        margin-top: 1px;
    }

    /* ===== FILTER CARD ===== */
    .filter-card {
        background: #fff;
        border-radius: 10px;
        border: 1px solid #eef2f7;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        padding: 12px 16px;
        margin-bottom: 14px;
    }
    .filter-card .form-label {
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #5a6a85;
        margin-bottom: 3px;
    }
    .filter-card .form-control,
    .filter-card .form-select {
        border-radius: 7px;
        border: 1.5px solid #dfe3ea;
        font-size: 13px;
        padding: 5px 10px;
        background: #fbfcfd;
        transition: all 0.2s;
    }
    .filter-card .form-control:focus,
    .filter-card .form-select:focus {
        border-color: #1e3a5f;
        box-shadow: 0 0 0 3px rgba(30, 58, 95, 0.1);
        background: #fff;
    }

    /* ===== MAIN CARD & TABLE ===== */
    .main-sales-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #eef2f7;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.04);
        overflow: visible;
    }
    .main-sales-card .card-header {
        background: #fff;
        border-bottom: 1px solid #edf2f7;
        padding: 10px 18px;
    }

    .table-responsive {
        overflow-x: auto;
        overflow-y: visible !important;
        min-height: 280px;
        padding-bottom: 70px;
    }

    .sales-table {
        font-size: 13px;
        margin-bottom: 0 !important;
        width: 100% !important;
    }
    
    /* Table Header styling - solid navy background so it never disappears */
    .sales-table thead th,
    table.dataTable thead th,
    table.dataTable thead td {
        background-color: #1e3a5f !important;
        background: #1e3a5f !important;
        background-image: none !important;
        color: #ffffff !important;
        font-weight: 700 !important;
        text-transform: uppercase;
        font-size: 11px !important;
        letter-spacing: 0.5px;
        border: none !important;
        padding: 10px 12px !important;
        vertical-align: middle;
        text-align: center;
    }
    
    table.dataTable thead .sorting:before,
    table.dataTable thead .sorting_asc:before,
    table.dataTable thead .sorting_desc:before,
    table.dataTable thead .sorting:after,
    table.dataTable thead .sorting_asc:after,
    table.dataTable thead .sorting_desc:after {
        color: #ffffff !important;
        opacity: 0.75 !important;
    }

    .sales-table tbody td {
        padding: 10px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }
    .sales-table tbody tr:hover {
        background-color: #f8fafc;
    }

    /* Product Item Tags */
    .sale-product-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        background: #f1f5f9;
        border: 1px solid #e2e8f0;
        border-radius: 6px;
        padding: 2px 7px;
        font-size: 11px;
        font-weight: 600;
        color: #334155;
        margin: 1px 0;
    }
    .sale-product-pill .badge-qty {
        color: #059669;
        font-weight: 800;
    }

    /* Status Badge */
    .status-badge {
        padding: 3px 8px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 20px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .status-completed {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    .status-returned {
        background: #fef2f2;
        color: #dc2626;
        border: 1px solid #fecaca;
    }

    /* Action Dropdown */
    .action-dropdown {
        position: relative !important;
        display: inline-block !important;
    }
    .action-dropdown .dropdown-toggle {
        background: #fff;
        color: #334155;
        border: 1.5px solid #cbd5e1;
        padding: 4px 12px;
        font-size: 12px;
        font-weight: 600;
        border-radius: 7px;
        transition: all 0.2s;
        cursor: pointer;
        white-space: nowrap;
    }
    .action-dropdown .dropdown-toggle:hover {
        background: #f8fafc;
        border-color: #94a3b8;
    }
    .action-dropdown .dropdown-menu {
        position: absolute !important;
        top: 100% !important;
        bottom: auto !important;
        right: 0 !important;
        left: auto !important;
        width: 175px !important;
        min-width: 175px !important;
        max-width: 175px !important;
        border-radius: 8px !important;
        border: 1px solid #e2e8f0 !important;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12) !important;
        padding: 5px 0 !important;
        z-index: 1060 !important;
        margin-top: 4px !important;
        transform: none !important;
    }
    .action-dropdown .dropdown-menu.show {
        display: block !important;
        opacity: 1 !important;
        visibility: visible !important;
    }
    .action-dropdown .dropdown-item {
        font-size: 12px;
        padding: 7px 14px;
        display: flex;
        align-items: center;
        gap: 8px;
        color: #334155;
        font-weight: 500;
        text-align: left;
    }
    .action-dropdown .dropdown-item i {
        width: 16px;
        text-align: center;
    }
    .action-dropdown .dropdown-item:hover {
        background: #f1f5f9;
        color: #0f172a;
    }

    /* Header Buttons */
    .btn-new-sale {
        background: linear-gradient(135deg, #10b981, #059669);
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 700;
        padding: 7px 16px;
        box-shadow: 0 3px 10px rgba(5, 150, 105, 0.25);
        transition: all 0.2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        font-size: 13px;
    }
    .btn-new-sale:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 14px rgba(5, 150, 105, 0.35);
        color: #fff;
    }
</style>

<div class="container-fluid px-3 px-lg-4 mt-3">

    {{-- Top Heading & Actions --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <div>
            <h4 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                <i class="fas fa-shopping-cart text-primary"></i> Sales Register
            </h4>
            <small class="text-muted">View, search and manage all customer sales invoices</small>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <a href="{{ route('sale.add') }}" class="btn-new-sale">
                <i class="fas fa-plus-circle me-1"></i> New Sale
            </a>
            {{-- Bookings button removed as requested --}}
            <a href="{{ url('sale-returns') }}" class="btn btn-outline-warning btn-sm fw-bold px-3 py-2" style="border-radius:8px;">
                <i class="fas fa-undo me-1"></i> Returns
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm fw-bold px-3 py-2" style="border-radius:8px;">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    @php
        $totalSalesCount = $sales->count();
        $totalSalesSum = $sales->sum(function($s) {
            return (float)($s->total_net ?: $s->total_bill_amount);
        });
        $todaySales = $sales->filter(function($s) {
            return \Carbon\Carbon::parse($s->created_at)->isToday();
        });
        $todaySalesSum = $todaySales->sum(function($s) {
            return (float)($s->total_net ?: $s->total_bill_amount);
        });
        $returnedSalesCount = $sales->where('sale_status', 1)->count();
    @endphp

    {{-- KPI Metric Cards --}}
    <div class="row g-2 mb-3">
        <div class="col-xl-3 col-md-6">
            <div class="sales-kpi-card">
                <div class="kpi-icon-box kpi-icon-green">
                    <i class="fas fa-coins"></i>
                </div>
                <div>
                    <div class="kpi-title">Total Revenue</div>
                    <div class="kpi-value">Rs {{ number_format($totalSalesSum, 0) }}</div>
                    <div class="kpi-sub">{{ $totalSalesCount }} Invoices generated</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="sales-kpi-card">
                <div class="kpi-icon-box kpi-icon-blue">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div>
                    <div class="kpi-title">Today's Sales</div>
                    <div class="kpi-value text-primary">Rs {{ number_format($todaySalesSum, 0) }}</div>
                    <div class="kpi-sub">{{ $todaySales->count() }} Sales today</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="sales-kpi-card">
                <div class="kpi-icon-box kpi-icon-purple">
                    <i class="fas fa-receipt"></i>
                </div>
                <div>
                    <div class="kpi-title">Total Invoices</div>
                    <div class="kpi-value">{{ $totalSalesCount }}</div>
                    <div class="kpi-sub">Completed sales transactions</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="sales-kpi-card">
                <div class="kpi-icon-box kpi-icon-amber">
                    <i class="fas fa-undo-alt"></i>
                </div>
                <div>
                    <div class="kpi-title">Sales Returned</div>
                    <div class="kpi-value text-warning">{{ $returnedSalesCount }}</div>
                    <div class="kpi-sub">Returned invoices logged</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="filter-card">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <span class="fw-bold text-dark d-flex align-items-center gap-2" style="font-size:13.5px;">
                <i class="fas fa-filter text-primary"></i> Filter Sales Data
            </span>
            <small class="text-muted">Filter by date range, customer or invoice status</small>
        </div>
        <div class="row g-2 align-items-end">
            <div class="col-lg-3 col-md-6">
                <label class="form-label"><i class="far fa-calendar-alt me-1"></i>From Date</label>
                <input type="date" id="filterStartDate" class="form-control">
            </div>
            <div class="col-lg-3 col-md-6">
                <label class="form-label"><i class="far fa-calendar-alt me-1"></i>To Date</label>
                <input type="date" id="filterEndDate" class="form-control">
            </div>
            <div class="col-lg-3 col-md-6">
                <label class="form-label"><i class="fas fa-user me-1"></i>Customer</label>
                <select id="filterCustomer" class="form-select">
                    <option value="">-- All Customers --</option>
                    <option value="Walk-in Customer">Walk-in Customer</option>
                    @if(isset($customers))
                        @foreach($customers as $c)
                            <option value="{{ $c->customer_name }}">{{ $c->customer_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <label class="form-label"><i class="fas fa-check-circle me-1"></i>Status</label>
                <select id="filterStatus" class="form-select">
                    <option value="">-- All Status --</option>
                    <option value="Completed">Completed</option>
                    <option value="Returned">Returned</option>
                </select>
            </div>
            <div class="col-lg-1 col-md-2">
                <button type="button" id="btnResetFilters" class="btn btn-outline-secondary w-100" title="Reset all filters">
                    <i class="fas fa-redo-alt"></i>
                </button>
            </div>
        </div>
    </div>

    {{-- Main Sales Table Card --}}
    <div class="main-sales-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="fw-bold text-dark" style="font-size:14.5px;">
                <i class="fas fa-list-ul me-2 text-primary"></i>Sales Records
            </div>
            <div class="badge bg-light text-secondary border px-3 py-2 font-monospace">
                Total: {{ $sales->count() }} records
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="productTable" class="table sales-table align-middle nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:70px;"># Inv</th>
                            <th>Customer</th>
                            <th>Products</th>
                            <th style="width:80px;">Items</th>
                            <th>Net Total</th>
                            <th>Date & Time</th>
                            <th style="width:100px;">Status</th>
                            <th style="width:100px;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        @php
                            $products = explode(',', $sale->product);
                            $qtys = explode(',', $sale->qty);
                            $totalItems = array_sum(array_map('floatval', $qtys));
                            $custName = optional($sale->customer_relation)->customer_name ?? 'Walk-in Customer';
                            $dateRaw = \Carbon\Carbon::parse($sale->created_at)->format('Y-m-d');
                            $statusText = ($sale->sale_status == 1) ? 'Returned' : 'Completed';
                            $displayTotal = (float)($sale->total_net ?: $sale->total_bill_amount);
                        @endphp
                        <tr data-date="{{ $dateRaw }}" data-customer="{{ strtolower($custName) }}" data-status="{{ $statusText }}">
                            <td class="text-center">
                                <span class="badge bg-light text-dark border font-monospace">
                                    {{ $sale->invoice_no ?? ('SAL-' . str_pad($sale->id, 3, '0', STR_PAD_LEFT)) }}
                                </span>
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $custName }}</div>
                                @if($sale->reference)
                                    <small class="text-muted"><i class="fas fa-hashtag me-1"></i>Ref: {{ $sale->reference }}</small>
                                @endif
                            </td>
                            <td>
                                <div class="product-list" style="max-height:85px; overflow-y:auto;">
                                    @foreach($products as $index => $p)
                                        @php $product = \App\Models\Product::find($p); @endphp
                                        @if($product)
                                            <div class="sale-product-pill">
                                                <span>{{ $product->item_name }}</span>
                                                <span class="badge-qty">x{{ $qtys[$index] ?? 1 }}</span>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-secondary border font-monospace">
                                    {{ $totalItems }}
                                </span>
                            </td>
                            <td class="text-end pe-4" data-order="{{ $displayTotal }}">
                                <span class="fw-bold text-success" style="font-size:14px;">
                                    Rs {{ number_format($displayTotal, 2) }}
                                </span>
                            </td>
                            <td class="text-center" data-order="{{ $sale->created_at }}">
                                <div class="fw-semibold text-dark"><i class="far fa-calendar-alt me-1 text-muted"></i>{{ \Carbon\Carbon::parse($sale->created_at)->format('d M, Y') }}</div>
                                <small class="text-muted"><i class="far fa-clock me-1"></i>{{ \Carbon\Carbon::parse($sale->created_at)->format('h:i A') }}</small>
                            </td>
                            <td class="text-center">
                                @if($sale->sale_status == 1)
                                    <span class="status-badge status-returned"><i class="fas fa-undo"></i> Returned</span>
                                @else
                                    <span class="status-badge status-completed"><i class="fas fa-check-circle"></i> Completed</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="dropdown action-dropdown">
                                    <button class="btn dropdown-toggle" type="button" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v me-1"></i> Actions
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end shadow">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('sales.invoice', $sale->id) }}" target="_blank">
                                                <i class="fas fa-print text-danger"></i> Thermal Receipt
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('sales.invoice_a4', $sale->id) }}" target="_blank">
                                                <i class="fas fa-file-pdf text-primary"></i> A4 Invoice
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('sales.edit', $sale->id) }}">
                                                <i class="fas fa-edit text-info"></i> Edit Sale
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider my-1"></li>
                                        <li>
                                            <a class="dropdown-item text-warning" href="{{ route('sales.return.create', $sale->id) }}">
                                                <i class="fas fa-undo"></i> Return Sale
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#productTable').DataTable({
            responsive: true,
            pageLength: 20,
            lengthMenu: [
                [10, 20, 50, 100, -1],
                [10, 20, 50, 100, "All"]
            ],
            order: [
                [0, 'desc'] // Latest first
            ],
            language: {
                search: "",
                searchPlaceholder: "Search by invoice, customer, product...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ sales",
                paginate: {
                    previous: "<i class='fas fa-chevron-left'></i>",
                    next: "<i class='fas fa-chevron-right'></i>"
                }
            },
            dom: '<"px-3 py-2 border-bottom d-flex flex-wrap justify-content-between align-items-center"<"d-flex align-items-center"l><"d-flex align-items-center"f>>rt<"px-3 py-2 border-top d-flex flex-wrap justify-content-between align-items-center"ip>',
        });

        // Style the search & length inputs
        $('.dataTables_filter input').addClass('form-control form-control-sm').css({
            'width': '250px',
            'border-radius': '7px',
            'border': '1.5px solid #dfe3ea',
            'padding': '5px 10px'
        });
        $('.dataTables_length select').addClass('form-select form-select-sm').css({
            'width': 'auto',
            'border-radius': '7px',
            'border': '1.5px solid #dfe3ea',
            'padding': '5px 10px'
        });

        // Reliable Action dropdown toggle
        $(document).on('click', '.action-dropdown .dropdown-toggle', function(e) {
            e.preventDefault();
            e.stopPropagation();
            var $menu = $(this).siblings('.dropdown-menu');
            var isShown = $menu.hasClass('show');
            $('.action-dropdown .dropdown-menu').removeClass('show');
            if (!isShown) {
                $menu.addClass('show');
            }
        });

        // Close dropdown when clicking outside
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.action-dropdown').length) {
                $('.action-dropdown .dropdown-menu').removeClass('show');
            }
        });

        // Custom DataTables Filter by Date Range, Customer, and Status
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var $row = $(table.row(dataIndex).node());
                var rowDate = $row.data('date');
                var rowCustomer = ($row.data('customer') || '').toString().toLowerCase();
                var rowStatus = ($row.data('status') || '').toString().toLowerCase();

                var startDate = $('#filterStartDate').val();
                var endDate = $('#filterEndDate').val();
                var selectedCustomer = ($('#filterCustomer').val() || '').toString().toLowerCase();
                var selectedStatus = ($('#filterStatus').val() || '').toString().toLowerCase();

                // Date filter
                if (startDate && rowDate < startDate) {
                    return false;
                }
                if (endDate && rowDate > endDate) {
                    return false;
                }

                // Customer filter
                if (selectedCustomer && !rowCustomer.includes(selectedCustomer)) {
                    return false;
                }

                // Status filter
                if (selectedStatus && rowStatus !== selectedStatus) {
                    return false;
                }

                return true;
            }
        );

        // Filter events
        $('#filterStartDate, #filterEndDate, #filterCustomer, #filterStatus').on('change input', function() {
            table.draw();
        });

        // Reset Filters Button
        $('#btnResetFilters').on('click', function() {
            $('#filterStartDate').val('');
            $('#filterEndDate').val('');
            $('#filterCustomer').val('');
            $('#filterStatus').val('');
            table.search('').draw();
        });
    });
</script>
@endsection
