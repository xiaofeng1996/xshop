<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>购物车页面</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/base.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_common.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_header.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_gouwuche.css" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>public/home/js/jquery-1.8.3.min.js" ></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/home/js/topNav.js" ></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/home/js/jquery.goodnums.js" ></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>public/home/js/shop_gouwuche.js" ></script>
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
			<a href="">我的购物车</a>
		</span>
	</div>
	<div class="clear"></div>
	<!-- 面包屑 End -->

	<!-- Header End -->
	
	<!-- 购物车 Body -->
	<div id="shop_cart">
	<div class="shop_gwc_bd clearfix" >
		<!-- 在具体实现的时候，根据情况选择其中一种情况 -->
		<!-- 购物车为空 -->
		<?php if (empty($shop_cart)): ?>
			<div class="empty_cart mb10">
				<div class="message">
					<p>购物车内暂时没有商品，您可以<a href="<?php echo site_url('index/index'); ?>">去首页</a>挑选喜欢的商品</p>
				</div>
			</div>
			<!-- 购物车为空 end-->
		<?php else: ?>
<!-- 购物车有商品 -->
		<div class="shop_gwc_bd_contents clearfix">
			<!-- 购物流程导航 -->
			<div class="shop_gwc_bd_contents_lc clearfix">
				<ul>
					<li class="step_a hover_a">确认购物清单</li>
					<li class="step_b">确认收货人资料及送货方式</li>
					<li class="step_c">购买完成</li>
				</ul>
			</div>
			<!-- 购物流程导航 End -->

			<!-- 购物车列表 -->
			<table>
				<thead>
					<tr>
						<th><span>商品标号</span></th>
						<th><span>商品图片</span></th>
						<th><span>商品</span></th>
						<th><span>单价(元)</span></th>
						<th><span>数量</span></th>
						<th><span>小计</span></th>
						<th><span>操作</span></th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($shop_cart as $key => $val): ?>
						<tr id="<?=$val['rec_id'] ?>">
							<td class="gwc_list_title"><input type="checkbox" value="<?=$val['rec_id'] ?>" id="rec_id" /></td>
							<td class="gwc_list_pic"><a href="javascript:void(0)"><img src="<?php echo base_url(); ?><?=$val['goods_img']?>" width="100px;" height="100px;" /></a></td>
							<td class="gwc_list_title"><a href=""><?=$val['goods_name'] ?> </a></td>
							<td class="gwc_list_danjia"><span>￥<strong id="danjia_001"><?=$val['goods_price'] ?></strong></span></td>
							<td class="gwc_list_shuliang">
								<span>
									<a class="good_num_jian this_good_nums" did="danjia_001" xid="xiaoji_001" ty="-" valId="goods_001" href="javascript:void(0);">-</a>
										<input type="text" value="<?=$val['goods_number'] ?>" id="goods_001" class="good_nums" /><a href="javascript:void(0);" did="danjia_001" xid="xiaoji_001" ty="+" class="good_num_jia this_good_nums" valId="goods_001">+</a>
								</span></td>
							<td class="gwc_list_xiaoji"><span>￥<strong id="xiaoji_001" class="good_xiaojis"><?php echo $val['goods_price'] * $val['goods_number']; ?></strong></span></td>
							<td class="gwc_list_caozuo"><a href="">收藏</a><a href="javascript:void(0);" class="shop_good_delete">删除</a></td>
						</tr>
					<?php endforeach ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="6">
							<div class="gwc_foot_links"  style="float:left; padding-top:20px;">
								<a href="javascript:void(0)" class="op" id="p_delete">批量删除</a>
							</div>
							<div class="gwc_foot_zongjia">商品总价(不含运费)<span>￥<strong id="good_zongjia">0</strong></span></div>
							<div class="clear"></div>
							<div class="gwc_foot_links">
								<input type="hidden" id="uid" value="<?=$uid; ?>" />
								<a href="<?php echo site_url('index/index') ?>" class="go">继续购物</a>
								<a href="javascript:void(0)" class="op" id="firmorder">确认并填写订单</a>
							</div>
						</td>
					</tr>
				</tfoot>
			</table>
			<!-- 购物车列表 End -->
		</div>
		<!-- 购物车有商品 end -->
		<?php endif ?>
	</div>
	</div>
	<!-- 购物车 Body End -->

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
<script type="text/javascript">
	//批量删除
	$(document).on('click','#p_delete',function(){
		var obj=$(":checkbox");
        var arr=Array();
        for (var i = 0; i < obj.length; i++) {
            if(obj[i].checked==true){
                arr.push(obj[i].value);
            }
        }
        var id=arr.join(',');
        if(id==""){
        	sweetAlert('请检查是否选中商品')
        }else{
	       $.post("<?php echo site_url('flow/p_delete') ?>",{id:id},function(m){
				$('#shop_cart').children().remove();
				$('#shop_cart').append(m)
			});
        }
	})
	//计算商品价格
	$(document).on('click',':checkbox',function(){
		obj=$(':checkbox');
		var arr=Array();
		for (var i = 0; i < obj.length; i++) {
			if(obj[i].checked==true){
				arr.push(obj[i].value)
			}
		}
		var id=arr.join(',');
		if(id==""){
        	$("#good_zongjia").text(0)
        }else{
	       $.post("<?php echo site_url('flow/p_select') ?>",{id:id},function(m){
		       	if(m > 0){
		       		$("#good_zongjia").text(m)
		       	}else{
		       		$("#good_zongjia").text(0)
		       	}
			});
        }
	})
	//确认收货订单
	$(document).on('click','#firmorder',function(){
		var uid=$("#uid").val();
		if(uid != ""){
			obj=$(':checkbox');
			var arr=Array();
			for (var i = 0; i < obj.length; i++) {
				if(obj[i].checked==true){
					arr.push(obj[i].value)
				}
			}
			var id=arr.join(',');
			if(id==""){
				sweetAlert('请检查是否选中商品')
			}else{
				$.post("<?php echo site_url('flow/goshoping') ?>",{id:id},function(m){
		       		if(m.msg == 1){
		       			 window.location.href="<?=site_url('flow/flow3'); ?>?id="+m.rec_id;
		       		}else{
		       			sweetAlert('您没有该商品');
		       		}
				},"json");
			}
		}else{
			sweetAlert('请先登录');
			window.location.href="<?=site_url('login/login'); ?>?flow=1";
		}
	})
</script>
</html>