<body class="g-sidenav-show  bg-gray-100">
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-NKDMSK6" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-1 fixed-start ms-2 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href="" target="_blank">
                <img src="<?= base_url(); ?>assets_adm/img/logo/logo2.png" class="navbar-brand-img h-100"
                    alt="main_logo">
                <span class="ms-1 font-weight-bold">Site Plan</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto h-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a <?= $this->uri->segment(1) == 'Dashboard' || $this->uri->segment(1) == '' ? 'class="nav-link active"' : '' ?>
                        class="nav-link" href="<?php echo site_url('Dashboard'); ?> ">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg width="12px" height="12px" viewBox="0 0 45 40" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>shop </title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1716.000000, -439.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g transform="translate(0.000000, 148.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M46.7199583,10.7414583 L40.8449583,0.949791667 C40.4909749,0.360605034 39.8540131,0 39.1666667,0 L7.83333333,0 C7.1459869,0 6.50902508,0.360605034 6.15504167,0.949791667 L0.280041667,10.7414583 C0.0969176761,11.0460037 -1.23209662e-05,11.3946378 -1.23209662e-05,11.75 C-0.00758042603,16.0663731 3.48367543,19.5725301 7.80004167,19.5833333 L7.81570833,19.5833333 C9.75003686,19.5882688 11.6168794,18.8726691 13.0522917,17.5760417 C16.0171492,20.2556967 20.5292675,20.2556967 23.494125,17.5760417 C26.4604562,20.2616016 30.9794188,20.2616016 33.94575,17.5760417 C36.2421905,19.6477597 39.5441143,20.1708521 42.3684437,18.9103691 C45.1927731,17.649886 47.0084685,14.8428276 47.0000295,11.75 C47.0000295,11.3946378 46.9030823,11.0460037 46.7199583,10.7414583 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M39.198,22.4912623 C37.3776246,22.4928106 35.5817531,22.0149171 33.951625,21.0951667 L33.92225,21.1107282 C31.1430221,22.6838032 27.9255001,22.9318916 24.9844167,21.7998837 C24.4750389,21.605469 23.9777983,21.3722567 23.4960833,21.1018359 L23.4745417,21.1129513 C20.6961809,22.6871153 17.4786145,22.9344611 14.5386667,21.7998837 C14.029926,21.6054643 13.533337,21.3722507 13.0522917,21.1018359 C11.4250962,22.0190609 9.63246555,22.4947009 7.81570833,22.4912623 C7.16510551,22.4842162 6.51607673,22.4173045 5.875,22.2911849 L5.875,44.7220845 C5.875,45.9498589 6.7517757,46.9451667 7.83333333,46.9451667 L19.5833333,46.9451667 L19.5833333,33.6066734 L27.4166667,33.6066734 L27.4166667,46.9451667 L39.1666667,46.9451667 C40.2482243,46.9451667 41.125,45.9498589 41.125,44.7220845 L41.125,22.2822926 C40.4887822,22.4116582 39.8442868,22.4815492 39.198,22.4912623 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Kelola Maps</h6>
                </li>
                <?php
                    foreach ($perumahan as $data) {
                            $id_perum = $data->id_perum;
                            $nama = $data->nama;
                            $tittle = preg_replace("![^a-z0-9]+!i", "-", $nama);
                            $isActive = ($this->uri->segment(2) == 'visit' && $this->uri->segment(3) ==  $tittle);
                ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo $isActive ? 'active' : ''; ?>" href="<?php echo site_url('Home'); ?> "
                        data-bs-toggle="collapse" id="collapseExample" data-bs-target="#collapseExample<?= $id_perum ?>"
                        role="button" aria-expanded="<?php echo $isActive ? 'true' : 'false'; ?>">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center d-flex align-items-center justify-content-center  me-2">
                            <svg width="12px" height="12px" viewbox="0 0 42 42" version="1.1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                <title>office</title>
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g transform="translate(-1869.000000, -293.000000)" fill="#FFFFFF"
                                        fill-rule="nonzero">
                                        <g transform="translate(1716.000000, 291.000000)">
                                            <g id="office" transform="translate(153.000000, 2.000000)">
                                                <path class="color-background opacity-6"
                                                    d="M12.25,17.5 L8.75,17.5 L8.75,1.75 C8.75,0.78225 9.53225,0 10.5,0 L31.5,0 C32.46775,0 33.25,0.78225 33.25,1.75 L33.25,12.25 L29.75,12.25 L29.75,3.5 L12.25,3.5 L12.25,17.5 Z">
                                                </path>
                                                <path class="color-background"
                                                    d="M40.25,14 L24.5,14 C23.53225,14 22.75,14.78225 22.75,15.75 L22.75,38.5 L19.25,38.5 L19.25,22.75 C19.25,21.78225 18.46775,21 17.5,21 L1.75,21 C0.78225,21 0,21.78225 0,22.75 L0,40.25 C0,41.21775 0.78225,42 1.75,42 L40.25,42 C41.21775,42 42,41.21775 42,40.25 L42,15.75 C42,14.78225 41.21775,14 40.25,14 Z M12.25,36.75 L7,36.75 L7,33.25 L12.25,33.25 L12.25,36.75 Z M12.25,29.75 L7,29.75 L7,26.25 L12.25,26.25 L12.25,29.75 Z M35,36.75 L29.75,36.75 L29.75,33.25 L35,33.25 L35,36.75 Z M35,29.75 L29.75,29.75 L29.75,26.25 L35,26.25 L35,29.75 Z M35,22.75 L29.75,22.75 L29.75,19.25 L35,19.25 L35,22.75 Z">
                                                </path>
                                            </g>
                                        </g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1"><?= $data->nama; ?></span>
                    </a>
                    <div class="collapse <?php echo $isActive ? 'show' : ''; ?>" id="collapseExample<?= $id_perum ?>">
                        <ul class="nav ms-4 ps-3">
                            <?php
                                foreach ($area_siteplan as $area) {
                                    if ($area->id_perum_siteplan == $id_perum) {
                                        $nama = $data->nama;
                                        $tittle = preg_replace("![^a-z0-9]+!i", "-", $nama);
                                        $isActiveChild = ($this->uri->segment(3) == $tittle && $this->uri->segment(4) == $area->area);
                            ?>
                            <li class="nav-item">
                                <a class="nav-link <?php echo $isActiveChild ? 'active' : ''; ?>"
                                    href="<?php echo site_url('Home'); ?>/visit/<?= $tittle; ?>/<?= $area->area; ?>">
                                    <span class="sidenav-normal"> <?= $area->area; ?> </span>
                                </a>
                            </li>
                            <?php
                                    }
                                }
                            ?>
                        </ul>
                    </div>
                </li>
                <?php
                   }
                   ?>
                <li class=" nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">
                        Kelola Data</h6>
                </li>
                <li class="nav-item">
                    <a <?= $this->uri->segment(1) == 'Customer' && $this->uri->segment(2) != 'customer_lead' && $this->uri->segment(2) != 'customer_visit' ? 'class="nav-link active"' : 'class="nav-link"' ?>
                        class="nav-link" href="<?php echo site_url('Customer'); ?> ">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg fill="#000000" height="800px" width="800px" version="1.1" id="Capa_1"
                                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                viewBox="0 0 502.642 502.642" xml:space="preserve">
                                <g>
                                    <g>
                                        <g>
                                            <circle cx="251.364" cy="76.188" r="65.359" />
                                            <polygon
                                                points="343.817,168.662 287.237,156.129 275.61,144.503 258.483,163.097 268.686,248.366 366.121,248.366 			" />
                                            <polygon
                                                points="215.363,156.129 158.826,168.662 136.629,248.323 234,248.323 244.203,163.075 227.011,144.503 			" />
                                            <circle cx="108.264" cy="329.364" r="61.714" />
                                            <polygon
                                                points="142.108,404.797 131.215,393.796 115.015,411.312 124.593,491.792 216.506,491.792 195.518,416.553 			" />
                                            <polygon
                                                points="74.354,404.797 21.032,416.553 0,491.814 91.892,491.814 101.491,411.312 85.334,393.839 			" />
                                            <path d="M456.179,329.386c0-34.082-27.632-61.671-61.779-61.671c-33.996,0-61.628,27.589-61.628,61.671
				s27.654,61.649,61.628,61.649C428.504,391.035,456.179,363.468,456.179,329.386z" />
                                            <polygon
                                                points="481.654,416.553 428.288,404.797 417.351,393.796 401.173,411.269 410.794,491.771 502.642,491.771 			" />
                                            <polygon
                                                points="360.534,404.797 307.168,416.553 286.158,491.814 378.071,491.814 387.692,411.312 371.427,393.839 			" />
                                        </g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                    <g>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Data Formulir Customer</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a <?= $this->uri->segment(2) == 'customer_lead' && $this->uri->segment(1) != '' ? 'class="nav-link active"' : 'class="nav-link"' ?>
                        href="<?php echo site_url('Customer/customer_lead'); ?> ">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                <!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                <path
                                    d="M284 224.8a34.1 34.1 0 1 0 34.3 34.1A34.2 34.2 0 0 0 284 224.8zm-110.5 0a34.1 34.1 0 1 0 34.3 34.1A34.2 34.2 0 0 0 173.6 224.8zm220.9 0a34.1 34.1 0 1 0 34.3 34.1A34.2 34.2 0 0 0 394.5 224.8zm153.8-55.3c-15.5-24.2-37.3-45.6-64.7-63.6-52.9-34.8-122.4-54-195.7-54a406 406 0 0 0 -72 6.4 238.5 238.5 0 0 0 -49.5-36.6C99.7-11.7 40.9 .7 11.1 11.4A14.3 14.3 0 0 0 5.6 34.8C26.5 56.5 61.2 99.3 52.7 138.3c-33.1 33.9-51.1 74.8-51.1 117.3 0 43.4 18 84.2 51.1 118.1 8.5 39-26.2 81.8-47.1 103.5a14.3 14.3 0 0 0 5.6 23.3c29.7 10.7 88.5 23.1 155.3-10.2a238.7 238.7 0 0 0 49.5-36.6A406 406 0 0 0 288 460.1c73.3 0 142.8-19.2 195.7-54 27.4-18 49.1-39.4 64.7-63.6 17.3-26.9 26.1-55.9 26.1-86.1C574.4 225.4 565.6 196.4 548.3 169.5zM285 409.9a345.7 345.7 0 0 1 -89.4-11.5l-20.1 19.4a184.4 184.4 0 0 1 -37.1 27.6 145.8 145.8 0 0 1 -52.5 14.9c1-1.8 1.9-3.6 2.8-5.4q30.3-55.7 16.3-100.1c-33-26-52.8-59.2-52.8-95.4 0-83.1 104.3-150.5 232.8-150.5s232.9 67.4 232.9 150.5C517.9 342.5 413.6 409.9 285 409.9z" />
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Data Lead</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a <?= $this->uri->segment(2) == 'customer_visit' && $this->uri->segment(1) != '' ? 'class="nav-link active"' : 'class="nav-link"' ?>
                        href="<?php echo site_url('Customer/customer_visit'); ?> ">
                        <div
                            class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                            <svg xmlns="http://www.w3.org/2000/svg" data-name="Layer 1" viewBox="0 0 128 128"
                                id="visit">
                                <path
                                    d="M44 16a2.0001 2.0001 0 0 0 2-2V10a2 2 0 0 0-4 0v4A2.0001 2.0001 0 0 0 44 16zM52 16a2.0001 2.0001 0 0 0 2-2V10a2 2 0 0 0-4 0v4A2.0001 2.0001 0 0 0 52 16zM60 16a2.0001 2.0001 0 0 0 2-2V10a2 2 0 0 0-4 0v4A2.0001 2.0001 0 0 0 60 16zM68 16a2.0001 2.0001 0 0 0 2-2V10a2 2 0 0 0-4 0v4A2.0001 2.0001 0 0 0 68 16zM76 16a2.0001 2.0001 0 0 0 2-2V10a2 2 0 0 0-4 0v4A2.0001 2.0001 0 0 0 76 16zM84 16a2.0001 2.0001 0 0 0 2-2V10a2 2 0 0 0-4 0v4A2.0001 2.0001 0 0 0 84 16zM13 54a2 2 0 0 0-4 0v4a2 2 0 0 0 4 0zM19 60a2.0001 2.0001 0 0 0 2-2V54a2 2 0 0 0-4 0v4A2.0001 2.0001 0 0 0 19 60zM27 60a2.0001 2.0001 0 0 0 2-2V54a2 2 0 0 0-4 0v4A2.0001 2.0001 0 0 0 27 60zM13 66a2 2 0 0 0-4 0v4a2 2 0 0 0 4 0zM17 70a2 2 0 0 0 4 0V66a2 2 0 0 0-4 0zM25 70a2 2 0 0 0 4 0V66a2 2 0 0 0-4 0zM13 78a2 2 0 0 0-4 0v4a2 2 0 0 0 4 0zM17 82a2 2 0 0 0 4 0V78a2 2 0 0 0-4 0zM25 82a2 2 0 0 0 4 0V78a2 2 0 0 0-4 0zM13 90a2 2 0 0 0-4 0v4a2 2 0 0 0 4 0zM13 102a2 2 0 1 0-4 0v4a2 2 0 0 0 4 0zM11 112a2.0001 2.0001 0 0 0-2 2v4a2 2 0 0 0 4 0v-4A2.0001 2.0001 0 0 0 11 112zM101 60a2.0001 2.0001 0 0 0 2-2V54a2 2 0 1 0-4 0v4A2.0001 2.0001 0 0 0 101 60zM109 60a2.0001 2.0001 0 0 0 2-2V54a2 2 0 1 0-4 0v4A2.0001 2.0001 0 0 0 109 60zM117 60a2.0001 2.0001 0 0 0 2-2V54a2 2 0 1 0-4 0v4A2.0001 2.0001 0 0 0 117 60zM99 70a2 2 0 0 0 4 0V66a2 2 0 0 0-4 0zM107 70a2 2 0 0 0 4 0V66a2 2 0 0 0-4 0zM115 70a2 2 0 0 0 4 0V66a2 2 0 0 0-4 0zM99 82a2 2 0 0 0 4 0V78a2 2 0 0 0-4 0zM107 82a2 2 0 0 0 4 0V78a2 2 0 0 0-4 0zM115 82a2 2 0 0 0 4 0V78a2 2 0 0 0-4 0zM115 94a2 2 0 0 0 4 0V90a2 2 0 0 0-4 0zM115 106a2 2 0 1 0 4 0v-4a2 2 0 1 0-4 0zM115 118a2 2 0 0 0 4 0v-4a2 2 0 0 0-4 0zM42 26a2 2 0 0 0 4 0V22a2 2 0 0 0-4 0zM50 26a2 2 0 0 0 4 0V22a2 2 0 0 0-4 0zM58 26a2 2 0 0 0 4 0V22a2 2 0 0 0-4 0zM66 26a2 2 0 0 0 4 0V22a2 2 0 0 0-4 0zM74 26a2 2 0 0 0 4 0V22a2 2 0 0 0-4 0zM82 26a2 2 0 0 0 4 0V22a2 2 0 0 0-4 0z">
                                </path>
                                <path
                                    d="M122,44H110V40a6.00656,6.00656,0,0,0-6-6H94V6a6.00656,6.00656,0,0,0-6-6H40a6.00656,6.00656,0,0,0-6,6V34H24a6.00656,6.00656,0,0,0-6,6v4H6a6.00656,6.00656,0,0,0-6,6v72a6.00656,6.00656,0,0,0,6,6H18.69208a9.3692,9.3692,0,0,1-1.58-4H6a2.00261,2.00261,0,0,1-2-2V50a2.00261,2.00261,0,0,1,2-2H30V44H22V40a2.00261,2.00261,0,0,1,2-2H34V85.39471l4-2.06464V6a2.00261,2.00261,0,0,1,2-2H88a2.00261,2.00261,0,0,1,2,2V83.05658l4,2.14471V38h10a2.00261,2.00261,0,0,1,2,2v4H98v4h24a2.00261,2.00261,0,0,1,2,2v72a2.00261,2.00261,0,0,1-2,2H110.88794a9.3692,9.3692,0,0,1-1.58,4H122a6.00656,6.00656,0,0,0,6-6V50A6.00656,6.00656,0,0,0,122,44Z">
                                </path>
                                <path
                                    d="M101 88a1.9888 1.9888 0 0 0-1.12805.34979L103 90.027V90A2.0001 2.0001 0 0 0 101 88zM17 94a1.999 1.999 0 0 0 1.57043 1.95111A13.36325 13.36325 0 0 1 21 92.86371V90a2 2 0 0 0-4 0zM25 90.04016l3.18457-1.64374A1.992 1.992 0 0 0 25 90zM111 94V90a2 2 0 0 0-4 0v2.78784a12.90737 12.90737 0 0 1 2.47845 3.14813A1.99634 1.99634 0 0 0 111 94z">
                                </path>
                                <path
                                    d="M101.917,93.98828c-.03125-.01855-21.458-11.50488-21.51953-11.53027a1.54368,1.54368,0,0,1-.97949-1.28906V72.5495a39.415,39.415,0,0,0,3.73541-8.92535A22.6428,22.6428,0,0,0,84,57.55719a18.92328,18.92328,0,0,0-.72217-5.12506,9.054,9.054,0,0,0,1.5993-1.80646,7.99778,7.99778,0,0,0-2.15845-10.50159,44.9396,44.9396,0,0,0-10.29828-6.16766A22.37348,22.37348,0,0,0,63.58948,32a17.80052,17.80052,0,0,0-14.00977,6.94543c-5.16632,1.71918-5.81537,10.476-5.51807,17.15814C44.02484,56.58386,44,57.0675,44,57.55719a33.817,33.817,0,0,0,5.252,17.36023v6.25153A1.3924,1.3924,0,0,1,48.4248,82.458c-.05176.02148-.10254.04492-.15137.07031,0,0-22.15234,11.43652-22.19336,11.46191C22.709,96.05371,21,98.73828,21,101.96875v20.65137A5.34133,5.34133,0,0,0,26.29,128H101.71a5.34133,5.34133,0,0,0,5.29-5.37988V101.96875C107,98.54687,105.47949,96.16015,101.917,93.98828ZM50.84271,42.74078l1.27148-.4231.76-1.1037A13.88309,13.88309,0,0,1,63.5896,36a18.55617,18.55617,0,0,1,7.25775,1.63416,40.70016,40.70016,0,0,1,9.3866,5.62457,4.03533,4.03533,0,0,1,1.3042,5.16437c-1.35144,2.04877-4.99243,3.58209-9.73969,4.10168a21.89108,21.89108,0,0,1-2.37134.13348,16.86358,16.86358,0,0,1-3.78088-.40729,24.96916,24.96916,0,0,1-5.49146-2.80225,4.74235,4.74235,0,0,0-7.09979,1.848,5.64271,5.64271,0,0,0-1.41315-.18042H51.6413A5.8631,5.8631,0,0,0,48.024,52.37951C48.16943,47.37127,49.08521,43.32562,50.84271,42.74078ZM48.39417,61.79712c-.046-.47321-.10059-1.05383-.104-1.12891a4.99208,4.99208,0,0,1,.23138-2.0509c.43591-1.22034,1.56378-3.50122,3.11951-3.501a1.73281,1.73281,0,0,1,.67218.14093c.00415.00177,2.45842,1.0283,2.45842,1.0283A.91709.91709,0,0,0,55.8866,55.751l.76831-2.69025a.72354.72354,0,0,1,.70367-.52155.75421.75421,0,0,1,.445.14557A27.48594,27.48594,0,0,0,64.702,56.13818a20.78465,20.78465,0,0,0,4.7251.52008,25.82033,25.82033,0,0,0,2.80664-.15723,26.3816,26.3816,0,0,0,7.464-1.86841A14.85486,14.85486,0,0,1,80,57.55719a18.56244,18.56244,0,0,1-.69885,4.98975C77.526,68.8952,74.121,74.46118,69.95972,77.8175A9.81435,9.81435,0,0,1,63.73065,80a11.876,11.876,0,0,1-8.68671-3.99146A29.91439,29.91439,0,0,1,48.39417,61.79712ZM63.626,91.51953,52.621,83.699a5.43911,5.43911,0,0,0,.63092-2.53009V79.87311A15.71039,15.71039,0,0,0,63.73071,84a13.79551,13.79551,0,0,0,8.73981-3.06866A26.03258,26.03258,0,0,0,75.418,78.09247v3.07648a5.01393,5.01393,0,0,0,.2016,1.36621ZM68.998,110.74121a.8756.8756,0,0,1-.17285.541l-.24023.22656s-2.43555,2.70117-4.12109,4.5918L59.33105,111.376l-.10645-.0918a.99329.99329,0,0,1-.21289-.68359l2.76947-15.4837.64752.46027a2.00636,2.00636,0,0,0,2.56836-.08691l.604-.45245ZM103,122.62011A1.33909,1.33909,0,0,1,101.71,124H26.29A1.33909,1.33909,0,0,1,25,122.62011V101.96875c0-1.21484.35547-2.8252,3.1084-4.53027L49.5473,86.37256a2.00691,2.00691,0,0,0,.29449.25732l8.33429,5.92432L55.085,109.84179a4.87063,4.87063,0,0,0,1.58105,4.51758l5.7959,5.335a3.144,3.144,0,0,0,4.35254-.2168c1.44629-1.63281,4.126-4.60742,4.65039-5.19043a4.70709,4.70709,0,0,0,1.42969-4.44727l-3.7713-17.44049,8.91156-6.6756a5.67778,5.67778,0,0,0,.73181.3866L99.88086,97.43164C102.48828,99.03222,103,100.30957,103,101.96875Z">
                                </path>
                            </svg>
                        </div>
                        <span class="nav-link-text ms-1">Data Kunjungan</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var collapseExample = document.getElementById('collapseExample<?= $id_perum ?>');
        var collapseButton = document.getElementById('collapseExample');

        if (collapseButton.getAttribute('aria-expanded') === 'false') {
            collapseExample.classList.remove('show');
            collapseExample.classList.add('hide');
        }

        collapseButton.addEventListener('click', function() {
            if (collapseButton.getAttribute('aria-expanded') === 'true') {
                collapseExample.classList.remove('hide');
                collapseExample.classList.add('show');
            } else {
                collapseExample.classList.remove('show');
                collapseExample.classList.add('hide');
            }
        });
    });
    </script>