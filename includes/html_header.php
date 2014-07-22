<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html<?php if(isset($declaration_entete_html)) echo $declaration_entete_html; ?>>
<head>
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
<base href="<?php echo BASE_URL; ?>" />
<link rel="shortcut icon" type="image/x-icon" href="<?php echo BASE_URL; ?>favicon.ico" />
<?php
  // on recupere meta
  $sql='select * from '.PREFIXE_BDD.'metatags where language="'.$_GET['language'].'"';
  $res=mysql_query($sql);
  $row=mysql_fetch_assoc($res); 
  define('META_TITLE',$row['titre']);
  define('META_DESCRIPTION',$row['description']);
  define('META_KEYWORDS',$row['mots']);
?>
<title><?php echo META_TITLE; ?></title>
<meta name="keywords" content="<?php echo META_KEYWORDS; ?>" />
<meta name="description" content="<?php echo META_DESCRIPTION; ?>" />
<meta name="revisit-after" content="1 days" />
<meta name="robots" content="index, follow" />
<?php
if(isset($header_article_facebook))
{
  echo $header_article_facebook;
}
?>
<link rel="shortcut icon" href="#">
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="libraries/chosen/chosen.min.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="libraries/pictopro-outline/pictopro-outline.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="libraries/pictopro-normal/pictopro-normal.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="libraries/colorbox/colorbox.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="libraries/jslider/bin/jquery.slider.min.css" media="screen, projection">
    <link rel="stylesheet" type="text/css" href="assets/css/carat.css" media="screen, projection">

    <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:100,400,700,400italic,700italic" rel="stylesheet" type="text/css"  media="screen, projection">
</head>
   <body>
  <div class="topbar gray">
  <div class="container">
    <div class="row">
            <div class="col-md-6 col-xs-12 header-top-left">
                <div>
                    <div class="news">
                        <div class="inner">
                                <ul class="news-list">
                                    <li>Chrysler plans new <a href="#">product</a> at Windsor, Ontario, plant, report says</li>
                                    <li>Tesla retail model faces new legal challenge in Ohio</li>
                                    <li>Toyota revealing new model</li>

                                </ul><!-- /.news-list -->
                        </div><!-- /.inner -->
                    </div><!-- /.news -->
                </div>
            </div>

            <div class="col-md-6 col-xs-12 header-top-right">
                <div>
                    <div class="social">
                        <div class="inner">
                                <ul class="social-links">
                                    <li class="social-icon google-plus"><a href="#">Google+</a></li>
                                    <li class="social-icon youtube"><a href="#">YouTube</a></li>
                                    <li class="social-icon twitter"><a href="#">Twitter</a></li>
                                    <li class="social-icon pinterest"><a href="#">Pinterest</a></li>
                                    <li class="social-icon facebook"><a href="#">Facebook</a></li>
                                </ul><!-- /.social-links -->
                        </div><!-- /.inner -->
                    </div><!-- /.social -->

                    <div class="languages">
                        <ul>
                            <li><a href="#"><img src="assets/img/flags/en.png" alt="#"></a></li>
                            <li><a href="#"><img src="assets/img/flags/ru.png" alt="#"></a></li>
                        </ul>
                    </div><!-- /.languages -->

                    <form class="navbar-form search-form" role="search">
                        <div class="input-group">
                          <input type="text" class="form-control" placeholder="Search" required="required">

                          <span class="input-group-btn">
                            <button type="submit" class="btn btn-default"><i class="icon icon-normal-magnifier"></i></button>
                          </span><!-- /.input-group-btn -->
                        </div><!-- /.input-group -->                     
                    </form><!-- /.search-form -->
                </div>
            </div><!-- /.col-md-5 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</div><!-- /.topbar -->

<header id="header">
  <div class="header-inner">
    <div class="container">
      <div class="row">
        <div class="col-md-12 clearfix">
          <div class="brand">
            <div class="logo">
              <a href="index-2.html">
                <img src="assets/img/logo.png" alt="Carat HTML Template">
              </a>
            </div><!-- /.logo -->

            <div class="slogan">Car Rental, Dealership,<br>Magazine Template</div><!-- /.slogan -->
          </div><!-- /.brand -->
          
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
          </button>

          <nav class="collapse navbar-collapse navbar-collapse" role="navigation">
            <ul class="navigation">
            <li><a href="index.html">Home</a></li>            

            <li class="menuparent has-regularmenu">
              <a href="magazine.html">Features</a>

              <div class="regularmenu">
                <ul class="regularmenu-inner">
                  <li><a href="detail.html"><i class="icon icon-normal-car"></i> Car Detail</a></li>
                                                                        <li><a href="filter.html"><i class="icon icon-normal-magnifier"></i> Search results</a></li>
                                                                        <li><a href="about.html"><i class="icon icon-normal-profile-checkbox"></i> About</a></li>
                  <li><a href="faq.html"><i class="icon icon-normal-collage-hat"></i> FAQ</a></li>
                  <li><a href="pricing.html"><i class="icon icon-normal-coins"></i> Pricing</a></li>
                  <li><a href="blog.html"><i class="icon icon-normal-question-mark"></i> Blog</a></li>
                  <li><a href="article.html"><i class="icon icon-normal-file-text"></i>Article Detail</a></li>
                  <li><a href="404.html"><i class="icon icon-normal-cog-wheel"></i>Page Not Found</a></li>
                </ul><!-- /.regularmenu-inner -->
              </div><!-- /.regularmenu -->
            </li>

            <li class="menuparent has-regularmenu">
              <a href="#">Reservation</a>

              <div class="regularmenu">
                <ul class="regularmenu-inner">
                  <li><a href="rental-1.html"><strong>1.</strong> Request Reservation</a></li>
                  <li><a href="rental-2.html"><strong>2.</strong> Select Your Car</a></li>
                  <li><a href="rental-3.html"><strong>3.</strong> Extra Features</a></li>
                  <li><a href="rental-4.html"><strong>4.</strong> Review &amp; Checkout</a></li>
                </ul><!-- /.regularmenu-inner -->
              </div><!-- /.regularmenu -->
            </li>

            <li><a href="magazine.html">Magazine</a></li>
            <li class="menuparent has-megamenu">
              <a href="#">Popular</a>

              <div class="megamenu">
                <div class="megamenu-inner clearfix">
                  <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="block random-cars">
                      <div class="title">
                        <h2>Popular Cars</h2>
                      </div><!-- /.title -->

                      <div class="items">
                        <div class="teaser-item-wrapper">
                          <div class="teaser-item">
                              <div class="title">
                                  <a href="detail.html">Toyota Landcruiser</a>
                              </div><!-- /.title -->

                              <div class="subtitle">Windsor Locks, CT </div><!-- /.subtitle -->

                              <div class="row">
                                  <div class="picture-wrapper col-md-4 col-sm-4 col-xs-4">
                                      <div class="picture">
                                          <a href="detail.html">
                                            <span class="hover">
                                              <span class="hover-inner">
                                                <i class="icon icon-normal-link"></i>
                                              </span><!-- /.hover-inner -->
                                            </span><!-- /.hover -->

                                              <img src="assets/img/content/toyota4.jpg" alt="#">
                                          </a>
                                      </div><!-- /.picture -->
                                  </div><!-- /.col-md-5 -->

                                  <div class="content-wrapper col-md-8 col-sm-8 col-xs-8">
                                      <div class="price">$9,799</div>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque.</p>
                                  </div><!-- /.col-md-7 -->
                              </div><!-- /.row -->
                          </div><!-- /.teaser-item -->
                        </div><!-- /.teaser-item-wrapper -->

                        <div class="teaser-item-wrapper">                       
                          <div class="teaser-item">
                              <div class="title">
                                  <a href="detail.html">Toyota Landcruiser</a>
                              </div><!-- /.title -->

                              <div class="subtitle">Windsor Locks, CT </div><!-- /.subtitle -->

                              <div class="row">
                                  <div class="picture-wrapper col-md-4 col-sm-4 col-xs-4">
                                      <div class="picture">
                                          <a href="detail.html">
                                            <span class="hover">
                                              <span class="hover-inner">
                                                <i class="icon icon-normal-link"></i>
                                              </span><!-- /.hover-inner -->
                                            </span><!-- /.hover -->

                                                                                                                            <img src="assets/img/content/toyota6.jpg" alt="#">
                                          </a>
                                      </div><!-- /.picture -->
                                  </div><!-- /.col-md-5 -->

                                  <div class="content-wrapper col-md-8 col-sm-8 col-xs-8">
                                      <div class="price">$9,799</div>
                                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate neque.</p>
                                  </div><!-- /.col-md-7 -->
                              </div><!-- /.row -->
                          </div><!-- /.teaser-item -->
                        </div><!-- /.teaser-item-wrapper -->
                      </div><!-- /.items -->
                    </div><!-- /.block -->        
                  </div>

                  <div class="col-md-3 col-sm-6">
                    <h2>Recent Posts</h2>

                    <div class="latest-reviews block">
                      <div class="block-inner">
                        <div class="inner">
                          <div class="item-wrapper">
                            <div class="item">
                              <div class="title">
                                <a href="detail.html">Toyota Landcruiser</a>
                              </div><!-- /.title -->

                              <div class="date">10/12/2013</div><!-- /.date -->

                              <div class="description">
                                <p>
                                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
                                </p>
                              </div><!-- /.description -->
                            </div><!-- /.item -->
                          </div><!-- /.item-wrapper -->

                          <div class="item-wrapper">
                            <div class="item">
                              <div class="title">
                                <a href="detail.html">Toyota RAV</a>
                              </div><!-- /.title -->

                              <div class="date">12/12/2013</div><!-- /.date -->

                              <div class="description">
                                <p>
                                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
                                </p>
                              </div><!-- /.description -->
                            </div><!-- /.item -->     
                          </div><!-- /.item-wrapper -->

                          <div class="item-wrapper">
                            <div class="item">
                              <div class="title">
                                <a href="detail.html">Toyota 4Runner</a>
                              </div><!-- /.title -->

                              <div class="date">20/12/2013</div><!-- /.date -->

                              <div class="description">
                                <p>
                                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent eu vulputate...
                                </p>
                              </div><!-- /.description -->
                            </div><!-- /.item -->     
                          </div><!-- /.item-wrapper -->
                        </div><!-- /.inner -->
                      </div><!-- /.block-inner -->
                    </div><!-- /.block -->                  
                  </div>

                  <div class="col-md-5 col-sm-12">
                    <h2>Our Brands</h2>               

                    <div class="brands block">
                      <div class="row">
                        <div class="col-md-6 col-sm-6">
                          <ul>
                            <li><a href="#"><img src="assets/img/brands/ford.png" alt="#"> Ford</a></li>
                            <li><a href="#"><img src="assets/img/brands/toyota.png" alt="#"> Toyota</a></li>
                            <li><a href="#"><img src="assets/img/brands/kia.png" alt="#"> Kia</a></li>
                            <li><a href="#"><img src="assets/img/brands/opel.png" alt="#"> Opel</a></li>
                            <li><a href="#">&nbsp;<img src="assets/img/brands/bmw.png" alt="#"> BMW</a></li>
                          </ul>
                        </div><!-- /.col-md-6 -->

                        <div class="col-md-6 col-sm-6">
                          <ul>
                            <li><a href="#"><img src="assets/img/brands/audi.png" alt="#"> Audi</a></li>
                            <li><a href="#"><img src="assets/img/brands/honda.png" alt="#"> Honda</a></li>
                            <li><a href="#"><img src="assets/img/brands/volkswagen.png" alt="#"> Volkswagen</a></li>
                            <li><a href="#"><img src="assets/img/brands/peugot.png" alt="#"> Peugot</a></li>
                            <li><a href="#"><img src="assets/img/brands/chevrolet.png" alt="#"> Chevrolet</a></li>
                          </ul>
                        </div><!-- /.col-md-6 -->                     
                      </div><!-- /.row -->
                    </div><!-- /.brands -->
                  </div><!-- /.col-md-5 -->
                </div><!-- /.megamenu-inner -->
              </div><!-- /.mega-menu-->
            </li>
            <li><a href="contact.html">Contact</a></li>
            </ul><!-- /.nav -->
          </nav>
        </div><!-- /.col-md-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </div><!-- /.header-inner -->
</header><!-- /#header -->


<div class="infobar">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <ol class="breadcrumb pull-left">
            <li><a href="#">Home</a></li>
            <li><a href="#">Featured Cars</a></li>
            <li class="active">Buy</li>
        </ol>

        <div class="contact pull-right">
          <div class="contact-item phone">
            <div class="label"><i class="icon icon-normal-mobile-phone"></i></div><!-- /.label -->
            <div class="value">123-456-789</div><!-- /.value -->
          </div><!-- /.phone -->

          <div class="contact-item mail">
            <div class="label"><i class="icon icon-normal-mail"></i></div><!-- /.label -->
            <div class="value"><a href="mailto:example@example.com">example@example.com</a></div><!-- /.value -->
          </div><!-- /.mail -->

          <div class="contact-item opening">
            <div class="label"><i class="icon icon-normal-clock"></i></div><!-- /.label -->
            <div class="value">Mon - Sun: 8:00 - 16:00</div><!-- /.value -->
          </div><!-- /.opening -->
        </div><!-- /.contact -->
      </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
  </div><!-- /.container -->
</div><!-- /.infobar -->  <div id="content" class="rental">
    <div id="highlighted">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="teaser">
                        <div class="title">
                            <h1>Make a reservation<br/>and enjoy a ride</h1>
                        </div><!-- /.title -->

                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam tempus tincidunt tellus.
                            Quisque urna elit, placerat at nisl sagittis, aliquam sollicitudin sem.
                        </p>
                    </div><!-- /.teaser -->
                </div>

                <div class="col-md-5">
                    <div id="reservation-form" class="block">
                        <div class="block-inner white block-shadow">
                            <div class="block-title">
                                <h3>Make Your Reservation</h3>
                            </div>
                            <!-- /.block-title -->

                            <form method="post" action="http://html.carat.pragmaticmates.com/rental-1.html?">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="pickup-date">Pickup Date</label>
                                            <input type="date" id="pickup-date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="return-date">Return Date</label>
                                            <input type="date" id="return-date" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <select data-placeholder="Choose a state" class="form-control">
                                        <option>United kingdom</option>
                                        <option>Finland</option>
                                        <option>Sweden</option>
                                        <option>Norland</option>
                                        <option>France</option>
                                        <option>Spain</option>
                                        <option>Poland</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select data-placeholder="Choose a city" class="form-control">
                                        <option>London</option>
                                        <option>Manchester</option>
                                        <option>Liverpool</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select data-placeholder="Choose a location" class="form-control">
                                        <option>London square</option>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <div class="checkbox">
                                        <input type="checkbox"><label>Return car to same location</label>
                                    </div>

                                    <div class="checkbox">
                                        <input type="checkbox"><label>25+ age</label>
                                    </div>
                                </div>

                                <div class="form-group button-group">
                                    <a href="rental-2.html" class="btn btn-primary">Continue</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div><!-- /.row -->
        </div><!-- /.container -->
    </div>

    <div class="section gray-light">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div id="main">
                        <div class="features-block block">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <div class="page-header-inner">
                        <div class="heading">
                            <h2>Why Choose Us?</h2>
                        </div><!-- /.heading -->

                        <div class="line">
                            <hr/>
                        </div><!-- /.line -->
                    </div><!-- /.page-header-inner -->
                </div><!-- /.page-header -->
            </div>
        </div>
    <div class="row">
        <div class="feature">
            <div class="col-xs-12 col-md-4 col-sm-4">
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <div class="feature-icon">
                            <div class="feature-icon-inverse">
                                <i class="icon-outline-car"></i>
                            </div><!-- /.feature-icon-inverse -->

                            <div class="feature-icon-normal">
                                <i class="icon-normal-car"></i>
                            </div><!-- /.feature-icon-normal -->
                        </div><!-- /.feature-icon -->
                    </div><!-- /.col-md-5 -->

                    <div class="col-xs-12 col-md-7">
                        <h3>Great Prices</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque dolor, placerat mattis justo id, convallis porta nulla</p>
                    </div><!-- /.col-md-7 -->
                </div><!-- /.row -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.feature -->

        <div class="feature">
            <div class="col-xs-12 col-md-4 col-sm-4">
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <div class="feature-icon">
                            <div class="feature-icon-inverse">
                                <i class="icon-outline-currency-dollar"></i>
                            </div><!-- /.feature-icon-inverse -->

                            <div class="feature-icon-normal">
                                <i class="icon-normal-currency-dollar"></i>
                            </div><!-- /.feature-icon-normal -->
                        </div><!-- /.feature-icon -->
                    </div><!-- /.col-md-5 -->

                    <div class="col-xs-12 col-md-7">
                        <h3>Wide Selection</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque dolor, placerat mattis justo id, convallis porta nulla</p>
                    </div><!-- /.col-md-7 -->
                </div><!-- /.row -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.feature -->

        <div class="feature">
            <div class="col-xs-12 col-md-4 col-sm-4">
                <div class="row">
                    <div class="col-xs-12 col-md-5">
                        <div class="feature-icon">
                            <div class="feature-icon-inverse">
                                <i class="icon-outline-car-door"></i>
                            </div><!-- /.feature-icon-inverse -->

                            <div class="feature-icon-normal">
                                <i class="icon-normal-car-door"></i>
                            </div><!-- /.feature-icon-normal -->
                        </div><!-- /.feature-icon -->
                    </div><!-- /.col-md-5 -->

                    <div class="col-xs-12 col-md-7">
                        <h3>24/7 Hotline</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed neque dolor, placerat mattis justo id, convallis porta nulla</p>
                    </div><!-- /.col-md-7 -->
                </div><!-- /.row -->
            </div><!-- /.col-md-4 -->
        </div><!-- /.feature -->
    </div><!-- /.row -->
</div><!-- /.block -->                        <div class="testimonials-block block">
  <div class="page-header center">
    <div class="page-header-inner">
      <div class="line">
        <hr/>
      </div>

      <div class="heading">
        <h2>Our Satisfied Customers</h2>
      </div><!-- /.heading -->

      <div class="line">
        <hr/>
      </div><!-- /.line -->
    </div><!-- /.page-header-inner -->
  </div><!-- /.page-header -->

  <div class="row">
    <div class="col-sm-12 col-md-6">
      <div class="testimonial white">
        <div class="inner">
          <div class="row">
            <div class="col-sm-3 col-md-4">
              <div class="picture">
                <img src="assets/img/testimonials-1.png" alt="#">
              </div><!-- /.picture -->
            </div><!-- /.col-md-4 -->

            <div class="col-sm-9 col-md-8">
              <div class="description quote">
                <p>
                  <i>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula ipsum, ornare ac augue
                    in, suscipit pretium purus. Vestibulum turpis felis, gravida ac justo.
                  </i>
                </p>
              </div><!-- /.description -->

              <div class="star-rating">
                <input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
                <input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
                <input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
                <input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
                <input name="star0" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
              </div><!-- /.star-rating -->

              <div class="author">
                <strong>Fanny Harley</strong>
              </div><!-- /.author -->
            </div><!-- /.col-md-8 -->
          </div><!-- /.row -->
        </div><!-- /.inner -->
      </div><!-- /.testimonial -->
    </div><!-- /.col-md-6 -->


    <div class="col-sm-12 col-md-6">
      <div class="testimonial white">
        <div class="inner">
          <div class="row">
            <div class="col-sm-3 col-md-4">
              <div class="picture">
                <img src="assets/img/testimonials-2.png" alt="#">
              </div><!-- /.picture -->
            </div><!-- /.col-md-4 -->

            <div class="col-sm-9 col-md-8">
              <div class="description quote">
                <p>
                  <i>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ligula ipsum, ornare ac augue
                    in, suscipit pretium purus. Vestibulum turpis felis, gravida ac justo.
                  </i>
                </p>
              </div><!-- /.description -->

              <div class="star-rating">
                <input name="star1" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
                <input name="star1" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
                <input name="star1" type="radio" class="star icon-normal-star" checked="checked" disabled="disabled">
                <input name="star1" type="radio" class="star icon-normal-star" disabled="disabled">
                <input name="star1" type="radio" class="star icon-normal-star" disabled="disabled">
              </div><!-- /.star-rating -->

              <div class="author">
                <strong>Chavi Ernanéz</strong>
              </div><!-- /.author -->
            </div><!-- /.col-md-8 -->
          </div><!-- /.row -->
        </div><!-- /.inner -->
      </div><!-- /.testimonial -->
    </div><!-- /.col-md-6 -->
  </div><!-- /.row -->
</div><!-- /.testimonials-block -->                        <div class="partners-block block">
        <div class="page-header">
            <div class="page-header-inner">


                <div class="heading">
                    <h2>Our Partners</h2>
                </div><!-- /.heading -->

                <div class="line">
                    <hr/>
                </div><!-- /.line -->
            </div><!-- /.page-header-inner -->
        </div><!-- /.page-header -->

  <div class="inner-block white block-shadow">
    <div class="row">
      <div class="col-sm-2 col-md-2">
        <div class="partner">
          <a href="#">
            <img src="assets/img/partners/volkswagen.png" alt="#">
          </a>
        </div><!-- /.partner -->
      </div><!-- /.col-md-2 -->

      <div class="col-sm-2 col-md-2">
        <div class="partner">
          <a href="#">
            <img src="assets/img/partners/ford.png" alt="#">
          </a>
        </div><!-- /.partner -->
      </div><!-- /.col-md-2 -->

      <div class="col-sm-2 col-md-2">
        <div class="partner">
          <a href="#">
            <img src="assets/img/partners/honda.png" alt="#">
          </a>
        </div><!-- /.partner -->
      </div><!-- /.col-md-2 -->

      <div class="col-sm-2 col-md-2">
        <div class="partner">
          <a href="#">
            <img src="assets/img/partners/mercedes.png" alt="#">
          </a>
        </div><!-- /.partner -->
      </div><!-- /.col-md-2 -->

      <div class="col-sm-2 col-md-2">
        <div class="partner">
          <a href="#">
            <img src="assets/img/partners/toyota.png" alt="#">
          </a>
        </div><!-- /.partner -->
      </div><!-- /.col-md-2 -->

      <div class="col-sm-2 col-md-2">
        <div class="partner">
          <a href="#">
            <img src="assets/img/partners/bmw.png" alt="#">
          </a>
        </div><!-- /.partner -->
      </div><!-- /.col-md-2 -->
    </div><!-- /.row -->
  </div><!-- /.inner-block -->
</div><!-- /.partners-block -->                    </div><!-- /#main -->
                </div>


            </div>
            <!-- /.row -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.section -->

</div>
<!-- /#content --> 
      <?php include 'footer.php'; ?>

<script src="assets/js/jquery.js"></script>
<script src="../code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="assets/js/jquery.ui.js"></script>
<script src="assets/js/bootstrap.js"></script>
<script src="assets/js/cycle.js"></script>
<script src="libraries/jquery.bxslider/jquery.bxslider.js"></script>
<script src="libraries/easy-tabs/lib/jquery.easytabs.min.js"></script>
<script src="libraries/chosen/chosen.jquery.js"></script>
<script src="libraries/star-rating/jquery.rating.js"></script>
<script src="libraries/colorbox/jquery.colorbox-min.js"></script>
<script src="libraries/jslider/bin/jquery.slider.min.js"></script>
<script src="libraries/ezMark/js/jquery.ezmark.js"></script>

<script type="text/javascript" src="libraries/flot/jquery.flot.js"></script>
<script type="text/javascript" src="libraries/flot/jquery.flot.canvas.js"></script>
<script type="text/javascript" src="libraries/flot/jquery.flot.resize.js"></script>
<script type="text/javascript" src="libraries/flot/jquery.flot.time.js"></script>


<script src="http://maps.googleapis.com/maps/api/js?sensor=true&amp;v=3.13"></script>
<script src="assets/js/carat.js"></script></body>
</html>