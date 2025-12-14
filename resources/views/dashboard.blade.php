<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finwise Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8f9fa;
        }
        /* Sidebar Styling */
        .sidebar {
            min-height: 100vh;
            background-color: #fff;
            border-right: 1px solid #dee2e6;
        }
        .sidebar .nav-link {
            color: #495057;
            font-weight: 500;
            padding: 0.75rem 1rem;
            margin-bottom: 0.25rem;
            border-radius: 0.375rem;
        }
        .sidebar .nav-link.active {
            color: #0f766e;
            background-color: #dcfce7; /* Light green from image */
        }
        .sidebar .nav-link:hover:not(.active) {
            background-color: #f1f3f5;
        }
        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: #212529;
            padding: 1.5rem 1rem;
        }
        .logout-link {
            color: #dc3545;
            font-weight: 500;
            text-decoration: none;
            padding: 0.75rem 1rem;
            display: block;
            border-top: 1px solid #dee2e6;
        }

        /* Main Content Styling */
        .main-content {
            padding-bottom: 2rem;
        }
        .header-title {
            font-weight: 700;
            color: #212529;
        }
        .card-icon {
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 1.25rem;
        }
        /* Custom Colors */
        .text-success-custom { color: #10b981; }
        .bg-success-soft { background-color: #dcfce7; color: #10b981; }
        .text-danger-custom { color: #ef4444; }
        .bg-danger-soft { background-color: #fee2e2; color: #ef4444; }

        /* Placeholder Cards */
        .placeholder-card {
            min-height: 300px;
            background-color: #fff;
            border-radius: 0.5rem;
            border: 1px solid #dee2e6;
        }

        .sidebar {
            background-color: #fff;
            border-right: 1px solid #dee2e6;
        }

        /* Mobile toggle (hamburger icon) */
        .sidebar-toggle-btn {
            position: fixed;
            top: 15px;
            left: 15px;
            z-index: 1050;
        }

        /* Make sidebar overlay on mobile */
        @media (max-width: 767px) {
            .sidebar {
                position: fixed;
                z-index: 1040;
                width: 250px;
                height: 100vh;
                background-color: #fff;
                transform: translateX(-100%);
                transition: transform .3s ease;
            }
            .sidebar.show {
                transform: translateX(0);
            }
        }
    </style>
</head>
<body>
<button class="btn btn-primary d-md-none sidebar-toggle-btn" 
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu">
    <i class="bi bi-list"></i>
</button>

<div class="container-fluid">
    <div class="row">
        <x-sidebar />

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
            <x-topbar />

            <div class="mb-4">
                <h2 class="fw-bold">Dashboard</h2>
                <p class="text-muted">Overview of your financial status</p>
            </div>

            <div class="row g-4 mb-4">
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="card-subtitle text-muted">Total Income</h6>
                                    <h3 class="card-title fw-bold mt-2">Rp 15,700,000</h3>
                                </div>
                                <div class="card-icon bg-success-soft">
                                    <i class="bi bi-arrow-up-right"></i>
                                </div>
                            </div>
                            <p class="card-text text-success-custom small fw-medium">
                                <i class="bi bi-arrow-up"></i> +12.5% from last month
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="card-subtitle text-muted">Total Expense</h6>
                                    <h3 class="card-title fw-bold mt-2">Rp 8,420,000</h3>
                                </div>
                                <div class="card-icon bg-danger-soft">
                                    <i class="bi bi-arrow-down-right"></i>
                                </div>
                            </div>
                            <p class="card-text text-danger-custom small fw-medium">
                                <i class="bi bi-arrow-down"></i> +8.2% from last month
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h6 class="card-subtitle text-muted">Total Income</h6>
                                    <h3 class="card-title fw-bold mt-2">Rp 6,830,000</h3>
                                </div>
                                <div class="card-icon bg-success-soft">
                                    <i class="bi bi-graph-up"></i>
                                </div>
                            </div>
                            <p class="card-text text-success-custom small fw-medium">
                                <i class="bi bi-arrow-up"></i> +12.5% from last month
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="placeholder-card mb-4"></div>

            <div class="placeholder-card"></div>

        </main>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>