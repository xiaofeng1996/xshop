<div class="shop_hd_menu">
			<!-- 所有商品菜单 -->
                        
			<div class="shop_hd_menu_all_category shop_hd_menu_hover"><!-- 首页去掉 id="shop_hd_menu_all_category" 加上clsss shop_hd_menu_hover -->
				<div class="shop_hd_menu_all_category_title"><h2 title="所有商品分类"><a href="javascript:void(0);">所有商品分类</a></h2><i></i></div>
				<div id="shop_hd_menu_all_category_hd" class="shop_hd_menu_all_category_hd">
					<ul class="shop_hd_menu_all_category_hd_menu clearfix">
						 <?php
					    foreach($list as $value) { ?>
						<li id="cat_1" class="">
							<h3><a><?php echo $value['cat_name']?></a></h3>
							<div id="cat_1_menu" class="cat_menu clearfix" style="">
								<?php
								  foreach($value['son'] as $val) {  ?>
									  <dl class="clearfix">
										  <dt><a href="女装" href=""><font color="#a52a2a"><?php echo $val['cat_name']?></font></a></dt>
										  <dd>
										   <?php
										   foreach($val['son'] as $va) { ?>
											  <a href="<?php echo site_url('goods/goods')?>?id=<?php echo $va['cat_id']?>"><font color="black"><?php echo $va['cat_name']?></font></a>
									<?php	   }
										  ?>
										  </dd>
									  </dl>
								<?php  }
								?>
							 </div>
                       </li>
					<?php	}
						?>
						<li class="more"><a href="">查看更多分类</a></li>
					</ul>
				</div>
			</div>
			<!-- 所有商品菜单 END -->

			<!-- 普通导航菜单 -->
			<ul class="shop_hd_menu_nav">
				<li class="current_link"><a href="<?php echo site_url('index/index'); ?>"><span>首页</span></a></li>
				<li class="link"><a href="<?php echo site_url('search/search'); ?>"><span>团购</span></a></li>
				<li class="link"><a href="<?php echo site_url('search/search'); ?>"><span>品牌</span></a></li>
				<li class="link"><a href="<?php echo site_url('search/search'); ?>"><span>优惠卷</span></a></li>
				<li class="link"><a href="<?php echo site_url('search/search'); ?>"><span>积分中心</span></a></li>
				<li class="link"><a href="<?php echo site_url('search/search'); ?>"><span>运动专场</span></a></li>
				<li class="link"><a href="<?php echo site_url('search/search'); ?>"><span>微商城</span></a></li>
			</ul>
			<!-- 普通导航菜单 End -->
		</div>