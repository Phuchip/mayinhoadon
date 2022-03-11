<div id="gallery" class="modal faded">
    <div class="modal-content">
        <div class="modal-header">
            <span class="close cursor" onclick="closeModal()"></span>    
            <p class="modal-title-cart">Ảnh sản phẩm</p>
            <span class="close cursor" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <div class="gallery-slide">
                <img src="/images/item/<?= $data['image'] ?>" alt="Ảnh đại diện">
            </div>
            <?php foreach ($list_img as $key => $value) : ?>
                <div class="gallery-slide">
                    <img src="/images/item/<?= $value ?>" alt="Mô tả">
                </div>
            <?php endforeach ?>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>
        </div>
        <div class="gallery-list">
            <div class="column active">
                <img class="demo cursor" src="/images/item/<?= $data['image'] ?>" onclick="currentSlide(1)" alt="Ảnh đại diện">
            </div>
            <?php $i = 2;
            foreach ($list_img as $key => $value) : ?>
                <div class="column">
                    <img class="demo cursor" src="/images/item/<?= $value ?>" onclick="currentSlide(<?= $i ?>)" alt="Mô tả">
                </div>
            <?php $i++;
            endforeach ?>
        </div>
    </div>
</div>