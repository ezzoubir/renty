<div id="sys_mod_filter" class="mod-filter">
            <div class="grid_frame">
                <div class="container_grid clearfix">
                    <div class="grid_12">
                        <div class="lbl-search">
                            <input class="txt-search" id="sys_txt_search" placeholder="Recherche" type="search">
                            <input class="btn-search" value="" type="submit">
                        </div>
                        <div class="select-cate">
                            <div id="sys_selected_val" class="show-val">
                                <span data-cate-id="0">Catégories</span>
                                <i class="pick-down"></i>
                            </div>
                            <div id="sys_list_dd_cate" class="dropdown-cate">
                                <div class="first-lbl">Toutes les Catégories</div>
                                <div class="wrap-list-cate clearfix">
									<?php
										$sql=mysql_query('select * from categories order by id ');
										while($data=mysql_fetch_array($sql)){
									?>
                                    <a href="#" data-cate-id="<?php echo $data['id']; ?>"><?php echo $data['cat']; ?></a>
									<?php } ?>
                                </div>
                            </div>
                        </div><!--end: .select-cate -->
						<div class="select-cate">
                            <div id="sys_selected_val" class="show-val">
                                <span data-cate-id="1">Ville</span>
                                <i class="pick-down"></i>
                            </div>
                            <div id="sys_list_dd_cate" class="dropdown-cate">
                                <div class="first-lbl">Toutes les villes</div>
                                <div class="wrap-list-cate clearfix">
									<?php
										$sql=mysql_query('select * from villes order by id');
										while($data=mysql_fetch_array($sql)){
									?>
                                    <a href="#" data-cate-id="<?php echo $data['id']; ?>"><?php echo $data['ville']; ?></a>
									<?php } ?>
                                </div>
                            </div>
                        </div><!--end: .select-cate -->
                        <!--div class="range-days-left">
                            <span class="lbl-day">Days left</span>
                            <span id="sys_min_day" class="min-day">1</span>
                            <div id="sys_filter_days_left" class="filter-days noUi-target noUi-ltr noUi-horizontal noUi-background">
							<div class="noUi-base"><div style="left: 0%;" data-style="left" class="noUi-origin noUi-connect">
							<div class="noUi-handle noUi-handle-lower"></div></div>
							<div style="left: 49.6855%;" data-style="left" class="noUi-origin noUi-background">
							<div class="noUi-handle noUi-handle-upper"></div></div></div></div>
                            <span id="sys_max_day" class="max-day">80</span>
                        </div><!--end: .range-days-left -->
                        <input id="sys_apply_filter" class="btn btn-red type-1 btn-apply-filter" value="Apply Filter" type="button">
                    </div>
                </div>
            </div>
        </div><!--end: .mod-filter -->