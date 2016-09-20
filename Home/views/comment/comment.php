<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>评价管理</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/base.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_common.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_header.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_manager.css" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>public/home/js/jquery.js" ></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/home/js/topNav.js" ></script>
</head>

<body>
		<!-- Header  -wll-2013/03/24 -->
	<div class="shop_hd">
		<!-- Header TopNav -->
		<?php require_once "Home/views/pub/head.php"; ?>
		<div class="clear"></div>
		<!-- Header TopNav End -->
<!-- Header TopNav End -->
		<!--搜索框-->
		<?php require_once "Home/views/pub/search.php"; ?>
		<!-- TopHeader Center End -->

		<!-- Header Menu -->
		<?php require_once "Home/views/pub/left1.php"; ?>
		<!-- Header Menu End -->

	</div>
	<div class="clear"></div>
	<!-- 面包屑 注意首页没有 -->
	<div class="shop_hd_breadcrumb">
		<strong>当前位置：</strong>
		<span>
			<a href="">首页</a>&nbsp;›&nbsp;
			<a href="">我的商城</a>&nbsp;›&nbsp;
			<a href="">已买到商品</a>
		</span>
	</div>
	<div class="clear"></div>
	<!-- 面包屑 End -->

	<!-- Header End -->	

	<!-- 我的个人中心 -->
	<div class="shop_member_bd clearfix">
		<!-- 左边导航 -->
		<?php require_once "Home/views/pub/people.php"; ?>
		<!-- 左边导航 End -->
		
		<!-- 右边购物列表 -->
		<div class="shop_member_bd_right clearfix">
			
			<div class="shop_meber_bd_good_lists clearfix">
				<div class="title"><h3>订单列表</h3></div>
				<table>
					<thead class="tab_title">
						<th style="width:80px;"><span>&nbsp;</span></th>
						<th style="width:320px;"><span>评价内容</span></th>
						<th style="width:180px;"><span>评价人</span></th>
						<th style="width:100px;"><span>宝贝信息</span></th>
						<th style="width:115px;"><span>操作</span></th>
					</thead>
					<tbody>

						<tr><td colspan="5">
							<table class="good" style="height:50px">
								<tbody>
									<tr>
										<td class="pingjia_pic"><span class="pingjia_type pingjia_type_1"></span></td>
										<td class="pingjia_title"><span><a href=""> 好评！</a></span><br />[2012-12-01 19:55:37]</td>
										<td class="pingjia_danjia"><strong>wanglele</strong></td>
										<td class="pingjia_shuliang"><a href="">金士顿TF 8G卡</a><br />99.00元</td>
										<td class="pingjia_caozuo"><a href="">删除</a></td>
									</tr>
								</tbody>
							</table>
						</td></tr>

						<tr><td colspan="5">
							<table class="good" style="height:50px">
								<tbody>
									<tr>
										<td class="pingjia_pic"><span class="pingjia_type pingjia_type_2"></span></td>
										<td class="pingjia_title"><span><a href=""> 中评！</a></span><br />[2012-12-01 19:55:37]</td>
										<td class="pingjia_danjia"><strong>wanglele</strong></td>
										<td class="pingjia_shuliang"><a href="">金士顿TF 8G卡</a><br />99.00元</td>
										<td class="pingjia_caozuo"><a href="">删除</a></td>
									</tr>
								</tbody>
							</table>
						</td></tr>

						<tr><td colspan="5">
							<table class="good" style="height:50px">
								<tbody>
									<tr>
										<td class="pingjia_pic"><span class="pingjia_type pingjia_type_3"></span></td>
										<td class="pingjia_title"><span><a href=""> 差评！</a></span><br />[2012-12-01 19:55:37]</td>
										<td class="pingjia_danjia"><strong>wanglele</strong></td>
										<td class="pingjia_shuliang"><a href="">金士顿TF 8G卡</a><br />99.00元</td>
										<td class="pingjia_caozuo"><a href="">删除</a></td>
									</tr>
								</tbody>
							</table>
						</td></tr>



					</tbody>
				</table>
			</div>
		</div>
		<!-- 右边购物列表 End -->

	</div>
	<!-- 我的个人中心 End -->

	<!-- Footer - wll - 2013/3/24 -->
	<div class="clear"></div>
	<div class="shop_footer">
            <div class="shop_footer_link">
                <p>
                    <a href="">首页</a>|
                    <a href="">招聘英才</a>|
                    <a href="">广告合作</a>|
                    <a href="">关于ShopCZ</a>|
                    <a href="">关于我们</a>
                </p>
            </div>
            <div class="shop_footer_copy">
                <p>Copyright 2004-2013 itcast Inc.,All rights reserved.</p>
            </div>
        </div>
	<!-- Footer End -->
</body>
</html>