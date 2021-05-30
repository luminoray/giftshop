<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'home'}">GiftShop</router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <template v-if="user">
                        <li class="nav-item">
                            <a @click="logout" class="nav-link active" aria-current="page" href="/logout">Logout</a>
                        </li>
                    </template>
                    <template v-else>
                        <li class="nav-item">
                            <router-link class="nav-link active" aria-current="page" :to="{name: 'login'}">Login</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link active" aria-current="page" :to="{name: 'register'}">Register</router-link>
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
                let current = this;
                axios.post('http://localhost/logout')
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
