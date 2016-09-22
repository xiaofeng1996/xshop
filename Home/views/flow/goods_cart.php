	<div id="shop_cart">
	<div class="shop_gwc_bd clearfix">
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
							<td class="gwc_list_title"><input type="checkbox" value="<?=$val['rec_id'] ?>" id="rec_id" /> <?=$val['rec_id'] ?></td>
							<td class="gwc_list_pic"><a href="javascript:void(0)"><img src="<?php echo base_url(); ?><?=$val['goods_img']?>" /></a></td>
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
							<div class="gwc_foot_zongjia">商品总价(不含运费)<span>￥<strong id="good_zongjia"><?=$nums_price; ?></strong></span></div>
							<div class="clear"></div>
							<div class="gwc_foot_links">
								<a href="<?php echo site_url('index/index') ?>" class="go">继续购物</a>
								<a href="<?php echo site_url('flow/flow2') ?>" class="op">确认并填写订单</a>
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