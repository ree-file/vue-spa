import JwtToken from './../../helpers/Jwt'
export default {
  actions : {
    loginRequest({dispatch},formData){
      return axios.post('/api/login',formData).then(response=>{
        JwtToken.setToken(response.data.token);
        dispatch('setAuthUser');
      }).catch(error=>{
        console.log(error.response.data);
      })
    },
    loginoutRequest({dispatch}){
      return axios.post('/api/loginout').then(response=>{
        dispatch('unsetAuthUser');
      })
    }

  }
}
