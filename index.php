<?php
	@ob_start();
	include 'include/functions/header.php';
?>
<!DOCTYPE html>
<html lang="<?php print $language_code; ?>"<?php if(in_array($language_code, $rtl)) print ' dir="rtl"'; ?>>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="UTF-8" />

    <title><?php print $site_title.' - '.$title; if($offline) print ' - '.$lang['server-offline']; ?></title>

    <link rel="stylesheet" href="<?php print $site_url; ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php print $site_url; ?>css/font-awesome.min.css">
    <link rel='stylesheet' href='<?php print $site_url; ?>css/clean.css' type='text/css' media='all' />
	<?php if($page=="admin" && $a_page=="player_edit") { ?>
    <link rel='stylesheet' href='<?php print $site_url; ?>css/bootstrap-select.css'/>
	<?php } ?>
	<link rel="shortcut icon" href="<?php print $site_url; ?>images/favicon.ico?v=" />
</head>

<body class="page page-parent page-template page-template-template-blog-php">

    <!-- CABECERA PRINCIPAL -->
    <div class="main-hd" role="navigation">
        <div class="page-width">
            <!-- Logo -->
            <h1>
                <a href="<?php print $site_url; ?>" title="<?php print $site_title; ?>" rel="home">
                    <img src="<?php print $site_url; ?>images/logo-stone.svg" alt="<?php print $site_title; ?>" class="logo-icon">
                    <div>
                        <div class="logo-text"><?php print $site_title; ?></div>
                        <div class="logo-subtitle">MMORPG Server</div>
                    </div>
                </a>
            </h1>

            <!-- Navegación Principal -->
            <ul id="menu-header-nav" class="cms2-g main eason">
                <?php if(!$offline) { ?>
                    <li class="cms2-u menu-item"><a href="<?php print $site_url; ?>news"><i class="fa fa-newspaper-o"></i> <?php print $lang['news']; ?></a></li>
                    <li class="cms2-u menu-item"><a href="<?php print $site_url; ?>download"><i class="fa fa-download"></i> <?php print $lang['download']; ?></a></li>
                    <li class="cms2-u menu-item"><a href="<?php print $site_url; ?>ranking/players"><i class="fa fa-trophy"></i> <?php print $lang['ranking']; ?></a>
                        <ul class="sub-menu">
                            <li class="menu-item"><a href="<?php print $site_url; ?>ranking/players"><i class="fa fa-user"></i> <?php print $lang['players']; ?></a></li>
                            <li class="menu-item"><a href="<?php print $site_url; ?>ranking/guilds"><i class="fa fa-users"></i> <?php print $lang['guilds']; ?></a></li>
                        </ul>
                    </li>

                    <?php if(!$database->is_loggedin()) { ?>
                        <li class="cms2-u menu-item"><a href="<?php print $site_url; ?>users/register"><i class="fa fa-user-plus"></i> <?php print $lang['register']; ?></a></li>
                        <li class="cms2-u menu-item"><a href="<?php print $site_url; ?>users/login"><i class="fa fa-sign-in"></i> <?php print $lang['login']; ?></a></li>
                    <?php } else { ?>
                        <li class="cms2-u menu-item"><a href="<?php print $site_url; ?>user/administration"><i class="fa fa-user-circle"></i> <?php print $lang['my-account']; ?></a></li>
                        <li class="cms2-u menu-item"><a href="<?php print $site_url; ?>users/logout"><i class="fa fa-sign-out"></i> <?php print $lang['logout']; ?></a></li>
                    <?php } ?>

                    <?php if($forum != "") { ?>
                        <li class="cms2-u menu-item"><a href="<?php print $forum; ?>" target="_blank"><i class="fa fa-comments"></i> Forum</a></li>
                    <?php } ?>

                    <?php if(count($json_languages['languages']) > 1) { ?>
                        <li class="cms2-u menu-item"><a href="#"><i class="fa fa-globe"></i> <?php print $json_languages['languages'][$language_code]; ?></a>
                            <ul class="sub-menu">
                                <?php foreach($json_languages['languages'] as $key => $value) { ?>
                                    <li class="menu-item"><a href="<?php print $site_url; ?>?lang=<?php print $key; ?>"><?php print $value; ?></a></li>
                                <?php } ?>
                            </ul>
                        </li>
                    <?php } ?>
                <?php } else { ?>
                    <li class="cms2-u menu-item"><a href="#"><i class="fa fa-exclamation-triangle"></i> <?php print $lang['server-offline']; ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>


    <div id="content">
        <div class="article">
            <div class="page-width">
                <div class="mt2cms2-c page-bd">
                    <!-- Contenido Principal -->
                    <div class="mt2cms2-c-l">
                        <?php include 'pages/'.$page.'.php'; ?>
                    </div>

                    <!-- Sidebar Derecho -->
                    <div class="mt2cms2-c-s">
                        <!-- Panel de Usuario -->
                        <div class="bd-c">
                            <?php include 'include/sidebar/user.php'; ?>
                        </div>

                        <!-- Estadísticas (si está habilitado) -->
                        <?php if(!$offline && $statistics) { ?>
                            <div class="bd-c">
                                <?php include 'include/sidebar/statistics.php'; ?>
                            </div>
                        <?php } ?>

                        <!-- Ranking -->
                        <div class="bd-c">
                            <?php include 'include/sidebar/ranking.php'; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FOOTER -->
    <div class="mt2cms2-footer esrb">
        <div class="footer-nav">
            <div class="page-width">
                <p class="copyright">
                    &copy; Copyright <?php 
                        $copyright_year = date('Y');
                        if($copyright_year > 2017)
                            print '2017 - '.$copyright_year;
                        else print $copyright_year;
                        print ' '.$site_title;
                    ?>
                </p>
                
                <?php if($social_links) { ?>
                    <div style="text-align: center; margin-top: 15px;">
                        <?php print $social_links; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- SCRIPTS -->
	<script type="text/javascript" src="<?php print $site_url; ?>js/jquery-2.2.4.min.js"></script>
	<?php include 'include/functions/footer.php'; ?>
	<script src="<?php print $site_url; ?>js/tether.min.js"></script>
    <script src="<?php print $site_url; ?>js/bootstrap.min.js"></script>
</body>

</html>