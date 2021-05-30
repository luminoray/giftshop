<template>
    <div id="item-create">
        <h1>Item Creation</h1>
        <form @submit="createItem">
            <div class="mb-3">
                <label class="form-label">Upload photo</label>
                <input @change="updateFile" class="form-control" type="file" ref="file">
            </div>
            <div class="mb-3">
                <label class="form-label">Item Name</label>
                <input class="form-control" type="text" v-model="name" placeholder="Teapot 418" maxlength="50">
            </div>
            <div class="mb-3">
                <label class="form-label">Price</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">$</span>
                    <input class="form-control" type="text" v-model="price" placeholder="4.18">
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select class="form-select" v-model="category">
                    <option value="0" selected="selected">Uncategorized</option>
                    <option value="1">Art</option>
                    <option value="2">Cooking</option>
                    <option value="3">Hobby</option>
                    <option value="4">Technology</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" v-model="description"></textarea>
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Create</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ItemCreateForm",
        data() {
            return {
                file: undefined,
                name: '',
                price: 0,
                category: 0,
                description: ''
            };
        },
        methods: {
            updateFile() {
                this.file = this.$refs.file.files[0];
            },
            createItem(e) {
                e.preventDefault();
                let formData = new FormData;
                formData.append('file', this.file);
                formData.append('name', this.name);
                formData.append('price', this.price);
                formData.append('category', this.category);
                formData.append('description', this.description);
                axios.post('http://localhost/api/items', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(function (response) {

                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>

<style scoped>

</style>
