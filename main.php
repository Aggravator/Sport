<?php
    require_once 'mainlib.php';
    global $app;
?>
<html class="ng-app:App" id="ng-app" ng-app="App" xmlns:ng="http://angularjs.org">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Пользователь</title>
         <!--[if lte IE 7]>
             <script src="/path/to/json2.js"></script>
         <![endif]-->
         <!--[if lte IE 8]>
          <script>
            document.createElement('ng-include');
            document.createElement('ng-pluralize');
            document.createElement('ng-view');
    
            // Optionally these for CSS
            document.createElement('ng:include');
            document.createElement('ng:pluralize');
            document.createElement('ng:view');
          </script>
        <![endif]-->
        <script type="text/javascript">
            usr=<?php echo json_encode($app::$user->getPersonInfo()); ?>;
        </script>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <script src="scripts/moment.js"></script>
        <script src="scripts/pikaday.js"></script>
        <script src="angular/angular.js"></script>
        <link rel="stylesheet" href="css/andrey.css">
        <link rel="stylesheet" href="css/pikaday.css">
        <link rel="stylesheet" href="css/base.css">

        <style type="text/css">
            .left-column{
                width:250px;
                float:left;
            }
            .left-column .inner{
                border: 1px solid #d4d4d4;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                height: 500px;
                overflow:none;
            }
            .left-column .inner .category{
                width: 100%;
                text-align:left;
                padding:0px;
                font-size:20px;
                line-height:30px;
                height:30px;
                background-color: #dfdfdf;
                border-bottom: 2px solid #ffffff;
                position:relative;
                cursor:pointer;
            }
            .left-column .inner .category:hover{
                background-color: #d5d5d5;
            }
            .left-column .inner .category .arrow{
                float:left;
                height:30px;
                width:30px;
                text-align:center;
            }
            .left-column .inner .category .name{
                float:left;
            }
            .left-column .inner .category .counts{
                padding:0px 10px 0px 0px;
                float:right;                
            }
            .left-column .inner .category .counts div{
                display:inline;
                font-size:18px;
            }
            .left-column .inner .arrow:before{
                content:"►";
            }
            .left-column .inner .envelop .arrow:before{
                content:"▼";
            }
            .left-column .inner .tournament-list{
                width:100%;
                list-style:none;
                margin:0px;
                padding:0px 0px 0px 0px;
                font-size: 14px;
                height: 406px;
                overflow-y:auto;
            }
            .left-column .inner .tournament-list li{
                padding:5px 0px 0px 15px;
                cursor:pointer; 
            }
            .left-column .inner .tournament-list li:hover{
                background-color: #f3f3f3;
            }
            .right-column{
                margin-left:250px;
                text-align:center;
                padding:0px 10px 10px 10px;
            }
            .participants{
                display:inline-block;
                text-align:left;
            }
            .participants .pure-table{
            	margin-bottom:10px;
            	font-size:14px;
            }
            .participants .pure-table th{
                text-align:center;
            }
            .participants .pure-table .pic-cell{
                cursor:pointer;
                padding:0px;
            }
            .participants .pure-table td{
                text-align:center;
            }
            a{
                text-decoration:none;
                cursor:pointer;
                color:#0000EE;
            }

            .dialog{
                border:1px solid #C8C8C8;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
                padding:0px;
                text-align:left;
            }
            .dialog .header{
                height:30px;
                background-color: #dddddd;
                color:#aaaaaa;
                font-size:24px;
                border-bottom:1px solid #aaaaaa;
            }
            .dialog .header .text{
                color:#555555;
                font-size:18px;
                float:left;
                line-height:30px;
                margin-left:10px;
            }
            .dialog .header .close-button{
                float:right;
                height:100%;
                line-height:30px;
                width:30px;
                text-align:center;
                border-left:1px solid #aaaaaa;
                cursor:pointer;
            }
            .dialog .header .close-button:hover{
                color:#555555;
            }
            .dialog .content{
                padding:10px 5px 10px 5px;
                background-color:#ffffff;
            }
            .dialog .content select{height:36px;}
        </style>
    </head>
    <body>
        <div class="container">
            <div class="nav-bar">
                <div class="nav-bar-inner gradient-grey">
                    <ul class="nav-path lpath">
                        <li>САМБО-70</li>
                    </ul>
                    <ul class="right-menu">
                        <li onclick="window.location.assign('exit.php')">Выход</li>
                    </ul>
                    <span class="fio">{{user.surname}} {{user.name}} {{user.patronymic}}</span>
                </div>
            </div>
            <div ng-include="'templates/couch-start.html'"></div>
            <div class="footer">
                <p>
                    <a href="http://xn---70-5cdf9dpu.xn--p1ai/" target="_blank">САМБО-70</a>
                </p>
            </div>
        </div>
        
        <script src="scripts/andrey.js"></script>
        <?php
            require('ModalWindows\add-sportman.template');
            require('ModalWindows\edit-sportman.template');
        ?>
        <script src="scripts/app.js"></script>
    </body>
</html>