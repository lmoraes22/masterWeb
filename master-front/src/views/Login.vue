<template>
  <div class="login">
    <div class="d-flex justify-content-center p-4">
      <div class="card d-flex justify-content-center py-4 rounded-3" style="width: 24rem;">
        <main class="form-signin w-100 m-auto">
          <form @submit.stop.prevent="login">
            <h1>Login</h1>
            <div class="form-floating">
              <input v-model="email" name="email" type="email" class="form-control" id="floatingInput"
                     placeholder="name@example.com">
              <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
              <input v-model="password" name="password" type="password" class="form-control" id="floatingPassword"
                     placeholder="Password">
              <label for="floatingPassword">Password</label>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Login</button>
          </form>
        </main>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';
import Cookie from 'js-cookie';
import router from "@/router";

export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: '',
    }
  },
  methods: {
    login() {
      let params = JSON.stringify({
        "email": this.email,
        "password": this.password,
      });
      axios.post(process.env.VUE_APP_ROOT_API + 'login', params, {
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
        },
      })
      .then(response => {
        this.$swal.fire({
          icon: 'success',
          title: 'Login realizado com sucesso!',
          showConfirmButton: false,
          timer: 3000
        });
        Cookie.set('_masterWeb_token', response.data.access_token);
        router.push({path: '/'});
      })
      .catch(error => {
        this.$swal.fire({
          icon: 'error',
          html: '<h3>Ops, tivemos problemas!</h3><small><a href="#">Clique aqui e entre em contato com nosso suporte para mais informações!</a></small>',
          showConfirmButton: false,
          timer: 3000
        });
        console.log(error)
      });
    }
  }
}
</script>

<style>
.form-signin {
  max-width: 330px;
  padding: 1rem;
}

.form-signin .form-floating:focus-within {
  z-index: 2;
}

.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}

.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>