<link rel="stylesheet" type="text/css" href="<?php bloginfo( 'stylesheet_url' ); ?>"/>
<?
   get_header(); ?>
   

   
<div id="wrapper">
   <div id="menusection">
      <div id="menu">
         <h5>Menu</h5>
         <ul class="sidemenustyling">
         <ul class="sidemenustyling">
             <? get_template_part( 'template-parts/frontpagesidebar', 'none' ); ?>
         <ul>
      </div>
   </div>
   
   <? if ( is_product() ){ ?>
        <div id="defaultcontent">
            <div id="SinglePostPage">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                <?
                ?><h5><?php the_title(); ?></h5><?
                
                $currency = get_woocommerce_currency_symbol();
                $price = get_post_meta( get_the_ID(), '_regular_price', true);
                $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                ?>
                
                <?php if($sale) : ?>
                <p class="product-price-tickr"><del><?php echo $currency; echo $price; ?></del> <?php echo $currency; echo $sale; ?></p>    
                <?php elseif($price) : ?>
                <p class="product-price-tickr"><?php echo $currency; echo $price; ?></p>    
                <?php endif; ?>
                
                <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'single-post-thumbnail' );?>
                <img src="<?php  echo $image[0]; ?>" data-id="<?php echo $loop->post->ID; ?>">
                
                <?
                global $product;
                echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                    sprintf( '<a href="%s" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
                        esc_url( $product->add_to_cart_url() ),
                        esc_attr( $product->id ),
                        esc_attr( $product->get_sku() ),
                        $product->is_purchasable() ? 'add_to_cart_button' : '',
                        esc_attr( $product->product_type ),
                        esc_html( $product->add_to_cart_text() )
                    ),
                $product );
                ?>
                
                <?php endwhile; endif; ?>
            </div>
        </div>
   <? 
    }else
    {
   ?>
   <div id="defaultcontent">
      <div id="SinglePostPage">
      



         <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
         <div <?php post_class() ?> id="post-<?php the_ID(); ?>">
            <h5><?php the_title(); ?></h5>
            <div id="submittext">
            <div id="postcat">
               <?   
                  $categories = get_the_category();
                  $separator = ' ';
                  $output = '';
                  if ( ! empty( $categories ) ) 
                  {
                  
                  foreach( $categories as $category ) 
                  {
                  if($category->name !== 'Spotlight-badge')
                  {
                  	$output .= '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts		 in %s', 'textdomain' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a></li>' . $separator;
                  }
                  }
                  
                  echo trim( $output, $separator );
                  }
                   ?>
            </div>
            <br>
 
 
 			<?
			$post_id = get_the_ID();
			
			?>
			
			<script>
			var $postid = "<?php echo get_the_ID(); ?>";
		//	alert($postid);
			</script>
			
			
			<? //echo $post_id; ?>
            <script>
				$(function()
				{
					$("body").click(function(e) 
					{
						if (e.target.id == "contentblock" || $(e.target).parents("#contentblock").size()) 
						{
								//alert("Inside div");
								if ($(e.target).is("a"))
								{
										$('#afterdownload').fadeIn('slow');
										$('#ajax').load('<?php echo get_template_directory_uri(); ?>/count_download_in_background.php?choices=<?php echo $post_id; ?>');
								}
						}
					});
				});   
            </script>
            
            <div id="ajax"></div>
            <div id="contentblock">
               
                  
               
               <div class="entry">
                  <div id="styleDownloadLink"  >
                     <?php the_content(); ?>
                  </div>
                  </div>
            </div>
            
            <div id="afterdownload">
                  Thanks for downloading, 
                  <br>Like our content? Support our page.
                  <br><div class="fb-like" data-href="https://www.facebook.com/papercraftplaza" data-layout="button" data-action="like" data-size="large" data-show-faces="true" data-share="false"></div>
               </div>
            
            <a id="loadmodellink" href="javascript:loadmodelfunction();">Show 3d model </a>
            
            <? /*this shows the views*/ ?>
            <div id="viewsblock">
               <? echo getPostViews(get_the_ID()); ?>
               <br><? echo getPostDownloads(get_the_ID()); ?>
               <? if( current_user_can('editor') || current_user_can('administrator') )
                  {
                  ?> 
               		<br><? 	echo getPostGlances(get_the_ID());
                  }
                  
                global $current_user;
                get_currentuserinfo();
 
	            
                    ?>
            </div>
            <div id="dateblock">
               <br>Date added: 
                  <?php the_time('d/m/Y') ?> <!-- by <?php the_author() ?> -->
               <? /*this gets the views*/
                  setPostViews(get_the_ID()); ?>
            </div>
            
            
			Submitted by: <? the_author(); ?>
         <?
		 if( current_user_can('editor') || current_user_can('administrator') )
                  {
			if ( is_user_logged_in() ) 
			{
			    
         		 //Favorite button here
         		 //if ( function_exists( 'wfp_button' ) ) wfp_button(); 
         		 //wpfp_link();
			}
			else 
			{
				
			}
				  }
			?>
			
			
         
        <br></br>
        <?
        if ( is_user_logged_in() ) 
		{
			    
            wpfp_link();
			}
		else
		{
		   ?> <a id="favlogindirect" href="#" onclick="loginlinkfunction();">Add to favorites</a> <?
		}
			
        
        ?>
        
      
		
        <script>
            //make a div that will be used for the canvas
            var iDiv = document.createElement('div');
            iDiv.id = 'testcanvas';
            iDiv.className = 'testcanvas';
            document.getElementsByTagName('body')[0].appendChild(iDiv);
        </script>
        
		<? //Check if link contains a .obj and hide it ?>
     
       
		 <script src="https://papercraftplaza.com/wp-content/themes/papercraftplazaV3/js/loaders/OBJLoader.js"></script>
		 <script src="https://papercraftplaza.com/wp-content/themes/papercraftplazaV3/js/loaders/DDSLoader.js"></script>
		<script src="https://papercraftplaza.com/wp-content/themes/papercraftplazaV3/js/loaders/MTLLoader.js"></script>
		<script src="https://papercraftplaza.com/wp-content/themes/papercraftplazaV3/js/controls/TrackballControls.js"></script>
		 
		<script>
		var $objlink;
		var $texturelink;
		
		 $(document).ready(function () {
		     	var $texname = $postid+".jpg";
            //Hide the link
		    $('a:contains(".obj")').hide();
		    $("a:contains("+ $texname +")").hide();
		    
		    //Link to var
			$objlink = $('a:contains(".obj")');
			
			$texturelink = $("a:contains("+ $texname +")");
			//alert($postid+".jpg");

			$objlink.each(function()
			{
                $objlink = ($(this).attr('href'));
            })
            
        	$texturelink.each(function()
			{
                $texturelink = ($(this).attr('href'));
            })
            
			document.getElementById("loadmodellink").style.display = "none";
			if ($objlink.indexOf('.obj') > -1)
			{
			  document.getElementById("loadmodellink").style.visibility = "visible";
			  document.getElementById("loadmodellink").style.display = "inline";
			  
			}
			
		
		if($texturelink =="[object Object]")
		{
		     //alert("contains no texture");
		}
		

		});
		
		

		
        function loadmodelfunction() 
        {
            //alert($objlink);
			//$('#loadmodel').fadeIn('slow');
			$('#testcanvas').fadeIn('slow');
			$('#loginbackground').fadeIn('slow');
			$('#closebutton').fadeIn('slow');
			$('#controls').fadeIn('slow');
			//$('canvas').fadeIn('slow');
			startmodelscript();
			$stopscroll = true;
		}
		
		    
		    
		function startmodelscript()
		{
		    document.documentElement.style.height = 100+"%";
            document.body.style.height = 100+"%";
            document.documentElement.style.overflow = "hidden";
            document.body.style.overflow = "hidden";
		     
		    
            /*
		    window.onscroll = function () 
		    { 
		        if($stopscroll==true)
		        {
		            //window.scrollTo(0, 0);
		        }
		    };
		    
		    $(document.body).on("touchmove", function(event) 
		    {
                 //window.scrollTo(0, 0);
                 //console.log("mobilescroll");
                 if($stopscroll==true)
		        {
                    //$('html, body').scrollTop(1);
		        }
            });
            */
			    
		    var container;
		    var camera, scene, renderer, controls;
		    var mouseX = 0, mouseY = 0;
		    var windowHalfX = window.innerWidth / 2;
		    var windowHalfY = window.innerHeight / 2;
			
			
			init();
			animate();
			function init()
			{
				container = document.getElementById( 'testcanvas' );
				document.body.appendChild( container );
				
				camera = new THREE.PerspectiveCamera( 45,600/600, 0.1, 2000 );
				camera.position.z = 10;
				//camera.position.y = 0;
				
				controls = new THREE.TrackballControls( camera );
				controls.rotateSpeed = 3.0;
				controls.zoomSpeed = 4.2;
				controls.panSpeed = 0.8;
				controls.noZoom = true;
				controls.noPan = true;
				controls.staticMoving = false;
				controls.dynamicDampingFactor = 0.3;
				controls.keys = [ 65, 83, 68 ];
				controls.addEventListener( 'change', render );
				
				// scene
				scene = new THREE.Scene();
				
				//Lights
				var ambientLight = new THREE.AmbientLight( 0xcccccc, 0.7 );
				scene.add( ambientLight );
				var pointLight = new THREE.PointLight( 0xffffff, 0.35 );
				camera.add( pointLight );
				pointLight.position.x =3;
				pointLight.position.y =-1;

				// texture
				var manager = new THREE.LoadingManager();
				manager.onProgress = function ( item, loaded, total ) 
				{
					console.log( item, loaded, total );
				};
				var textureLoader = new THREE.TextureLoader( manager );
				if($texturelink =="[object Object]")
		        {
				    var texture = textureLoader.load( '/wp-content/themes/papercraftplazaV3/textures/white.jpg' );
		        }
		        else
		        {
		            var texture = textureLoader.load($texturelink);
		        }
				
				// model
				var onProgress = function ( xhr )
				{
					if ( xhr.lengthComputable ) {
						var percentComplete = xhr.loaded / xhr.total * 100;
						console.log( Math.round(percentComplete, 2) + '% downloaded' );
					}
				};
				var onError = function ( xhr )
				{
				};
				var loader = new THREE.OBJLoader( manager );

				loader.load( $objlink, function ( object )
				{
					object.traverse( function ( child )
					{
						if ( child instanceof THREE.Mesh )
						{
							child.material.map = texture;
                            child.material.side = THREE.DoubleSide;
                            //child.material.wireframe = true;
                            //child.material.color = new THREE.Color( 0x6893DE  );
						}
					} );
					
					//Set up a bounding box around mesh
					var box = new THREE.Box3().setFromObject( object );
					var helperunscaled = new THREE.Box3Helper( box, 0xffff00 );
					
                    //Get scale of the width, depth and height. Spit out the biggest one so you can scale it to fit the model viewer
                    var gethighest = Math.max(box.max.x - box.min.x, box.max.y - box.min.y, box.max.z - box.min.z);
                    
                    //var scalefactor = 4/(box.max.y - box.min.y) ;
                    var scalefactor = 5.5/gethighest;
                    
                    //Set scale of object
                    object.scale.set(scalefactor,scalefactor,scalefactor);
                    
                    //Create new bounding box after scale
                    var testbox = new THREE.Box3().setFromObject( object );
                    var helperscaled = new THREE.Box3Helper( testbox, 0xffff00 );
                    
                    //repos object
                    // Getcenter point of box
                    getXPos = testbox.max.x + testbox.min.x;
                    getYPos = testbox.max.y + testbox.min.y;
                    getZPos = testbox.max.z + testbox.min.z;
                    
                    //reposition mesh
                    object.position.x = -getXPos/2; //Diepte
                    object.position.y = -getYPos/2; // verticale as Hoogte
                    object.position.z = -getZPos/2; //horizontale as
                    
                    //Create new bounding box after scale
                    var lastbox = new THREE.Box3().setFromObject( object );
                    var helperFinal = new THREE.Box3Helper( lastbox, 0xffff00 );
                    
					scene.add(object);
					scene.add( camera );
					
					//scene.add(helperunscaled);
					//scene.add( helperscaled );
					//scene.add( helperFinal );
					
					/*
					//Gridhelper
					var size = 10;
                    var divisions = 10;
                    var gridHelper = new THREE.GridHelper( size, divisions );
                    scene.add( gridHelper );
                    
                    //Axis helper
                    var axisHelper = new THREE.AxesHelper(800); // 500 is size 3
                    scene.add(axisHelper);
                    */

				}, onProgress, onError );

				renderer = new THREE.WebGLRenderer({ antialias: true });
				renderer.setPixelRatio( window.devicePixelRatio );
				renderer.setSize( document.getElementById("testcanvas").offsetWidth,document.getElementById("testcanvas").offsetHeight );
				renderer.setClearColor( 0xffffff );
				container.appendChild( renderer.domElement );
				
				document.addEventListener( 'mousemove', onDocumentMouseMove, false );
				window.addEventListener( 'resize', onWindowResize, false );
			}
			function onWindowResize()
			{
				//Resize render if div is resized
			    renderer.setSize( document.getElementById("testcanvas").offsetWidth,document.getElementById("testcanvas").offsetHeight );
			}
			function onDocumentMouseMove( event )
			{
				mouseX = event.clientX;
				mouseY = event.clientY;
			}
			function animate()
			{
				controls.update();
				requestAnimationFrame( animate );
				render();
			}
			function render()
			{
                renderer.render( scene, camera );
			}
		}

		
	
		</script>
		 

		
		
        </script>
        
         <?
			$user_id = get_current_user_id();
			$post_id = get_post();
			$post_title = get_the_title( $post_id );
			
			//maak text file aan genaamd userID.txt
			//Schrijf de postID telkens in een nieuwe regel
         ?>
     
  
            <div class="social">
            
           	<div id="sharetext">
              <br> Share this papercraft on:
               </div>
               <!--Twitter-->
               <a class="twitter" href="http://twitter.com/home?status=Reading: <?php the_permalink(); ?>" title="Share this post on Twitter!" target="_blank">Twitter</a>
               <!--Facebook-->
               <a class="facebook" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&amp;t=<?php the_title(); ?>" title="Share this post on Facebook!" onclick="window.open(this.href); return false;">Facebook</a>
               <!--Google Plus-->
               <a class="google-plus" target="_blank" href="https://plus.google.com/share?url=<?php the_permalink(); ?>">Google+</a>
            </div>
         </div>
         </div>
         <div id="submittext">
         <?php edit_post_link(__('<img src="http://papercraftplaza.com/wp-content/themes/papercraftplazaV3/images/edit.png" width="12" height="12" alt=""/> Quick Edit'), ''); ?>
         
         <?
         if (is_user_logged_in() && $current_user->ID == $post->post_author) 
	            {
		           ?>
		           <p><a href="<?php echo get_delete_post_link( get_the_ID(), $deprecated, $force_delete=true); ?>">Delete Papercraft</a></p>
		           
		           
		           <?
		           
	            }
         ?>
         
         <?php endwhile; endif; ?>
         <div id="troubleblock">
            <a href="http://www.papercraftplaza.com/tutorialbasic/">Having problems opening the downloaded file?</a>
         	</div>
         </div>
      </div>
   </div>
   <?
    }
    ?>

   </div>


   <div id="relatedsection">
      <div id="relatedblock">
         <h5>Related</h5>
         <div id="related-column">
            <?php
               // get other posts from this category only as related posts //
               $backup = $post;  // backup the current object
                  $categories = get_the_category($post->ID);
                  if ($categories) {
                      $category_ids = array();
                      foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
               
                      $args = array (
                          'category__in' => $category_ids,
                          'post__not_in' => array($post->ID),
               		'posts_per_page'=>6,
                          'orderby' => 'rand',
                          'caller_get_posts'=>1
                      );
               
                      $my_query = new wp_query($args);
                      if( $my_query->have_posts() ) {
                          while ($my_query->have_posts()) : $my_query->the_post();
                    ?>
            <div>
               <?php echo('<article class="galleryitem">');
                  //echo('<h1><a href="' . get_permalink() . '">' . get_the_title() . '</a></h1>');
                  echo('<a href="' . get_permalink() . '">' . ShortenText(get_the_title()) . '<br></a>');
                  
                  
                  $content = get_the_content();
                  preg_match('#(<img.*?>)#', $content, $results);
               //echo $results[1];
               echo('<a href="' . get_permalink() . '">' . $results[1] . '<br></a>');
               echo('</article>');
               ?>
            </div>
            <?php
               endwhile;
                }
                $post = $backup;  // copy it back
                wp_reset_query(); // to use the original query again
               }
               ?>
         </div>
   </div>
</div>
<div id="horbanner">
   <div id="bannerinsert">     
   </div>
</div>
<?php 
   //get_footer();
   ?>