<template>
    <div id="login">
        <h1>Login</h1>
        <form @submit="login">
            <div class="mb-3">
                <label class="form-label">E-Mail</label>
                <input class="form-control" type="text" v-model="email" placeholder="email@domain.com" maxlength="50">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" v-model="password" placeholder="password">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Login</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "LoginForm.vue",
        data() {
            return {
                email: '',
                password: ''
            };
        },
        methods: {
            login(e) {
                e.preventDefault();
                let current = this;
                axios.post('http://localhost/login', {
                    email: this.email,
                    password: this.password
                })
                    .then(function (response) {
                        if (response.status == 200) {
                            window.location.href = '/';
                        }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
