<?php
/**
 * Gutenix_Pro_Comment_Likes class
 *
 * @package gutenix-pro
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Gutenix_Pro_Comment_Likes' ) ) {

	/**
	 * Define Gutenix_Pro_Comment_Likes class
	 */
	class Gutenix_Pro_Comment_Likes extends Gutenix_Pro_Module_Base {

		/**
		 * Is enabled comment likes.
		 *
		 * @since  1.0.0
		 * @access private
		 * @var    null|bool
		 */
		private $is_comment_likes_enabled = null;

		/**
		 * Added options to customizer.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function customizer_options() {
			return array(
				'single_post_comment_likes' => array(
					'title'    => esc_html__( 'Comment Likes', 'gutenix-pro' ),
					'section'  => 'blog_post',
					'priority' => 300,
					'default'  => false,
					'field'    => 'gutenix-toggle-checkbox',
					'type'     => 'control',
					'sanitize_callback' => 'gutenix_sanitize_checkbox',
				),
			);
		}

		/**
		 * Modify selective refresh partial
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function selective_refresh_partials() {
			return array(
				'comment_likes_enable' => array(
					'settings' => array( 'single_post_comment_likes' ),
				),
			);
		}

		/**
		 * Add or remove module-related hooks
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function hooks() {
			add_action( 'wp_ajax_gutenix_pro_comment_votes_comment_ajax_action', array( $this, 'like_dislike_action_id' ) );
            add_action( 'wp_ajax_nopriv_gutenix_pro_comment_votes_comment_ajax_action', array ( $this, 'like_dislike_action_id' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'register_assets' ) );
			add_filter( 'comment_text', array( $this, 'render_comment_likes' ), 20, 2);
		}

		/**
		 * Check comment likes is enabled.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return null|bool
		 */
		public function is_comment_likes_enabled() {

			if ( null === $this->is_comment_likes_enabled ) {
				$this->is_comment_likes_enabled = gutenix_theme()->customizer->get_value( 'single_post_comment_likes' );
			}

			return $this->is_comment_likes_enabled;
		}

		/**
		 * Register assets.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function register_assets() {
			
			if( $this->is_comment_likes_enabled() ) {
				
				wp_enqueue_style( 'comment-likes', gutenix_pro()->plugin_url( 'assets/lib/jquery-comment-likes/comment-likes.css' ), array(), '1.0.0' );

				wp_enqueue_script( 'jquery-comment-likes', gutenix_pro()->plugin_url( 'assets/lib/jquery-comment-likes/jquery-comment-likes.js' ), array( 'jquery' ), '1.0.0', true );
				
				if ( is_user_logged_in() ){
					$current_user = wp_get_current_user();
					$user_id = $current_user->ID;
					$logged_in = 1;
				} else {
					$user_id = '';
					$logged_in = 0;
				}

				$comment_likes_obj = array(
					'ajax_url' 			=> admin_url('admin-ajax.php'),
					'ajax_nonce' 		=> wp_create_nonce('gutenix_pro_comment_votes_ajax_nonce'),
					'error_message' 	=> esc_html__( 'Please Login First', 'gutenix-pro' ),
					'logged_in' 		=> $logged_in,
					'user_id' 			=> $user_id,
					'number_format' 	=> 'format_1',
				);
				wp_localize_script( 'jquery-comment-likes', 'gutenix_pro_comment_likes_obj', $comment_likes_obj);
			}
		}

		/**
		 * Number Format
		 *
		 * @since  1.0.0
		 */
		public function comment_likes_number_format( $input, $number_format) {
            
			$prev 			= $input;
			$input 			= number_format( ( float ) $input );
			$input_count 	= substr_count( $input, ',' );
			$arr 			= array( 1 => 'K', 'M', 'B', 'T' );
			
			if ( isset( $arr[(int) $input_count] ) ) {
				return substr( $input, 0, ( -1 * $input_count ) * 4 ) . $arr[(int) $input_count];
			} else {
				return $prev;
			}
        }

		/**
		 * Added additional post template part slugs.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $slug Default slug.
		 * @return string
		 */
		function render_comment_likes( $comment_text ) {

			if ( is_admin() ) {
				return $comment_text;
			}
			
			if( $this->is_comment_likes_enabled() ) {

				ob_start();

				$this->comment_likes_html();

				$like_dislike_html = ob_get_contents();

				ob_end_clean();

				$comment_text .= $like_dislike_html;

				return $comment_text;

			} else {
				
				return $comment_text;

			}
        }

        function like_dislike_action_id( $args ) {
            
            if ( isset($_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'gutenix_pro_comment_votes_ajax_nonce' ) ) {
                
                $comment_id 	= intval( sanitize_text_field( $_POST['comment_id'] ) );
                $type 			= sanitize_text_field( $_POST['type'] );
                $user_id 		= sanitize_text_field( $_POST['user_id'] );
                $logged_in 		= sanitize_text_field( $_POST['logged_in'] );
                $number_format 	= sanitize_text_field( $_POST['number_format'] );
                $liked_ids 		= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_likedids', true );
                $disliked_ids 	= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_dislikedids', true );
                $total_count 	= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_total_count', true );
                $like_count 	= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_like_count', true );
                $dislike_count 	= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_dislike_count', true );

                if ( empty( $like_count ) ) {
                    $like_count = 0;
                }
                if ( empty( $dislike_count ) ) {
                    $dislike_count = 0;
                }
                if ( $type == 'like' ) {
                    if ( empty( $liked_ids ) ) {
                        $liked_ids = array();
                    }
                    if (!in_array($user_id, $liked_ids) && !in_array($user_id, $disliked_ids)) {
                        $liked_ids[] = $user_id;
                        $like_count = $like_count + 1;
                        update_comment_meta($comment_id, 'gutenix_pro_comment_votes_likedids', $liked_ids);
                    } else if (!in_array($user_id, $liked_ids) && in_array($user_id, $disliked_ids)) {
                        $key = array_search($user_id, $disliked_ids);
                        unset($disliked_ids[$key]);
                        $dislike_count = $dislike_count - 1;
                        if($dislike_count <= 0){
                            $dislike_count = 0;
                        }
                        $liked_ids[] = $user_id;
                        $like_count = $like_count + 1;
                        $l = update_comment_meta($comment_id, 'gutenix_pro_comment_votes_likedids', $liked_ids);
                        $d = update_comment_meta($comment_id, 'gutenix_pro_comment_votes_dislikedids', $disliked_ids);
                    } else {
                        $key = array_search($user_id, $liked_ids);
                        unset($liked_ids[$key]);
                        $like_count = $like_count - 1;
                        if ($like_count <= 0) {
                            $like_count = 0;
                        }
                        $l = update_comment_meta($comment_id, 'gutenix_pro_comment_votes_likedids', $liked_ids);
                    }
                    $check = update_comment_meta($comment_id, 'gutenix_pro_comment_votes_like_count', $like_count);
                    if ($check) {
                        update_comment_meta($comment_id, 'gutenix_pro_comment_votes_dislike_count', $dislike_count);
                        $like_count = $this->comment_likes_number_format($like_count, $number_format);
                        $dislike_count = $this->comment_likes_number_format($dislike_count, $number_format);
                        $response_array = array('success' => true, 'latest_count' => $like_count, 'latest_dislike_count' => $dislike_count);
                    } else {
                        $response_array = array('success' => false, 'latest_count' => $like_count);
                    }
                } else {
                    if (empty($disliked_ids)) {
                        $disliked_ids = array();
                    }
                    if (!in_array($user_id, $disliked_ids) && !in_array($user_id, $liked_ids)) {
                        $disliked_ids[] = $user_id;
                        $dislike_count = $dislike_count + 1;
                        update_comment_meta($comment_id, 'gutenix_pro_comment_votes_dislikedids', $disliked_ids);
                    } else if (!in_array($user_id, $disliked_ids) && in_array($user_id, $liked_ids)) {
                        $key = array_search($user_id, $liked_ids);
                        unset($liked_ids[$key]);
                        $like_count = $like_count - 1;
                        if ($like_count <= 0) {
                            $like_count = 0;
                        }
                        $disliked_ids[] = $user_id;
                        $dislike_count = $dislike_count + 1;
                        $l = update_comment_meta($comment_id, 'gutenix_pro_comment_votes_likedids', $liked_ids);
                        $d = update_comment_meta($comment_id, 'gutenix_pro_comment_votes_dislikedids', $disliked_ids);
                    } else {
                        $key = array_search($user_id, $disliked_ids);
                        unset($disliked_ids[$key]);
                        $dislike_count = $dislike_count - 1;
                        if ($dislike_count <= 0) {
                            $dislike_count = 0;
                        }
                        $l = update_comment_meta($comment_id, 'gutenix_pro_comment_votes_dislikedids', $disliked_ids);
                    }
                    $check = update_comment_meta($comment_id, 'gutenix_pro_comment_votes_dislike_count', $dislike_count);
                    if ($check) {
                        update_comment_meta($comment_id, 'gutenix_pro_comment_votes_like_count', $like_count);
                        $like_count = $this->comment_likes_number_format($like_count, $number_format);
                        $dislike_count = $this->comment_likes_number_format($dislike_count, $number_format);
                        $response_array = array('success' => true, 'latest_count' => $dislike_count, 'latest_like_count' => $like_count);
                    } else {
                        $response_array = array('success' => false, 'latest_count' => $dislike_count);
                    }
                }

                echo json_encode( $response_array );

                die();
            }
        }

		 /**
		 * Added additional post template part slugs.
		 *
		 * @since  1.0.0
		 * @access public
		 * @param  string $slug Default slug.
		 * @return string
		 */
		public function comment_likes_html() {
			
			$comment 			= get_comment();
			$comment_id 		= $comment->comment_ID;
			$total_count 		= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_total_count', true );
			$total_count 		= apply_filters( 'gutenix_pro_comment_votes_total_count', $total_count, $comment_id );
			$number_format 		= 'format_1';
			$total_count 		= $this->comment_likes_number_format( $total_count, $number_format );
			$like_count 		= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_like_count', true );
			$like_count 		= apply_filters( 'gutenix_pro_comment_votes_like_count', $like_count, $comment_id );
			$like_count 		= $this->comment_likes_number_format( $like_count, $number_format );
			$dislike_count 		= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_dislike_count', true );
			$dislike_count 		= apply_filters( 'gutenix_pro_comment_votes_dislike_count', $dislike_count, $comment_id );
			$dislike_count 		= $this->comment_likes_number_format( $dislike_count, $number_format );
			$icon_liked 		= '';
			$icon_disliked 		= '';

			if ( is_user_logged_in() ) {
			    
			    $current_user 	= wp_get_current_user();
			    $user_id 		= $current_user->ID;
			    $liked_ids 		= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_likedids', true );
			    
			    if ( empty($liked_ids ) ) {
			        $liked_ids 	= array();
			    }

			    $disliked_ids 	= get_comment_meta( $comment_id, 'gutenix_pro_comment_votes_dislikedids', true );

			    if ( empty( $disliked_ids ) ) {
			        $disliked_ids = array();
			    }

			    if ( in_array( $user_id, $liked_ids ) ) {
			        $liked 			= 'already-liked';
			        $disliked 		= '';
			        $icon_liked 	= 'have-liked';
			        $icon_disliked 	= '';
			    } else if ( in_array( $user_id, $disliked_ids ) ) {
			        $disliked 		= 'already-disliked';
			        $liked 			= '';
			        $icon_liked 	= '';
			        $icon_disliked 	= 'have-disliked';
			    } else {
			        $liked 			= '';
			        $disliked 		= '';
			        $icon_liked 	= '';
			        $icon_disliked 	= '';
			    }

			} else {
			    $user_id 		= '';
			    $liked_ids 		= array();
			    $disliked_ids 	= array();
			    $liked 			= '';
			    $disliked 		= '';
			    $icon_liked 	= '';
			    $icon_disliked 	= '';
			}

			?>
			
			<div class="gutenix_pro_comment_votes-message" id="gutenix_pro_comment_votes-message-<?php echo esc_attr( $comment_id ); ?>"></div>
			<div class="gutenix_pro_comment_votes-like-dislike-wrapper">
				<div class="gutenix_pro_comment_votes-like-wrap gutenix_pro_comment_votes-common-wrap <?php echo esc_attr( $icon_liked ); ?>">
					<div class="gutenix_pro_comment_votes-like-trigger gutenix_pro_comment_votes-like-dislike-trigger <?php echo esc_attr( $liked ); ?>" data-comment-id="<?php echo esc_attr( $comment_id ); ?>" data-trigger-type="like">
						<?php 
							if ( in_array($user_id, $liked_ids ) ) {
								echo gutenix_get_icon_svg( 'like-square' );
							} else {
								echo gutenix_get_icon_svg( 'like' );
							}
						?>
					</div>
					<div class="gutenix_pro_comment_votes-count-wrap gutenix_pro_comment_votes-common-wrap">
						<span class="gutenix_pro_comment_votes-like-count-wrap gutenix_pro_comment_votes-count-wrapper" id="gutenix_pro_comment_votes-like-count-<?php echo esc_attr( $comment_id ); ?>">
							<?php echo esc_html( ( empty( $like_count ) ) ? 0 : $like_count ); ?>
						</span>
					</div>
					<?php echo gutenix_get_icon_svg( 'like' ); ?>
				</div>
				<div class="gutenix_pro_comment_votes-dislike-wrap gutenix_pro_comment_votes-common-wrap <?php echo esc_attr( $icon_disliked ); ?>">
				    <div class="gutenix_pro_comment_votes-dislike-trigger gutenix_pro_comment_votes-like-dislike-trigger <?php echo esc_attr( $disliked ); ?>" data-comment-id="<?php echo esc_attr( $comment_id ); ?>" data-trigger-type="dislike">
						<?php 
							if ( in_array($user_id, $disliked_ids ) ) {
								echo gutenix_get_icon_svg( 'like-square' );
							} else {
								echo gutenix_get_icon_svg( 'like' );
							}
						?>
				    </div>
				    <div class="gutenix_pro_comment_votes-count-wrap gutenix_pro_comment_votes-common-wrap">
					    <span class="gutenix_pro_comment_votes-dislike-count-wrap gutenix_pro_comment_votes-count-wrapper" id="gutenix_pro_comment_votes-dislike-count-<?php echo esc_attr( $comment_id ); ?>">
					    	<?php echo esc_html( ( empty( $dislike_count ) ) ? 0 : $dislike_count ); ?>
					    </span>
					</div>
				</div>
			</div>

			<?php
		}
	}
}
