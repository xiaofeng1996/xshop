<head>
<script src="<?php echo base_url()?>/public/news/js/sweet-alert.min.js"></script>
<!--注释样式冲突-->
<!-- <link rel="stylesheet" href="<?php echo base_url()?>/public/news/css/example.css"> -->
<!-- This is what you need -->
<script src="<?php echo base_url()?>/public/news/js/sweet-alert.js"></script>
<!--<link rel="stylesheet" href="--><?php //echo base_url()?><!--/public/news/css/sweet-alert.css">-->
</head>
<div class="shop_hd_topNav">
			<div class="shop_hd_topNav_all">
				<!-- Header TopNav Left -->
				<div class="shop_hd_topNav_all_left">
					<p>您好，欢迎来到<b><a href="/">ShopCZ商城</a></b>[<a href="<?php echo site_url('login/login'); ?>">登录</a>][<a href="<?php echo site_url('register/register'); ?>">注册</a>]</p>
				</div>
				<!-- Header TopNav Left End -->

				<!-- Header TopNav Right -->
				<div class="shop_hd_topNav_all_right">
					<ul class="topNav_quick_menu">

						<li>
							<div class="topNav_menu">
								<a href="#" class="topNavHover">我的商城<i></i></a>
								<div class="topNav_menu_bd" style="display:none;" >
						            <ul>
						              <li><a title="已买到的商品" target="_top" href="<?php echo site_url('member/member'); ?>">已买到的商品</a></li>
						              <li><a title="个人主页" target="_top" href="<?php echo site_url('member/memberinfo'); ?>">个人主页</a></li>
						              <li><a title="我的好友" target="_top" href="#">我的好友</a></li>
						            </ul>
						        </div>
							</div>
						</li>
                                 <li>
							<div class="topNav_menu">
								<a href="#" class="topNavHover">卖家中心<i></i></a>
								<div class="topNav_menu_bd" style="display:none;">
						            <ul>
						            	<!--可以自己找这些页面  链接不是唯一-->
						              <li><a title="已售出的商品" target="_top" href="<?php echo site_url('member/member'); ?>">已售出的商品</a></li>
						              <li><a title="销售中的商品" target="_top" href="<?php echo site_url('member/member'); ?>">销售中的商品</a></li>
						            </ul>
						        </div>
							</div>
						</li>
						<li>
							<div class="topNav_menu">
								<a href="<?php echo site_url('flow/flow') ?>" class="topNavHover">购物车<b>0</b>种商品<i></i></a>
								<div class="topNav_menu_bd" style="display:none;">
									<!--
						            <ul>
						              <li><a title="已售出的商品" target="_top" href="#">已售出的商品</a></li>
						              <li><a title="销售中的商品" target="_top" href="#">销售中的商品</a></li>
						            </ul>
						        	-->
						            <p>还没有商品，赶快去挑选！</p>
						        </div>
							</div>
						</li>

						<li>
							<div class="topNav_menu">
								<a href="<?php echo site_url('favorite/favorite'); ?>" class="topNavHover">我的收藏<i></i></a>
								<div class="topNav_menu_bd" style="display:none;">
						            <ul>
						              <li><a title="收藏的商品" target="_top" href="<?php echo site_url('favorite/favorite'); ?>">收藏的商品</a></li>
						              <li><a title="收藏的店铺" target="_top" href="#">收藏的店铺</a></li>
						            </ul>
						        </div>
							</div>
						</li>

						<li>
							<div class="topNav_menu">
								<a href="#">站内消息</a>
							</div>
						</li>

					</ul>
				</div>
				<!-- Header TopNav Right End -->
			</div>
			<div class="clear"></div>
		</div>
