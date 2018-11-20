<template>
    <div class="container">
        <div class="login row justify-content-center">
            <div class="col-md-8">
                <div class="card card-default">
                    <div class="card-header">login</div>
                    <div class="card-body">
                        <form @submit.prevent="authenticate">
                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
                                <div class="col-md-6">
                                    <input type="email" v-model="form.email" class="form-control" placeholder="Email Address">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">Password:</label>
                                <div class="col-md-6">
                                    <input type="password" v-model="form.password" class="form-control" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group row">
                                <input type="submit" class="btn btn-primary" value="Login">
                            </div>
                            <div class="form-group row" v-if="authError">
                                <p class="error">
                                    {{ authError }}
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import {login} from '../../helpers/auth';

    export default {
        name: "login",
        data() {
            return {
                form: {
                    email: '',
                    password: ''
                },
                error: null
            };
        },
        methods: {
            authenticate() {
                this.$store.dispatch('login');

                login(this.$data.form)
                    .then((res) => {
                        this.$store.commit("loginSuccess", res);
                        this.$router.push({path: '/'});
                    })
                    .catch((error) => {
                        this.$store.commit("loginFailed", {error});
                    });
            }
        },
        computed: {
            authError() {
                return this.$store.getters.authError;
            }
        }
    }
</script>

<style lang="scss" scoped>
.form-group{
    label {
        margin-left: 10px;
    }
    
    input.form-control, input[type="submit"]{
        margin: 0 10px;
    }

    input[type="submit"]{
        margin: 0 auto;
        width: 100px;
    }

    .error {
        margin: 0 auto;
        color: red;
    }
}
</style>
