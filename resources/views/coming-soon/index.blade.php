<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="ThemeStarz">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" >
    <link rel="stylesheet" href="{{asset('')}}comingsoon/css/bootstrap.css" type="text/css">
    <link rel="stylesheet" href="{{asset('')}}comingsoon/css/font-awesome.css" type="text/css">
    <link rel="stylesheet" href="{{asset('')}}comingsoon/css/parallax-hero.css">
    <link rel="stylesheet" href="{{asset('')}}comingsoon/css/magnific-popup.css">
    <link rel="stylesheet" href="{{asset('')}}comingsoon/css/style.css">
    <link rel="stylesheet" href="{{asset('')}}comingsoon/css/user.css">
    <title>Coming Soon</title>
</head>
<body class="side-panel-light has-loading-screen color-theme-blue" data-background-color="#002254">
    <div id="page">
        <div class="cd-background-wrapper">
            <figure class="cd-floating-background">
                <div class="base-layer">
                    <canvas id="displayCanvas"></canvas>
                </div>
                <div class="layer animate pointer-events-none" data-layer-depth="550">
                    <div id="particles-js"></div>
                </div>
                <div class="layer animate" data-layer-depth="300">
                    <div id="content">
                        <div class="content-wrapper">
                            <div class="container">
                                <div class="heading">
                                    <h3>Eshopping Nepal</h3>
                                    <h1 class="large">Coming Soon !!!</h1>
                                    <!-- <p>Fresh design and content is preparing right now.<br>Don't forget to subscribe to stay tuned!</p> -->
                                </div>
                                <div class="brand">
                                    <span>Powered By:</span>
                                    <a href="https://nectardigit.com/" target="_blank">
                                        <img src="{{asset('')}}comingsoon/images/nectarlogo.png" alt="images">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </figure>
        </div>
    </div>
    <script src="{{asset('')}}comingsoon/js/jquery-2.1.1.js"></script>
    <script type="text/javascript" src="{{asset('')}}comingsoon/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
    <script src="{{asset('')}}comingsoon/js/pace.min.js"></script>
    <script src="{{asset('')}}comingsoon/js/jquery.validate.min.js"></script>
    <script src="{{asset('')}}comingsoon/js/parallax-hero.js"></script>
    <script src="{{asset('')}}comingsoon/js/modernizr.js"></script>
    <script src="{{asset('')}}comingsoon/js/jquery.magnific-popup.min.js"></script>
    <script src="{{asset('')}}comingsoon/js/particle-sphere.js"></script>
    <script src="{{asset('')}}comingsoon/js/custom.js"></script>
    <script type="text/javascript">
        // RGB Color
        var r = 51;
        var g = 200;
        var b = 240;
        var backgroundColor = "#002254";
        window.addEventListener("load", particleSphree(r,g,b, backgroundColor), false);
        var latitude = 34.038405;
        var longitude = -117.946944;
        var markerImage = "{{asset('')}}comingsoon/img/map-marker.png";
        var mapTheme = "light";
        var mapElement = "map-contact";
        google.maps.event.addDomListener(window, 'load', simpleMap(latitude, longitude, markerImage, mapTheme, mapElement));
    </script>
</body>
</html>