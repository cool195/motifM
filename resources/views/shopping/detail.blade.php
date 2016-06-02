<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no">
    <title>shopping detail</title>
    <link rel="icon" href="/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <link rel="stylesheet" href="/styles/vendor.css">

    <link rel="stylesheet" href="/styles/shoppingDetail.css">

    <script src="/scripts/vendor/modernizr.js"></script>
</head>
<body>
    <!-- 外层容器 -->
    <div id="body-content">
        <!-- 展开的汉堡菜单 -->
		@include('nav')
        <!-- 主体内容 -->
        <div class="body-container">
			@include('navigator')
			<!-- 图片详情 --><!-- 弹出图片轮播 -->
			<div class="product-detailImg fade">
				<div class="swiper-container" id="detailImg-swiper">
					<div class="swiper-wrapper">
					@foreach($data['productImages'] as $image)
					 <div class="swiper-slide"><img class="img-fluid" src="{{ 'https://s3-us-west-1.amazonaws.com/emimagetest/n2/'.$image['img_path'] }}"></div>
					@endforeach
					</div>
					<div class="swiper-pagination font-size-sm" id="detailImg-pagination"></div>
				</div>
			</div>
			<!-- 商品内容介绍 -->
			<section class="container-fluid p-x-0">
				<!-- 产品图片 -->
				<div class="product-baseImg">
					<!-- Swiper -->
					<!-- 页面上图片轮播 -->
					<div class="swiper-container" id="baseImg-swiper">
						<div class="swiper-wrapper">
							@forelse($data['productImages'] as $image)
								<div class="swiper-slide"><img class="img-fluid" src="{{ 'https://s3-us-west-1.amazonaws.com/emimagetest/n2/'.$image['img_path'] }}"></div>
							@empty
								<div class="swiper-slide"></div>
							@endforelse
						</div>
						<!-- 分页器 -->
						<div class="swiper-pagination text-right p-r-20x font-size-sm" id="baseImg-pagination"></div>
					</div>
				</div>

				<!-- 产品 标题 简介 价格 基本信息 -->
				<article class="product-baseInfo bg-white m-b-10x">
					<div class="product-text">
						<h6 class="text-main">{{$data['main_title']}}</h6>
						<p class="text-primary font-size-sm">{{ $data['intro_short'] }}</p>
						@if(!empty($data['designer']))
						<p class="text-primary font-size-sm">
							<span>Designer:</span>
							<a href="{{$data['designer']['designer_home_page']}}" class="text-primary text-underLine">{{$data['designer']['designer_name']}}</a>
						</p>
						@endif
					</div>
					<hr class="hr-light m-x-10x">
					<div class="product-price">
						<span class="font-size-lx text-primary">$ {{ $data['skuPrice']['price'] }}</span>
						<span class="font-size-sm text-common">＄{{ $data['skuPrice']['sale_price']  }}</span>
						<span class="font-size-sm text-primary">(51% off)</span>
						<a class="text-primary pull-xs-right" href="#"><i class="iconfont icon-share icon-size-xm"></i></a>
					</div>
					<div class="text-warming font-size-xs p-x-15x">{{ $data['seo_describe'] }}</div>
				</article>
				<!-- 产品 其他信息 -->
				<section>
					<!-- 添加到购物车 立即购买 -->
					<aside class="container-fluid bg-white p-y-10x p-x-15x m-b-10x">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="btn btn-primary-outline btn-block">Add To Bag</a>
							</div>
							<div class="col-xs-6">
								<a href="#" class="btn btn-primary btn-block">Buy Now</a>
							</div>
						</div>
					</aside>
					<!-- 选择商品参数 -->
					<aside class="bg-white m-b-10x">
						<a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" data-remodal-target="modal" href="#">
							<span>Select</span>
						<span class="flex flex-alignCenter flex-fullJustified">
							<span class="m-r-10x">Size Color</span> <i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
						</span>
						</a>
					</aside>
					<!-- 产品描述 -->
					<aside class="bg-white p-x-15x p-y-10x m-b-10x">
						<p class="font-size-md text-main"><strong>Description</strong></p>
						<p class="font-size-sm text-primary">{{ $data['seo_describe'] }} </p>
						<a class="flex flex-alignCenter flex-fullJustified font-size-xs text-common" href="#">
							show more
							<i class="iconfont icon-arrow-bottom icon-size-xm text-common"></i>
						</a>
					</aside>
					<!-- 用户 Q & A -->
					<aside class="product-secondaryInfo">
						<a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
							Ask a Question <i class="iconfont icon-arrow-right icon-size-xm text-common"></i></a>
					</aside>
					<aside class="product-secondaryInfo">
						<a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x">
							Size Guide
							<i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
						</a>
						<hr class="hr-base">
						<a class="flex flex-alignCenter flex-fullJustified font-size-sm text-primary p-a-15x" href="#">
							Shipping, Returns, Payments
							<i class="iconfont icon-arrow-right icon-size-xm text-common"></i>
						</a>
					</aside>

					<!-- 版权信息 -->
					<!-- TODO -->
					<aside class="product-secondaryInfo p-a-15x">
						<div class="media m-a-0">
							<div class="media-left media-middle">
								<img class="media-object" src="/images/icon/icon-guarantee.png" srcset="/images/icon/icon-guarantee@2x.png 2x, /images/icon/icon-guarantee@3x.png 3x" alt="">
							</div>
							<div class="media-body media-middle">
								<p class="font-size-sm text-primary m-a-0 p-r-2">MOTIF guarantee quality merchandise and return service</p>
							</div>
						</div>
					</aside>
					<!-- 添加购物车 -->
					<aside class="product-secondaryInfo container-fluid p-y-10x p-x-15x">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="btn btn-primary-outline btn-block">Add To Bag</a>
							</div>
							<div class="col-xs-6">
								<a href="#" class="btn btn-primary btn-block">Buy Now</a>
							</div>
						</div>
					</aside>
					<!-- 推荐商品 -->
					<aside class="m-b-20x">
						<article class="font-size-md text-primary p-x-15x"><strong>More Like This</strong></article>
						<div class="container-fluid p-a-10x">
							<div class="row">
								<div class="col-xs-6">
									<div class="productList-item">
										<div class="image-bg">
											<div class="image-container">
												<img class="img-fluid" src="/images/product/product1.jpg" alt="商品的名称">
												<div class="price-off"><strong class="font-size-sm">OFF 49%</strong></div>
											</div>
										</div>
										<div class="price-caption">
											<span class="font-size-sm m-l-5x"><strong>$60.95</strong></span>
											<span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
										</div>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="productList-item">
										<div class="image-bg">
											<div class="image-container">
												<img class="img-fluid" src="/images/product/product2.jpg" alt="商品的名称">
												<div class="price-off"><strong class="font-size-sm">OFF 89%</strong></div>
											</div>
										</div>
										<div class="price-caption">
											<span class="font-size-sm text-primary m-l-5x"><strong>$60.95</strong></span>
											<span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
										</div>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="productList-item">
										<div class="image-bg">
											<div class="image-container">
												<img class="img-fluid" src="/images/product/product3.jpg" alt="商品的名称">
											</div>
										</div>
										<div class="price-caption">
											<span class="font-size-sm text-primary m-l-5x"><strong>$60.95</strong></span>
											<span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
										</div>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="productList-item">
										<div class="image-bg">
											<div class="image-container">
												<img class="img-fluid" src="/images/product/product4.jpg" alt="商品的名称">
											</div>
										</div>
										<div class="price-caption">
											<span class="font-size-sm text-primary m-l-5x"><strong>$60.95</strong></span>
											<span class="font-size-xs text-common text-throughLine m-l-5x">$125.95</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</aside>
				</section>
			</section>

				<!-- 弹出选择 size color Engraving -->
				<!-- TODO remodal 有多余的样式 需要整理 -->
				<div class="remodal p-a-0 modal-content" data-remodal-id="modal" id="modalDialog">
					<form action="">
						<div class="p-x-15x p-t-15x text-right">
							<a data-remodal-action="close"><i class="iconfont icon-cross text-common icon-size-lg"></i>
							</a>
						</div>
						<fieldset class="text-primary p-x-15x p-b-10x text-left">
							<div class="font-size-sm"><strong>$748.00</strong></div>
							<div class="font-size-sm">Select: Size, Color</div>
						</fieldset>
						<hr class="hr-base m-a-0">
						@foreach($data['spuAttrs'] as $value)
						<fieldset class="p-x-15x p-y-10x text-left">
							<div class="container-fluid p-a-0">
								<div class="text-primary font-size-sm">{{$value['attr_type_value']}}</div>
								<div class="row">
									@foreach($value['skuAttrValues'] as $skuValue)
									<div class="col-xs-3 p-t-10x">
										<input type="radio" name="{{$value['attr_type_value']}}" id="{{$skuValue['attr_value_id']}}" hidden>
										<label class="btn btn-block btn-itemProperty btn-sm m-b-0" for="{{$skuValue['attr_value_id']}}">{{$skuValue['attr_value']}}</label>
									</div>
									@endforeach
								</div>
							</div>
						</fieldset>
						<hr class="hr-base m-a-0">
						@endforeach

						@if(isset($data['vasBases']) && !empty($data['vasBases']))
							@foreach($data['vasBases'] as $vas)
								@if(1 == $vas['vas_type'])
					    <hr class="hr-base m-a-0">
                	    <fieldset class="p-x-15x p-y-10x text-left">
                       	 	<div class="text-primary font-size-sm m-b-10x">{{ $vas['vas_describe'] }} +$4.5</div>
                       	 	<div class="flex flex-fullJustified flex-alignCenter">
                            	<input class="input-engraving form-control font-size-sm" type="text">
                            	<span class="p-l-20x">
                                	<a href="#"><i class="iconfont icon-checkcircle text-common"></i></a>
                            	</span>
                        	</div>
                    	</fieldset>
                    			@else
                    	<hr class="hr-base m-a-0">
                    	<fieldset class="p-x-15x p-y-10x text-left">
                        	<div class="flex flex-fullJustified flex-alignCenter">
                           	 	<div class="text-primary font-size-sm">{{ $vas['vas_describe'] }} +$4.5(optional)</div>
                            	<span class="p-l-20x">
                                	<a href="#"><i class="iconfont icon-checkcircle text-common"></i></a>
                            	</span>
                        	</div>
                    	</fieldset>
                    			@endif
                    		@endforeach
                    	@endif
                    	<hr class="hr-base m-a-0">
                    	<fieldset class="p-x-15x p-y-10x">
                        	<div class="flex flex-fullJustified flex-alignCenter">
                            	<span class="text-primary font-size-sm">Qty:</span>
                            	<div class="btn-group flex">
                                	<div class="btn btn-cartCount btn-sm disabled">-</div>
                                	<div class="btn btn-cartCount btn-sm">2</div>
                                	<div class="btn btn-cartCount btn-sm">+</div>
                            	</div>
                        	</div>
                    	</fieldset>
                    	<hr class="hr-dark m-a-0">
                    	<fieldset class="container-fluid p-a-15x">
                        	<div class="row">
                            	<div class="col-xs-6">
                                	<a href="#" class="btn btn-primary-outline btn-block">Add To Bag</a>
                            	</div>
                            	<div class="col-xs-6">
                                	<a href="#" class="btn btn-primary btn-block">Buy Now</a>
                            	</div>
                        	</div>
                    	</fieldset>
                	</form>
            	</div>


							
				

<!-- 页脚 功能链接 start-->
	@include('footer')
<!-- 页脚 功能链接 end-->
		</div>
	</div>
</body>
<script src="/scripts/vendor.js"></script>

<script src="/scripts/shoppingDetail.js"></script>

</html>
