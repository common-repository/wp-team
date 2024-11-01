<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

// WP Team ShortCode
function wpv_wp_team_shortcode( $atts ) {
	extract( shortcode_atts( array(
		'items'         => '4',
		'small_desktop' => '3',
		'tablet'        => '2',
		'mobile'        => '1',
		'navigation'    => 'true',
		'rtl'           => 'false',
	), $atts, 'wp-team' ) );

	// Query for the normal logos
	$args = array(
		'post_type'      => 'wp_team',
		'orderby'        => 'date',
		'order'          => 'DESC',
		'posts_per_page' => - 1
	);

	$que = new WP_Query( $args );

	$custom_id = uniqid();
	$outline   = '';

	$outline .= '
    <script type="text/javascript">
    	    jQuery(document).ready(function() {
				jQuery("#wpv-wp-team-' . $custom_id . '.wpv-wp-team-area").slick({
			        infinite: true,
			        pauseOnHover: true,
			        slidesToShow: ' . $items . ',
			        slidesToScroll: 1,
			        autoplay: true,
			        rtl: ' . $rtl . ',
		            arrows: ' . $navigation . ',
		            prevArrow: "<div class=\'slick-prev\'><i class=\'fa fa-angle-left\'></i></div>",
	                nextArrow: "<div class=\'slick-next\'><i class=\'fa fa-angle-right\'></i></div>",
		            responsive: [
						    {
						      breakpoint: 1000,
						      settings: {
						        slidesToShow: ' . $small_desktop . '
						      }
						    },
						    {
						      breakpoint: 700,
						      settings: {
						        slidesToShow: ' . $tablet . '
						      }
						    },
						    {
						      breakpoint: 460,
						      settings: {
						        slidesToShow: ' . $mobile . '
						      }
						    }
						  ]
		        });

		    });
    </script>';

	$outline .= '<div class="wpv-wp-team-section">';
	$outline .= '<div id="wpv-wp-team-' . $custom_id . '" class="wpv-wp-team-area">';

	if ( $que->have_posts() ) {
		while ( $que->have_posts() ) : $que->the_post();

			$member_image = get_the_post_thumbnail_url( get_the_ID(), 'wp-team-member-image' );

			$outline .= '<div class="wpv-team-member">';

			if ( has_post_thumbnail() ) {
				$outline .= '<img src="' . $member_image . '" alt="' . get_the_title() . '">';
			}

			$facebook    = get_post_meta( get_the_ID(), 'facebook', true );
			$twitter     = get_post_meta( get_the_ID(), 'twitter', true );
			$google_plus = get_post_meta( get_the_ID(), 'google_plus', true );
			$instagram   = get_post_meta( get_the_ID(), 'instagram', true );
			$designation = get_post_meta( get_the_ID(), 'designation', true );

			$outline .= '<div class="wpt-member-info">';
			$outline .= '<h2 class="wpt-member-name text-center">' . esc_html( get_the_title() ) . '</h2>';
			if ( $designation ) {
				$outline .= '<p class="wpt-member-designation text-center">' . esc_html( $designation ) . '</p>';
			}
			$outline .= '<div class="wpt-member-social-links text-center">';

			if ( $facebook ) {
				$outline .= '<a href="' . esc_url( $facebook ) . '" target="_blank"><i class="fa fa-facebook"></i></a>';
			}
			if ( $twitter ) {
				$outline .= '<a href="' . esc_url( $twitter ) . '" target="_blank"><i class="fa fa-twitter"></i></a>';
			}
			if ( $google_plus ) {
				$outline .= '<a href="' . esc_url( $google_plus ) . '" target="_blank"><i class="fa fa-google-plus"></i></a>';
			}
			if ( $instagram ) {
				$outline .= '<a href="' . esc_url( $instagram ) . '" target="_blank"><i class="fa fa-instagram"></i></a>';
			}

			$outline .= '</div>';
			$outline .= '</div>';

			$outline .= '</div>';

		endwhile;
		wp_reset_postdata();

	} else {
		$outline .= '<h2 class="wpv-not-found-any-member">' . esc_html__( 'Not found any member', 'wp-team' ) . '</h2>';
	}

	$outline .= '</div>';
	$outline .= '</div>';


	return $outline;

}

add_shortcode( 'wp-team', 'wpv_wp_team_shortcode' );