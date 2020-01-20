<div class='row'>
    <div class='col-sm-12 col-md-4'>
        <div class="form-group">
            <label for="satis_temsilci">Satış Temsilcisi</label>
            <select class="form-control" id="satis_temsilci" v-model='form.satis_temsilci' >
                    <option v-for='satisci in satiscilar' :value='satisci.TEMSILCINO'>@{{ satisci.ACIKLAMA1 }}</option>
                    
            </select>
            <small id="satisci" class="form-text text-danger" v-if="form.errors.has('satis_temsilci')">Bu alan bos birakilamaz</small>
        </div>
    </div>
    <div class='col-6 col-md-4'>
        <div class="form-group">
            <label for="hastane">Takip Tipi</label>
            <select class="form-control" id="hastane" v-model='form.takip' >
                    <option v-for='takip in takipler' :value='takip.KOD'>@{{ takip.ACIKLAMA }}</option>
            </select>
            <small id="sevkuyari" class="form-text text-danger" v-if="form.errors.has('takip')">Bu alan bos birakilamaz</small>
        </div>
    </div>
    <div class='col-6 col-md-4'>
        <div class="form-group">
                <label for="ihale">Ihale Tipi</label>
            <select class="form-control" id="ihale" v-model='form.ihale' >
                 <option v-for='ihale in ihaleler' :value='ihale.KOD'>@{{ ihale.ACIKLAMA }}</option>
            </select>
            <small id="sevkuyari" class="form-text text-danger" v-if="form.errors.has('ihale')">Bu alan bos birakilamaz</small>
        </div>
    </div>
</div>
<div class='row'>
    <div class='col-4 col-md-4'>
        <div class="form-group">
            <input type='text' class='form-control' id='hasta_adsoyad' placeholder="Hasta Adı Soyadı" v-model='form.hasta' />
        </div>
        <small class="form-text text-danger" v-if="form.errors.has('hasta')">Bu alan bos birakilamaz</small>
    </div>
    <div class='col-4 col-md-4'>
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
