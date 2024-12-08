<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="public/assets/css/index.css">
    <title>Improved Sidebar Layout</title>

</head>
<body>
<div id="viewport">
    <!-- Sidebar -->
    <div id="sidebar">
        <header>My App</header>
        <ul class="nav">
            <li>
                <a href="#">
                    <i class="material-icons">dashboard</i> Dashboard
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">link</i> Shortcuts
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">widgets</i> Overview
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">event</i> Events
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">info</i> About
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">settings</i> Services
                </a>
            </li>
            <li>
                <a href="#">
                    <i class="material-icons">contact_mail</i> Contact
                </a>
            </li>
        </ul>
    </div>

    <!-- Content -->
    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="navbar-toggler" id="sidebarToggle">
                <i class="material-icons">menu</i>
            </button>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="material-icons text-danger">notifications</i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">Test User</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container-fluid">
            <h1>Welcome to My App</h1>
            <p>Ensure all page content is within the <code>#content</code> section for proper layout.</p>
        </div>
    </div>
</div>

<script>
    document.getElementById('sidebarToggle').addEventListener('click', function () {
        document.getElementById('sidebar').classList.toggle('active');
    });
</script>
</body>
</html>