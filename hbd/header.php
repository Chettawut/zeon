<?php
include_once('../config.php'); 
?>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
        <a class="navbar-brand" href="<?php echo PATH; ?>">Jaroon Software</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse"
            data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo PATH; ?>">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo PATH; ?>">ติดต่อเรา</a>
                </li>

                <!-- <li class="nav-item">
            <a class="nav-link" href="post.html">Sample Post</a>
          </li> -->
                <!-- <li class="nav-item">
                        <a class="nav-link" href="">About</a>
                    </li> -->
            </ul>
        </div>
    </div>
</nav>

<!-- Page Header -->
<header class="masthead" style="background-image: url('<?php echo PATH; ?>/img/home-bg.jpg')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="site-heading">

                    <body>
                        <div class="login">
                            <h1> <img src="<?php echo PATH; ?>/img/logo_fb.png" width="80px;"></h1>
                            <br>
                            <h3 style="color:black;">กรอกโค้ดครั้งที่ <span style="font-size:24px;"
                                    id="txtcount">1</span></h3>
                            <form action="submitscript.php" target="dummyframe">
                                <label for="username">
                                    <i class="far fa-keyboard"></i>
                                </label>
                                <input type="text" name="username" placeholder="กรอก Code ด้วยจ้า" id="username"
                                    required>
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"
                                    style="border-color:black;background-color:#FFC0CB">คำใบ้ที่ <span
                                        style="font-size:18px;" id="txtcount2">1</span></button>
                                <input id="btnSubmit" type="submit" value="ตกลง">

                            </form>
                        </div>
                    </body>
                    <!-- <h2>Pokémon Database</h2>
                        <span class="subheading">News & Updates</span> -->
                </div>
            </div>
        </div>

        <iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>
    </div>
</header>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"><span style="font-size:18px;" id="txtcount3">คำใบ้ที่
                        1</span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h3 id="textarea1">กล่องใส่ Nintendo Switch สีฟ้า</h3>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$("form").submit(function() {

    // $('#txtcount').text()
    // $('#txtcount2').text()
    // $('#txtcount3').text()
    // SOMANY
    // MYDEAR
    if ($('#txtcount').text() == 1) {
        if ($('#username').val() == 'THANKS') {
            Swal.fire('สำเร็จ', 'กดดูคำใบ้ต่อไปเลยจ้า', 'success');
            $('#txtcount').text('2')
            $('#txtcount2').text('2')
            $('#txtcount3').text('คำใบ้ที่ 2')
            $('#textarea1').text('กล่องนอนจรูญใต้ปริ้นเตอร์')
            $('#username').val('')
        } else
            Swal.fire('เกิดข้อผิดพลาด', "Code ผิดจ้า", 'error');
    } else if ($('#txtcount').text() == 2) {
        if ($('#username').val() == 'SOMANY') {
            Swal.fire('สำเร็จ', 'กดดูคำใบ้ต่อไปเลยจ้า', 'success');
            $('#txtcount').text('3')
            $('#txtcount2').text('3')
            $('#txtcount3').text('คำใบ้ที่ 3')
            $('#textarea1').text('ตู้เก็บของสีขาวอันใหม่')
            $('#username').val('')
        } else
            Swal.fire('เกิดข้อผิดพลาด', "Code ผิดจ้า", 'error');
        } else if ($('#txtcount').text() == 3) {
        if ($('#username').val() == 'MYDEAR') {
            Swal.fire('สำเร็จ', 'กดดูคำใบ้ต่อไปเลยจ้า', 'success');
            $('#txtcount').text('4')
            $('#txtcount2').text('4')
            $('#txtcount3').text('คำใบ้ที่ 4')
            $('#textarea1').text('ลิ้นชักในรถยนต์ฝั่งซ้าย')
            $('#username').val('')
        } else
            Swal.fire('เกิดข้อผิดพลาด', "Code ผิดจ้า", 'error');
    }
});
</script>