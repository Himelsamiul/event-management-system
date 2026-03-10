{{-- sidebar.blade.php --}}

<style>
/* ================= SIDEBAR BASE ================= */
.sidebar {
    min-height: 100vh;
    background: linear-gradient(180deg, #0f2027, #203a43, #2c5364);
    color: #fff;
    position: sticky;
    top: 0;
}

/* ================= NAV LINKS ================= */
.sidebar .nav-link {
    color: #e0e0e0;
    padding: 12px 18px;
    margin-bottom: 6px;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 12px;
    position: relative;
    overflow: hidden;
    transition: all 0.35s ease;
}

/* Hover animation */
.sidebar .nav-link:hover {
    background: rgba(255, 255, 255, 0.12);
    transform: translateX(6px);
    color: #ffffff;
}

/* Active link */
.active-link {
    background: linear-gradient(90deg, #00c6ff, #0072ff);
    color: #fff !important;
    font-weight: 600;
    box-shadow: 0 8px 18px rgba(0, 114, 255, 0.4);
}

/* Left glowing bar */
.active-link::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    width: 5px;
    height: 100%;
    background: #00eaff;
    border-radius: 5px;
}

/* Icon animation */
.sidebar .nav-link i {
    font-size: 1.2rem;
    transition: transform 0.35s ease;
}
.sidebar .nav-link:hover i {
    transform: rotate(-8deg) scale(1.1);
}

/* Ripple effect */
.sidebar .nav-link::after {
    content: '';
    position: absolute;
    width: 120px;
    height: 120px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 50%;
    transform: scale(0);
    opacity: 0;
    transition: transform 0.6s ease, opacity 0.6s ease;
}
.sidebar .nav-link:active::after {
    transform: scale(2.5);
    opacity: 1;
}

/* ================= SCROLLBAR ================= */
.sidebar::-webkit-scrollbar {
    width: 6px;
}
.sidebar::-webkit-scrollbar-thumb {
    background: rgba(255,255,255,0.25);
    border-radius: 10px;
}

/* ================= OFFCANVAS BODY ================= */
.offcanvas-body {
    padding-top: 25px;
}
</style>

<div id="sidebar" class="sidebar border-end col-md-3 col-lg-2 p-0">
  <div class="offcanvas-body d-md-flex flex-column overflow-y-auto">

    <ul class="nav flex-column">

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.home.page') ? 'active-link' : '' }}"
           href="{{ route('admin.home.page') }}">
          <i class="bi bi-house-fill"></i> Home
        </a>
      </li>


      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.event.*') ? 'active-link' : '' }}"
           href="{{ route('admin.event.list') }}">
          <i class="bi bi-calendar-event"></i> Events
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.package.*') ? 'active-link' : '' }}"
           href="{{ route('admin.package.list') }}">
          <i class="bi bi-box-seam"></i> Packages
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.vendor.*') ? 'active-link' : '' }}"
           href="{{ route('admin.vendor.list') }}">
          <i class="bi bi-briefcase-fill"></i> Vendor
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.food.*') ? 'active-link' : '' }}"
           href="{{ route('admin.food.list') }}">
          <i class="bi bi-cup-straw"></i> Foods
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.decoration.*') ? 'active-link' : '' }}"
           href="{{ route('admin.decoration.list') }}">
          <i class="bi bi-stars"></i> Decorations
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.package.service.*') ? 'active-link' : '' }}"
           href="{{ route('admin.package.service.list') }}">
          <i class="bi bi-gear-fill"></i> Package Services
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.booking') ? 'active-link' : '' }}"
           href="{{ route('admin.booking') }}">
          <i class="bi bi-journal-check"></i> Bookings
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.customize.food.*') ? 'active-link' : '' }}"
           href="{{ route('admin.customize.food.list') }}">
          <i class="bi bi-egg-fried"></i> Custom Foods
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.customize.decoration.*') ? 'active-link' : '' }}"
           href="{{ route('admin.customize.decoration.list') }}">
          <i class="bi bi-lamp-fill"></i> Custom Decorations
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.customize.booking') ? 'active-link' : '' }}"
           href="{{ route('admin.customize.booking') }}">
          <i class="bi bi-calendar2-plus"></i> Custom Bookings
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.customer.*') ? 'active-link' : '' }}"
           href="{{ route('admin.customer.list') }}">
          <i class="bi bi-people-fill"></i> Customers
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.appointment.*') ? 'active-link' : '' }}"
           href="{{ route('admin.appointment.details') }}">
          <i class="bi bi-clipboard-check"></i> Appointments
        </a>
      </li>

      <li class="nav-item mt-3">
        <a class="nav-link text-danger"
           href="{{ route('admin.logout') }}">
          <i class="bi bi-box-arrow-right"></i> Logout
        </a>
      </li>

    </ul>

  </div>
</div>

{{-- ================= JS (Optional enhancement) ================= --}}
<script>
document.querySelectorAll('.sidebar .nav-link').forEach(link => {
    link.addEventListener('click', function () {
        document.querySelectorAll('.sidebar .nav-link').forEach(l => l.classList.remove('clicked'));
        this.classList.add('clicked');
    });
});
</script>
