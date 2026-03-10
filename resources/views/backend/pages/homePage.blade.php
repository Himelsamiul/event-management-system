@extends('backend.master')

@section('content')
<div class="container dashboard-container">

    <h2 class="dashboard-header">Admin Dashboard</h2>

    {{-- ================= DASHBOARD CARDS ================= --}}
    <div class="row g-4 mb-5">

        @php
            $cards = [
                ['title'=>'Total Booking','value'=>$totalBookings,'color'=>'grad-1'],
                ['title'=>'Pending Booking','value'=>$totalPendingBookings,'color'=>'grad-2'],
                ['title'=>'Accepted Booking','value'=>$totalAcceptBookings,'color'=>'grad-3'],
                ['title'=>'Cancelled Booking','value'=>$totalRejectBookings,'color'=>'grad-4'],

                ['title'=>'Customize Pending','value'=>$totalCustomizePending,'color'=>'grad-5'],
                ['title'=>'Customize Accepted','value'=>$totalCustomizeAccept,'color'=>'grad-6'],
                ['title'=>'Customize Rejected','value'=>$totalCustomizeReject,'color'=>'grad-7'],

                ['title'=>'Customers','value'=>$totalCustomers,'color'=>'grad-8'],
                ['title'=>'Appointments','value'=>$totalAppointments,'color'=>'grad-9'],
                ['title'=>'Decorations','value'=>$totalDecorations,'color'=>'grad-10'],
                ['title'=>'Events','value'=>$totalEvents,'color'=>'grad-11'],
                ['title'=>'Foods','value'=>$totalFoods,'color'=>'grad-12'],
                ['title'=>'Packages','value'=>$totalPackages,'color'=>'grad-13'],
                ['title'=>'Package Services','value'=>$totalPackageServices,'color'=>'grad-14'],
                ['title'=>'Customize Booking','value'=>$totalCustomizeBookings,'color'=>'grad-15'],
                ['title'=>'Vendors','value'=>$totalVendors,'color'=>'grad-16'],
                ['title'=>'Users','value'=>$totalUsers,'color'=>'grad-17'],

                ['title'=>'Booking Paid (৳)','value'=>$totalPaidAmount,'color'=>'grad-18'],
                ['title'=>'Booking Due (৳)','value'=>$totalDueAmount,'color'=>'grad-19'],
                ['title'=>'Booking Collectable (৳)','value'=>$totalCollectableAmount,'color'=>'grad-20'],

                ['title'=>'Customize Paid (৳)','value'=>$totalCustomizePaidAmount,'color'=>'grad-21'],
                ['title'=>'Customize Due (৳)','value'=>$totalCustomizeDueAmount,'color'=>'grad-22'],
                ['title'=>'Customize Collectable (৳)','value'=>$totalCustomizeCollectableAmount,'color'=>'grad-23'],
            ];
        @endphp

        @foreach($cards as $card)
        <div class="col-sm-6 col-md-4 col-lg-3">
            <div class="dashboard-card {{ $card['color'] }}">
                <h6>{{ $card['title'] }}</h6>
                <span class="counter" data-target="{{ $card['value'] }}">0</span>
            </div>
        </div>
        @endforeach

    </div>

    {{-- ================= PIE CHART SECTION (BOTTOM) ================= --}}
    <div class="row mb-4">

        {{-- Booking Pie --}}
        <div class="col-md-6 d-flex justify-content-center">
            <div class="chart-card">
                <h5 class="mb-2">Booking Status</h5>
                <canvas id="bookingPie"></canvas>
            </div>
        </div>

        {{-- Customize Booking Pie --}}
        <div class="col-md-6 d-flex justify-content-center">
            <div class="chart-card">
                <h5 class="mb-2">Customize Booking Status</h5>
                <canvas id="customizePie"></canvas>
            </div>
        </div>

    </div>

</div>

{{-- ================= CSS ================= --}}
<style>
.dashboard-container { padding:30px; }

.dashboard-header {
    text-align:center;
    font-size:36px;
    font-weight:800;
    margin-bottom:35px;
    letter-spacing:2px;
}

/* -------- Cards -------- */
.dashboard-card{
    padding:22px;
    border-radius:18px;
    color:#fff;
    text-align:center;
    box-shadow:0 12px 30px rgba(0,0,0,.25);
    transition:.35s ease;
    position:relative;
    overflow:hidden;
}
.dashboard-card:hover{
    transform:translateY(-10px) scale(1.03);
}
.dashboard-card::after{
    content:'';
    position:absolute;
    inset:0;
    background:rgba(255,255,255,.15);
    opacity:0;
    transition:.3s;
}
.dashboard-card:hover::after{ opacity:1; }

.dashboard-card h6{
    font-size:16px;
    margin-bottom:10px;
}
.dashboard-card span{
    font-size:28px;
    font-weight:900;
}

/* -------- Pie Chart -------- */
.chart-card{
    background:transparent;
    text-align:center;
}
.chart-card canvas{
    width:240px !important;
    height:240px !important;
}

/* -------- Gradients -------- */
.grad-1{background:linear-gradient(135deg,#ff416c,#ff4b2b);}
.grad-2{background:linear-gradient(135deg,#f7971e,#ffd200);}
.grad-3{background:linear-gradient(135deg,#56ab2f,#a8e063);}
.grad-4{background:linear-gradient(135deg,#cb2d3e,#ef473a);}
.grad-5{background:linear-gradient(135deg,#2193b0,#6dd5ed);}
.grad-6{background:linear-gradient(135deg,#00b09b,#96c93d);}
.grad-7{background:linear-gradient(135deg,#7b4397,#dc2430);}
.grad-8{background:linear-gradient(135deg,#4776e6,#8e54e9);}
.grad-9{background:linear-gradient(135deg,#ee0979,#ff6a00);}
.grad-10{background:linear-gradient(135deg,#42275a,#734b6d);}
.grad-11{background:linear-gradient(135deg,#134e5e,#71b280);}
.grad-12{background:linear-gradient(135deg,#ff8008,#ffc837);}
.grad-13{background:linear-gradient(135deg,#6a11cb,#2575fc);}
.grad-14{background:linear-gradient(135deg,#f12711,#f5af19);}
.grad-15{background:linear-gradient(135deg,#141e30,#243b55);}
.grad-16{background:linear-gradient(135deg,#11998e,#38ef7d);}
.grad-17{background:linear-gradient(135deg,#fc4a1a,#f7b733);}
.grad-18{background:linear-gradient(135deg,#00c6ff,#0072ff);}
.grad-19{background:linear-gradient(135deg,#ff512f,#dd2476);}
.grad-20{background:linear-gradient(135deg,#8360c3,#2ebf91);}
.grad-21{background:linear-gradient(135deg,#1d976c,#93f9b9);}
.grad-22{background:linear-gradient(135deg,#e65c00,#f9d423);}
.grad-23{background:linear-gradient(135deg,#654ea3,#eaafc8);}
</style>

{{-- ================= JS ================= --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
// COUNTER ANIMATION
document.querySelectorAll('.counter').forEach(counter=>{
    let target=+counter.dataset.target,count=0,step=target/60;
    (function run(){
        if(count<target){
            count+=step;
            counter.innerText=Math.ceil(count);
            requestAnimationFrame(run);
        }else counter.innerText=target.toLocaleString();
    })();
});

// BOOKING PIE
new Chart(document.getElementById('bookingPie'),{
    type:'pie',
    data:{
        labels:['Pending','Accepted','Rejected'],
        datasets:[{
            data:[
                {{ $totalPendingBookings }},
                {{ $totalAcceptBookings }},
                {{ $totalRejectBookings }}
            ],
            backgroundColor:['#f9c74f','#43aa8b','#f94144'],
            borderWidth:0
        }]
    },
    options:{
        maintainAspectRatio:false,
        radius:'70%',
        plugins:{ legend:{ position:'bottom' } }
    }
});

// CUSTOMIZE PIE
new Chart(document.getElementById('customizePie'),{
    type:'pie',
    data:{
        labels:['Pending','Accepted','Rejected'],
        datasets:[{
            data:[
                {{ $totalCustomizePending }},
                {{ $totalCustomizeAccept }},
                {{ $totalCustomizeReject }}
            ],
            backgroundColor:['#ffd166','#06d6a0','#ef476f'],
            borderWidth:0
        }]
    },
    options:{
        maintainAspectRatio:false,
        radius:'70%',
        plugins:{ legend:{ position:'bottom' } }
    }
});
</script>
@endsection
