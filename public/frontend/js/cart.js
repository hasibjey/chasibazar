const addToCart = (
    user_id,
    customer_id,
    product_id,
    product_title,
    product_quantity,
    product_unit,
    product_price
) => {
    const totalPrice = parseFloat(product_quantity) * parseFloat(product_price);

    axios
        .post("/customer/addToCart", {
            user_id: user_id,
            customer_id: customer_id,
            product_id: product_id,
            product_title: product_title,
            product_quantity: product_quantity,
            product_unit: product_unit,
            product_price: product_price,
            totalPrice: totalPrice,
        })
        .then((res) => {
            console.log(res.data);

            if(res.data.message == 'success') {
                $(".cart-drawer").addClass("group-hover:block");
                $(".cart-count").html(res.data.count);
                $(".cart-drawer-item").html(res.data.cart);
                $(".sub-total").html(res.data.subTotal);
                Toast.fire({
                    icon: "success",
                    title: "পণ্য সফলভাবে যোগ করা হয়েছে",
                });
            }
        })
        .catch((error) => {
            Toast.fire({
                icon: "error",
                title: "পণ্য যুক্ত হয়নি",
            });
        });
};
