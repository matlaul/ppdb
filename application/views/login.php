<?php $this->load->view('web/include/menu_web'); ?>   
</div>
</div>

<p>&nbsp;</p>   
<center><?php echo $message;?></center>
 <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Silahkan Masuk / Login</h3>
                    </div>
                    <div class="panel-body">
<?php echo form_open('web/validate_credentials');?>
                            <fieldset>
								<div>
											<p align="center"><font face="verdana" size="2" color="#333333"><?php  if(isset($_GET['gagal'])){ echo "&laquo;".$_GET['gagal']."&raquo;"; }?></font></p>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="email" name="nisn" type="text" autofocus required>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                         
                                <input type="submit" value="login" class="btn btn-lg btn-success btn-block" name="Login"/>
                            </fieldset>
<?php echo form_close();?>
                    </div>
                </div>
            </div>
        </div>
    </div>
 <?php $this->load->view('include/footer.php'); ?> 
