@extends('admin_panel.layout.app')
@section('content')

<style>
    /* ===== PAGE BASE & STATS ===== */
    .purchases-kpi-card {
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
    .purchases-kpi-card:hover {
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
    .kpi-icon-red   { background: #fef2f2; color: #dc2626; }

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
    .main-purchases-card {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #eef2f7;
        box-shadow: 0 3px 14px rgba(0, 0, 0, 0.04);
        overflow: visible;
    }
    .main-purchases-card .card-header {
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

    .purchases-table {
        font-size: 13px;
        margin-bottom: 0 !important;
        width: 100% !important;
    }
    
    /* Table Header styling */
    .purchases-table thead th,
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

    .purchases-table tbody td {
        padding: 10px 12px;
        vertical-align: middle;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }
    .purchases-table tbody tr:hover {
        background-color: #f8fafc;
    }

    tr.returned-row {
        background-color: #fef2f2 !important;
    }
    tr.returned-row td {
        background-color: #fef2f2 !important;
    }

    /* Product Item Tags */
    .purchase-product-pill {
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
    .purchase-product-pill .badge-qty {
        color: #059669;
        font-weight: 800;
    }

    /* Badges */
    .dest-badge {
        font-size: 11px;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 6px;
    }
    .dest-shop {
        background: #ecfdf5;
        color: #059669;
        border: 1px solid #a7f3d0;
    }
    .dest-wh {
        background: #eff6ff;
        color: #2563eb;
        border: 1px solid #bfdbfe;
    }

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

    /* Header Button */
    .btn-new-purchase {
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
    .btn-new-purchase:hover {
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
                <i class="fas fa-boxes text-primary"></i> Purchases Register
            </h4>
            <small class="text-muted">View, search and manage all inventory purchases and gatepass bills</small>
        </div>
        <div class="d-flex gap-2 align-items-center">
            <a href="{{ route('add_purchase') }}" class="btn-new-purchase">
                <i class="fas fa-plus-circle me-1"></i> Add New Purchase
            </a>
            <a href="{{ route('purchase.return.index') }}" class="btn btn-outline-warning btn-sm fw-bold px-3 py-2" style="border-radius:8px;">
                <i class="fas fa-undo me-1"></i> View Returns
            </a>
            <a href="{{ url()->previous() }}" class="btn btn-outline-secondary btn-sm fw-bold px-3 py-2" style="border-radius:8px;">
                <i class="fas fa-arrow-left me-1"></i> Back
            </a>
        </div>
    </div>

    @php
        $totalPurchasesCount = $Purchase->count();
        $totalPurchasesSum = $Purchase->sum(function($p) {
            return (float)($p->net_amount ?? 0);
        });
        $todayPurchases = $Purchase->filter(function($p) {
            $d = $p instanceof \App\Models\InwardGatepass ? $p->gatepass_date : $p->purchase_date;
            return $d && \Carbon\Carbon::parse($d)->isToday();
        });
        $todayPurchasesSum = $todayPurchases->sum(function($p) {
            return (float)($p->net_amount ?? 0);
        });
        $totalDueSum = $Purchase->sum(function($p) {
            return (float)($p->due_amount ?? 0);
        });
        $returnedPurchasesCount = $Purchase->filter(function($p) {
            return !empty($p->return);
        })->count();
    @endphp

    {{-- KPI Metric Cards --}}
    <div class="row g-2 mb-3">
        <div class="col-xl-3 col-md-6">
            <div class="purchases-kpi-card">
                <div class="kpi-icon-box kpi-icon-green">
                    <i class="fas fa-coins"></i>
                </div>
                <div>
                    <div class="kpi-title">Total Purchases</div>
                    <div class="kpi-value">Rs {{ number_format($totalPurchasesSum, 0) }}</div>
                    <div class="kpi-sub">{{ $totalPurchasesCount }} Total Bills Logged</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="purchases-kpi-card">
                <div class="kpi-icon-box kpi-icon-blue">
                    <i class="fas fa-calendar-day"></i>
                </div>
                <div>
                    <div class="kpi-title">Today's Purchases</div>
                    <div class="kpi-value text-primary">Rs {{ number_format($todayPurchasesSum, 0) }}</div>
                    <div class="kpi-sub">{{ $todayPurchases->count() }} Purchases today</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="purchases-kpi-card">
                <div class="kpi-icon-box kpi-icon-purple">
                    <i class="fas fa-receipt"></i>
                </div>
                <div>
                    <div class="kpi-title">Total Invoices</div>
                    <div class="kpi-value">{{ $totalPurchasesCount }}</div>
                    <div class="kpi-sub">Completed purchases & gatepasses</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="purchases-kpi-card">
                <div class="kpi-icon-box kpi-icon-red">
                    <i class="fas fa-exclamation-circle"></i>
                </div>
                <div>
                    <div class="kpi-title">Total Due / Payable</div>
                    <div class="kpi-value text-danger">Rs {{ number_format($totalDueSum, 0) }}</div>
                    <div class="kpi-sub">{{ $returnedPurchasesCount }} Returned purchases</div>
                </div>
            </div>
        </div>
    </div>

    {{-- Filter Card --}}
    <div class="filter-card">
        <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="fw-bold text-dark d-flex align-items-center gap-2" style="font-size:13px;">
                <i class="fas fa-filter text-primary"></i> Filter Purchases Data
            </span>
            <small class="text-muted">Filter by date, vendor, destination or status</small>
        </div>
        <div class="row g-2 align-items-end">
            <div class="col-lg-3 col-md-6">
                <label class="form-label"><i class="far fa-calendar-alt me-1"></i>From Date</label>
                <input type="date" id="filterStartDate" class="form-control" value="{{ $start_date ?? '' }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <label class="form-label"><i class="far fa-calendar-alt me-1"></i>To Date</label>
                <input type="date" id="filterEndDate" class="form-control" value="{{ $end_date ?? '' }}">
            </div>
            <div class="col-lg-3 col-md-6">
                <label class="form-label"><i class="fas fa-truck me-1"></i>Vendor</label>
                <select id="filterVendor" class="form-select">
                    <option value="">-- All Vendors --</option>
                    @if(isset($vendors))
                        @foreach($vendors as $v)
                            <option value="{{ $v->name }}">{{ $v->name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-lg-2 col-md-4">
                <label class="form-label"><i class="fas fa-warehouse me-1"></i>Destination</label>
                <select id="filterDest" class="form-select">
                    <option value="">-- All --</option>
                    <option value="Shop">Shop</option>
                    @if(isset($warehouses))
                        @foreach($warehouses as $w)
                            <option value="{{ $w->warehouse_name }}">{{ $w->warehouse_name }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="col-lg-1 col-md-2">
                <button type="button" id="btnResetFilters" class="btn btn-outline-secondary w-100" title="Reset all filters">
                    <i class="fas fa-redo-alt"></i>
                </button>
            </div>
        </div>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    {{-- Main Purchases Table Card --}}
    <div class="main-purchases-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <div class="fw-bold text-dark" style="font-size:14px;">
                <i class="fas fa-list-ul me-2 text-primary"></i>Purchase Records
            </div>
            <div class="badge bg-light text-secondary border px-3 py-2 font-monospace">
                Total: {{ $Purchase->count() }} records
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table id="purchaseTable" class="table purchases-table align-middle nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width:70px;"># Inv</th>
                            <th>Vendor</th>
                            <th style="width:100px;">Destination</th>
                            <th>Products</th>
                            <th style="width:70px;">Qty</th>
                            <th>Net Total</th>
                            <th>Paid / Due</th>
                            <th>Date</th>
                            <th style="width:90px;">Status</th>
                            <th style="width:90px;" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Purchase as $purchase)
                        @php
                            $isGatepass = $purchase instanceof \App\Models\InwardGatepass;
                            $invNo = $purchase->invoice_no ?? ('PUR-' . str_pad($purchase->id, 3, '0', STR_PAD_LEFT));
                            $vendorName = $purchase->vendor->name ?? 'N/A';
                            
                            // Destination
                            if ($isGatepass) {
                                $dest = $purchase->warehouse->warehouse_name ?? 'Shop';
                            } else {
                                $dest = ($purchase->purchase_to === 'warehouse') ? ($purchase->warehouse->warehouse_name ?? 'Warehouse') : 'Shop';
                            }

                            // Date
                            $rawDate = $isGatepass ? $purchase->gatepass_date : $purchase->purchase_date;
                            $dateStr = $rawDate ? \Carbon\Carbon::parse($rawDate)->format('Y-m-d') : '';
                            $dateFormatted = $rawDate ? \Carbon\Carbon::parse($rawDate)->format('d M, Y') : '-';

                            // Items & Qtys
                            $itemsList = $purchase->items ?? [];
                            $totalQty = 0;
                            foreach ($itemsList as $it) {
                                $totalQty += floatval($it->qty ?? 0);
                            }

                            $netAmount = (float)($purchase->net_amount ?? 0);
                            $paidAmount = (float)($purchase->paid_amount ?? 0);
                            $dueAmount = (float)($purchase->due_amount ?? 0);
                            $isReturned = !empty($purchase->return);
                            $returnedQty = 0;
                            $returnedAmount = 0;
                            if ($isReturned && isset($purchase->return->items)) {
                                $returnedQty = floatval($purchase->return->items->sum('qty'));
                                $returnedAmount = floatval($purchase->return->net_amount ?? 0);
                            }
                            $statusText = $isReturned ? 'Returned' : 'Completed';
                        @endphp
                        <tr @if($isReturned) class="returned-row" @endif data-date="{{ $dateStr }}" data-vendor="{{ strtolower($vendorName) }}" data-dest="{{ strtolower($dest) }}" data-status="{{ $statusText }}">
                            <td class="text-center">
                                <span class="badge bg-light text-dark border font-monospace">
                                    {{ $invNo }}
                                </span>
                                @if($isGatepass)
                                    <div><span class="badge bg-success" style="font-size:9.5px;">Inward</span></div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $vendorName }}</div>
                                @if(!empty($purchase->vendor->phone))
                                    <small class="text-muted"><i class="fas fa-phone-alt me-1"></i>{{ $purchase->vendor->phone }}</small>
                                @endif
                            </td>
                            <td class="text-center">
                                @if(strtolower($dest) === 'shop')
                                    <span class="dest-badge dest-shop"><i class="fas fa-store me-1"></i>Shop</span>
                                @else
                                    <span class="dest-badge dest-wh"><i class="fas fa-warehouse me-1"></i>{{ $dest }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="product-list" style="max-height:85px; overflow-y:auto;">
                                    @foreach($itemsList as $it)
                                        @php
                                            $itemRetQty = ($isReturned && isset($purchase->return->items))
                                                ? floatval($purchase->return->items->where('product_id', $it->product_id)->sum('qty'))
                                                : 0;
                                        @endphp
                                        <div class="purchase-product-pill">
                                            <span>{{ $it->product->item_name ?? 'N/A' }}</span>
                                            @if($itemRetQty > 0)
                                                <span class="badge-qty">x{{ ($it->qty ?? 1) - $itemRetQty }}</span>
                                                <span class="badge bg-danger ms-1" style="font-size:10px;">-{{ $itemRetQty }} Ret</span>
                                            @else
                                                <span class="badge-qty">x{{ $it->qty ?? 1 }}</span>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            </td>
                            <td class="text-center font-monospace fw-bold">
                                @if($returnedQty > 0)
                                    <div>{{ $totalQty - $returnedQty }}</div>
                                    <small class="text-danger fw-semibold d-block" style="font-size:11px;">(-{{ $returnedQty }} Ret)</small>
                                @else
                                    {{ $totalQty }}
                                @endif
                            </td>
                            <td class="text-end pe-3" data-order="{{ $netAmount - $returnedAmount }}">
                                @if($returnedAmount > 0)
                                    <span class="fw-bold text-dark" style="font-size:13.5px;">
                                        Rs {{ number_format($netAmount - $returnedAmount, 2) }}
                                    </span>
                                    <small class="text-muted text-decoration-line-through d-block" style="font-size:11px;">
                                        Rs {{ number_format($netAmount, 2) }}
                                    </small>
                                @else
                                    <span class="fw-bold text-dark" style="font-size:13.5px;">
                                        Rs {{ number_format($netAmount, 2) }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div><small class="text-success fw-bold">Paid: Rs {{ number_format($paidAmount, 0) }}</small></div>
                                @if($dueAmount > 0)
                                    <div><small class="text-danger fw-bold">Due: Rs {{ number_format($dueAmount, 0) }}</small></div>
                                @else
                                    <div><small class="text-muted">Due: Rs 0</small></div>
                                @endif
                                @if($returnedAmount > 0)
                                    <div><small class="text-danger" style="font-size:10.5px;">(Ret: Rs {{ number_format($returnedAmount, 0) }})</small></div>
                                @endif
                            </td>
                            <td class="text-center" data-order="{{ $dateStr }}">
                                <div class="fw-semibold text-dark"><i class="far fa-calendar-alt me-1 text-muted"></i>{{ $dateFormatted }}</div>
                            </td>
                            <td class="text-center">
                                @if($isReturned)
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
                                        @if($isGatepass)
                                            <li>
                                                <a class="dropdown-item" href="{{ route('InwardGatepass.inv', $purchase->id) }}" target="_blank">
                                                    <i class="fas fa-print text-danger"></i> Print Invoice
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a class="dropdown-item" href="{{ route('purchase.invoice', $purchase->id) }}" target="_blank">
                                                    <i class="fas fa-print text-danger"></i> Print Invoice
                                                </a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('purchase.edit', $purchase->id) }}">
                                                    <i class="fas fa-edit text-info"></i> Edit Purchase
                                                </a>
                                            </li>
                                            <li><hr class="dropdown-divider my-1"></li>
                                            <li>
                                                <a class="dropdown-item text-warning" href="{{ route('purchase.return.show', $purchase->id) }}">
                                                    <i class="fas fa-undo"></i> Return Purchase
                                                </a>
                                            </li>
                                        @endif
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
        var table = $('#purchaseTable').DataTable({
            responsive: true,
            pageLength: 20,
            lengthMenu: [
                [10, 20, 50, 100, -1],
                [10, 20, 50, 100, "All"]
            ],
            order: [
                [7, 'desc'] // Date latest first
            ],
            language: {
                search: "",
                searchPlaceholder: "Search purchase, vendor, invoice...",
                lengthMenu: "Show _MENU_ entries",
                info: "Showing _START_ to _END_ of _TOTAL_ purchases",
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

        // Custom DataTables Filter by Date Range, Vendor, and Destination
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var $row = $(table.row(dataIndex).node());
                var rowDate = $row.data('date');
                var rowVendor = ($row.data('vendor') || '').toString().toLowerCase();
                var rowDest = ($row.data('dest') || '').toString().toLowerCase();

                var startDate = $('#filterStartDate').val();
                var endDate = $('#filterEndDate').val();
                var selectedVendor = ($('#filterVendor').val() || '').toString().toLowerCase();
                var selectedDest = ($('#filterDest').val() || '').toString().toLowerCase();

                // Date filter
                if (startDate && rowDate && rowDate < startDate) {
                    return false;
                }
                if (endDate && rowDate && rowDate > endDate) {
                    return false;
                }

                // Vendor filter
                if (selectedVendor && !rowVendor.includes(selectedVendor)) {
                    return false;
                }

                // Destination filter
                if (selectedDest && !rowDest.includes(selectedDest)) {
                    return false;
                }

                return true;
            }
        );

        // Filter events
        $('#filterStartDate, #filterEndDate, #filterVendor, #filterDest').on('change input', function() {
            table.draw();
        });

        // Reset Filters Button
        $('#btnResetFilters').on('click', function() {
            $('#filterStartDate').val('');
            $('#filterEndDate').val('');
            $('#filterVendor').val('');
            $('#filterDest').val('');
            table.search('').draw();
        });
    });
</script>
@endsection
