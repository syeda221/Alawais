<div class="container-scroller">
    <!-- Top Configuration -->
    <style>
        /* Sleek Modern Petrol Executive Header */
        .top_nav {
            background: linear-gradient(135deg, #093028 0%, #0e4c3a 45%, #156d53 100%) !important;
            border-bottom: 1px solid rgba(255, 255, 255, 0.12) !important;
            box-shadow: 0 4px 20px rgba(9, 48, 40, 0.22);
            position: relative;
            z-index: 101;
        }
        .rt_nav_header .top_nav {
            height: 68px;
        }
        .rt_logo {
            display: inline-flex;
            align-items: center;
            padding: 4px 8px;
            border-radius: 8px;
            transition: transform 0.2s ease;
        }
        .rt_logo:hover {
            transform: scale(1.02);
        }
        .rt_logo img {
            height: 42px;
            object-fit: contain;
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.2)) brightness(0) invert(1);
        }

        /* User Profile Pill */
        .user-profile-pill {
            display: inline-flex !important;
            align-items: center !important;
            background: rgba(255, 255, 255, 0.12) !important;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.22) !important;
            border-radius: 30px !important;
            padding: 5px 14px 5px 6px !important;
            text-decoration: none !important;
            transition: all 0.25s ease !important;
            gap: 9px;
        }
        .user-profile-pill:hover,
        .user-profile-pill:focus {
            background: rgba(255, 255, 255, 0.22) !important;
            border-color: rgba(255, 255, 255, 0.4) !important;
            box-shadow: 0 4px 14px rgba(0, 0, 0, 0.15) !important;
        }
        .user-avatar-wrap {
            position: relative;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: linear-gradient(135deg, #34d399 0%, #059669 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.15);
        }
        .user-avatar-initial {
            color: #ffffff;
            font-weight: 700;
            font-size: 14px;
            line-height: 1;
        }
        .user-status-dot {
            position: absolute;
            bottom: 0px;
            right: 0px;
            width: 9px;
            height: 9px;
            background-color: #22c55e;
            border: 2px solid #0e4c3a;
            border-radius: 50%;
        }
        .user-meta-info {
            display: flex;
            flex-direction: column;
            line-height: 1.15;
        }
        .profile_name {
            color: #ffffff !important;
            font-weight: 600 !important;
            font-size: 13.5px !important;
            letter-spacing: 0.2px;
        }
        .profile_role {
            color: rgba(255, 255, 255, 0.72);
            font-size: 10px;
            font-weight: 500;
            letter-spacing: 0.4px;
            text-transform: uppercase;
        }
        .user-profile-pill .ft-chevron-down {
            color: rgba(255, 255, 255, 0.8) !important;
            font-size: 12px;
            transition: transform 0.2s ease;
        }
        .dropdown.show .user-profile-pill .ft-chevron-down {
            transform: rotate(180deg);
        }

        /* Profile Dropdown Menu */
        .modern-profile-menu {
            border-radius: 12px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12) !important;
            min-width: 210px !important;
            padding: 8px !important;
            margin-top: 10px !important;
        }
        .modern-profile-menu .dropdown-header {
            padding: 8px 12px 10px !important;
            margin-bottom: 6px;
            border-bottom: 1px solid #f1f5f9;
        }
        .modern-profile-menu .dropdown-item {
            font-size: 13px !important;
            font-weight: 600 !important;
            border-radius: 8px !important;
            padding: 8px 12px !important;
            transition: all 0.2s ease !important;
        }
        .modern-profile-menu .dropdown-item:hover {
            background-color: #fee2e2 !important;
            color: #dc2626 !important;
        }

        /* Bottom Navigation Bar */
        .rt_nav_header .nav-bottom {
            background-color: #ffffff !important;
            border-bottom: 1.5px solid #edf2f7 !important;
            box-shadow: 0 4px 16px rgba(15, 23, 42, 0.04) !important;
        }
        .page-navigation {
            display: flex;
            align-items: center;
        }
        .page-navigation > .nav-item {
            margin: 0 3px;
        }
        .page-navigation > .nav-item > .nav-link {
            padding: 13px 16px !important;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 9px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .page-navigation > .nav-item > .nav-link .menu-title {
            font-size: 13.5px;
            font-weight: 600;
            color: #334155;
            transition: color 0.2s ease;
        }
        .page-navigation > .nav-item > .nav-link .menu-arrow {
            color: #94a3b8;
            font-size: 11px;
            margin-left: 2px;
            transition: transform 0.2s ease;
        }
        .page-navigation > .nav-item:hover > .nav-link {
            background-color: #f1f5f9;
            transform: translateY(-1px);
        }
        .page-navigation > .nav-item:hover > .nav-link .menu-title {
            color: #0e4c3a !important;
        }
        .page-navigation > .nav-item:hover > .nav-link .menu-arrow {
            color: #0e4c3a;
            transform: translateY(1px);
        }

        /* Icon Colors */
        .nav-icon-dashboard { color: #2563eb !important; font-size: 16px; }
        .nav-icon-sale { color: #059669 !important; font-size: 15px; }
        .nav-icon-mgmt { color: #d97706 !important; font-size: 15px; }
        .nav-icon-finance { color: #7c3aed !important; font-size: 15px; }
        .nav-icon-reports { color: #0891b2 !important; font-size: 16px; }

        /* Mega Menu & Submenu Dropdowns */
        .rt_nav_header.horizontal-layout .nav-bottom .page-navigation > .nav-item .submenu {
            border-radius: 14px !important;
            border: 1px solid #e2e8f0 !important;
            box-shadow: 0 18px 40px rgba(15, 23, 42, 0.12), 0 4px 12px rgba(15, 23, 42, 0.05) !important;
            padding: 18px 22px !important;
            background: #ffffff !important;
            top: calc(100% + 4px) !important;
        }
        .category-heading {
            font-size: 11.5px !important;
            font-weight: 700 !important;
            letter-spacing: 0.8px !important;
            text-transform: uppercase !important;
            color: #0e4c3a !important;
            padding-bottom: 8px !important;
            border-bottom: 2px solid #e2e8f0 !important;
            margin-bottom: 12px !important;
            display: flex;
            align-items: center;
            gap: 6px;
        }
        .category-heading i {
            color: #059669;
            font-size: 12px;
        }
        .submenu-item {
            list-style: none;
            padding-left: 0;
            margin-bottom: 0;
        }
        .submenu-item li {
            margin-bottom: 2px;
        }
        .submenu-item li a,
        .submenu-item .nav-item .nav-link {
            color: #475569 !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            padding: 7px 10px !important;
            border-radius: 6px !important;
            display: flex !important;
            align-items: center !important;
            text-decoration: none !important;
            transition: all 0.18s ease !important;
        }
        .submenu-item li a:hover,
        .submenu-item .nav-item .nav-link:hover {
            background-color: #ecfdf5 !important;
            color: #065f46 !important;
            padding-left: 14px !important;
        }
        .submenu-item i {
            width: 22px !important;
            text-align: center !important;
            margin-right: 8px !important;
            color: #10b981 !important;
            font-size: 13px !important;
            transition: transform 0.2s ease !important;
        }
        .submenu-item li a:hover i,
        .submenu-item .nav-item .nav-link:hover i {
            color: #059669 !important;
            transform: scale(1.18);
        }

        /* Mobile Toggle */
        .navbar-toggler span {
            color: #ffffff !important;
        }
    </style>

    <nav class="rt_nav_header horizontal-layout col-lg-12 col-12 p-0">
        <!-- Top Bar -->
        <div class="top_nav flex-grow-1">
            <div class="container d-flex flex-row h-100 align-items-center">
                <!-- Logo -->
                <div class="text-center rt_nav_wrapper d-flex align-items-center">
                    <a class="nav_logo rt_logo" href="{{ url('/home') }}">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="logo" />
                    </a>
                </div>
                
                <!-- Right Side Profile -->
                <div class="nav_wrapper_main d-flex align-items-center justify-content-between flex-grow-1">
                    <ul class="navbar-nav navbar-nav-right mr-0 ml-auto">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link user-profile-pill" href="#" data-toggle="dropdown" id="profileDropdown">
                                <div class="user-avatar-wrap">
                                    <span class="user-avatar-initial">{{ strtoupper(substr(Auth::check() ? Auth::user()->name : 'A', 0, 1)) }}</span>
                                    <span class="user-status-dot"></span>
                                </div>
                                <div class="user-meta-info text-left d-none d-sm-block">
                                    <span class="profile_name">{{ Auth::check() ? Auth::user()->name : 'Admin' }}</span>
                                    <span class="profile_role">Online</span>
                                </div>
                                <i class="feather ft-chevron-down"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right modern-profile-menu pt-2" aria-labelledby="profileDropdown">
                                <div class="dropdown-header">
                                    <small class="text-muted d-block text-uppercase" style="font-size: 10px; font-weight: 700; letter-spacing: 0.5px;">Signed In As</small>
                                    <span class="font-weight-bold text-dark" style="font-size: 13.5px;">{{ Auth::check() ? Auth::user()->name : 'Admin' }}</span>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger border-0 bg-transparent w-100 text-left">
                                        <i class="feather ft-power text-danger mr-2"></i> Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>

                    <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="feather ft-menu text-white"></span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation Bar -->
        <div class="nav-bottom">
            <div class="container">
                <ul class="nav page-navigation">
                    <!-- Dashboard -->
                    <li class="nav-item">
                        <a href="{{ url('/home') }}" class="nav-link">
                            <i class="menu_icon feather ft-home nav-icon-dashboard"></i>
                            <span class="menu-title">Dashboard</span>
                        </a>
                    </li>

                    <!-- Sale -->
                    <li class="nav-item">
                        <a href="{{ url('/sale/create') }}" class="nav-link">
                            <i class="menu_icon fas fa-cash-register nav-icon-sale"></i>
                            <span class="menu-title">Sale</span>
                        </a>
                    </li>

                    <!-- Management (Mega Menu) -->
                    <li class="nav-item mega-menu">
                        <a href="#" class="nav-link">
                            <i class="menu_icon fas fa-tasks nav-icon-mgmt"></i>
                            <span class="menu-title">Management</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="submenu">
                            <div class="col-group-wrapper row">
                                <!-- Products & Categories -->
                                <div class="col-group col-md-3">
                                    <p class="category-heading"><i class="fas fa-boxes"></i> Inventory Setup</p>
                                    <ul class="submenu-item">
                                        @can('Products')
                                        <li><a href="{{ route('product') }}"><i class="fas fa-box"></i> Products</a></li>
                                        <!-- <li><a href="{{ route('group-products.index') }}"><i class="fas fa-cubes"></i> Group Products</a></li> -->
                                        <!-- @endcan
                                        @can('Discount Products')
                                        <li><a href="{{ route('discount.index') }}"><i class="fas fa-tags"></i> Discount Products</a></li>
                                        @endcan -->
                                        @can('Category')
                                        <li><a href="{{ route('Category.home') }}"><i class="fas fa-list"></i> Category</a></li>
                                        @endcan
                                        @can('Sub Category')
                                        <li><a href="{{ route('subcategory.home') }}"><i class="fas fa-th-list"></i> Sub Category</a></li>
                                        @endcan
                                        @can('Brands')
                                        <li><a href="{{ route('Brand.home') }}"><i class="fas fa-trademark"></i> Brands</a></li>
                                        @endcan
                                    </ul>
                                </div>

                                <!-- Purchase & Inventory -->
                                <div class="col-group col-md-3">
                                    <p class="category-heading"><i class="fas fa-truck-moving"></i> Purchase & Vendors</p>
                                    <ul class="submenu-item">
                                        <!-- @can('List Inwards')
                                        <li><a href="{{ route('InwardGatepass.home') }}"><i class="fas fa-arrow-circle-down"></i> List Inwards</a></li>
                                        @endcan 
                                        @can('Create Inward Gatepass')
                                        <li><a href="{{ route('add_inwardgatepass') }}"><i class="fas fa-plus-circle"></i> Create Inward</a></li>
                                        @endcan -->
                                        @can('Purchase')
                                        <li><a href="{{ route('Purchase.home') }}"><i class="fas fa-shopping-cart"></i> Purchase</a></li>
                                        @endcan
                                        @can('Purchase Return')
                                        <li><a href="{{ route('purchase.return.index') }}"><i class="fas fa-undo"></i> Purchase Return</a></li>
                                        @endcan
                                        @can('Vendor')
                                        <li><a href="{{ route('vendors') }}"><i class="fas fa-truck"></i> Vendors</a></li>
                                        @endcan
                                    </ul>
                                </div>

                                <!-- Warehouse & Stock -->
                                <div class="col-group col-md-3">
                                    <p class="category-heading"><i class="fas fa-warehouse"></i> Warehouse & Stock</p>
                                    <ul class="submenu-item">
                                        @can('List Warehouse')
                                        <li><a href="{{ url('warehouse') }}"><i class="fas fa-warehouse"></i> Warehouses</a></li>
                                        @endcan
                                        @can('Warehouse Stock')
                                        <li><a href="{{ url('warehouse_stocks') }}"><i class="fas fa-boxes"></i> Stock Status</a></li>
                                        @endcan
                                        @can('Stock Transfer')
                                        <li><a href="{{ url('stock_transfers') }}"><i class="fas fa-exchange-alt"></i> Stock Transfer</a></li>
                                        @endcan
                                    </ul>
                                </div>

                                <!-- Sales & Customers -->
                                <div class="col-group col-md-3">
                                    <p class="category-heading"><i class="fas fa-shopping-bag"></i> Sales Operations</p>
                                    <ul class="submenu-item">
                                        @can('Sales')
                                        <li><a href="{{ url('sale') }}"><i class="fas fa-receipt"></i> Sales History</a></li>
                                        @endcan
                                        @can('Sale Return')
                                        <li><a href="{{ url('sale-returns') }}"><i class="fas fa-undo"></i> Returns</a></li>
                                        @endcan
                                        @can('Bookings')
                                        {{-- <li><a href="{{ route('bookings.index') }}"><i class="fas fa-calendar-check"></i> Bookings</a></li> --}}
                                        @endcan
                                        @can('Customer')
                                        <li><a href="{{ url('customers') }}"><i class="fas fa-users"></i> Customers</a></li>
                                        @endcan
                                        <li><a href="{{ route('dual.party.create') }}"><i class="fas fa-people-arrows"></i> Customer & Vendor</a></li>
                                        <!-- @can('Sales Officer')
                                        <li><a href="{{ url('sales-officers') }}"><i class="fas fa-user-tie"></i> Sales Officers</a></li>
                                        @endcan
                                         -->
                                        @can('Zone')
                                        <li><a href="{{ url('zone') }}"><i class="fas fa-map-marker-alt"></i> Zones</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                    <!-- Vouchers -->
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="menu_icon fas fa-file-invoice-dollar nav-icon-finance"></i>
                            <span class="menu-title">Finance</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="submenu">
                            <ul class="submenu-item">
                                @can('Char Of Accounts')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('view_all') }}">
                                        <i class="fas fa-book mr-2"></i> Chart of Accounts
                                    </a>
                                </li>
                                @endcan
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('voucher.history') }}">
                                        <i class="fas fa-list mr-2"></i> All Vouchers View
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('create.voucher') }}">
                                        <i class="fas fa-plus-circle mr-2"></i> All Vouchers Create
                                    </a>
                                </li>
                                @can('Narrations')
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('narrations.index') }}">
                                        <i class="fas fa-pen-nib mr-2"></i> Narrations
                                    </a>
                                </li> 
                                @endcan
                                @can('Receipts Voucher')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('all-recepit-vochers') }}">
                                        <i class="fas fa-money-bill mr-2"></i> Receipt Vouchers
                                    </a>
                                </li>
                                @endcan
                                @can('Payment Voucher')
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('all-Payment-vochers') }}">
                                        <i class="fas fa-hand-holding-usd mr-2"></i> Payment Vouchers
                                    </a>
                                </li> -->
                                @endcan
                                @can('Expense Voucher')
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('all-expense-vochers') }}">
                                        <i class="fas fa-receipt mr-2"></i> Expense Vouchers
                                    </a>
                                </li> -->
                                @endcan
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('payment.in') }}">
                                        <i class="fas fa-hand-holding-usd mr-2"></i> Payment In (Customer)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('payment.out') }}">
                                        <i class="fas fa-money-bill-wave mr-2"></i> Payment Out (Vendor)
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('other.income') }}">
                                        <i class="fas fa-coins mr-2"></i> Other Income
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('transfer-vouchers') }}">
                                        <i class="fas fa-exchange-alt mr-2"></i> Party To Party
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('account-transfers') }}">
                                        <i class="fas fa-random mr-2"></i> Account Transfers Payment
                                    </a>
                                </li> -->
                                <!-- <li class="nav-item">
                                    <a class="nav-link" href="{{ route('journal-vouchers') }}">
                                        <i class="fas fa-journal-whills mr-2"></i> Journal Vouchers (Day Book)
                                    </a>
                                </li> -->
                            </ul>
                        </div>
                    </li>

                    <!-- Reports (Mega Menu) -->
                    <li class="nav-item mega-menu">
                        <a href="{{ route('reports.index') }}" class="nav-link">
                            <i class="menu_icon feather ft-pie-chart nav-icon-reports"></i>
                            <span class="menu-title">Reports</span>
                            <i class="menu-arrow"></i>
                        </a>
                        <div class="submenu">
                            <div class="col-group-wrapper row">
                                <!-- Col 1: Sales & Purchase -->
                                <div class="col-group col-md-3">
                                    <p class="category-heading"><i class="fas fa-chart-line"></i> Sales & Purchase</p>
                                    <ul class="submenu-item">
                                        @can('Sale Report')
                                        <li><a href="{{ route('report.sale') }}"><i class="fas fa-chart-line"></i> Daily Sale</a></li>
                                        <li><a href="{{ route('report.sale.category') }}"><i class="fas fa-list-alt"></i> Category Sale</a></li>
                                        <li><a href="{{ route('report.party_wise_sale') }}"><i class="fas fa-user-tag"></i> Party Sale</a></li>
                                        @endcan
                                        @can('Purchase Report')
                                        <li><a href="{{ route('report.purchase') }}"><i class="fas fa-truck-loading"></i> Purchase Report</a></li>
                                        @endcan
                                    </ul>
                                </div>

                                <!-- Col 2: Cash & Finance -->
                                <div class="col-group col-md-3">
                                    <p class="category-heading"><i class="fas fa-wallet"></i> Cash & Finance</p>
                                    <ul class="submenu-item">
                                        @can('Sale Report')
                                        <li><a href="{{ route('report.cash_book') }}"><i class="fas fa-book-open"></i> Daily Cash Book</a></li>
                                        @endcan
                                        @can('Customer Ledger')
                                        <li><a href="{{ route('report.customer.ledger') }}"><i class="fas fa-file-invoice"></i> Customer Ledger</a></li>
                                        <li><a href="{{ route('report.vendor.ledger') }}"><i class="fas fa-file-invoice-dollar"></i> Vendor Ledger</a></li>
                                        <li><a href="{{ route('report.dual_party.ledger') }}"><i class="fas fa-sync"></i> Dual Party Ledger</a></li>
                                        @endcan
                                    </ul>
                                </div>

                                <!-- Col 3: Profit & Loss -->
                                <div class="col-group col-md-3">
                                    <p class="category-heading"><i class="fas fa-balance-scale"></i> Profit & Loss</p>
                                    <ul class="submenu-item">
                                        <li><a href="{{ route('report.financial_summary') }}"><i class="fas fa-chart-pie"></i> Financial Summary</a></li>
                                        @can('Sale Report')
                                        <li><a href="{{ route('report.profit_loss') }}"><i class="fas fa-file-invoice-dollar"></i> Profit & Loss</a></li>
                                        <li><a href="{{ route('report.customer_wise_profit') }}"><i class="fas fa-chart-line"></i> Customer Profit</a></li>
                                        @endcan
                                        <li><a href="{{ route('report.expense') }}"><i class="fas fa-receipt"></i> Expense Report</a></li>

                                    </ul>
                                </div>

                                <!-- Col 4: Stocks & Inventory -->
                                <div class="col-group col-md-3">
                                    <p class="category-heading"><i class="fas fa-layer-group"></i> Stocks & Inventory</p>
                                    <ul class="submenu-item">
                                        @can('Item Stock Report')
                                        <li><a href="{{ route('report.item_stock') }}"><i class="fas fa-boxes"></i> Current Stock</a></li>
                                        @endcan
                                        @can('System Reports')
                                        <li><a href="{{ route('System.Reports') }}"><i class="fas fa-cogs"></i> System Reports</a></li>
                                        <li><a href="{{ route('report.party_balances') }}"><i class="fas fa-users-cog"></i> Parties Balances</a></li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>