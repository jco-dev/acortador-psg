<div class="page-title-alt-bg"></div>
<div class="page-title-box">
    <div class="page-title-right">
        <ol class="breadcrumb m-0">
            <li class="breadcrumb-item"><a href="<?= base_url(route_to('dashboard')) ?>">Inicio</a></li>
            <li class="breadcrumb-item active"><?= $this->renderSection("subtitle") ?></li>
        </ol>
    </div>
    <h4 class="page-title"><?= $this->renderSection("title_toolbar") ?></h4>
</div>