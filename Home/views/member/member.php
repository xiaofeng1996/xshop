<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>个人中心</title>
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
						<th style="width:410px;"><span>商品信息</span></th>
						<th style="width:100px;"><span>单价</span></th>
						<th style="width:80px;"><span>数量</span></th>
						<th style="width:100px;"><span>订单总价</span></th>
						<th style="width:115px;"><span>状态与操作</span></th>
					</thead>
					<tbody>
					<!-- 订单列表 -->
					<?php foreach ($order as $key => $val): ?>
						<tr><td colspan="5">
							<table class="good">
								<thead >
									<tr><th colspan="6">
										<span><strong>订单号码：</strong><?=$val['order_sn']?></span>
									</th></tr>
								</thead>
								<tbody>
									<tr>
										<td class="dingdan_title"><span><a href=""><?=$val['goods_name']?></a></span><br />****</td>
										<td class="dingdan_danjia">￥<strong><?=$val['goods_price']?></strong></td>
										<td class="dingdan_shuliang"><?=$val['goods_number']?></td>
										<td class="dingdan_zongjia">￥<strong><?=$val['goods_price'] * $val['goods_number']?></strong><br />(免运费)</td>
										<td class="digndan_caozuo">
										<?php if ($val['is_status'] == '4'): ?>
											待评价
										<?php else: ?>
											待评价
										<?php endif ?>
										</td>
									</tr>
								</tbody>
							</table>
						</td></tr>
					<?php endforeach ?>
						

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