<style type="text/css">
.navbar{
  margin-bottom:0;
  border:none;
}

.navbar-brand .glyphicon{
  margin-right:6px;
}

.hero{
  background-size:cover;
  border:none;
}

@media (min-width:992px) {
  .hero .get-it{
    text-align:right;
    margin-top:80px;
    padding-right:30px;
  }
}

@media (max-width:992px) {
  .hero .get-it{
    text-align:center;
  }
}

@media (max-width:992px) {
  .hero .phone-preview{
    text-align:center;
  }
}

.hero .get-it h1, .hero .get-it p{
  color:#bfbfbf;
  text-shadow:1px 2px 3px rgba(0, 0, 0, 0.18)
  margin-bottom:40px;
}

.hero .get-it .btn{
  margin-left:10px;
  margin-bottom:10px;
  text-shadow:none;
}

div.iphone-mockup{
  position:relative;
  max-width:250px;
  margin:20px;
  display:inline-block;
}

.iphone-mockup img.device{
  width:100%;
  height:auto;
}

.iphone-mockup .screen{
  position:absolute;
  width:88%;
  height:77%;
  top:12%;
  border-radius:2px;
  left:6%;
  border:1px solid #444;
  background-color:#aaa;
  overflow:hidden;
  background:url(<?php echo base_url('assets/images/CaptureLogin-1.png')?>);
  background-size:cover;
  background-position:center;
}

.iphone-mockup .screen:before{
  content:'';
  background-color:#fff;
  position:absolute;
  width:70%;
  height:140%;
  top:-12%;
  right:-60%;
  transform:rotate(-19deg);
  opacity:0.2;
}

.icon-feature{
  text-align:center;
}

.icon-feature .glyphicon{
  font-size:60px;
}

section.features{
  background-color:#369;
  padding:40px 0;
  color:#fff;
}

.features h2{
  color:#fff;
}

.features .icon-features{
  margin-top:15px;
}

.testimonials blockquote{
  text-align:center;
}

section.testimonials{
  margin:50px 0;
}

.site-footer{
  padding:20px 0;
  text-align:center;
}

@media (min-width:768px) {
  .site-footer h5{
    text-align:left;
  }
}

.site-footer h5{
  color:inherit;
  font-size:20px;
}

.site-footer .social-icons a:hover{
  opacity:1;
}

.site-footer .social-icons a{
  display:inline-block;
  width:32px;
  border:none;
  font-size:20px;
  border-radius:50%;
  margin:4px;
  color:#fff;
  text-align:center;
  background-color:#798FA5;
  height:32px;
  opacity:0.8;
  line-height:32px;
}

@media (min-width:768px) {
  .site-footer .social-icons{
    text-align:right;
  }
}


</style>
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand navbar-link" href="#"><img src="<?php echo base_url() ?>assets/images/coat_of_arms.png" width="25" height="25" /> NVIP KENYA</a>
                <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
            </div>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="active" role="presentation"><a class="text-success bg-info" href="<?php echo base_url('users')?>">CHANJO eLMIS Platform Login</a></li>
                    <li role="presentation"><a href="#">e-Resources</a></li>
                    <li role="presentation"><a href="#">Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="jumbotron hero">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-md-push-7 phone-preview">
                    <div class="iphone-mockup"><img src="<?php echo base_url() ?>assets/images/iphone.svg"" width="100" height="20" class="device">
                        <div class="screen"><img src="<?php echo base_url() ?>assets/images/CaptureLogin-1.png" width="220" height="390"></div>
                    </div>
                </div>
                <div class="col-md-6 col-md-pull-3 get-it">
                    <h1>Introducing the CHANJO eLMIS</h1>
                    <p class="lead">As a National Strategic Program and for efficient and effective management of immunization services in Kenya, the EPI program requires a tool to aggregate all immunization indicators and provide managers at all levels with an early response mechanism and highlights areas to focus on.</p>
                    <p><a class="btn btn-primary btn-lg" role="button" href="#"> SIGN UP TO ACCESS THE SYSTEM</a><a class="btn btn-success btn-lg" role="button" href="<?php echo base_url('users')?>">I ALREADY HAVE PASSWORD</a></p>
                </div>
            </div>
        </div>
    </div>
    <section class="features">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Core Achievements in 2016</h2>
                    <p>"The national team congratulates everyone who was invovled in and parrticipated to make the activities a success. Thanks for serving the nation and saving the lives of our children" Dr Maree - Head NVIP</p>
                </div>
                <div class="col-md-6">
                    <div class="row icon-features">
                        <div class="col-xs-4 icon-feature">
                            <p style="padding-top:48px">Cold Chain Inventory 2016 </p>
                        </div>
                        <div class="col-xs-4 icon-feature">
                            <p style="padding-top:48px">Roll Out of Fridge Tags in 95% of Health Facilities</p>
                        </div>
                        <div class="col-xs-4 icon-feature">
                            <p style="padding-top:48px">Successful switch to bOPV and introduction of IPC</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="site-footer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <h5>NVIP © 2016</h5></div>
            </div>
        </div>
    </footer>
   


</body></html>