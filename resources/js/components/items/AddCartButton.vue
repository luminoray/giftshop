<template>
    <button @click="addItemToCart" class="btn btn-primary">Add to cart</button>
</template>

<script>
    import EventBus from "../../event-bus";

    export default {
        name: "AddCartButton",
        props: ['itemId'],
        methods: {
            addItemToCart () {
                let cart = JSON.parse(this.$cookie.get('cart')) ?? {};
                cart[this.itemId] = (cart[this.itemId] ?? 0) + 1;
                this.$cookie.set('cart',JSON.stringify(cart), 7);
                EventBus.$emit('updateCart', cart);
            }
        }
    }
</script>
