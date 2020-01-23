<div class='row'>
    <div class='col'>
        <div class="form-group">
            <label for="hastane">Takip Tipi</label>
            <select class="form-control" id="hastane" v-model='form.takip' >
                    <option v-for='takip in takipler' :value='takip.KOD'>@{{ takip.ACIKLAMA }}</option>
            </select>
            <small id="sevkuyari" class="form-text text-danger" v-if="form.errors.has('takip')">Bu alan bos birakilamaz</small>
        </div>
    </div>
    <div class='col'>
        <div class="form-group">
            <input type='text' class='form-control' id='hasta_adsoyad' placeholder="Hasta Adı Soyadı" v-model='form.hasta' />
        </div>
        <small class="form-text text-danger" v-if="form.errors.has('hasta')">Bu alan bos birakilamaz</small>
    </div>
    <div class='col'>
        <div class="form-group">
            <input type='text' class='form-control' id='protokolno' placeholder="Hasta Protokol No" v-model='form.protokol' />
        </div>
    </div>
</div>
<div class='row'>
    <div class='col'>
        <div class="form-group">
            <input type='text' class='form-control' placeholder="Açıklama" id='aciklama' v-model='form.aciklama' />
        </div>
    </div>
</div>
