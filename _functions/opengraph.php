<?php

function zero_og_article_extras()
{
	echo "\n";
	echo "\t\t<meta property=\"og:type\" content=\"article\">\n";

	echo "\t\t<meta property=\"article:published_time\" content=\"" . get_the_date('c') . "\">\n";
	echo "\t\t<meta property=\"article:modified_time\" content=\"" . get_the_modified_date('c') . "\">\n";

	$terms = get_the_terms(0, 'category');
	if ($terms !== false) {
		foreach ($terms as $term) {
			echo "\t\t<meta property=\"article:section\" content=\"" . esc_attr($term->name) . "\">\n";
		}
	}

	$terms = get_the_terms(0, 'post_tag');
	if ($terms !== false) {
		foreach ($terms as $term) {
			echo "\t\t<meta property=\"article:tag\" content=\"" . esc_attr($term->name) . "\">\n";
		}
	}

}
