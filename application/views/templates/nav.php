<?php

/* 
 * UniLog project.
 * UniLog is an on-line educational courseware for the University of Engineering and Technology, Lahore.
 * Copyright 2015 log inc.
 */
?>


<nav class="navbar navbar-default" >
    <div class="container-fluid">
        <div class="col-md-3 navbar-header" style="padding:10px">            
                <?php
		$a = '<a href="' . base_url() . '" >';
		$a .= img(image_path('unilog_logo.png'), FALSE, 'width="100" alt="unilog logo"');
		echo $a . '</a>';
		?>
        </div>
        <div class="col-md-9">
            <div class ="row">
                <div style="float: left;padding-top: 10px">
                    <?php $a = img(image_path('schoolbag.png'), FALSE, 'width="35" alt="school_bag"');
                    echo $a ;
                    ?>
                </div>
                <div class="col-md-6" style="padding-top: 10px" >
                    <form role="search">
                        <div class="input-group">
                            
                            <input type="text" class="form-control" placeholder="Search My Bag" name="srch-term" id="srch-term">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                            </div>
                        </div>
                    </form>
                    
                </div>
           
            <div style="font-size: 17px">
                <ul class="nav navbar-nav navbar-right" >
                    
                    
                    <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            <strong>Ahmar Sultan</strong> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Profile</a></li>
                            <li><a href="#">Help</a></li>
                            <li><a href="#">Log Out</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><strong>Notice Board</strong></a></li>
                    
                    
                </ul>
            </div>
            
            </div>
        </div>
        
</nav>

