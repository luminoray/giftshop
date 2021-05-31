<template>
    <div id="cart">
        <table class="table">
            <thead class="fs-4">
                <tr>
                    <td class="w-100">Name</td>
                    <td></td>
                    <td>#</td>
                    <td>Cost</td>
                </tr>
            </thead>
            <tbody class="fs-5">
                <tr>
                    <td colspan="4" v-if="! items.length">
                        <template v-if="! Object.keys(this.cart).length">
                            No items in your cart!
                        </template>
                        <template v-else>
                            Loading your cart
                        </template>
                    </td>
                </tr>
                <tr v-for="item in items">
                    <td>
                        <router-link :to="{ name: 'item-detail', params: {id: item.id}}">
                            {{item.name}}
                        </router-link>
                    </td>
                    <td><remove-cart-button :item-id="item.id"></remove-cart-button></td>
                    <td>{{cart[item.id]}}</td>
                    <td>${{(item.price * cart[item.id]).toFixed(2)}}</td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                    <td>Total:</td>
                    <td>${{total.toFixed(2)}}</td>
                </tr>
            </tbody>
        </table>
        <button @click="confirmPurchase" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#thanks-modal">Confirm Purchase</button>
        <div id="thanks-modal" class="modal" tabindex="-1" v-if="user">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thank you!</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Thank you for your purchase!</p>
                        <p>Your total was ${{lastTotal.toFixed(2)}}</p>
                    </div>
                    <div class="modal-footer">
                        <button @click="continueShopping" type="button" class="btn btn-primary" data-bs-dismiss="modal">Continue Shopping</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import RemoveCartButton from "./RemoveCartButton";
    import EventBus from "../../event-bus";

    export default {
        name: "ItemCart",
        components: {RemoveCartButton},
        props: ['user'],
        data() {
            return {
                cart: {},
                items: [],
                lastTotal: 0
            };
        },
        mounted() {
            this.cart = JSON.parse(this.$cookie.get('cart')) ?? {};
            this.getItems();
            let current = this;
            EventBus.$on('updateCart', function (cart, itemId) {
                if (! cart[itemId]) {
                    let index = current.items.findIndex((item) => item.id == itemId);
                    current.items.splice(index, 1);
                }
                current.cart = cart;
            });
        },
        methods: {
            confirmPurchase() {
                if (this.user) {
                    this.lastTotal = this.total;
                    this.$cookie.set('cart',JSON.stringify({}), 7);
                    EventBus.$emit('updateCart', {});
                    this.items = [];
                } else {
                    this.$router.push({name: 'login'});
                }
            },
            continueShopping() {
                this.$router.push({ name: 'items'});
            },
            getItems() {
                let current = this;
                let itemIds = Object.keys(this.cart);
                if (itemIds.length) {
                    let query = '';
                    // In this case, queryString is not used because of a bug preventing from stringifying arrays.
                    itemIds.forEach(function (id) {
                        query += ((query === '') ? '' : '&') + 'ids[]=' + id;
                    });
                    current.items = [];
                    axios.get('/api/items?limit=100&' + query)
                        .then(function (response) {
                            current.items = response.data.data;
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }
            }
        },
        computed: {
            total: function () {
                let total = 0;
                let current = this;
                this.items.forEach(function (item) {
                    total += item.price * current.cart[item.id];
                });
                return total;
            }
        }
    }
</script>
