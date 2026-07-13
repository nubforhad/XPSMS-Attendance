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
            }

            .sidebar {
                width: 260px;
                min-height: 100vh;
                transition: 0.3s;
            }

            .content-area {
                margin-left: 260px;
                transition: 0.3s;
            }

            .nav-link {
                padding: 10px 15px;
                border-radius: 5px;
            }

            .nav-link:hover {
                background: #343a40;
            }

            @media (max-width: 768px) {
                .sidebar {
                    position: fixed;
                    left: -260px;
                    top: 0;
                    z-index: 1050;
                }

                .sidebar.active {
                    left: 0;
                }

                .content-area {
                    margin-left: 0;
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
                        <a href="{{ route('dashboard') }}" class="nav-link text-white">
                            <i class="bi bi-speedometer2"></i>
                            Dashboard
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('company.index') }}" class="nav-link text-white">
                            <i class="bi bi-building"></i>
                            Company
                        </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-diagram-3"></i>
                            Branch
                        </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-cpu"></i>
                            Device
                        </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link text-white">
                            <i class="bi bi-people"></i>
                            Employee
                        </a>
                    </li>
                </ul>
            </div>

            <div class="overlay" id="overlay" onclick="toggleMenu()"></div>

            {{-- Main Area --}}

            <div class="content-area flex-grow-1">
                <nav class="navbar navbar-expand bg-light shadow-sm px-3">
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
