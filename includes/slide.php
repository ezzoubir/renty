<div class="top-area">
            <div class="mod-head-slide">
                <div class="grid_frame">
                    <div class="wrap-slide">
                        
                        <div id="sys_head_slide" class="head-slide flexslider">
                            
                        <div style="overflow: hidden; position: relative;" class="flex-viewport">
							<ul style="width: 1000%; transition-duration: 0s; transform: translate3d(-2136px, 0px, 0px);" class="slides">
									<?php
										$sql=mysql_query('select * from '.PREFIXE_BDD.'photos_sans_categorie_avec_lien');
										while($data=mysql_fetch_array($sql)){
									?>
									<li style="width: 1068px; float: left; display: block;" aria-hidden="true" class="clone">
										<a href="<?php echo $data['lien']; ?>"><img draggable="false" src="images/photos/<?php echo $data['fichier']; ?>" alt=""></a>
									</li>
									<?php } ?>
							</ul>
						</div>
						<ul class="flex-direction-nav">
							<li><a class="flex-prev" href="#">Previous</a></li>
							<li><a class="flex-next" href="#">Next</a></li></ul>
						</div>
                    </div>
                </div>
            </div>
        </div>