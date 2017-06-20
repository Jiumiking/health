<!DOCTYPE HTML>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo empty($this_setting['station_name'])?'':$this_setting['station_name']; ?></title>
    <link href="<?php echo base_url('images/icon.ico');?>" type="image/x-icon" rel="shortcut icon" />
    <!-- Css files -->
    <link href="<?php echo base_url('css/bootstrap.min.css');?>" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url('css/style.min.css');?>" rel="stylesheet">
</head>
<body>
    <div class="container-fluid content">
        <div class="row">
            <div id="content" class="col-sm-12 full">
            
                <div class="row box-error">
                
                    <div class="col-lg-12 col-md-12 col-xs-12">
                    <div class="text-center">
                        <h1>500</h1>
                        <h2>Unauthorized ...</h2>
                        <p>你没有权限访问当前页面</p>
                        <a href="javascript: history.go(-1)">
                            <button class="btn btn-default"><span class="fa fa-chevron-left"> Go Back</span></button>
                        </a>
                    </div>
                    
                    </div><!--/col-->
                
                </div><!--/row-->
        
            </div><!--/content-->	
        </div><!--/row-->
    </div><!--/container-fluid-->
</body>
</html>