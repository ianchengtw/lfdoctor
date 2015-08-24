<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mobile Factory Test</title>

    <!-- Bootstrap Core CSS - Uses Bootswatch Flatly Theme: http://bootswatch.com/flatly/ -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/freelancer.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="css/mobile_factory.css" rel="stylesheet">
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#page-top">Mobile Factory Test</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="http://www.ianchengtw.com/">
                        	<img class="img-responsive" src="img/profile.png" style="width:50px;height:50px;display:inline-block;">
                        	About Me
                        </a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h1>Is the picked time inside the time range?</h1>
                </div>
                <div class="col-sm-6">
                    <div class="col-lg-12 text-center">
                        <h3>Time Range</h3>
                        <hr class="star-light">
                        <div class="clock-container col-lg-10 col-lg-offset-1">
                        <span class="btn btn-xs btn-outline mfQuestion">
                            <h3>
                                <span id="qStart">22:00</span>
                                - 
                                <span id="qEnd">02:00</span>
                            </h3>
                        </span>
                        </div>
                    </div>
                    <div class="col-lg-12 text-center">
                        <h3>Pick a time hour</h3>
                        <hr class="star-light">
                        <div class="col-lg-10 col-xs-offset-1">
                            <div class="col-lg-12 btn-detect-container">
                                <span class="btn btn-xs btn-outline">00</span>
                                <span class="btn btn-xs btn-outline">01</span>
                                <span class="btn btn-xs btn-outline">02</span>
                                <span class="btn btn-xs btn-outline">03</span>
                                <span class="btn btn-xs btn-outline">04</span>
                                <span class="btn btn-xs btn-outline">05</span>
                                <span class="btn btn-xs btn-outline">06</span>
                                <span class="btn btn-xs btn-outline">07</span>
                                <span class="btn btn-xs btn-outline">08</span>
                                <span class="btn btn-xs btn-outline">09</span>
                                <span class="btn btn-xs btn-outline">10</span>
                                <span class="btn btn-xs btn-outline">11</span>
                                <span class="btn btn-xs btn-outline">12</span>
                                <span class="btn btn-xs btn-outline">13</span>
                                <span class="btn btn-xs btn-outline">14</span>
                                <span class="btn btn-xs btn-outline">15</span>
                                <span class="btn btn-xs btn-outline">16</span>
                                <span class="btn btn-xs btn-outline">17</span>
                                <span class="btn btn-xs btn-outline">18</span>
                                <span class="btn btn-xs btn-outline">19</span>
                                <span class="btn btn-xs btn-outline">20</span>
                                <span class="btn btn-xs btn-outline">21</span>
                                <span class="btn btn-xs btn-outline">22</span>
                                <span class="btn btn-xs btn-outline">23</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="col-lg-12 text-center">
                        <h3>History</h3>
                        <hr class="star-light">
                        <span class="btn btn-xs btn-outline mfHistory">
                            <span class="title"></span>
                            <span class="content"></span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-above">
            <div class="container">
                <div class="row">
                    <div class="footer-col col-lg-12">
                        <h3>Around the Web</h3>
                        <ul class="list-inline">
                            <li>
                                <a href="https://www.facebook.com/winky.baoh" class="btn-social btn-outline" target="_blank"><i class="fa fa-fw fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="https://tw.linkedin.com/pub/ian-cheng/68/a33/900" class="btn-social btn-outline" target="_blank"><i class="fa fa-fw fa-linkedin"></i></a>
                            </li>
                            <li>
                                <a href="https://github.com/ianchengtw" class="btn-social btn-outline" target="_blank"><i class="fa fa-fw fa-github"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Copyright &copy; Ian Cheng 2015
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="js/classie.js"></script>
    <script src="js/cbpAnimatedHeader.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="js/freelancer.js"></script>
    <script src="js/mobile_factory.js"></script>

</body>

</html>
