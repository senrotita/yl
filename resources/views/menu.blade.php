<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>menu</title>
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <link href="https://cdn.bootcss.com/Swiper/4.0.6/css/swiper.min.css" rel="stylesheet">
    <style>
        body{padding: 0;margin: 0}
        .swiper-slide{width: auto!important;}
        .topmenu{height: 35px;background-color: white;border-bottom: 1px solid #CCCCCC;padding: 0 10px;line-height: 35px;font-family: "微软雅黑"}
    </style>
</head>
<body id="mall">
<!-- Swiper -->
<div class="topmenu">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <span class="swiper-slide">阿斯蒂芬</span>
            <span class="swiper-slide">时的风格</span>
            <span class="swiper-slide">啥都搞好对方更好的</span>
            <span class="swiper-slide">是的</span>
            <span class="swiper-slide">时的风格</span>
            <span class="swiper-slide">撒地方</span>
            <span class="swiper-slide">为阿斯蒂芬</span>
            <span class="swiper-slide">撒地方</span>
        </div>
    </div>
</div>
<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.bootcss.com/Swiper/4.0.6/js/swiper.min.js"></script>
<script>
    $(function () {
        var swiper = new Swiper('.swiper-container', {
            spaceBetween: 20,
            slidesPerView:'auto',
            freeMode: true
        });
    })
</script>
</body>
</html>