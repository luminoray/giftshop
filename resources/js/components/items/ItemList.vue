<template>
    <div id="item-list" class="row gx-3 gy-3">
        <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3" v-for="item in items">
            <div class="card">
                <div class="card-img-top d-flex justify-content-center align-items-center">
                    <img :src="'/storage/items/' + item.file" alt="">
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{ item.name }}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">${{ item.price }}</h6>
                    <button class="btn btn-primary">Add to cart</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "ItemList.vue",
        props: ['user'],
        data() {
            return {
                items: [],
            };
        },
        mounted() {
            this.getItems();
        },
        methods: {
            getItems() {
                let current = this;
                current.items = [];
                axios.get('http://localhost/api/items')
                    .then(function (response) {
                        current.items = response.data.data;
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
    height: 150px;
    img {
        max-height: 100%;
        max-width: 100%;
    }
}
</style>
