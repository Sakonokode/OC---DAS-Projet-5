import axios from 'axios';

const API_LOGIN_URL = 'https://projet5.sakonokode.dev/api/login_check';
const API_REGISTER_URL = 'https://projet5.sakonokode.dev/api/register';

class AuthService {
  login(user) {
    return axios
      .post(API_LOGIN_URL, {
        username: user.username,
        password: user.password
      })
      .then(response => {
        if (response.data.token) {
          localStorage.setItem('token', JSON.stringify(response.data));
        }
        
        return response.data;
      });
  }

  logout() {
    console.log('logout est appelle')
    localStorage.removeItem('token');
  }

  register(user) {
    return axios.post(API_REGISTER_URL, {
      username: user.username,
      email: user.email,
      password: user.password
    });
  }
}

export default new AuthService();