<?php
	
function shortcode_tragop($atts) {

	global $wp_widget_factory;

	extract(shortcode_atts(array(
			'tong_gia' => FALSE,
			'thoi_gian'    => '',
			'lai_xuat' => ''
	), $atts));
	$price=  $tong_gia;
	
	ob_start();?>
	<div id="mua_tra_gop">
	<div class="close_x"></div>
	<div class="all">
	<div class="content">
                <div class="item1">
                    <h3>Dự tính chi phí trả góp</h3>
					
                    <div class="price">Giá xe: <span data-xe="<?php echo $price?>" class="gia_xe_tra_gop"><?php echo number_format($price,0)?> VNĐ</span></div>
                    <label>Số tiền vay</label>
                    <ul class="count">
                        <li>
                            <select class="tien_vay">
								<?php for($i=5;$i<=85;$i+=5){?>
									<option value="<?php echo $i?>"><?php echo $i?>%</option>
								<?php }?>
							</select>
                        </li>
                        <li>= <span class="tong_phan_tram"><?php echo number_format($price,0)?> VNĐ</span></li>
                    </ul>
                    <ul class="count2">
                        <li>
                            <label>Thời gian</label>
                            <select class="thoi_gian_vay">
                                                                    <option value="1">1 năm</option>
                                                                        <option value="2">2 năm</option>
                                                                        <option value="3">3 năm</option>
                                                                        <option value="4">4 năm</option>
                                                                        <option value="5">5 năm</option>
                                                                        <option value="6">6 năm</option>
                                                                </select>
                        </li>
                        <li>
                            <label>Lãi xuất/năm</label>
                            <select class="lai_xuat_vay">
							<?php for($i=7;$i<=12;$i+=0.5){?>
								<option value="<?php echo $i?>"><?php echo $i?>%</option>
							<?php }?>
							</select>
                        </li>
                    </ul>
                    <div class="line-tra-gop"></div>
                    <p>Số tiền TB đóng hàng tháng: <span class="txt_tong_so_tien_thang">5.025.246 VNĐ</span></p>
                    <p>Số tháng: <span class="txt_so_thang">12</span></p>

                    <a href="tel:<?php echo $mobile?>" class="btn-tra-gop"><?php echo $mobile?></a>

                    <ul class="txt">
                        <li><span>•</span>  Bảng này giúp bạn tính toán số tiền cần trả khi vay ngân hàng để mua xe trả góp.</li>
                        <li><span>•</span>  Cách thức tính theo dư nợ giảm dần hàng tháng.</li>
                        <li><span>•</span>  Giá trị của bảng là tương đối, sẽ được chi tiết cụ thể khi tiến hành thủ tục trả góp.</li>
                    </ul>
                    <div class="close"><span class="fa fa-close"></span></div>
                </div>
                <div class="item2">
                    <p class="du_no_dau_ky0">58100000</p>
                    <table>
                        <thead>
                            <tr>
                                <th>Tháng</th>
                                <th>Dư nợ đầu kỳ</th>
                                <th>Trả gốc hàng tháng</th>
                                <th>Trả Lãi hàng tháng</th>
                                <th>Gốc + lãi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>0</td>
                                <td class="gia_ban_dau">58.100.000</td>
                                <td>0</td>
                                <td>0</td>
                                <td>0</td>
                            </tr>
                        </tbody>
                        <tfoot class="append-content">
                            <tr>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
		</div>
	</div>
			<style>
#mua_tra_gop {
 width:100%;
 height:100vh;
 top:0;
 position:fixed;
 background:rgba(0,0,0,.5);
 z-index:9999999999;
 left:0;
 display:none
}
#mua_tra_gop .all {
 width:auto;
 height:auto;
 position:absolute;
 background:0 0;
 left:50%;
 top:50%;
 -webkit-transform:translate(-50%,-50%);
 -ms-transform:translate(-50%,-50%);
 transform:translate(-50%,-50%)
}
#mua_tra_gop .all .content {
 width:100%;
 height:auto;
 background:0 0;
 position:relative;
 display:-webkit-box;
 display:-webkit-flex;
 display:-ms-flexbox;
 display:flex
}
#mua_tra_gop .all .item1 {
 width:430px;
 margin-right:10px;
 text-align:center;
 background:#fff;
 padding:40px;
 position:relative
}
#mua_tra_gop .all .item1 .close {
 top:0
}
#mua_tra_gop .all .item1 .close img {
 width:100%;
 margin-top:0
}
#mua_tra_gop .all .item1 h3 {
 font-size:30px;
 font-weight:600;
 text-align:center;
 color:#ec1c2f;
 padding-top:0;
 margin-top:-8px
}
#mua_tra_gop .all .item1 img {
 width:223px;
 margin-top:-8px
}
#mua_tra_gop .all .item1 .price,#mua_tra_gop .all .item1 button {
 font-size:14px;
 color:#333;
 font-weight:600;
 text-align:center
}
#mua_tra_gop .all .item1 .price span {
 font-size:18px;
 font-weight:600;
 text-align:center;
 color:#e32220
}
#mua_tra_gop .all .item1 label {
 font-family:Arial;
 font-size:14px;
 text-align:left;
 color:#333;
 margin-top:21px
}
#mua_tra_gop .all,#mua_tra_gop .all .item1 ul.count,#mua_tra_gop .all .item1 ul.count2 {
 display:-webkit-box;
 display:-webkit-flex;
 display:-ms-flexbox;
 display:flex
}
#mua_tra_gop .all .item1 ul.count li,#mua_tra_gop .all .item1 ul.count2 li {
 font-size:16px;
 font-weight:600;
 text-align:left;
 color:#333;
 line-height:44px;
 margin-top:2px
}
#mua_tra_gop .all .item1 ul.count li select,#mua_tra_gop .all .item1 ul.count2 li select {
 width:165px;
 height:44px;
 border-radius:22px;
 background-color:#f4f4f4;
 border:solid 1px #e9e9e9;
 outline:0;
 font-family:Arial;
 font-size:14px;
 text-align:left;
 color:#333;
 padding:0 19px;
 margin-right:10px
}
#mua_tra_gop .all .item1 ul.count li label,#mua_tra_gop .all .item1 ul.count2 li label {
 margin-top:-13px;
 margin-bottom:-2px
}
#mua_tra_gop .all .item1 ul.count2 li {
 margin-right:10px
}
#mua_tra_gop .all .item1 .line-tra-gop {
 width:100%;
 height:1px!important;
 background:#e9e9e9;
 margin-top:6px;
 margin-bottom:17px
}
#mua_tra_gop .all .item1 p,#mua_tra_gop .all .item1 p .txt_so_thang {
 font-family:Arial;
 font-size:14px;
 line-height:1.71;
 text-align:left;
 color:#333;
 margin-bottom:0
}
#mua_tra_gop .all .item1 p span {
 font-family:Montserrat;
 font-size:18px;
 font-weight:600;
 line-height:1.33;
 color:#ec1c2f
}
#mua_tra_gop .all .item1 p .txt_so_thang {
 font-weight:400
}
#mua_tra_gop .all .item1 button {
 width:350px;
 height:44px;
 border-radius:22px;
 background-color:#ec1c2f;
 border:0!important;
 font-weight:500;
 line-height:1.71;
 letter-spacing:.7px;
 color:#fff;
 margin:24px 0;
 -webkit-transform:none;
 -ms-transform:none;
 transform:none
}
#mua_tra_gop .all .item1 button svg {
 margin-left:3px
}
#mua_tra_gop .all .item1 ul.txt li {
 font-family:Arial;
 font-size:14px;
 line-height:1.8;
 text-align:left;
 color:#333
}
#mua_tra_gop .all .item1 ul.txt span {
 color:#ec1c2f!important
}
#mua_tra_gop .all .item2 {
 width:720px;
 height:664px;
 background:#fff;
 overflow-y:scroll;
 display:none;
 position:relative;
 overflow-x:hidden
}
#mua_tra_gop .all .item2 table {
 border-color:#e9e9e9;
 margin-top:-1px
}
#mua_tra_gop .all .item2 table td,#mua_tra_gop .all .item2 table th {
 border-color:#e9e9e9;
 border-left:none
}
#mua_tra_gop .all .item2 table .fixed-th {
 position:fixed
}
#mua_tra_gop .all .item2 table tr th {
 padding-left:15px;
 background:#ec1c2f;
 font-size:14px;
 font-weight:500;
 line-height:1.71;
 text-align:left;
 color:#fff
}
#mua_tra_gop .all .item2 table tr th:nth-child(1) {
 width:75px
}
#mua_tra_gop .all .item2 table tr th:last-child {
 width:20%
}
#mua_tra_gop .all .item2 table tr th:nth-child(2) {
 width:140px
}
#mua_tra_gop .all .item2 table tr th:nth-child(3) {
 width:175px
}
.du_no_dau_ky,p.du_no_dau_ky0 {
 position:absolute;
 visibility:hidden
}
.tong_chi_phi_tra_gop {
 font-weight:600;
 text-align:center;
 padding:0;
 margin:0
}</style>
	
	<script>
	! function(e) {
    "use strict";
    jQuery(document).ready(function() {
        jQuery(".click-search").on("click", function() {
            jQuery(".search-header .search-form").slideToggle()
        }), jQuery(".thong_so_ky_thuat .tabs .item:first-child .content").show(), jQuery(".thong_so_ky_thuat .tabs .item:first-child .toggle").addClass("active_title"), jQuery(".thong_so_ky_thuat .tabs .item:first-child .toggle h3 .fa-plus").hide(), jQuery(".thong_so_ky_thuat .tabs .item:first-child .toggle h3 .fa-minus").show(), jQuery(".thong_so_ky_thuat .tabs .item").on("click", function() {
            jQuery(this).find(".fa-plus").toggle(), jQuery(this).find(".fa-minus").toggle(), jQuery(this).find(".toggle").toggleClass("active_title"), jQuery(this).find(".content").slideToggle()
        }), jQuery(document).scroll(function() {
            10 < jQuery(document).scrollTop() ? (jQuery(".site-header.desktop").addClass("sticky-header"), jQuery(".single-post_oto .hotline_box").addClass("remove")) : (jQuery(".site-header.desktop").removeClass("sticky-header"), jQuery(".single-post_oto .hotline_box").removeClass("remove"))
        }), jQuery("#mua_ngay .content .close").on("click", function() {
            jQuery("#mua_ngay").fadeOut()
        }), jQuery("#click_mua_ngay").on("click", function() {
            jQuery("#mua_ngay").fadeIn()
        });
        var e = jQuery("#mua_ngay .content .gia").attr("data-gia"),
            t = jQuery("#mua_ngay .content h3").text();
        jQuery(".gia_mua_ngay_hide").val(e), jQuery(".ten_xe_mua_ngay_hide").val(t), jQuery(".btn-mua-ngay").on("click", function() {
            0 == jQuery("#fld_8768091_1").val().length || 0 == jQuery("#fld_9970286_1").val().length || 0 == jQuery("#fld_6009157_1").val().length ? (jQuery("#mua_ngay .content p").show(), jQuery("#mua_ngay ul.icon").show(), jQuery(".form-dk").show(), jQuery(".dk_thanh_cong").hide()) : (jQuery("#mua_ngay .content p").hide(), jQuery("#mua_ngay ul.icon").hide(), jQuery(".form-dk").hide(), jQuery(".dk_thanh_cong").show())
        }), jQuery("#click_yeu_cau_bao_gia").on("click", function() {
            jQuery("#yeu_cau_bao_gia").fadeIn()
        }), jQuery("#click_nhan_bao_gia2").on("click", function() {
            return jQuery("#yeu_cau_bao_gia").fadeIn(), !1
        }), jQuery("#yeu_cau_bao_gia .content .close").on("click", function() {
            jQuery("#yeu_cau_bao_gia").fadeOut()
        }), jQuery("#yeu_cau_bao_gia ul.img_xe li:first-child").addClass("active"), jQuery(".ten_xe_yeu_cau_bao_gia_hide").val(jQuery("#yeu_cau_bao_gia ul.img_xe li:first-child").attr("data-name")), jQuery("#yeu_cau_bao_gia ul.img_xe li").on("click", function() {
            jQuery("#yeu_cau_bao_gia ul.img_xe li").removeClass("active"), jQuery(this).addClass("active"), jQuery(".ten_xe_yeu_cau_bao_gia_hide").val(jQuery(this).attr("data-name"))
        }), jQuery("#click_dang_ky_lai_thu").on("click", function() {
            jQuery("#dang_ky_lai_thu").fadeIn()
        }), jQuery(".hotline_box .dk").on("click", function() {
            jQuery("#dang_ky_lai_thu").fadeIn()
        }), jQuery(".hotline_box .tra_gop").on("click", function() {
            jQuery("#mua_tra_gop").fadeIn()
        }), jQuery(".hotline_box .bao_gia").on("click", function() {
            jQuery("#yeu_cau_bao_gia").fadeIn()
        }), jQuery("#click_dang_ky_lai_thu2").on("click", function() {
            return jQuery("#dang_ky_lai_thu").fadeIn(), !1
        }), jQuery("#dang_ky_lai_thu .content .close").on("click", function() {
            jQuery("#dang_ky_lai_thu").fadeOut()
        }), jQuery("#dang_ky_lai_thu ul.img_xe li:first-child").addClass("active"), jQuery(".ten_xe_dk_hide").val(jQuery("#dang_ky_lai_thu ul.img_xe li:first-child").attr("data-name")), jQuery("#dang_ky_lai_thu ul.img_xe li").on("click", function() {
            jQuery("#dang_ky_lai_thu ul.img_xe li").removeClass("active"), jQuery(this).addClass("active"), jQuery(".ten_xe_dk_hide").val(jQuery(this).attr("data-name"))
        }), jQuery("#dk_lai_thu a").on("click", function() {
            return jQuery("#dang_ky_lai_thu").fadeIn(), !1
        }), jQuery("#nhan-bao-gia a").on("click", function() {
            return jQuery("#yeu_cau_bao_gia").fadeIn(), !1
        }), jQuery("#mua_tra_gop .close_x").on("click", function() {
            jQuery("#mua_tra_gop").fadeOut()
        }), jQuery("#dang_ky_lai_thu .close_x").on("click", function() {
            jQuery("#dang_ky_lai_thu").fadeOut()
        }), jQuery("#mua_ngay .close_x").on("click", function() {
            jQuery("#mua_ngay").fadeOut()
        }), jQuery("#yeu_cau_bao_gia .close_x").on("click", function() {
            jQuery("#yeu_cau_bao_gia").fadeOut()
        }), jQuery(".tien_vay option[value=10]").attr("selected", "selected");
        var S = jQuery(".gia_xe_tra_gop").attr("data-xe"),
            a = parseFloat(jQuery(".tien_vay option:selected").text()),
            n = parseFloat(jQuery(".thoi_gian_vay option:selected").text()),
            r = parseFloat(jQuery(".lai_xuat_vay option:selected").text()),
            i = jQuery(".tong_phan_tram"),
            u = S / 100 * a;
        i.text(u.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + " VNĐ"), jQuery(".txt_so_thang").text(12 * n);
        var o = parseFloat(jQuery(".tien_vay option:selected").text()),
            _ = S / 100 * o;
        i.text(_.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + " VNĐ"), jQuery(".du_no_dau_ky0").text(_), jQuery(".gia_ban_dau").text(_.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")), jQuery(".tien_vay").on("change", function() {
            var e = parseFloat(jQuery(".tien_vay option:selected").text()),
                t = S / 100 * e;
            i.text(t.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + " VNĐ"), jQuery(".du_no_dau_ky0").text(t), jQuery(".gia_ban_dau").text(t.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
            var a = parseFloat(jQuery(".lai_xuat_vay option:selected").text()),
                n = parseFloat(jQuery(".thoi_gian_vay option:selected").text()),
                r = a / 100,
                u = (24 + 12 * n * r + r) * t / 24 / (12 * n);
            u = parseInt(u), jQuery(".txt_tong_so_tien_thang").text(u.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + " VNĐ")
        }), jQuery(".thoi_gian_vay").on("change", function() {
            var e = parseFloat(jQuery(".thoi_gian_vay option:selected").text());
            jQuery(".txt_so_thang").text(12 * e);
            var t = parseFloat(jQuery(".tien_vay option:selected").text()),
                a = S / 100 * t,
                n = parseFloat(jQuery(".lai_xuat_vay option:selected").text()) / 100,
                r = (24 + 12 * e * n + n) * a / 24 / (12 * e);
            r = parseInt(r), jQuery(".txt_tong_so_tien_thang").text(r.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + " VNĐ")
        }), jQuery(".lai_xuat_vay").on("change", function() {
            var e = parseFloat(jQuery(".thoi_gian_vay option:selected").text()),
                t = parseFloat(jQuery(".tien_vay option:selected").text()),
                a = S / 100 * t,
                n = parseFloat(jQuery(".lai_xuat_vay option:selected").text()) / 100,
                r = (24 + 12 * e * n + n) * a / 24 / (12 * e);
            r = parseInt(r), jQuery(".txt_tong_so_tien_thang").text(r.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + " VNĐ")
        });
        o = parseFloat(jQuery(".tien_vay option:selected").text()), n = parseFloat(jQuery(".thoi_gian_vay option:selected").text()), r = parseFloat(jQuery(".lai_xuat_vay option:selected").text());
        var l = 12 * n,
            c = (_ = S / 100 * o, r / 100),
            y = (24 + 12 * n * c + c) * _ / 24 / l;

        function $(e, t) {
            return parseInt(e / t)
        }

        function C(e, t, a) {
            return parseInt(e * a / t)
        }

        function w(e, t) {
            return parseInt(e + t)
        }
        y = parseInt(y), jQuery(".txt_tong_so_tien_thang").text(y.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.") + " VNĐ");
        var N = [];
        jQuery(".btn-tra-gop").on("click", function() {
            jQuery(".append-content").empty();
            for (var e, t, a, n = parseFloat(jQuery(".tien_vay option:selected").text()), r = S / 100 * n, u = parseFloat(jQuery(".thoi_gian_vay option:selected").text()), i = parseFloat(jQuery(".thoi_gian_vay option:selected").text()), o = parseFloat(jQuery(".lai_xuat_vay option:selected").text()) / 100, _ = parseInt(12 * u), l = 0, c = 0, y = 0, d = 0, s = 1; s <= _; s++) {
                var g = r,
                    j = o * (12 * i - s + 1),
                    Q = 144 * i,
                    p = r,
                    h = 12 * i,
                    f = jQuery(".du_no_dau_ky" + l++).text() - $(p, h),
                    x = (x = f).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."),
                    k = $(p, h),
                    m = ($(p, h), C(g, Q, j));
                N.push($(p, h));
                var v = $(p, h).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                c += $(p, h);
                var b = C(g, Q, j).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                t = (y = y + C(g, Q, j)).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                var I = w(k, m).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.");
                if (a = (d += w(k, m)).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."), f < 1e3) {
                    var F = "number_fix";
                    e = (e = c + f).toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1.")
                } else F = "";
                jQuery(".append-content").append('<tr class="' + F + '"><td>' + s + '</td> <td><span class="du_no_dau_ky du_no_dau_ky' + s + '">' + f + "</span>" + x + "</td> <td>" + v + "</td> <td>" + b + "</td> <td>" + I + "</td> </tr>")
            }
            jQuery(".append-content").append("<tr><td> </td> <td></td> <td><strong>" + e + "</strong></td> <td><strong>" + t + "</strong></td> <td><strong>" + a + "</strong></td></tr>"), jQuery(".append-content").append('<tr><td colspan="5" class="border-none"><p class="tong_chi_phi_tra_gop">TỔNG CHI PHÍ: <span>' + a + " VNĐ</span></p></td></tr>"), jQuery("#mua_tra_gop .all .item2").fadeIn(), jQuery(".number_fix td:nth-child(2)").text("0")
        }), jQuery("#mua_tra_gop .all .item1 .close").on("click", function() {
            jQuery("#mua_tra_gop").fadeOut()
        }), jQuery("#click_mua_tra_gop").on("click", function() {
            jQuery("#mua_tra_gop").fadeIn()
        });
        var d = jQuery(".slider_noi_that .item").length;
        jQuery(".pagi-number .n2").text(d);
        var s = jQuery(".slider_noi_that .item.is-selected").attr("data-count");
        jQuery(".pagi-number .n1").load(s), jQuery(".slider_noi_that .item").change(function() {
            jQuery(".pagi-number .n1").load(s)
        })
    })
}(jQuery);
	</script>
	<?php 
	$output = ob_get_contents();
	ob_end_clean();
	return $output;

}
add_shortcode('tragop','shortcode_tragop');
