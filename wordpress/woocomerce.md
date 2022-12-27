# sample code for wordpress woocomerce
Change price to contact button when zero
```
add_filter('woocommerce_get_price_html', function ( $price ) {	
    return $price ? $price : '<a href="/contact" class="price-contact">Contact</a>';
} );
```
