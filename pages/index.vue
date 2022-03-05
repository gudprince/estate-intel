<template>
  <div class="container">

    <div class="text-center mt-4">
      <h4>You need to login to continue</h4>
      <div>
        <strong>Email:</strong> admin@exmaple.com
      </div>
      <div>
        <strong>Password:</strong> secret
      </div>
    </div>
    <div class="card mx-auto mt-4" style="width: 70%;">
      <div class="card-body">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" class="form-control" v-model="email">
          <span class="text-danger">{{emailError}}</span>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password</label>
          <input type="password" class="form-control" v-model="password">
          <span class="text-danger">{{passwordError}}</span>
        </div>
        <button type="submit" @click="login" class="btn gray text-white">Login</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'IndexPage',
  data(){
    return {
      email: '',
      password: '',
      passwordError: '',
      emailError:''
    }
  },
  methods: {
    login(){
      this.emailError = '';
      this.passwordError = '';
      if(this.email == 'admin@exmaple.com' && this.password == 'secret'){
        this.$cookies.set('isLogin', true, {
          path: '/',
          maxAge: 60 * 60 * 24 * 7
        })
        this.$router.push('shapes');
      }
      else{
        if(this.password !== 'secret'){
          this.passwordError = 'Password is incorrect'
        }
        if(this.email !== 'admin@exmaple.com'){
          this.emailError = 'Email Address is incorrect'
        }
      }
    }
    
  }
}
</script>
