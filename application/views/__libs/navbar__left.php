<aside class="app-navbar">
	<!-- begin sidebar-nav -->
	<div class="sidebar-nav scrollbar scroll_light">
		<ul class="metismenu " id="sidebarNav">
			<li>
				<a href="<?= 'dashboard' ?>" class="mb-3">
					<img src="<?= base_url() . 'assets/img/rumah-akad-banner-white.png' ?>" class="img-fluid logo-desktop" alt="Rumah Akad" />
				</a>
			</li>
			<li class="nav-static-title">Management Menu</li>
			<li class="<?= $this->uri->segment(1) === '' || $this->uri->segment(1) === 'dashboard' ? 'active' : ''; ?>">
				<a href="dashboard" aria-expanded="false"><span class="nav-title">Dashboard</span></a>
			</li>
			<li class="<?= $this->uri->segment(1) === 'airlines' || $this->uri->segment(1) === 'airports' || $this->uri->segment(1) === 'routes' ? 'active' : ''; ?>">
				<a class="has-arrow" href="javascript:void(0)" aria-expanded="false">
					<span class="nav-title">Flights</span>
				</a>
				<ul aria-expanded="false">
					<li class="<?= $this->uri->segment(1) === 'routes' ? 'active' : ''; ?>">
						<a href="routes">Routes</a>
					</li>
					<li class="<?= $this->uri->segment(1) === 'airports' ? 'active' : ''; ?>">
						<a href="airports">Airports</a>
					</li>
					<li class="<?= $this->uri->segment(1) === 'airlines' ? 'active' : ''; ?>">
						<a href="airlines">Airlines</a>
					</li>
					<li class="<?= $this->uri->segment(1) === 'details' ? 'active' : ''; ?>">
						<a href="details">Featured Flight</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
	<!-- end sidebar-nav -->
</aside>
