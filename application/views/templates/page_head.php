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
        <link rel="stylesheet" href="<?php echo style_uri('bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo style_uri('bootstrap-theme.min.css') ?>">
        <link rel="stylesheet" href="<?php echo style_uri('custom_nav.css') ?>">
        <script src="<?php echo script_uri('jquery-2.1.1.min.js') ?>"></script>
        <script src="<?php echo script_uri('bootstrap.min.js') ?>"></script>
        
        <style>
            body{
                font-family:"Calibri Light";
                font-size: 20px;
                background-color: <?php if (isset($white)) {
	echo '#fff';
} else {
	echo '#eee';
} ?>;
            }
            
            .thumbnail {
                position:relative;
                overflow:hidden;
            }    
            
            .img-wrapper{
                background-color: white;
                background-repeat:no-repeat;
                background-size:contain;
                background-position:center; 
                min-height: 150px;
                text-align: center;
                color:#4472c4
            }
            .post-div{
                background-color: white;
                border-style:outset;
                border-width:2px;
                padding: 20px;
            } 
            .course-tile{
                margin-top: 20px;
                background-color: white;
                text-align: center;
                border-style:outset;
                border-width:3px;
                // margin-left:25px;
            }           
            .course-tile-pic-caption{
                width:100%;
                height:100%;
                background:rgba(0,0,0,0.3);
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
            #cover{ 
                position:fixed; 
                top:0; 
                left:0; 
                background:rgba(0,0,0,0.5); 
                z-index:5; 
                width:100%; height:100%; display:none; 
            }  
            #addcourseScreen 
            { 
                height:500px;
                width:600px; margin:0 auto; position:relative; z-index:10; display:none; 
                border:5px solid #cccccc; border-radius:10px;
                background:white;
            } 
            #addcourseScreen:target, #addcourseScreen:target + #cover
            { 
                display:block;
                opacity:2; 
            }
            .cancel { 
                display:block; position:absolute; top:3px; right:2px;
                color:black; height:30px; width:35px; font-size:30px; text-decoration:none; text-align:center; font-weight:bold; 
            } 
            .formScreen
            {
                display:block; 
                position:absolute;
                padding:20px;
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
