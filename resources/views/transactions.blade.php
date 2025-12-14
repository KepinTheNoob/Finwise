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
            background-color: #f8f9fa; /* Light grey background for content */
        }

        /* --- Sidebar Styling --- */
        .sidebar {
            min-height: 100vh;
            background-color: #ffffff;
            border-right: 1px solid #e5e7eb;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            width: 250px;
            display: flex;
            flex-direction: column;
        }

        .sidebar-brand {
            font-size: 1.75rem;
            font-weight: 700;
            color: #111827;
            padding: 1.5rem 1.5rem;
            text-decoration: none;
            display: block;
        }

        .nav-link {
            color: #4b5563; /* Gray-600 */
            font-weight: 500;
            padding: 0.75rem 1.5rem;
            display: flex;
            align-items: center;
            transition: all 0.2s;
            margin-bottom: 4px;
        }

        .nav-link i {
            font-size: 1.25rem;
            margin-right: 12px;
        }

        /* Active State (Matches images) */
        .nav-link.active {
            color: #10b981; /* Brand Green */
            background-color: #d1fae5; /* Light Green background */
            border-right: 3px solid #10b981; /* Optional accent */
        }

        .nav-link:hover:not(.active) {
            background-color: #f3f4f6;
            color: #111827;
        }

        .logout-container {
            margin-top: auto;
            border-top: 1px solid #e5e7eb;
            padding: 1rem 0;
        }

        .logout-link {
            color: #ef4444; /* Red */
            padding: 0.75rem 1.5rem;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            align-items: center;
        }
        .logout-link:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }

        /* --- Main Content Styling --- */
        .main-content {
            margin-left: 250px; /* Offset for sidebar */
            padding: 2rem 3rem;
        }

        .header-section {
            margin-bottom: 2rem;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 1.5rem;
        }

        /* Summary Cards */
        .stat-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            background: white;
            padding: 1.5rem;
            height: 100%;
            transition: transform 0.2s;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .icon-circle {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .bg-green-soft { background-color: #d1fae5; color: #10b981; }
        .bg-red-soft { background-color: #fee2e2; color: #ef4444; }
        
        .text-green { color: #10b981; }
        .text-red { color: #ef4444; }

        /* Placeholders */
        .content-placeholder {
            background: white;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            min-height: 350px;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <x-sidebar />

    <main class="main-content">
        
        <div class="header-section">
            <h6 class="text-secondary mb-1">Welcome back!</h6>
            <h2 class="fw-bold mb-0">Username</h2>
        </div>

        <div class="mb-4">
            <h2 class="fw-bold">Dashboard</h2>
            <p class="text-secondary">Overview of your financial status</p>
        </div>

        <div class="row g-4 mb-5">
            
            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary d-block mb-1">Total Income</span>
                            <h3 class="fw-bold mb-0">Rp 15,700,000</h3>
                        </div>
                        <div class="icon-circle bg-green-soft">
                            <i class="bi bi-arrow-up-right"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-green small fw-bold">
                        <i class="bi bi-graph-up-arrow me-1"></i>
                        <span>+12.5% from last month</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary d-block mb-1">Total Expense</span>
                            <h3 class="fw-bold mb-0">Rp 8,420,000</h3>
                        </div>
                        <div class="icon-circle bg-red-soft">
                            <i class="bi bi-arrow-down-right"></i>
                        </div>
                    </div>
                    <div class="d-flex align-items-center text-red small fw-bold">
                        <i class="bi bi-graph-down-arrow me-1"></i>
                        <span>+8.2% from last month</span>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <div>
                            <span class="text-secondary d-block mb-1">Total Income</span> <h3 class="fw-bold mb-0">Rp 6,830,000</h3>
                        </div>
                        <div class="icon-circle bg-green-soft">
                            <i class="bi bi-wallet2"></i> </div>
                    </div>
                    <div class="d-flex align-items-center text-green small fw-bold">
                        <i class="bi bi-graph-up-arrow me-1"></i>
                        <span>+12.5% from last month</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-placeholder mb-4">
            </div>
        
        <div class="content-placeholder">
            </div>

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>