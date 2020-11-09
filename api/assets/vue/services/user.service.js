import axios from 'axios';
import authHeader from './auth-header';

const API_URL = 'https://projet5.sakonokode.dev/api';

class UserService {
  findAllPosts() {
    return axios.get(API_URL, + '/posts', { headers: authHeader() });
  }

  getDocumentation() {
    return axios.get(API_URL + '/v1', { headers: authHeader() });
  }

  getModeratorBoard() {
    return axios.get(API_URL + 'mod', { headers: authHeader() });
  }

  getAdminBoard() {
    return axios.get(API_URL + 'admin', { headers: authHeader() });
  }
}

export default new UserService();
