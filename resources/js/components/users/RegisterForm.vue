<template>
    <div id="register">
        <h1>Register</h1>
        <form @submit="register">
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" type="text" v-model="name" placeholder="John Doe" maxlength="30">
            </div>
            <div class="mb-3">
                <label class="form-label">E-Mail</label>
                <input class="form-control" type="text" v-model="email" placeholder="email@domain.com" maxlength="50">
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input class="form-control" type="password" v-model="password" placeholder="********" minlength="8">
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input class="form-control" type="password" v-model="password_confirmation" placeholder="********" minlength="8">
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit">Register</button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    name: "RegisterForm.vue",
    data() {
        return {
            name: '',
            email: '',
            password: '',
            password_confirmation: ''
        };
    },
    methods: {
        register(e) {
            e.preventDefault();
            let current = this;
            axios.post('http://localhost/register', {
                name: this.name,
                email: this.email,
                password: this.password,
                password_confirmation: this.password_confirmation
            })
                .then(function (response) {
                    if (response.status == 201) {
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
