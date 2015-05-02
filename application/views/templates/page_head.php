<?php
/*
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>
    
<!DOCTYPE html>
<html>
    <head>
        <title>UniLog | <?php echo $page_title; ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="<?php echo style_path('bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo style_path('bootstrap-theme.min.css') ?>">
        <link rel="stylesheet" href="<?php echo style_path('custom_nav.css') ?>">
        <script src="<?php echo script_path('jquery-2.1.1.min.js') ?>"></script>
        <script src="<?php echo script_path('bootstrap.min.js') ?>"></script>
        <style>
            body{
                font-family:"Calibri Light";
                font-size: 20px;
                background-color: <?php if (isset($white)) { echo '#fff'; } else { echo '#eee'; } ?>;
            }
            
            .thumbnail {
                position:relative;
                overflow:hidden;
            }
            
            .courses{
                margin-top: 20px;
                background-color: white;
                text-align: center;
                border-style:outset;
                border-width:5px;
               // margin-left:25px;
            }
            
            .pic-caption{
                width:100%;
                height:100%;
                background:rgba(0,0,0,0.5);
                position:absolute;
                top:0;
                right:0;
                display: none;
                text-align:center;
                z-index:2;                
            }
            .caption {
                position:absolute;
                top:0;
                right:0;
                background-color:lightgray;
                display: none;
                text-align:center;
                //color:#fff !important;
                z-index:2;
            }
            
            a:hover, a:focus {
                text-decoration: none;
            }
            
            .no-select {
                -webkit-touch-callout: none;
                -webkit-user-select: none;
                -khtml-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
            }
        </style>
    </head>
        
    <body>
        <div class="container">
            <div style="min-height:500px">