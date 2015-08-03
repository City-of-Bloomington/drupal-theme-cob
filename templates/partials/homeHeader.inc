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
        <nav class="cob-homeNav">
            <?php
                $class_current = empty($term) ? 'class="cob-ext-current"' : '';
                echo "<a href=\"$front_page\" $class_current>Home</a>";

                $class_current = ['attributes'=>['class'=>['cob-ext-current']]];

                $categories = taxonomy_vocabulary_machine_name_load('categories');
                foreach (taxonomy_get_tree($categories->vid, 0, 1) as $t) {
                    $attr = (  (!empty($term)         && $t->tid == $term->tid)
                            || (!empty($term->parent) && $t->tid == $term->parent->tid ))
                        ? $class_current
                        : [];
                    echo l($t->name, 'taxonomy/term/'.$t->tid, $attr);
                }
            ?>
        </nav>

    </div>
</header>
