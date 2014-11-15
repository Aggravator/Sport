<html>
    <head>
        <meta charset="utf-8">
        <title>registration</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <style type="text/css">
            .center{
                margin-left: auto;
                margin-right: auto;
            }
            .gradient-grey{
                background: #ffffff; /* Old browsers */
                background: -moz-linear-gradient(top,  #ffffff 0%, #e5e5e5 100%); /* FF3.6+ */
                background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ffffff), color-stop(100%,#e5e5e5)); /* Chrome,Safari4+ */
                background: -webkit-linear-gradient(top,  #ffffff 0%,#e5e5e5 100%); /* Chrome10+,Safari5.1+ */
                background: -o-linear-gradient(top,  #ffffff 0%,#e5e5e5 100%); /* Opera 11.10+ */
                background: -ms-linear-gradient(top,  #ffffff 0%,#e5e5e5 100%); /* IE10+ */
                background: linear-gradient(to bottom,  #ffffff 0%,#e5e5e5 100%); /* W3C */
                filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#e5e5e5',GradientType=0 ); /* IE6-9 */
            }
            .container{
                margin-left:auto;
                margin-right:auto;
                width:900px;
                display:table;
            }
            .nav-bar{
                display:block;
                margin: 10px 0px 20px 0px;
            }
            .nav-bar-inner{
                border: 1px solid #d4d4d4;
                height: 40px;
                padding:0px 10px 0px 0px;
                -webkit-border-radius: 4px;
                -moz-border-radius: 4px;
                border-radius: 4px;
            }
            .brand{
                float: left;
                font-weight:600;
                font-size: 20px;
                padding: 10px 20px 10px 20px;
                color: #777777;
                text-decoration: none;
            }
            .right-menu{
                float:right;
                list-style:none;
                margin:0px;
            }
            .right-menu li{
                display:inline-block;
                font-size: 20px;
                padding: 10px 10px 10px 10px;
                color: #777777;
                cursor:pointer;
            }
            .page-header{
                margin:20px 0px 20px 0px;
                border-bottom: solid 1px #999999;
            }
            .page-header .head-text{
                font-size:40px;
                margin: 20px;
            }
            .authority-form .pure-control-group label{
                width:20em;
            }
            .authority-form .pure-button{
                margin-top:20px;
                margin-left:345px;
            }
            .authority-form input{
                width:216px;
                height:36px;
            }
            .authority-form .select-field{
                width:216px;
                line-height:36px;
            }
            .select-field{
                display: inline-block;
                border: 1px solid #ccc;
                box-shadow: inset 0 1px 3px #ddd;
                border-radius: 4px;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                color: #aaaaaa;
                position:relative;
            }
            .select-field a{
                display:block;
                height:100%;width:100%;
                cursor:pointer;
            }
            .select-field a span {
                margin-right: 26px;
                margin-left: 10px;
                cursor:pointer;
                display: block;
                overflow: hidden;
                white-space: nowrap;
                -o-text-overflow: ellipsis;
                -ms-text-overflow: ellipsis;
                text-overflow: ellipsis;
            }
            .select-field div{
                position: absolute;
                right: 0;
                top: 0;
                bottom:0;
                display: block;
                height: 100%;
                width: 20px;
            }
            .pure-control-group label{
                vertical-align: top !important;
                padding: 10px 0px 5px 0px;
            }
            .pure-control-group .add-club{
                padding-left: 10px;
                color: #0000bb;
                cursor: pointer;
            }
            
        </style>
    </head>
    <body style="background-color: #ffffff">
        <div class="container">
            <div class="nav-bar">
                <div class="nav-bar-inner gradient-grey">
                    <a class="brand" href="#">Самбо-70</a>
                    <ul class="right-menu">
                        <li>Вход</li>
                    </ul>
                </div>
            </div>
            <div class="page-header">
                <h2 class="head-text">Регистрация</h2>
            </div>
            <form class="pure-form pure-form-aligned authority-form">
                <fieldset>
                    <div class="pure-control-group">
                        <label for="email">Email</label>
                        <input id="email" type="email" placeholder="Email">
                    </div>
                    <div class="pure-control-group">
                        <label for="password">Пароль</label>
                        <input id="password" type="password" placeholder="Пароль">
                    </div>
                    <div class="pure-control-group">
                        <label for="password">Подтверждение</label>
                        <input id="password" type="password" placeholder="Подтверждение">
                    </div></br>
                    <div class="pure-control-group">
                        <label for="password">Фамилия</label>
                        <input id="password" type="password" placeholder="Фамилия">
                    </div>
                    <div class="pure-control-group">
                        <label for="password">Имя</label>
                        <input id="password" type="password" placeholder="Имя">
                    </div>
                    <div class="pure-control-group">
                        <label for="password">Отчество</label>
                        <input id="password" type="password" placeholder="Отчество">
                    </div>
                    <div class="pure-control-group">
                        <label for="password">Клуб</label>
                        <div class="select-field">
                            <a style="">
                                <span>Выберите клуб</span><abbr class="select2-search-choice-close" style="display: none;"></abbr> <div><b>▼</b></div>
                            </a>
                        </div>
                        
                    </div>
                    <div class="pure-control-group"><label></label><a  class="pure-input-1-2 add-club">Добавить клуб</a></div>
                    <div class="pure-control-group">
                        <label for="password">Должность</label>
                        <input id="password" type="password" placeholder="Должность">
                    </div>
                    <button type="submit" class="pure-button pure-button-primary submit-button">Зарегестрироваться</button>
                </fieldset>
            </form>
        </div>
    </body>
</html>