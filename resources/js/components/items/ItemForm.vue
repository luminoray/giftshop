<template>
    <div id="item-submit">
        <h1>Item Submission</h1>
        <form @submit="submitItem">
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
                <button class="btn btn-primary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "ItemForm",
        props: ['id'],
        data() {
            return {
                file: '',
                name: '',
                price: 0,
                category: 0,
                description: ''
            };
        },
        mounted() {
            if (this.id) {
                this.getItem();
            }
        },
        methods: {
            updateFile() {
                this.file = this.$refs.file.files[0];
            },
            getItem() {
                let current = this;
                current.item = {};
                axios.get('/api/items/' + this.id)
                    .then(function (response) {
                        current.name = response.data.name;
                        current.price = response.data.price;
                        current.category = response.data.category;
                        current.description = response.data.description;
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            submitItem(e) {
                e.preventDefault();
                if (this.id) {
                    this.updateItem();
                } else {
                    this.createItem();
                }
            },
            updateItem(e) {
                let current = this;
                let formData = new FormData;
                formData.append('_method', 'PUT');
                formData.append('file', this.file);
                formData.append('name', this.name);
                formData.append('price', this.price);
                formData.append('category', this.category);
                formData.append('description', this.description);
                axios.post('/api/items/' + this.id, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(function (response) {
                        current.$router.push({ name: 'item-detail', params: {id: current.id}});
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            createItem(e) {
                let current = this;
                let formData = new FormData;
                formData.append('file', this.file);
                formData.append('name', this.name);
                formData.append('price', this.price);
                formData.append('category', this.category);
                formData.append('description', this.description);
                axios.post('/api/items', formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                    .then(function (response) {
                        current.$router.push({ name: 'item-detail', params: {id: response.data.id}});
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
