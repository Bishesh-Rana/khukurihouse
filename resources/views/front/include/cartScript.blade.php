<script>
    $(document).ready(function() {

        $(".ajax-add-to-cart").on('click', function(e) {
            e.preventDefault();
            let data = {
                productId: $(this).data('product_id'),
                qty: "1",
            }


            axios.post("{{ route('product.ajax.addToCart') }}", data).then(res => {
                console.log(res);
                $(".cart-products-list").html("");
                $(".cart-products-list").html(res.data);
                $(".mobile-cart-icon").load(" .mobile-cart-icon"); //For mobiles

                Lobibox.notify('success', {
                    size: 'mini',
                    soundPath: '{{ asset('') }}admincast/assets/lobibox/sounds/',
                    sound: 'sound4',
                    icon: 'fa fa-check',
                    iconSource: "fontAwesome",
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    width: 400,
                    rounded: true,
                    msg: 'Product Added To Cart',
                    delay: 3000,
                    delayIndicator: false,
                    onClickUrl: "{{ route('product.cart') }}"
                });
            }).catch(error => {
                Lobibox.notify('error', {
                    size: 'mini',
                    soundPath: '{{ asset('') }}admincast/assets/lobibox/sounds/',
                    sound: 'sound4',
                    icon: 'fas fa-skull',
                    iconSource: "fontAwesome",
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    width: 400,
                    rounded: true,
                    msg: error.response.data.error.qty,
                    delay: 3000,
                    delayIndicator: false,
                    onClickUrl: "{{ route('product.cart') }}"
                });

            })
        })


        $(document).off('click', '.ajax-remove-from-cart ').on('click', '.ajax-remove-from-cart ', function(e) {
            e.preventDefault();
            let data = {
                productId: $(this).data('product_id'),
            }

            axios.post("{{ route('product.ajax.removeFromCart') }}", data).then(res => {
                $(".cart-products-list").html("");
                $(".cart-products-list").html(res.data);
                $(".mobile-cart-icon").load(" .mobile-cart-icon"); //For mobiles

                Lobibox.notify('success', {
                    size: 'mini',
                    soundPath: '{{ asset('') }}admincast/assets/lobibox/sounds/',
                    sound: 'sound3',
                    icon: 'fa fa-close',
                    iconSource: "fontAwesome",
                    showClass: 'fadeInDown',
                    hideClass: 'fadeUpDown',
                    width: 400,
                    rounded: true,
                    msg: 'Product Removed From Cart',
                    delay: 3000,
                    delayIndicator: false,
                    onClickUrl: "{{ route('product.cart') }}"
                });
            });
        })

        // For success layout fade out
        $('#success').delay(5000).fadeOut('slow');

    });
</script>
