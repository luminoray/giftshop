<template>
    <div id="item-list" class="row gx-3 gy-3">
        <select @change="updateUrl" class="form-select" v-model="categoryForm" v-if="! compact">
            <option value="0" selected="selected">All Categories</option>
            <option value="1">Uncategorized</option>
            <option value="2">Art</option>
            <option value="3">Cooking</option>
            <option value="4">Hobby</option>
            <option value="5">Technology</option>
        </select>
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" v-for="item in items">
            <div class="card">
                <router-link class="card-img-top d-flex justify-content-center align-items-center" :to="{ name: 'item-detail', params: {id: item.id}}">
                    <img :src="'/storage/items/' + item.file" alt="">
                </router-link>
                <div class="card-body">
                    <h5 class="card-title text-truncate">
                        {{ item.name }}
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">${{ item.price }}</h6>
                    <router-link class="btn btn-secondary" :to="{ name: 'item-detail', params: {id: item.id}}">Details</router-link>
                    <add-cart-button :item-id="item.id"></add-cart-button>
                </div>
            </div>
        </div>
        <div id="pagination" class="d-flex">
            <router-link v-if="previous" class="btn btn-primary flex-fill" :to="'/items?' + previous">Previous</router-link>
            <router-link v-if="next" class="btn btn-primary flex-fill" :to="'/items?' + next">Next</router-link>
        </div>
    </div>
</template>

<script>
    import AddCartButton from "./AddCartButton";
    const queryString = require('querystring');

    export default {
        name: "ItemList",
        components: {AddCartButton},
        props: ['user', 'compact', 'category', 'wait', 'limit'],
        data() {
            return {
                items: [],
                query: {},
                categoryForm: 0,
                previous: null,
                next: null
            };
        },
        mounted() {
            this.initialize();
            this.categoryForm = this.query.category ?? 0;
            if (! this.wait) {
                this.getItems();
            }
        },
        watch:{
            $route (to, from) {
                this.initialize();
                this.categoryForm = this.query.category ?? 0;
                if (! this.wait) {
                    this.getItems();
                }
            },
            category (to, from){
                if (this.category) {
                    this.query.category = this.category
                }
                this.getItems();
            }
        },
        methods: {
            initialize() {
                this.query = queryString.parse(document.location.search.replace('?', ''));
                this.query.category = this.query.category ?? this.category;
                this.query.limit = this.limit ?? null;
                if (! this.query.category) {
                    delete this.query.category;
                }
                if (! this.query.limit) {
                    delete this.query.limit;
                }
            },
            updateUrl() {
                this.initialize();
                this.query.category = this.categoryForm;
                delete this.query.page;
                this.$router.push('/items?' + queryString.stringify(this.query));
            },
            getItems() {
                let current = this;
                current.items = [];
                axios.get('/api/items?' + queryString.stringify(this.query))
                    .then(function (response) {
                        current.items = response.data.data;
                        current.previous = (response.data.prev_page_url ?? '').split('?').pop();
                        current.next = (response.data.next_page_url ?? '').split('?').pop();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style lang="scss" scoped>
.card-img-top {
    height: 200px;
    img {
        max-height: 100%;
        max-width: 100%;
    }
}
#pagination {
    gap: 12px;
}
</style>
