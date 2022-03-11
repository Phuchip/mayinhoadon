<div class="row pt-md-4">
    <!--        navbar-->
    <div class="col-12">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container-fluid p-md-0">
                <button class="navbar-toggler" type="button" id="button-navbar-menu" onclick="navbar_menu()">
                    <i class="ic-menu"></i>
                </button>
                <div class="navbar-logo">
                    <a class="navbar-brand" href="/"><img class="lazyload" src="/images/loading.gif" data-src="/images/logo-1920.png" alt="logo"></a>
                </div>
                <div class="form-search">
                    <form class="d-flex form-seach-submit" method="GET" onsubmit="return false">
                        <input id="search-box pc_search dropdown show" name="keyword" onkeydown="searchdropdown()" required class="form-control me-2 search-box" type="search" placeholder="Nhập tên máy in hóa đơn, tên hãng" aria-label="Search" autocomplete="off">
                        <button class="btn btn-search" type="submit"><i class="ic-search"></i></button>
                    </form>
                    <!--dropdown-->
                    <div id="suggestion-box" class="dropdown-content suggestion-box">
                        <div class="icon-top-result">
                            <i class="ic-top-result"></i>
                        </div>
                        <div class="result-search">
                            <div class="bg-gray">
                                <p class="suggestion-title">Có phải bạn muốn tìm</p>
                            </div>
                            <div class="suggestion-body sugget_tag_pc">
                            </div>
                            <div class="bg-gray">
                                <p class="suggestion-title">Sản phẩm gợi ý</p>
                            </div>
                            <div class="list-item-suggest suggest_pc">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class=" navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link <?= ($sub_url[1] == '')?'active':'' ?>" href="/">Trang chủ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Hướng dẫn</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Tin tức</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="">Phần mềm quản lý bán hàng</a>
                        </li>
                    </ul>
                </div>
                <a href="javascript:void(0)" class="btn cart-btn d-flex" id="cart-btn">
                    <i class="ic-cart"></i><span class="badge cart-badge"><?= $num ?></span>
                </a>
            </div>
        </nav>
    </div>
    <div class="form-search-mobile col-12">
        <form class="d-flex form-seach-submit" onsubmit="return false">
            <input id="search-box mobile_search dropdown show" onkeydown="searchdropdown2()" class="form-control me-2 search-box" type="search" placeholder="Nhập tên máy in hóa đơn, tên hãng" aria-label="Search" autocomplete="off">
            <button class="btn btn-search" type="submit"><i class="ic-search"></i></button>
        </form>
        <!--dropdown-->
        <div id="suggestion-box2" class="dropdown-content suggestion-box">
            <div class="icon-top-result">
                <i class="ic-top-result"></i>
            </div>
            <div class="result-search">
                <div class="bg-gray">
                    <p class="suggestion-title">Có phải bạn muốn tìm</p>
                </div>
                <div class="suggestion-body sugget_tag_mb">
                </div>
                <div class="bg-gray">
                    <p class="suggestion-title">Sản phẩm gợi ý</p>
                </div>
                <div class="list-item-suggest suggest_mobile">
                </div>
            </div>
        </div>
    </div>
</div>