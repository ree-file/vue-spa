<template >
  <form class="form-horizontal" @submit.prevent="register">
    <div class="form-group" :class="{'has-error' : errors.has('name')}">
      <label for="name" class="col-md-4 control-label">用户名</label>
      <div class="col-md-6">
        <input
        v-validate data-vv-rules="required|min:4" data-vv-as="名称"
        type="text" id="name" class="form-control" name="name"
        required>
        <span class="help-block"v-show="errors.has('name')">{{errors.first('name')}}</span>
      </div>
    </div>
    <div class="form-group":class="{'has-error' : errors.has('email')}">
      <label for="email" class="col-md-4 control-label">邮箱</label>
      <div class="col-md-6">
        <input
         v-validate data-vv-rules="required|email" data-vv-as="邮箱"
         id="email"type="email" name="email" class="form-control"
         required>
        <span class="help-block"v-show="errors.has('email')">{{errors.first('email')}}</span>
      </div>
    </div>
    <div class="form-group" :class="{'has-error' : errors.has('password')}">
      <label for="password" class="col-md-4 control-label">密码</label>
      <div class="col-md-6">
        <input
        v-validate data-vv-rules="required|min:6" data-vv-as="密码"
        id ="password" type="password" name="password" class="form-control"
         required>
        <span class="help-block"v-show="errors.has('password')">{{errors.first('password')}}</span>

      </div>
    </div>
    <div class="form-group" :class="{'has-error' : errors.has('password-confirm')}">
      <label for="password-confirm" class="col-md-4 control-label">确认密码</label>
      <div class="col-md-6">
        <input
         v-validate data-vv-rules="required|min:6|confirmed:password" data-vv-as="确认密码" 
         id="password-confirm"type="password" name="password-confirm" class="form-control"
          required>
        <span class="help-block"v-show="errors.has('password-confirm')">{{errors.first('password-confirm')}}</span>

      </div>
    </div>
    <div class="form-group">
      <div class="col-md-6 col-md-offset-4">
        <button type="submit"class="btn btn-primary">
          注册
        </button>
      </div>
    </div>
  </form>
</template>
<script>
  export default{
    data(){
      return{
        name : '',
        email : '',
        password : ""
      }
    },
    methods:{
      register(){
        let formData = {
          name : this.name,
          email : this.email,
          password : this.password
        }
        axios.post('/api/register',formData).then(response=>{
          this.$router.push({name:'confirm'})
        })
      }
    }
  }
</script>
