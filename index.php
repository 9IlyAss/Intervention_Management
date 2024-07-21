<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Menu</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-3 sidebar">

                <div class="d-flex align-items-center justify-content-between mb-4">
                    <a href="#" class="d-flex align-items-center text-white">
                        <img class="logoBSRI" src="Img/BSRIQZ-01.png" alt="Logo">
                        <span class="title h4 mb-0 ml-2">Intervention Management</span>
                    </a>
                </div>

                <ul class="list-unstyled mt-3">
                    <li>
                        <a href="#Home" class="d-flex align-items-center text-white Home">
                            <ion-icon name="home-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li>
                        <a href="#Maintenance" class="d-flex align-items-center text-white Maintenance">
                            <ion-icon name="construct-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Maintenance</span>
                        </a>
                    </li>
                    <li>
                        <a href="#Security" class="d-flex align-items-center text-white Security">
                            <ion-icon name="lock-closed-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Security</span>
                        </a>
                    </li>
                    <li>
                        <a href="#Support" class="d-flex align-items-center text-white Support">
                            <ion-icon name="people-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Support</span>
                        </a>
                    </li>
                    <li>
                        <a href="#Analysis" class="d-flex align-items-center text-white Analysis">
                            <ion-icon name="bar-chart-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Analysis</span>
                        </a>
                    </li>
                </ul>

                <!-- Sign Out link -->
                <a href="#" class="d-flex align-items-center justify-content-center text-white mt-auto" id="Signout">
                    <ion-icon name="log-out-outline" class="mr-2 icon-lg"></ion-icon>
                    <span class="title">Sign Out</span>
                </a>

            </div>

            <!-- Main Content -->
            <div class="col-md-9 content">
                <?php
                include 'pages/Maintenance.html';
                ?>
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="jquery/jquery-3.7.1.min.js"></script>
    <script src="index.js"></script>
    <!-- Ionic Framework -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>