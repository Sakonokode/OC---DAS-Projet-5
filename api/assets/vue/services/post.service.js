import axios from 'axios';
import authHeader from './auth-header';

const API_URL = 'https://projet5.sakonokode.dev/api/posts';


class PostService {
    create(data) {
      return axios.post(API_URL, {
        title: data.title,
        content: data.content
      },
      {
        headers: authHeader()
      })
      .then(response => {
        return response.data;
      });
    }
    findAll() {
      return axios.get(API_URL, {
        headers: authHeader()
      });
    }
}

export default new PostService();
