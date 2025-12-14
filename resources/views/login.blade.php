<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finwise Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #FFFFFF 0%, #F5FBF8 50%, #F0FDF4 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Brand Colors */
        .text-brand { color: #10b981; }
        .bg-brand { background-color: #10b981; }
        .btn-brand {
            background-color: #10B881;
            color: white;
            font-weight: 500;
        }
        .btn-brand:hover {
            background-color: #059669;
            border-color: #059669;
            color: white;
        }

        /* Logo Styling */
        .logo-circle {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            font-size: 24px;
            color: white;
            margin: 0 auto 15px;
        }

        /* Custom Toggle Switch (Login/Register) */
        .auth-toggle {
            background-color: #f3f4f6;
            padding: 4px;
            border-radius: 8px;
            display: flex;
            margin-bottom: 20px;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }
        .auth-toggle a {
            flex: 1;
            text-align: center;
            padding: 8px;
            border-radius: 6px;
            text-decoration: none;
            color: #6b7280;
            font-size: 14px;
            font-weight: 500;
            transition: all 0.2s;
        }
        .auth-toggle a.active {
            background-color: white;
            color: #111827;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        /* Card Styling */
        .login-card {
            border: none;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            border-radius: 12px;
            padding: 20px;
        }

        .form-label {
            font-weight: 500;
            font-size: 0.9rem;
            color: #374151;
        }

        .form-control {
            padding: 0.6rem 0.75rem;
            border-color: #e5e7eb;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #10b981;
            box-shadow: 0 0 0 0.25rem rgba(16, 185, 129, 0.25);
        }

        ::placeholder {
            color: #9ca3af !important;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                
                <div class="text-center mb-4">
                    <div class="logo-circle bg-brand">
                        <i class="bi bi-wallet2"></i>
                    </div>
                    <h2 class="fw-bold mb-1">Finwise</h2>
                    <p class="text-secondary small">Manage your finances with ease</p>
                </div>

                <div class="auth-toggle">
                    <a href="#" class="active">Login</a>
                    <a href="#">Register</a>
                </div>

                <div class="card login-card bg-white">
                    <div class="card-body p-3">
                        <h5 class="fw-bold mb-1">Login</h5>
                        <p class="text-secondary small mb-4">Enter your credentials to access your account</p>
                        
                        <form>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" placeholder="john@example.com">
                            </div>

                            <div class="mb-4">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="••••••••">
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-brand py-2">Login</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>