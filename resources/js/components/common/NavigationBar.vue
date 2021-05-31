<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'home'}">GiftShop</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <router-link class="nav-link active" :to="{name: 'items'}">Shop</router-link>
                    </li>
                    <li class="nav-item" v-if="user ? user.admin : false">
                        <router-link class="nav-link active" :to="{name: 'item-create'}">Add Item</router-link>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li v-if="user" class="nav-item">
                        <a @click="logout" class="nav-link active" href="/logout">Logout</a>
                    </li>
                    <template v-else>
                        <li class="nav-item">
                            <router-link class="nav-link active" :to="{name: 'login'}">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link active" :to="{name: 'register'}">Register</router-link>
                        </li>
                    </template>
                </ul>
            </div>

        </div>
    </nav>
</template>

<script>
    export default {
        name: "NavigationBar",
        props: ["user"],
        methods: {
            logout(e) {
                e.preventDefault();
                axios.post('/logout')
                    .then(function (response) {
                        if (response.status == 204) {
                            window.location.reload();
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
