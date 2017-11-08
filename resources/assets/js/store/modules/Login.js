import JwtToken from './../../helpers/Jwt'
export default {
  actions : {
    loginRequest({dispatch},formData){
      axios.post('/api/login',formData).then(response=>{
        JwtToken.setToken(response.data.token);
        dispatch('setAuthUser');
      }).catch(error=>{
        console.log(error.response.data);
      })
    }

  }
}
