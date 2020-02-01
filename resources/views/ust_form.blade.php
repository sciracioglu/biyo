<div class='row'>
    <div class='col'>
        <div class="form-group">
            <label for="hastane">Hasta Adı Soyadı</label>
            <input type='text' class='form-control' id='hasta_adsoyad' placeholder="Hasta Adı Soyadı" v-model='form.hasta' />
        </div>
        <small class="form-text text-danger" v-if="form.errors.has('hasta')">Bu alan bos birakilamaz</small>
    </div>
    <div class='col'>
        <div class="form-group">
            <label for="hastane">Hasta Protokol No</label>
            <input type='text' class='form-control' id='protokolno' placeholder="Hasta Protokol No" v-model='form.protokol' />
        </div>
    </div>
    <div class='col'>
        <div class="form-group">
            <label for="hastane">Açıklama</label>
            <input type='text' class='form-control' placeholder="Açıklama" id='aciklama' v-model='form.aciklama' />
        </div>
    </div>
</div>

