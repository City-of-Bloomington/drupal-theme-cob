<header class="cob-homeHeader">
    <div class="cob-homeHeader-container">
        <?php
#            if (!empty($page['header_site'])) { echo render($page['header_site']); }
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
        <nav class="cob-homeNav">
            <a href="<?= $front_page ?>">Home</a>
            <?php
                foreach (taxonomy_get_tree(2, 0, 1) as $t) {
                    echo l($t->name, 'taxonomy/term/'.$t->tid);
                }
            ?>
        </nav>

    </div>
</header>
