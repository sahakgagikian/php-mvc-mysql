<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<script>
    $(document).ready(function () {
        var selected = document.querySelectorAll(".add-to-cart");
        selected.forEach(item => {
            item.addEventListener("click", function () {
                if (this.getAttribute("data-selected") == 0) {
                    $(this).attr('data-selected', '1');
                    $(this).prop('value', 'Remove from cart');
                } else {
                    $(this).attr('data-selected', '0');
                    $(this).prop('value', 'Add to cart');
                }
            });
        });

        $("#make-order").click(function (e) {
            e.preventDefault();
            let cart = [];
            let selected = Array.from($(".add-to-cart[data-selected='1']"));
            let notSelected = Array.from($(".add-to-cart[data-selected='0']"));
            let quantity = 0;
            selected.forEach(item => {
                let id = item.getAttribute("data-id");
                let obj = {
                    id: item.getAttribute("data-id"),
                    name: item.getAttribute("data-name"),
                    description: item.getAttribute("data-description"),
                    price: item.getAttribute("data-price"),
                    quantity: Number($(".qty[data-id='" + id + "']").val())
                };
                cart.push(obj);
            });
            $.ajax({
                type: "post",
                url: "/addToCart",
                data: {
                    data: JSON.stringify(cart)
                },
                success: function (data) {
                    console.log(data);
                    window.location.href = '/cart';
                },
                error: function (msg) {
                    // window.location.href = '/cart';
                }
            });
        });
    });
</script>

</head>

<body>
