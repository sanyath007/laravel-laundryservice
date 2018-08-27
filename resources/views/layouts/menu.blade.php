<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle Navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Laundry Service</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="{{ url('/') }}">หน้าหลัก</a></li>

        @if (!Auth::guest())
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              รายการประจำวัน
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/daily/received/list') }}">รับผ้าจากโรงงาน</a></li>
              <li><a href="{{ url('/daily/sentout/list') }}">ส่งผ้าไปโรงงาน</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="{{ url('/daily/sentin/stock') }}">เบิก-จ่ายผ้าสามัญ</a></li>
              <!-- <li><a href="{{ url('/daily/sentin/form2') }}">ส่งผ้าไปหน่วยงาน (สำหรับงานซักฟอก)</a></li> -->
              <li role="separator" class="divider"></li>
              <li><a href="{{ url('/daily/setdrape/list') }}">เบิก-จ่ายเซตผ้าหัตถการ</a></li>
              <!-- <li><a href="{{ url('/daily/sentin/list') }}">ส่งเซตผ้าไปหน่วยงาน (สำหรับงานซักฟอก)</a></li> -->
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              Stock Card
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/drape/gen/list') }}">ผ้าผู้ป่วยทั่วไป</a></li>
              <li><a href="{{ url('/drape/vip/list') }}">ผ้าผู้ป่วยห้องพิเศษ</a></li>
              <li><a href="{{ url('/drape/baby/list') }}">ผ้าผู้ป่วยเด็ก</a></li>
              <li><a href="{{ url('/drape/or/list') }}">ผ้าผ่าตัด</a></li>
              <li><a href="{{ url('/drape/lr/list') }}">ผ้าห้องคลอด</a></li>
              <li><a href="{{ url('/drape/den/list') }}">ผ้าทันตกรรม</a></li>
              <li><a href="{{ url('/drape/sup/list') }}">ผ้าเซตจ่ายกลาง</a></li>
              <li><a href="{{ url('/drape/off/list') }}">ชุดปฏิบัติงานเจ้าหน้าที่</a></li>
              <li><a href="{{ url('/drape/bag/list') }}">ถุงผ้าเปื้อน</a></li>
              <li><a href="{{ url('/drape/oth/list') }}">อื่นๆ</a></li>
            </ul>
          </li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              ตั้งค่าพื้นฐาน
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="{{ url('/vehicles') }}">รายการรถ</a></li>
              <li><a href="{{ url('/drivers') }}">พนักงานขับรถ</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">ประเภทผ้า</a></li>
              <li><a href="#">ชนิดผ้า</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">ผู้จัดจำหน่าย</a></li>
              <li><a href="#">อู่ซ่อมรถ</a></li>
            </ul>
          </li>
          <!-- <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              ตั้งค่าระบบ
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">Action</a></li>
              <li><a href="#">Another action</a></li>
              <li><a href="#">Something else here</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">Separated link</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">One more separated link</a></li>
            </ul>
          </li> -->
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
              รายงาน
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li><a href="#">รายงานยอดขายรายวัน</a></li>
              <li><a href="#">สรุปยอดขายรายวัน</a></li>
              <li><a href="#">สรุปยอดขายรายเดือน</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">รายงานสต๊อกสินค้า</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="#">รายงานลูกหนี้</a></li>
              <li><a href="#">รายงานเจ้าหนี้</a></li>
            </ul>
          </li>
        @endif

      </ul>
      
      <ul class="nav navbar-nav navbar-right">

        @if (Auth::guest())
          <li><a href="{{ url('/auth/login') }}">Login</a></li>
          <li><a href="{{ url('/auth/register') }}">Register</a></li>
        @else

          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->person_firstname }} {{ Auth::user()->person_lastname }}
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu" role="menu">
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
          </li>

        @endif

      </ul>
    </div>
  </div>
</nav>
