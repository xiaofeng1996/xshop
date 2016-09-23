<head>
		<style>
		.div_search{
			position: absolute;
			width: 250px;
			height: auto;
			background: white;
			border: 1px #000000 solid;
			line-height: 20px;
			border-top: none;
			z-index: 100;
		}
	</style>
</head>


		<!-- TopHeader Center -->
		<div class="shop_hd_header">
			<div class="shop_hd_header_logo"><h1 class="logo"><a href="/"><img src="<?php echo base_url(); ?>public/home/images/logo.png" alt="ShopCZ" /></a><span>ShopCZ</span></h1></div>
			<div class="shop_hd_header_search">
                            <ul class="shop_hd_header_search_tab">
			        <li id="search" class="current">商品</li>
			        <li id="shop_search">店铺</li>
			    </ul>
                            <div class="clear"></div>
			    <div class="search_form">
			    		<div class="search_formstyle">
			    			<input type="text" class="search_form_text" name="search_content" placeholder="输入宝贝"/>
			    			<input type="submit" class="search_form_sub" value="" title="搜索" onclick="fun3()"/>
			    		</div>
			    </div>
				<div class="div_search"></div>
				<div class="search_tag">
					<?php
					 foreach($hot as $vv) {  ?>
					  <a href="<?php echo site_url('goods/goods')?>"/<?php echo $vv['goodsid']?>><?php echo $vv['goodsname']?></a>
			<?php	}
					?>
			    </div>

			</div>
		</div>
		<div class="clear"></div>
<!--jqurty-->
<script>
	$(function(){
		$(".search_form_text").keyup(function(){
			  var search=$(".search_form_text").val();
			if(search=='')
			{
                 return false;
			}
		   //传值
			$.get("<?php echo site_url('Index/search')?>",{name:search},function(msg){
				  var str='';
				str+="<ul class='ul_click'>";
				for(i in msg){
					str+="<li><a href='<?php echo site_url('goods/goods').'/'?>"+msg[i].goods_id+"'>"+msg[i]['goods_name']+"</a></li>";
				}
				str+="</ul>";
				$(".div_search").show();
				$(".div_search").html(str);
			},'json')
		})
	})
	function fun3()
	{
		var val=$("input[name='search_content']").val();

	}
</script>