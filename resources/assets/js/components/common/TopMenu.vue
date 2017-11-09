<template>
  <nav class="navbar navbar-default navbar-static-top">
    <div class="contains">
      <div class="navbar-header">
        <router-link to="/" class="navbar-brand">Vue-SPA</router-link>
      </div>
      <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
          <router-link v-if="!user.authenticated" to="/login" tag="li">
            <a>登录</a>
          </router-link>
          <router-link v-if="!user.authenticated" to="/register" tag="li">
            <a>注册</a>
          </router-link>
          <router-link v-if="user.authenticated" to="/profile" tag="li">
            <a>个人中心</a>
          </router-link>
          <li v-if="user.authenticated">
            <a href="#" @click.prevent="loginout">退出登录</a>
          </li>
        </ul>

      </div>
    </div>
  </nav>
</template>
  <script>
    import {mapState} from 'vuex'
    export default{
      computed:{
        ...mapState({
          user:state => state.AuthUser
        })
      },
      methods:{
        loginout(){
          this.$store.dispatch('loginoutRequest').then(response=>{
            this.$router.push({name:'Home'});
          });
        }
      }
    }
  </script>
