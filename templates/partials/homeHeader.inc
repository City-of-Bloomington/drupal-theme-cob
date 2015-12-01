<header class="cob-homeHeader">
    <div class="cob-homeHeader-container">
        <?php
            if ($logo) {
                $t = t('Home');
                $alt_attribute = $site_name ? $site_name : $t;
                echo "
                    <a href=\"$front_page\" class=\"cob-homeHeader-logo\" title=\"$t\" rel=\"home\" id=\"logo\">
                        <img src=\"$logo\" alt=\"$alt_attribute\" class=\"cob-homeHeader-logo-image\" />
                    </a>
                ";
            }
        ?>
    </div>
</header>
