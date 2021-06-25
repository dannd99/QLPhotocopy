@extends('customer.layout_front')

@section('main')

<div class="I-carousel">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<div class="item_wrapper">
					<img src="images/image1.jpg" alt="" style="height: 650px">
					<div class="bg_wrapper"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="I-service">
	<div class="wrapper">
		<div class="service_wrapper">
			<div class="services_title">
				<h2>Dịch vụ của chúng tôi</h2>
			</div>
			<div class="services_subtitle">
				<h6>Chúng tôi cung cấp dịch vụ in ấn cao câp.</h6>
			</div>

			<div class="row" id="card-view">
				<?php foreach ($services as $key => $value): ?>
					<div class="col-xs-6 col-sm-4 col-md-4 col-lg-3"  data-aos-delay="200" data-aos-duration="450" data-aos="fade-up">
						<div class="card">
							<img class="card-img-top lazy" id="services-image" src="{{ asset($value->image) }}" alt="">
							<div class="card-body">
								<h4 class="m-t-10"><?php echo $value->name ?></h4>
								<p>Đơn giá: <?php echo number_format($value->prices) . " đ" ?></p>
								<!-- <p class="description-services"><?php echo $value->description; ?></p> -->
								<div class="m-t-20 text-center">
									<a href="{{ route('customer.create', ['id' => $value->id]) }}" class="btn btn-success btn-tone m-b-5">
										<i class="anticon anticon-check"></i>
										<span class="m-l-5">Sử dụng ( tùy chỉnh )</span>
									</a>
									<a href="{{ route('customer.create2', ['id' => $value->id]) }}" class="btn btn-success btn-tone m-b-5">
										<i class="anticon anticon-check"></i>
										<span class="m-l-5">Sử dụng ( one page )</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
	</div>
</div>

@endsection()