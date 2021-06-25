<!DOCTYPE html>
<html class="no-js" lang="en">
<head>

	<!-- meta -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Favicon package -->
    <!-- 
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff"> -->

    <!-- Site title -->
    <title>Photocopy</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo/logo.png') }}">

    <!-- CSS ============================================ -->
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <!-- <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}"> -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <!-- Aos CSS -->
   
</head>
<body>
	<header>
		<div class="I-header">
			<div class="page-topline">
				<div class="wrapper">
					<div class="info_wrapper">
						<div class="mail_wrapper">
							<a href="mailto:" class="time">danlv99nd@gmai.com</a>
						</div>
						<div class="telephone_wrapper">
							<a href="tel:0123445677" class="telephone">(+84) 904533913</a>
						</div>
					</div>
					<div class="social_wrapper">
						<a href="https://www.facebook.com/xd3nd3nx/" class="social-item"><i class="fab fa-facebook-f"></i></a>

					</div>
				</div>
			</div>
			<div class="page-header-wrapper">
				<div class="logo_wrapper">
					<div class="icon">
						<i class="fas fa-copy"></i>
					</div>
					<div class="logo_title">
						<a href="{{ route('customer.index') }}">
							<div class="header_title">
								DanLV
							</div>
							<div class="detail_title">
								Chất lượng hàng đầu
							</div>
						</a>
					</div>
				</div>
				<div class="I-navigation">
					<div class="navigation_wrapper">
						<div class="wrapper">
							<ul>
								<li><a href="{{ route('customer.index') }}">Trang Chủ</a></li>
								<li><a href="">Về Chúng Tôi</a></li>
								<li><a href="">Liên Hệ</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="action">
					@guest
					<a href="{{ route('customer.login') }}">Đăng Nhập</a>
					<a href="{{ route('customer.register') }}">Đăng Kí</a>
					@else
					 <ul class="nav-right">
                        <li class="dropdown dropdown-animated scale-left">
                            <div class="pointer" data-toggle="dropdown">
                                <div class="avatar avatar-image  m-h-10 m-r-15 image_avatar">
                                    <img src="{{ asset($customer_info->customer_info->avatar) }}"  alt="">
                                </div>
                            </div>
                            <div class="p-b-15 p-t-20 dropdown-menu pop-profile">
                                <div class="p-h-20 p-b-15 m-b-10 border-bottom">
                                    <div class="d-flex">
                                        <div class="avatar avatar-lg avatar-image">
                                            <img src="{{ asset($customer_info->customer_info->avatar) }}" alt="">
                                        </div>
                                        <div class="m-l-10">
                                            <p class="m-b-0 text-dark font-weight-semibold"><?php echo $customer_info->customer_info->name ?></p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ route('customer.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();" class="dropdown-item d-block p-h-15 p-v-10">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div>
                                            <i class="anticon opacity-04 font-size-16 anticon-logout"></i>
                                            <span class="m-l-10">Đăng xuất</span>
                                        </div>
                                        <i class="anticon font-size-10 anticon-right"></i>
                                    </div>
                                </a>
                                <form id="logout-form" action="{{ route('customer.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    </ul>
					@endguest
				</div>
			</div>	
		</div>
	</header>

	<!-- Page Conttent -->
	<main class="page-content">
		@yield('main')
	</main>
	<!--// Page Conttent -->

	<!-- Footer -->
	<footer class="footer">
		<div class="I-footer">
			<div class="footer_contact">
				<div class="wrapper">
					<div class="row">
						<div class="col-xs-12 col-xm-12 col-md-6 col-lg-3 col-xl-3">
							<a href="" class="full_logo">
								<img src="{{ asset('assets/images/logo/logo1.png') }}">
							</a>
						</div>
						<div class="col-xs-12 col-xm-12 col-md-6 col-lg-3 col-xl-3">
							<div class="contact_wrapper">
								<div class="contact_title">
									<h5>DanLV</h5>
								</div>
								<div class="contact_content">
									<span><i class="fas fa-address-card"></i> Địa chỉ</span>
									<span><i class="fas fa-phone"></i> <a href="tel:0" class="telephone">(+84) 904533913</a></span>
									<span><i class="fas fa-envelope"></i> <a href="mailto:" class="time">danlv99nd@gmai.com</a></span>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-xm-12 col-md-6 col-lg-3 col-xl-3">
							<div class="contact_wrapper">
								<div class="contact_title">
									<h5>Về chúng tôi</h5>
								</div>
								<div class="contact_content">
									<span>+ Công nghệ</span>
									<span>+ Độ tin cậy</span>
									<span>+ Chi phí hiệu quả</span>
									<span>+ Chương trình khuyến mãi</span>
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-xm-12 col-md-6 col-lg-3 col-xl-3">
							<div class="contact_wrapper">
								<div class="contact_title">
									<h5>Theo dõi chúng tôi</h5>
								</div>
								<div class="contact_content">
									<div class="social_wrapper">
										<a class="social-item" href="https://www.facebook.com/xd3nd3nx/"><i class="fab fa-facebook-f"></i></a>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="copyright">
				<div class="wrapper">
					<div class="pull-left">
						Copyright © 2021. All rights reserved. 
					</div>
				</div>
			</div>
		</div>
	</footer>
	<!--// Footer -->

	<!-- JS ============================================ -->

	<!-- Bootstrap JS -->
	<script src="js/bootstrap3.js"></script>
	<!-- Aos -->
	<script src="js/aos.js"></script>
	<!-- Custom -->
	<script src="js/custom.js"></script>


	<script>
		if (!window.Cypress) AOS.init();
	</script>

</body>
</html>