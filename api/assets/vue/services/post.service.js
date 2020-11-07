import axios from 'axios';
import authHeader from './auth-header';

const API_URL = 'https://projet5.sakonokode.dev/api/posts/';

class PostService {
    create(message) {
      return axios.post(API_URL, {
        headers: authHeader(),
        message: message,
      });
    }
}

export default new UserService();
