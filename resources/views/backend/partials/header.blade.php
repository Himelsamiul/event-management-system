<header id="navbar" class="admin-navbar">

    <!-- LEFT: Digital Clock -->
    <div class="clock-wrapper">
        <span id="digitalClock">00:00:00</span>
    </div>

    <!-- MIDDLE: Project Name -->
    <div class="brand-center">
        <i class=""></i>
        <span>Event Management System</span>
    </div>

    <!-- RIGHT: Admin Info -->
    @auth()
    <div class="admin-area">

        <div class="admin-btn" id="adminToggle">
            <i class="bi bi-person-circle"></i>
            <span>Admin</span>
            <i class="bi bi-chevron-down"></i>
        </div>

        <!-- Dropdown -->
        <div class="admin-dropdown" id="adminDropdown">
            <div class="admin-profile">
                <i class=""></i>
                <div>
                    <strong>Tanjina Akter Sraboni</strong>
                    <small>Web Developer</small>
                </div>
            </div>

            <div class="admin-info">
                <p><i class="bi bi-envelope-fill"></i> tanjina@gmail.com</p>
            </div>

            <div class="admin-actions">
                <a href="{{ route('admin.logout') }}">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </a>
            </div>
        </div>

    </div>
    @endauth

</header>

{{-- ================= CSS ================= --}}
<style>
.admin-navbar{
    height:65px;
    background:linear-gradient(90deg,#141e30,#243b55);
    display:grid;
    grid-template-columns: 1fr auto 1fr;
    align-items:center;
    padding:0 25px;
    color:#fff;
    box-shadow:0 4px 15px rgba(0,0,0,.4);
    position:sticky;
    top:0;
    z-index:1000;
}

/* ================= CLOCK ================= */
.clock-wrapper{
    font-family: 'Courier New', monospace;
    font-size:20px;
    font-weight:bold;
    letter-spacing:2px;
}

#digitalClock{
    padding:6px 14px;
    border-radius:10px;
    background:linear-gradient(135deg,#00c6ff,#0072ff,#00ffcc);
    background-size:300% 300%;
    animation: clockGlow 4s ease infinite;
    color:#fff;
    box-shadow:0 0 12px rgba(0,255,255,.6);
}

@keyframes clockGlow {
    0%{background-position:0% 50%;}
    50%{background-position:100% 50%;}
    100%{background-position:0% 50%;}
}

/* ================= CENTER BRAND ================= */
.brand-center{
    display:flex;
    align-items:center;
    justify-content:center;
    gap:10px;
    font-size:20px;
    font-weight:700;
    letter-spacing:1px;
}
.brand-center i{
    font-size:24px;
    color:#00eaff;
}

/* ================= ADMIN AREA ================= */
.admin-area{
    display:flex;
    justify-content:flex-end;
    position:relative;
}

.admin-btn{
    display:flex;
    align-items:center;
    gap:8px;
    cursor:pointer;
    padding:8px 14px;
    border-radius:30px;
    transition:.3s;
}
.admin-btn:hover{
    background:rgba(255,255,255,.15);
}
.admin-btn i{
    font-size:18px;
}

/* ================= DROPDOWN ================= */
.admin-dropdown{
    position:absolute;
    right:0;
    top:60px;
    width:260px;
    background:#fff;
    color:#333;
    border-radius:15px;
    box-shadow:0 15px 35px rgba(0,0,0,.25);
    opacity:0;
    visibility:hidden;
    transform:translateY(-10px);
    transition:.3s;
}
.admin-dropdown.show{
    opacity:1;
    visibility:visible;
    transform:translateY(0);
}

/* Profile */
.admin-profile{
    display:flex;
    gap:12px;
    align-items:center;
    padding:15px;
    border-bottom:1px solid #eee;
}
.admin-profile i{
    font-size:42px;
    color:#007bff;
}
.admin-profile strong{
    display:block;
}
.admin-profile small{
    color:#666;
}

/* Info */
.admin-info{
    padding:10px 15px;
    font-size:14px;
}
.admin-info i{
    color:#007bff;
    margin-right:6px;
}

/* Actions */
.admin-actions{
    border-top:1px solid #eee;
}
.admin-actions a{
    display:block;
    padding:12px 15px;
    text-decoration:none;
    color:#dc3545;
    font-weight:500;
}
.admin-actions a:hover{
    background:#f8f9fa;
}
</style>

{{-- ================= JS ================= --}}
<script>
// DIGITAL CLOCK
function updateClock(){
    const now = new Date();
    const h = String(now.getHours()).padStart(2,'0');
    const m = String(now.getMinutes()).padStart(2,'0');
    const s = String(now.getSeconds()).padStart(2,'0');
    document.getElementById('digitalClock').innerText = `${h}:${m}:${s}`;
}
setInterval(updateClock,1000);
updateClock();

// ADMIN DROPDOWN
const toggle = document.getElementById('adminToggle');
const dropdown = document.getElementById('adminDropdown');

toggle.addEventListener('click', function (e) {
    e.stopPropagation();
    dropdown.classList.toggle('show');
});

document.addEventListener('click', function () {
    dropdown.classList.remove('show');
});
</script>
