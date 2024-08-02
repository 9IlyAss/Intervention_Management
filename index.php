<?php
include("dbconn.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar Menu</title>
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap">
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
                        <a id="pages/Home.php" class="d-flex align-items-center text-white link ">
                            <ion-icon name="home-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Home</span>
                        </a>
                    </li>
                    <li>
                        <a id="pages/Maintenance.php" class="d-flex align-items-center text-white link">
                            <ion-icon name="construct-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Maintenance</span>
                        </a>
                    </li>
                    <li>
                        <a id="pages/Security.php" class="d-flex align-items-center text-white link">
                            <ion-icon name="lock-closed-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Security</span>
                        </a>
                    </li>
                    <li>
                        <a id="pages/Support.php" class="d-flex align-items-center text-white link">
                            <ion-icon name="people-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Support</span>
                        </a>
                    </li>
                    <li>
                        <a id="pages/Analysis.php" class="d-flex align-items-center text-white link">
                            <ion-icon name="bar-chart-outline" class="mr-2 icon-lg"></ion-icon>
                            <span class="title">Analysis</span>
                        </a>
                    </li>
                </ul>

                <!-- Sign Out link -->
                <a id="pages/SignOut.php" class="d-flex align-items-center justify-content-center text-white mt-auto" id="Signout">
                    <ion-icon name="log-out-outline" class="mr-2 icon-lg"></ion-icon>
                    <span class="title">Sign Out</span>
                </a>

            </div>

            <!-- Main Content -->
            <div class="col-md-9 content">
        
                
            </div>
        </div>
    </div>

    <!-- =========== Scripts =========  -->
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
    let list = $("li");
    
    function activeLink() {
        list.removeClass('hovered');  // Remove 'hovered' class from all list items
        $(this).addClass('hovered');  // Add 'hovered' class to the current item
    }
    list.mouseenter(activeLink);
     
                $.ajax({
                    url: 'pages/Home.php',
                    success: function(data) {
                        $('.content').html(data);
                    },
                    error: function() {
                        $('.content').html('<p>Error loading content.</p>');
                    }
                });
    
            
    $('.link').on('click', function () {
                var url = $(this).attr('id');
                $.ajax({
                    url: url,
                    success: function(data) {
                        $('.content').html(data);
                    },
                    error: function() {
                        $('.content').html('<p>Error loading content.</p>');
                    }
                });
            });
});
    </script>
    <!-- Ionic Framework -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>