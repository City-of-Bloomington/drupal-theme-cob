<?php
/**
 * @file
 * Default theme implementation to navigate books.
 *
 * Presented under nodes that are a part of book outlines.
 *
 * Available variables:
 * - $book_link: The book data for the current book
 * - $tree: The immediate children of the current node rendered as an unordered
 *   list.
 * - $current_depth: Depth of the current node within the book outline. Provided
 *   for context.
 * - $prev_url: URL to the previous node.
 * - $prev_title: Title of the previous node.
 * - $parent_url: URL to the parent node.
 * - $parent_title: Title of the parent node. Not printed by default. Provided
 *   as an option.
 * - $next_url: URL to the next node.
 * - $next_title: Title of the next node.
 * - $has_links: Flags TRUE whenever the previous, parent or next data has a
 *   value.
 * - $book_id: The book ID of the current outline being viewed. Same as the node
 *   ID containing the entire outline. Provided for context.
 * - $book_url: The book/node URL of the current outline being viewed. Provided
 *   as an option. Not used by default.
 * - $book_title: The book/node title of the current outline being viewed.
 *   Provided as an option. Not used by default.
 *
 * @see template_preprocess_book_navigation()
 *
 * @ingroup themeable
 */
if ($tree || $has_links) {
    $class_current = ['attributes' => ['class' => ['current']]];

    $m = book_get_flat_menu($book_link);
    if ($book_id == 39) {
        $route = menu_get_item('contact/directory');
        if (current_path() === 'contact/directory') { $book_title = $route['title']; }
        $m['custom'] = [
            'title'      => $route['title'],
            'link_title' => $route['title'],
            'link_path'  => 'contact/directory'
        ];
    }
    foreach ($m as $mlid => $menu_item) {
        #$attr = !empty($menu_item['in_active_trail']) ? $class_current : [];
        $attr = $menu_item['title'] === $book_title ? $class_current : [];
        echo l($menu_item['link_title'], $menu_item['link_path'], $attr);
    }
}
