<template>
    <div id="home">
        <h1>Welcome to GiftShop!</h1>
        <h2 class="mb-4">Here are some of our newly updated items.</h2>
        <item-list :compact="true" :limit="4"></item-list>
    </div>
</template>

<script>
    import ItemList from "./items/ItemList";

    export default {
        name: "Home",
        components: {ItemList}
    }
</script>
