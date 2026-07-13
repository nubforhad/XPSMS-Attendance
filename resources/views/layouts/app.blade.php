<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>@yield('title','XPSMS Attendance')</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet" />

        <style>
            body {
                overflow-x: hidden;

                background: #f8f9fa;
            }

            /* Sidebar */

            .sidebar {
                width: 260px;

                min-width: 260px;

                min-height: 100vh;

                transition: 0.3s;
            }

            /* Main Content */

            .content-area {
                flex: 1;

                min-width: 0;

                transition: 0.3s;
            }

            /* Sidebar Menu */

            .nav-link {
                padding: 10px 15px;

                border-radius: 6px;

                color: #fff !important;

                margin-bottom: 5px;
            }

            .nav-link:hover {
                background: #343a40;
            }

            /* Navbar */

            .navbar {
                min-height: 60px;
            }

            /* Table Responsive */

            .table-responsive {
                overflow-x: auto;
            }

            .table th,
            .table td {
                white-space: nowrap;
            }

            /* Mobile */

            @media (max-width: 768px) {
                .sidebar {
                    position: fixed;

                    top: 0;

                    left: -260px;

                    z-index: 1050;
                }

                .sidebar.active {
                    left: 0;
                }

                .content-area {
                    width: 100%;
                }

                .overlay {
                    display: none;

                    position: fixed;

                    inset: 0;

                    background: rgba(0, 0, 0, 0.5);

                    z-index: 1040;
                }

                .overlay.active {
                    display: block;
                }
            }
        </style>
    </head>

    <body>
        <div class="d-flex">
            {{-- Sidebar --}}

            <div class="sidebar bg-dark text-white p-3" id="sidebar">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">XPSMS</h5>

                    <button class="btn btn-sm btn-light d-md-none" onclick="toggleMenu()">
                        <i class="bi bi-x"></i>
                    </button>
                </div>

                <hr />

                <ul class="nav flex-column">
                    <li>
                        <a href="{{ route('dashboard') }}" class="nav-link">
                            <i class="bi bi-speedometer2 me-2"></i>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('company.index') }}" class="nav-link">
                            <i class="bi bi-building me-2"></i>
                            Company
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('branch.index') }}" class="nav-link">
                            <i class="bi bi-diagram-3 me-2"></i>
                            Branch
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('department.index') }}" class="nav-link">
                            <i class="bi bi-diagram-3 me-2"></i>
                            Department
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('designation.index') }}" class="nav-link">
                            <i class="bi bi-diagram-3 me-2"></i>
                            Designation
                        </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link">
                            <i class="bi bi-cpu me-2"></i>
                            Device
                        </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link">
                            <i class="bi bi-people me-2"></i>
                            Employee
                        </a>
                    </li>
                </ul>
            </div>

            {{-- Overlay Mobile --}}

            <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

            {{-- Main Area --}}

            <div class="content-area">
                {{-- Header/Navbar --}}

                <nav class="navbar bg-white shadow-sm px-3">
                    <button class="btn btn-dark d-md-none" onclick="toggleMenu()">
                        <i class="bi bi-list"></i>
                    </button>

                    <span class="ms-3 fw-semibold"> Attendance Cloud </span>

                    <div class="ms-auto">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-danger btn-sm">
                                <i class="bi bi-box-arrow-right"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                </nav>

                {{-- Page Content --}}

                <main class="p-3 p-md-4">@yield('content')</main>
            </div>
        </div>

        <script>
            function toggleMenu() {
                document.getElementById("sidebar").classList.toggle("active");

                document.getElementById("overlay").classList.toggle("active");
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
