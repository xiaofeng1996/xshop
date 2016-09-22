<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>编辑收货地址</title>
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/base.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_common.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_header.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_manager.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>public/home/css/shop_form.css" type="text/css" />
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
		<!--搜索框-->
		<?php require_once "Home/views/pub/search.php"; ?>
		<!-- TopHeader Center End -->
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
				<div class="title"><h3>编辑收货地址</h3></div>
				<div class="clear"></div>
				<dic class="shop_home_form">
					<form athion="" name="" class="shop_form" method="post">
						<ul>
							<li><label><span>*</span>收货人姓名：</label><input type="text" class="form-text" value="望乐乐" /></li>
							<li><label><span>*</span>所在地：</label><input type="text" class="form-text" value="中国" /></li>
							<li><label>详细地址：</label>
								<select class="province" onchange="getCity()">
									<option value="-1">请选择..</option>
									<?php foreach($province as $k=>$v){?>
										<option value="<?php echo $v['region_id'];?>"><?php echo $v['region_name'];?></option>
									<?php }?>
								</select>
								<select class="city" onchange="getDistrict()">
									<option value="-1">请选择..</option>
								</select>
								<select class="district">
									<option value="-1">请选择..</option>
								</select>
							</li>
							<li><label>邮编：</label><input type="text" class="form-text" value="100000" /></li>
							<li><label>电话：</label><input type="text" class="form-text" value="101-888888" /></li>
							<li><label>手机号：</label><input type="text" class="form-text" value="13366992329" /></li>
							<li class="bn"><label>&nbsp;</label><input type="submit" class="form-submit" value="保存修改" /></li>
						</ul>
					</form>
				</div>
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
<script>
	function getCity(){
		var id = $('.province').val();
		$.get('<?php echo site_url("Address/getCity");?>',{id:id},function(msg){
			if(msg != 0){
				var str='';
				$.each(msg,function(index,item){
					str+="<option value='"+item.region_id+"'>"+item.region_name+"</option>";
					$('.city').html(str);
				})
				getDistrict();
			}
		},'json')
	}
	function getDistrict(){
		var id = $('.city').val();
		$.get('<?php echo site_url("Address/getCity");?>',{id:id},function(msg){
			if(msg != 0){
				var str='';
				$.each(msg,function(index,item){
					str+="<option value='"+item.region_id+"'>"+item.region_name+"</option>";
					$('.district').html(str);
				})
			}
		},'json')
	}
</script>