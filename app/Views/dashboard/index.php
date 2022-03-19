<?= $this->extend('base') ?>

<?= $this->section('title_toolbar') ?>
Tablero
<?= $this->endSection() ?>

<?= $this->section('subtitle') ?>
Tablero
<?= $this->endSection() ?>

<?= $this->section("content") ?>
<div class="row">
    <div class="col-xl-4">
        <div class="card-box widget-chart-one gradient-success bx-shadow-lg">
            <div class="float-left" dir="ltr">
                <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#ffffff" data-bgcolor="rgba(255,255,255,0.2)" value="49" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
            </div>
            <div class="widget-chart-one-content text-right">
                <p class="text-white mb-0 mt-2">Statistics</p>
                <h3 class="text-white">$714</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card-box widget-chart-one gradient-warning bx-shadow-lg">
            <div class="float-left" dir="ltr">
                <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#ffffff" data-bgcolor="rgba(255,255,255,0.2)" value="49" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
            </div>
            <div class="widget-chart-one-content text-right">
                <p class="text-white mb-0 mt-2">Statistics</p>
                <h3 class="text-white">$714</h3>
            </div>
        </div>
    </div>
    <div class="col-xl-4">
        <div class="card-box widget-chart-one gradient-danger bx-shadow-lg">
            <div class="float-left" dir="ltr">
                <input data-plugin="knob" data-width="80" data-height="80" data-linecap=round data-fgColor="#ffffff" data-bgcolor="rgba(255,255,255,0.2)" value="49" data-skin="tron" data-angleOffset="180" data-readOnly=true data-thickness=".1" />
            </div>
            <div class="widget-chart-one-content text-right">
                <p class="text-white mb-0 mt-2">Statistics</p>
                <h3 class="text-white">$714</h3>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    <?php if (session('msg')) : ?>
        Swal.fire({
            type: "<?= session('msg')['type'] ?>",
            title: "Bienvenido!!!",
            text: "<?= session('msg')['body'] ?>",
            confirmButtonColor: "#00e378"
        });
    <?php endif; ?>
</script>
<?= $this->endSection() ?>