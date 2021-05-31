<template>
    <button @click="removeItemFromCart" class="btn btn-danger">Remove</button>
</template>

<script>
    import EventBus from "../../event-bus";

    export default {
        name: "RemoveCartButton",
        props: ['itemId'],
        methods: {
            removeItemFromCart () {
                let cart = JSON.parse(this.$cookie.get('cart')) ?? {};
                if (cart[this.itemId]) {
                    cart[this.itemId] -= 1;
                }
                if (! cart[this.itemId]) {
                    delete cart[this.itemId];
                }
                this.$cookie.set('cart',JSON.stringify(cart), 7);
                EventBus.$emit('updateCart', cart, this.itemId);
            }
        }
    }
</script>
