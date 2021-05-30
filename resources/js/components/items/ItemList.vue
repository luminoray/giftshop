<template>
    <div id="item-list">
        Welcome {{ this.user.name }}!
    </div>
</template>

<script>
    export default {
        name: "ItemList.vue",
        props: ['user']
    }
</script>
