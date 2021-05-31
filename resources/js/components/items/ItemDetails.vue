<template>
    <div id="item-details" class="row gx-5" v-show="Object.keys(item).length">
        <div id="item-photo" class="col-md-6 col-xl-7 d-flex justify-content-center align-items-center">
            <img v-if="item.file" class="mw-100 mh-50" :src="'/storage/items/' + item.file" alt="">
        </div>
        <div class="col-md-6 col-xl-5">
            <h2>{{ item.name }}</h2>
            <p class="mb-4 text-muted">Last updated: {{ item.updated_at }}</p>
            <p>{{ item.description }}</p>
            <p>Category: {{ item.category }}</p>
            <p class="fs-4">${{ item.price }}</p>
            <add-cart-button class="w-100 fs-3 mb-3" :item-id="item.id"></add-cart-button>
            <div id="admin-buttons" class="d-flex" v-if="user ? user.admin : false">
                <router-link class="btn btn-warning fs-5 flex-fill" :to="{name: 'item-edit', params: {id: id}}">Edit item</router-link>
                <button class="btn btn-danger fs-5 flex-fill" data-bs-toggle="modal" data-bs-target="#delete-modal">Delete item</button>
            </div>
        </div>
        <h3 class="mt-5">Related Items</h3>
        <item-list :compact="true" :category="category" :wait="true" :limit="4"></item-list>
        <div id="delete-modal" class="modal" tabindex="-1" v-if="user ? user.admin : false">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Delete item</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete this item? This cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button @click="deleteItem" type="button" class="btn btn-danger" data-bs-dismiss="modal">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import ItemList from "./ItemList";
    import AddCartButton from "./AddCartButton";

    export default {
        name: "ItemDetails",
        components: {AddCartButton, ItemList},
        props: ['id', 'user'],
        data() {
            return {
                item: {},
                category: undefined
            };
        },
        mounted() {
            this.getItem();
        },
        watch:{
            $route (to, from) {
                this.getItem();
            }
        },
        methods: {
            getItem() {
                let current = this;
                current.item = {};
                axios.get('/api/items/' + this.id)
                    .then(function (response) {
                        current.item = response.data;
                        current.category = response.data.category;
                    })
                    .catch(function (error) {
                        current.$router.replace({ name: 'items'});
                    });
            },
            deleteItem() {
                let current = this;
                axios.delete('/api/items/' + this.id)
                    .then(function (response) {
                        current.$router.push({ name: 'items'});
                    })
                    .catch(function (error) {
                        console.log(error);
                    })
            }
        }
    }
</script>

<style scoped lang="scss">
#admin-buttons {
    gap: 12px;
}
</style>
