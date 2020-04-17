<nav class="navbar navbar-expand-lg navbar-light bg-white">
  <a class="navbar-brand" href="#">
    <img src="/img/biyotem.png" alt="biyotem" style="height:40px;"/>
  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
        <li class="nav-item "><a class="nav-link" href="/"><i class="fa fa-user-plus fa-fw"></i><span class="text">Yeni Müşteri Seç</span></a></li>
        <li class="nav-item "><a class="nav-link" href="/siparis/create"><i class="fa fa-truck fa-fw"></i><span class="text">Sipariş</span></a></li>
        <li class="nav-item "><a class="nav-link" href="/siparis_liste"><i class="fa fa-list-ol fa-fw"></i><span class="text">Sipariş Listesi</span></a></li>
        <li class="nav-item "><a class="nav-link" href="/kapatma"><i class="fas fa-comments-dollar"></i><span class="text">Cari Hesap Kapatma</span></a></li>
        <li class="nav-item "><a class="nav-link" href="/stok_durum"><i class="fa fa-cubes fa-fw"></i><span class="text">Depo Stok Durumunuz</span></a></li>
        <li class="nav-item "><a class="nav-link" href="/rapor"><i class="fa fa-database fa-fw"></i><span class="text">Depo Ürün Stok Durumu</span></a></li>        <hr>
        <li class="nav-item "><a class="nav-link" href="/depo_durum"><i class="fa fa-search fa-fw"></i><span class="text">Genel Stok Durumu</span></a></li>
        @if(session('yetkili') == 1)
          <li class="nav-item ">
            <a class="nav-link" href="/satis_rapor">
              <i class="fa fa-money fa-fw"></i><span class="text">Satış Raporu</span></a>
          </li>
        @endif
        <li class="nav-item "><a class="nav-link" href="/profil"><i class="fa fa-user fa-fw"></i><span class="text">Profil</span></a></li>
        <li class="nav-item ">
          <form method="POST" action="/logout/{{ session('username') }}">
            @csrf
            @method('DELETE')
            <button class="btn btn-link btn-sm nav-link" type="submit"><i class="fa fa-sign-out fa-fw"></i><span class="text">Çıkış</span></button>
          </form>
        </li>
    </ul>
  </div>
</nav>
