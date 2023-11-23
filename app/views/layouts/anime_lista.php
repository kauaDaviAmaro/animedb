<swiper-container class="swiper" init="false">
    <?php foreach ($animes as $anime): ?>
        <swiper-slide>
            <?php include 'anime_slide.php'; ?>
        </swiper-slide>
    <?php endforeach; ?>
</swiper-container>