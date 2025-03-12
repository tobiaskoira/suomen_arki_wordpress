<?php
/**
 * WooCommerce Shop Page - Custom Template
 */
get_header(); ?>

<main class="custom-shop-container">
    <div class="shop-header">
        <h1><?php woocommerce_page_title(); ?></h1>
    </div>

    <div class="custom-shop-content">


        <section class="shop-products">
                <?php if (woocommerce_product_loop()) : ?>

                <div class="product-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <div class="custom-product-item">
                            <?php wc_get_template_part('content', 'product'); ?>
                        </div>
                    <?php endwhile; ?>
                </div>

                <?php woocommerce_pagination(); ?>
                
            <?php else : ?>
                <p>No products found.</p>
            <?php endif; ?>
        </section>


        <aside class="shop-sidebar">

            <h2>Your Basket</h2>
            <?php if (WC()->cart->get_cart_contents_count() > 0) : ?>
                <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                    <ul class="basket-items">
                        <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                            $product = $cart_item['data'];
                            $product_id = $product->get_id();
                            $product_name = $product->get_name();
                            $product_permalink = $product->get_permalink();
                            $product_thumbnail = $product->get_image('thumbnail');
                            $product_quantity = $cart_item['quantity'];
                            $max_quantity = $product->get_max_purchase_quantity();
                            $product_price = WC()->cart->get_product_subtotal($product, $product_quantity);
                            ?>
                                <li class="basket-item">
                                    <div class="basket-item-thumbnail">
                                        <a href="<?php echo esc_url($product_permalink); ?>">
                                            <?php echo $product_thumbnail; ?>
                                        </a>
                                    </div>
                                    <div class="basket-item-details">
                                        <a href="<?php echo esc_url($product_permalink); ?>" class="basket-item-name">
                                            <?php echo esc_html($product_name); ?>
                                        </a>
                                        <span class="basket-item-price"><?php echo $product_price; ?></span>
                                    </div>
                                    <div class="basket-item-controls">
                                        <input type="number" name="cart[<?php echo $cart_item_key; ?>][qty]" 
                                            value="<?php echo esc_attr($product_quantity); ?>" 
                                            min="0" 
                                            max="<?php echo esc_attr($max_quantity); ?>" 
                                            step="1" 
                                            class="quantity-input">
                                        <button type="submit" name="update_cart" class="update-cart-button">Update</button>
                                        <a href="<?php echo esc_url(wc_get_cart_remove_url($cart_item_key)); ?>" 
                                        class="remove-item" 
                                        aria-label="<?php esc_attr_e('Remove this item', 'woocommerce'); ?>" 
                                        data-product_id="<?php echo esc_attr($product_id); ?>">×</a>
                                    </div>
                                </li>

                        <?php endforeach; ?>
                    </ul>
                    <p class="basket-total"><strong>Total:</strong> <?php echo WC()->cart->get_cart_total(); ?></p>
                    <div class="basket-actions">
                        <button type="submit" name="update_cart" class="button">Update Basket</button>
                        <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="button checkout-button">Checkout</a>
                    </div>
                    <?php wp_nonce_field('woocommerce-cart'); ?>
                </form>
            <?php else : ?>
                <p>Your basket is currently empty.</p>
            <?php endif; ?>

            <?php 
            // Optionally include widgets in the sidebar
            if (is_active_sidebar('shop-sidebar')) {
                dynamic_sidebar('shop-sidebar');
            }
            ?>
</aside>


    </div>
</main>

<?php get_footer(); ?>

